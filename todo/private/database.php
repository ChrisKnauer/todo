<?php  // db related functions

require_once('db_credentials.php');

function db_connect() {
	$connect = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	return $connection;
}

function db_disconnect($connection) {
	// if there's a connection, close it, else no need to
	if(isset($connection)) {
		mysqli_close($connection);
	}
}