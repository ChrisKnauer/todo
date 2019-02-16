<?php

require_once('../private/initialize.php');

require_login();

$page_title = 'Passwort ändern';
$h2 = 'Passwort ändern';
include(SHARED_PATH . '/header_login.php');

if(is_post_request()) {

	$current_password = $_POST['current_password'];

	if(is_blank($current_password)) {
		$errors[] = "Aktuellen Passwort kann nicht leer sein.";
		//var_dump($errors);
	}

	$user = [];
	$user['id'] = $_SESSION['user_id'];
	$user['username'] = $_SESSION['username'];
	$user['password'] = $_POST['password'] ?? '';
	$user['confirm_password'] = $_POST['confirm_password'] ?? '';

	$result = update_user($user, $current_password);
	if($result === true) {
		$_SESSION['message'] = 'Passwort geändert.';
		header("Location: " . WWW_ROOT . "/show_user.php");
	} else {
		$errors = $result;
	}
}

?>


<?php echo display_errors($errors); ?>

<form style="text-align: right;" action="<?php echo WWW_ROOT . '/edit_user.php';  ?>" method="post">
	<input type="password" name="current_password" placeholder="Aktuelles Passwort">
	<input type="password" name="password" placeholder="Neues Passwort">
	<input type="password" name="confirm_password" placeholder="Bestätigen">
	<input class="button" type="submit" value="Passwort ändern">
</form>



<?php include(SHARED_PATH . '/footer.php'); ?>