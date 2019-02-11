<?php 

require_once('../private/initialize.php');

require_login();

$id = $_SESSION['user_id'];

if(is_post_request()) {
	$result = delete_user($id);
	$_SESSION['message'] = 'User deleted.';
	// die needed else session msg won't display
	die(header("Location: " . WWW_ROOT . "/index.php"));
} else {
	$user = find_user_by_id($id);
}

$page_title = 'Konto löschen';
$h2 = 'Konto löschen';
include(SHARED_PATH . '/header_login.php');

?>

<div id="content">

	<p>Sind Sie sicher das Sie dieses Konto löschen möchten?</p>
	<p>Benutzer: <?php echo h($user['username']); ?></p>

	<form action="<?php echo WWW_ROOT . '/delete_user.php?id=' . h(urlencode($user['id'])); ?>" method="post">

		<input type="submit" value="Konto löschen">

	</form>
	<a href="#">nein, nicht löschen</a>
</div>

<?php
include(SHARED_PATH . '/footer.php');
?>