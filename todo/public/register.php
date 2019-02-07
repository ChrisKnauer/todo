<?php

require_once("../private/initialize.php");

log_out_user();

$title = "Registration";
$h2 = "Create User";

include(SHARED_PATH . "/header.php");

if(is_post_request()) {
	$user = [];
	$user['username'] = $_POST['username'] ?? '';
	$user['password'] = $_POST['password'] ?? '';
	$user['confirm_password'] = $_POST['confirm_password'] ?? '';

	$result = insert_user($user);
	if($result === true) {
		$user['id'] = mysqli_insert_id($db); // new
		log_in_user($user); // new
		$_SESSION['message'] = 'User created.';
		header("Location: " . WWW_ROOT . "/list.php"); 
	} else {
		$errors = $result;
	}
} else {
	$user = [];
	$user['username'] = '';
	$user['password'] = '';
	$user['confirm_password'] = '';
}
?>


<div id="content">

	<?php echo display_errors($errors); ?>

	<form action="<?php echo WWW_ROOT . '/register.php'  ?>" method="post">

		Username:<br>
		<input type="text" name="username" value="<?php echo h($user['username']); ?>"><br>
		Password:<br>
		<input type="password" name="password" value=""><br>
		Confirm password:<br>
		<input type="password" name="confirm_password" value=""><br>
		<p>Password should be at least 6 characters.</p>
		<input type="submit" value="Register"></input>

	</form><br>

	<a href="<?php echo WWW_ROOT . '/index.php'  ?>">&laquo; Already have a username</a>

</div>


<?php include(SHARED_PATH . "/footer.php"); ?>