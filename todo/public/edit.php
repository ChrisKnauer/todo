<?php

// set default id if no id is sent
if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	$id = 1;
}

echo $id;