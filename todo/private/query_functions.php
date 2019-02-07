<?php  
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
// CRUD FOR TO DO LIST
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
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
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
// CRUD FOR USERS
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
function find_all_users() {
	global $db; // makes db-connection

	$sql = "SELECT * FROM users ";
	$sql .= "ORDER BY username ASC";
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	return $result;
}
function find_user_by_id($id) {
	global $db;

	$sql = "SELECT * FROM users ";
	$sql .= "WHERE id='" . db_escape($db, $id) . "' ";
	$sql .= "LIMIT 1";
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$user = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	return $user; // returns assoc. array
}
function find_user_by_username($username) {
	global $db;

	$sql = "SELECT * FROM users ";
	$sql .= "WHERE username='" . db_escape($db, $username) . "' ";
	$sql .= "LIMIT 1";
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$user = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	return $user; // returns assoc. array
}
function validate_user($user, $current_password=1) { //new

	// username section
	if(is_blank($user['username'])) {
		$errors[] = "Username cannot be blank.";
	} elseif(!has_length($user['username'], ['min' => 3, 'max' => 50])) {
		$errors[] = "Username must be between 4 and 50 characters.";
	} elseif (!has_unique_username($user['username'], $user['id'] ?? 0)) {
		$errors[] = "Username not allowed. Try another.";
	}
	// password section

	//new
	if(is_blank($current_password)) {
		$errors[] = "Current password cannot be blank.";
	}

	if(is_blank($user['password'])) {
		$errors[] = "Password cannot be blank.";
	} elseif(!has_length($user['password'], ['min' => 5])) {
		$errors[] = "Password must have at least 6 characters.";
	}
	if(is_blank($user['confirm_password'])) {
		$errors[] = "Confirm password cannot be blank.";
	} elseif ($user['password'] !== $user['confirm_password']) {
		$errors[] = 'Password and confirm password must match.';
	}

	// new
	// if errors not empty
	if(!empty($errors)) {
		return $errors;
	// if there're no errors
	} else {
		// if currentpassword not equal 1; in other words if user is trying to change the current pw
		if($current_password!==1) {

			$username = $user['username'];
			$user_from_db = find_user_by_username($username); // assoc. array

			// if current pw same as pw in db
			if(password_verify($current_password, $user_from_db['hashed_password'])) {
				// return empty errors array
				return $errors;
			} else {
				// current pw doesn't match
				$errors[] = "Password change unsuccessful.";
				return $errors;
			}
		// if current user is trying to register (and not change pw)
		} else {
			// return empty errors array
			return $errors;
		}
	}
}
function insert_user($user) {
	global $db;

	$errors = validate_user($user);
	if(!empty($errors)) {
		return $errors;
	}

	$hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

	$sql = "INSERT INTO users ";
	$sql .= "(username, hashed_password) ";
	$sql .= "VALUES (";
	$sql .= "'" . db_escape($db, $user['username']) . "',";
	$sql .= "'" . db_escape($db, $hashed_password) . "'";
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
function update_user($user, $current_password) {
	global $db;

	$errors = validate_user($user, $current_password);

	if(!empty($errors)){
		return $errors;
	}

	$hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

	$sql = "UPDATE users SET ";
	$sql .= "hashed_password='" . db_escape($db, $hashed_password) . "' ";
	$sql .= "WHERE id='" . db_escape($db, $user['id']) . "' ";
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
function delete_user($id) {
	global $db;

	$sql = "DELETE FROM users ";
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