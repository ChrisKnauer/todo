<?php

require_once("../private/initialize.php");

require_login();

$page_title = 'Einstellungen';
$h2 = 'Einstellungen';
include(SHARED_PATH . '/header_login.php');


$id = $_SESSION['user_id'];
$user = find_user_by_id($id);  // assoc. array

?>

<div id="content">

	Benutzer: <?php echo h($user['username']); ?> <br><br>

	<a href="<?php echo WWW_ROOT . '/edit_user.php'; ?>">Passwort ändern</a> <br><br>
	<a href="<? echo WWW_ROOT . "/delete_user.php"; ?>">Benutzerkonto löschen</a> <br>

</div>

<?php
include(SHARED_PATH . '/footer.php');
?>