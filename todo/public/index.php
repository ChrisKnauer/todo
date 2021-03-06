<?php  // root of our app ?>

<?php 

require_once('../private/initialize.php');

log_out_user();

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Validations
	if(is_blank($username)) {
		$errors[] = "Nutzername darf nicht leer sein.";
	}
	if(is_blank($password)) {
		$errors[] = "Passwort darf nicht leer sein.";
	}

	// if no errors, try to login
	if(empty($errors)) {
		// using one var ensures that msg is the same
		$login_failure_msg = "Anmeldung fehlgeschlagen."; //don't tell user why it wasn't
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


$page_title = 'Anmeldung';
$h2 = 'Anmeldung';
include(SHARED_PATH . '/header.php');

?>



<?php echo display_errors($errors); ?>

<form action="<?php echo WWW_ROOT . '/index.php'?>" method="post">

	<!-- Username<br> -->
	<input type="text" name="username" placeholder="Nutzername"><br>
	<!-- Password<br> -->
	<input type="password" name="password" value="" placeholder="Passwort"><br>
	<div class="row">
		<div class="col text-right">
	<input class="button" type="submit" name="submit" value="Weiter">
		</div>
</form><br>
		<div class="col order-first text-left">
			<a class="side_text" href="<?php echo WWW_ROOT . '/register.php' ?>">registrieren</a>
		</div>
	</div>



<?php
include(SHARED_PATH . '/footer.php');
?>