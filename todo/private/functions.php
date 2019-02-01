<?php

// always use htmlspecialchars before you drop dynamic data onto your page!
function h($string="") {
	return htmlspecialchars($string);
}
function is_post_request() {
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function display_errors($errors=array()) {
	$output = '';
	if(!empty($errors)) {
		$output = "Please fix the following errors:<br>";
		$output .= "<ul>";
		foreach ($errors as $error) {
			$output .= "<li>" . h($error) . "</li>";
		}
		$output .= "</ul>";
	}
	return $output;
}