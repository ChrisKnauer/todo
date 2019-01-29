<?php

// always use htmlspecialchars before you drop dynamic data onto your page!
function h($string="") {
	return htmlspecialchars($string);
}
function is_post_request() {
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}