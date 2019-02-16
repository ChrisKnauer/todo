<?php

require_once("../private/initialize.php");

log_out_user();

$page_title = "Konto Erstellung";
$h2 = "Konto erstellen";

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
		$_SESSION['message'] = 'Nutzerkonto erstellt.';
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


<?php echo display_errors($errors); ?>

<form action="<?php echo WWW_ROOT . '/register.php'  ?>" method="post">

	<input type="text" name="username" placeholder="Nutzername" value="<?php echo h($user['username']); ?>">

	<input type="password" name="password" placeholder="Passwort" value="">

	<input type="password" name="confirm_password" placeholder="Bestätigen" value="">

	<div class="row">
		<div class="col text-right">
	<input class="button" type="submit" value="Weiter"></input>
		</div>
</form>

		<div class="col order-first text-left">
<a class="side_text" href="<?php echo WWW_ROOT . '/index.php'  ?>">bereits ein Konto</a>
		</div>
	</div>


<?php include(SHARED_PATH . "/footer.php"); ?>