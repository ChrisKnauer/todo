<?php  

function find_all_items() {
	global $db;

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