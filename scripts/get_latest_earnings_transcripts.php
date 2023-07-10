<?php
// Get the values of the URL parameters
$q = $_GET['q']; // query name
$t = isset($_GET['t']) ? $_GET['t'] : null; // ticker (optional)

// Connect to the database (assuming you have a MySQL connection)
$host = 'localhost';
$dbname = 'saddlnts_quordata';
$username = 'saddlnts_bcollin';
$dbpassword = 'r^isHk6xFL4G2pEoZb9k';

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $dbpassword);

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the company_id using the ticker (if provided), otherwise use the query name
    if ($t) {
        $sql = "SELECT company_id FROM companies WHERE ticker = :ticker";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ticker', $t);
    } else {
        $sql = "SELECT company_id FROM companies WHERE name = :query";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':query', $q);
    }

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
		$company_id = $result["company_id"];

        // Retrieve the latest transcript for the company
        $sql = "SELECT quarter, year, transcript, summary, sentiment FROM earnings_calls WHERE company_id = :company_id ORDER BY year DESC, quarter DESC LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':company_id', $company_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $quarter = $result["quarter"];
            $year = $result["year"];
            $transcript = $result["transcript"];
			$summary = $result["summary"];
			$sentiment = $result["sentiment"];

            // Prepare the response as JSON
            $response = array(
                'query' => $q,
                'ticker' => $t,
                'quarter' => $quarter,
                'year' => $year,
                'transcript' => $transcript,
				'summary' => $summary,
				'sentiment' => $sentiment
            );

            // Set the response header as JSON
            header('Content-Type: application/json');

            // Send the response as JSON
            echo json_encode($response);
        } else {
            $response = array(
				'error' => true,
				'query' => $q
			);
			header('Content-Type: application/json');
			echo json_encode($response);
        }
    } else {
		$response = array(
			'error' => true,
			'query' => $q
		);
		header('Content-Type: application/json');
		echo json_encode($response);
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
