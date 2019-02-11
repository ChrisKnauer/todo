<?php

require_once('../private/initialize.php');

require_login();

$page_title = 'EDIT USER';
$h2 = 'Edit password';
include(SHARED_PATH . '/header_login.php');

if(is_post_request()) {

	$current_password = $_POST['current_password'];

	if(is_blank($current_password)) {
		$errors[] = "Current password cannot be blank.";
		//var_dump($errors);
	}

	$user = [];
	$user['id'] = $_SESSION['user_id'];
	$user['username'] = $_SESSION['username'];
	$user['password'] = $_POST['password'] ?? '';
	$user['confirm_password'] = $_POST['confirm_password'] ?? '';

	$result = update_user($user, $current_password);
	if($result === true) {
		$_SESSION['message'] = 'Password updated.';
		header("Location: " . WWW_ROOT . "/show_user.php");
	} else {
		$errors = $result;
			//var_dump($errors);
	}
}

?>


<div id="content">

	<?php echo display_errors($errors); ?>

	<form action="<?php echo WWW_ROOT . '/edit_user.php';  ?>" method="post">
		Current password:<br>
		<input type="password" name="current_password"><br>
		New password:<br>
		<input type="password" name="password"><br>
		Confirm new password:<br>
		<input type="password" name="confirm_password"><br>
		<p>Password should be at least 6 characters.</p>
		<input type="submit" value="Update password">
	</form>
</div>


<?php include(SHARED_PATH . '/footer.php'); ?>