<?php
$value = $_POST['search'];
$sleep_val = $_COOKIE['timer_val'];

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

// Splitting the string into two values
$split_values = explode(':', $value);
$name = $split_values[0]; // First part before the ':'
$ticker = $split_values[1]; // Second part after the ':'

$name = urlencode($name);
$ticker = urlencode($ticker);

sleep($sleep_val);

$url = "http://quordata.com/search_results.php?q=$name";
if (!empty($ticker)) {
    $url .= "&t=$ticker";
}

header("location: $url");
exit();

?>