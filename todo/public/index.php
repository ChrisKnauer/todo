<?php  // root of our app ?>

<?php 

require_once('../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Validations
	if(is_blank($username)) {
		$errors[] = "Username cannot be blank.";
	}
	if(is_blank($password)) {
		$errors[] = "Password cannot be blank.";
	}

	// if no errors, try to login
	if(empty($errors)) {
		// using one var ensures that msg is the same
		$login_failure_msg = "Log in was unsuccessful."; //don't tell user why it wasn't
		$user = find_user_by_username($username);
		if($user) {

			if(password_verify($password, $user['hashed_password'])) {
				// pw matches
				log_in_user($user);
				header("Location: " . WWW_ROOT . "/list.php");
			} else {
				// user found, but pw doesn't match
				$errors[] = $login_failure_msg;
			}
		} else {
			// no username found
			$errors[] = $login_failure_msg;
		}
	}
}


$page_title = 'Login';
$h2 = 'Login';
include(SHARED_PATH . '/header.php');

?>


<div id='content'>

	<?php echo display_errors($errors); ?>

	<form action="<?php echo WWW_ROOT . '/index.php'?>" method="post">

		Username<br>
		<input type="text" name="username"><br>
		Password<br>
		<input type="password" name="password" value=""><br>
		<input type="submit" name="submit" value="Continue">

	</form><br>

	<a href="<?php echo WWW_ROOT . '/register.php' ?>">Register</a>


</div>


<?php
include(SHARED_PATH . '/footer.php');
?>