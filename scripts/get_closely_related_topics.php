<?php
// Retrieve the request body
$requestBody = json_decode(file_get_contents('php://input'), true);

// Validate and sanitize the input
$userQuery = isset($requestBody['userQuery']) ? trim($requestBody['userQuery']) : '';
$topics = isset($requestBody['topics']) ? $requestBody['topics'] : [];

// Validate query_id and topics
if (empty($userQuery) || !is_array($topics)) {
  http_response_code(400);
  echo json_encode(array('message' => 'Invalid request'));
  exit;
}

// Clean up the topics array (trim and escape values if necessary)
$cleanedTopics = array_map(function ($topic) {
  return trim($topic); // Adjust as per your requirements
}, $topics);

try {
  // Establish the database connection using PDO
  $host = 'localhost';
  $dbname = 'saddlnts_quordata';
  $username = 'saddlnts_bcollin';
  $dbpassword = 'r^isHk6xFL4G2pEoZb9k';

  $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $dbpassword);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepare and execute the query to retrieve query_id based on userQuery
  $stmt = $connection->prepare("SELECT query_id FROM queries WHERE name = ?");
  $stmt->execute([$userQuery]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  // Check if a matching query_id was found
  if (!$row) {
    http_response_code(404);
    echo json_encode(array('message' => 'Query not found', 'query' => $userQuery));
    exit();
  }

  $queryId = $row['query_id'];

  // Retrieve existing topics for the query_id
  $existingTopics = [];
  $selectExistingQuery = "SELECT topic_name FROM closely_related_topics WHERE query_id = :queryId";
  $selectExistingStatement = $connection->prepare($selectExistingQuery);
  $selectExistingStatement->bindParam(':queryId', $queryId, PDO::PARAM_STR);
  $selectExistingStatement->execute();
  $existingTopicsRows = $selectExistingStatement->fetchAll(PDO::FETCH_COLUMN);
  foreach ($existingTopicsRows as $row) {
    $existingTopics[] = trim($row);
  }

  // Filter out duplicate topics from the new topics array
  $uniqueTopics = array_values(array_diff($cleanedTopics, $existingTopics));

  // Delete the oldest topics if more than 6 exist
$maxTopics = 6;
$deleteCount = count($existingTopics) + count($uniqueTopics) - $maxTopics;
if ($deleteCount > 0) {
  // Create a temporary table
$tempTableName = 'temp_topics';
$createTempTableQuery = "CREATE TEMPORARY TABLE $tempTableName (topic_name VARCHAR(255), timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";
$connection->exec($createTempTableQuery);

// Insert existing and new topics into the temporary table
$insertTempQuery = "INSERT INTO $tempTableName (topic_name) VALUES (:topicName)";
$insertTempStatement = $connection->prepare($insertTempQuery);
foreach ($existingTopics as $topic) {
  $insertTempStatement->bindValue(':topicName', $topic, PDO::PARAM_STR);
  $insertTempStatement->execute();
}
foreach ($uniqueTopics as $topic) {
  $insertTempStatement->bindValue(':topicName', $topic, PDO::PARAM_STR);
  $insertTempStatement->execute();
}

// Retrieve the oldest topics using the temporary table
$oldestTopicsQuery = "SELECT topic_name FROM $tempTableName WHERE topic_name IN (SELECT topic_name FROM closely_related_topics WHERE query_id = :queryId) ORDER BY timestamp ASC";
$oldestTopicsStatement = $connection->prepare($oldestTopicsQuery);
$oldestTopicsStatement->bindParam(':queryId', $queryId, PDO::PARAM_STR);
$oldestTopicsStatement->execute();
$oldestTopics = $oldestTopicsStatement->fetchAll(PDO::FETCH_COLUMN);

// Delete the oldest topics
$deleteQuery = "DELETE FROM closely_related_topics WHERE query_id = :queryId AND topic_name IN (";
$deleteParams = [];
$deleteParams[':queryId'] = $queryId;

$placeholders = [];
foreach ($oldestTopics as $index => $topic) {
  $placeholders[] = ":topic{$index}";
  $deleteParams[":topic{$index}"] = $topic;
}

$deleteQuery .= implode(", ", $placeholders) . ")";
$deleteStatement = $connection->prepare($deleteQuery);
$deleteStatement->execute($deleteParams);

// Drop the temporary table
$dropTempTableQuery = "DROP TEMPORARY TABLE IF EXISTS $tempTableName";
$connection->exec($dropTempTableQuery);
}

  // Insert new topics
if (!empty($uniqueTopics)) {
  $insertQuery = "INSERT INTO closely_related_topics (query_id, topic_name, timestamp) VALUES ";
  $insertValues = [];
  $currentTime = date('Y-m-d H:i:s');

  foreach ($uniqueTopics as $topic) {
    $insertValues[] = [
      'queryId' => $queryId,
      'topicName' => $topic,
      'createdAt' => $currentTime,
    ];
  }

  $valuePlaceholders = [];
  $bindParams = [];
  
  foreach ($insertValues as $key => $value) {
    $valuePlaceholders[] = "(:queryId{$key}, :topicName{$key}, :createdAt{$key})";
    $bindParams[":queryId{$key}"] = $value['queryId'];
    $bindParams[":topicName{$key}"] = $value['topicName'];
    $bindParams[":createdAt{$key}"] = $value['createdAt'];
  }

  $insertQuery .= implode(", ", $valuePlaceholders);

  $insertStatement = $connection->prepare($insertQuery);
  $insertStatement->execute($bindParams);
}
  // Retrieve the updated list of closely related topics
  $selectQuery = "SELECT topic_name FROM closely_related_topics WHERE query_id = :queryId ORDER BY timestamp DESC LIMIT :maxTopics";
  $selectStatement = $connection->prepare($selectQuery);
  $selectStatement->bindParam(':queryId', $queryId, PDO::PARAM_STR);
  $selectStatement->bindParam(':maxTopics', $maxTopics, PDO::PARAM_INT);
  $selectStatement->execute();
  $relatedTopics = $selectStatement->fetchAll(PDO::FETCH_COLUMN);

  echo json_encode($relatedTopics);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(array('message' => 'Failed to retrieve closely related topics: ' . $e->getMessage()));
}


// Close the database connection
$connection = null;
?>
