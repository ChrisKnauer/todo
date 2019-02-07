<?php

function log_in_user($user) {
	session_regenerate_id();
	$_SESSION['user_id'] = $user['id'];
	$_SESSION['last_login'] = time();
	$_SESSION['username'] = $user['username'];
	return true;
}

function is_logged_in() {
	return isset($_SESSION['user_id']);
}

function require_login() {
	if(!is_logged_in()) {
		header("Location: " . WWW_ROOT . "/index.php");
	} else {
		// do nothing, let rest of page proceed
	}
}