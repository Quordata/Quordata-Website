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

sleep($sleep_val);

header("location: http://quordata.com/Beta_$value");

?>