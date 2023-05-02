<?php
$value = $_POST['search'];
$sleep_val = $_COOKIE['timer_val'];

$queries = array('Amazon', 'Boeing', 'Lowes', 'McDonalds', 'Nvidia', 'Pfizer', 'Salesforce', 'Starbucks', 'Tesla', 'Walmart');

// If string is empty, do nothing
if (empty($value)) {
	return;
}

$value = strtolower($value);

if (strcmp($value, "mcdonalds") == 0)
	$value = "McDonalds";
else {
	$value = ucwords($value);
}

sleep($sleep_val);

if (in_array($value, $queries)) {
	header("location: http://quordata.com/Beta_$value");
	exit();
} else {
	$query = $_GET['q'];
	header("location: http://quordata.com/search_results.php?q=$value");
	exit();
}

?>