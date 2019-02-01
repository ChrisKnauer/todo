<?php  

function find_all_items() {
	global $db; // makes db-connection

	$sql = "SELECT * FROM items";
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	return $result;
}
function find_item_by_id($id) {
	global $db;

	$sql = "SELECT * FROM items ";
	$sql .= "WHERE id='" . db_escape($db, $id) . "'";
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$item = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	return $item; // returns assoc. array
}
function validate_item($description) {
	$errors = [];

	if(is_blank($description)) {
		$errors[] = "Description cannot be blank.";
	} elseif(!has_length($description, ['min' => 2, 'max' => 50])) {
		$errors[] = "Description must be between 2 and 50 characters.";
	}

	return $errors;
}
function insert_item($description) {
	global $db;

	$errors = validate_item($description);
	if(!empty($errors)) {
		return $errors;
	}

	$sql = "INSERT INTO items ";
	$sql .= "(description) ";
	$sql .= "VALUES (";
	$sql .= "'" . db_escape($db, $description) . "'";
	$sql .= ")";
	$result = mysqli_query($db, $sql); // For INSERT statements, $result is true/false
	if($result) {
		return true;
	} else {
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}
function update_item($item) {
	global $db;

	$errors = validate_item($item['description']);
	if(!empty($errors)){
		return $errors;
	}

	$sql = "UPDATE items SET ";
	$sql .= "description='" . db_escape($db, $item['description']) . "' ";
	$sql .= "WHERE id='" . db_escape($db, $item['id']) . "' ";
	$sql .= "LIMIT 1";

	$result = mysqli_query($db, $sql);
	
	if($result) {
		return true;
	} else {
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}
function delete_item($id) {
	global $db;

	$sql = "DELETE FROM items ";
	$sql .= "WHERE id='" . db_escape($db, $id) . "' ";
	$sql .= "LIMIT 1";

	$result = mysqli_query($db, $sql);

	if($result) {
		return true;
	} else {
		echo mysqli_error($db);
		db_disconnect($db);
		exit;
	}
}