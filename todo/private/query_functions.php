<?php  

function find_all_items() {
	global $db; // makes db-connection

	$sql = "SELECT * FROM items";
	$result = mysqli_query($db, $sql);
	return $result;
}
function find_item_by_id($id) {
	global $db;

	$sql = "SELECT * FROM items ";
	$sql .= "WHERE id='" . $id . "'";
	$result = mysqli_query($db, $sql);
	$item = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	return $item; // returns assoc. array
}
function insert_item($description) {
	global $db;

	$sql = "INSERT INTO items ";
	$sql .= "(description) ";
	$sql .= "VALUES (";
	$sql .= "'" . $description . "'";
	$sql .= ")";
	$result = mysqli_query($db, $sql); // For INSERT statements, $result is true/false
	if($result) {
		return true;
	}
}
function update_item($item) {
	global $db;

	$sql = "UPDATE items SET ";
	$sql .= "description='" . $item['description'] . "' ";
	$sql .= "WHERE id='" . $item['id'] . "' ";
	$sql .= "LIMIT 1";

	$result = mysqli_query($db, $sql);
	
	if($result) {
		return true;
	}
}