<?php  // root of our app ?>

<?php 
	require_once('../private/initialize.php');

	$username = '';
	$password = '';

	if(is_post_request()) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$_SESSION['username'] = $username;

		header("Location: " . WWW_ROOT . "/list.php");
	}

	$page_title = 'Login';
	$h2 = 'Login';
	include(SHARED_PATH . '/header.php');
?>


<div id='content'>

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