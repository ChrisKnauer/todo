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
		$output = "<div class='message message_errors'> Bitte korrigieren Sie folgende Fehler:<br><br>";
		$output .= "<ul>";
		foreach ($errors as $error) {
			$output .= "<li>" . h($error) . "</li>";
		}
		$output .= "</ul></div>";
	}
	return $output;
}
function get_and_clear_session_message() {
	if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
		$msg = $_SESSION['message'];
		unset($_SESSION['message']);
		return $msg;
	}
}
function display_session_message() {
	$msg = get_and_clear_session_message();
	if(!is_blank($msg)) {
		return '<div class="message">' . h($msg). '</div>';
	}
}