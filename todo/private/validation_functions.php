<?php

function is_blank($value) {
	return !isset($value) || trim($value) === '';
}

// reverse of is_blank()
// I prefer validation names with "has_"
function has_presence($value) {
	return !is_blank($value);
}

function has_length_greater_than($value, $min) {
	$length = strlen($value);
	return $length > $min;
}

function has_length_less_than($value, $max) {
	$length = strlen($value);
	return $length < $max;
}

function has_length_exactly($value, $exact) {
	$length = strlen($value);
	return $length == $exact;
}

// validate string length
// combines functions_greater_than, _less_than, _exactly
// $options is an assoc. array: ['min' => 3, 'max' => 5]
function has_length($value, $options) {
// if min-option is set && value not greater than min --> return false
	if (isset($options['min']) && ! has_length_greater_than($value, $options['min'])) {
		return false;
// if max-option is set && value not less than max --> return false
	} elseif (isset($options['max']) && ! has_length_less_than($value, $options['max'])) {
		return false;		
// if exact-option is set && value not exactly as long --> return false
	} elseif (isset($options['exact']) && ! has_length_exactly($value, $options['exact'])) {
		return false;
// if non of above conditions return false --> return true
	} else {
		return true;
	}
}

// $set is an array: [1,3,5,7,9]
function has_inclusion_of($value, $set) {
	return in_array($value, $set);
}

// $set is an array: [1,3,5,7,9]
function has_exclustion_of($value, $set) {
	return !in_array($value, $set);
}

// uses !== to prevent position 0 from being considered false
function has_string($value, $required_string) {
	return strpos($value, $required_string) !== false; 
}

function has_valid_email_format($value) {
	$email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
	return preg_match($email_regex, $value) === 1;
}
function has_unique_username($username, $current_id="0") {
	global $db;

	$sql = "SELECT * FROM users ";
	$sql .= "WHERE username='" . db_escape($db, $username) . "' ";
	$sql .= "AND id != '" . db_escape($db, $current_id) . "'";

	$result = mysqli_query($db, $sql);
	$admin_count = mysqli_num_rows($result);
	mysqli_free_result($result);

	return $admin_count === 0;
}