<?php 

require_once('../private/initialize.php');

require_login();

$id = $_SESSION['user_id'];

if(is_post_request()) {
	$result = delete_user($id);
	$_SESSION['message'] = 'Nutzerkonto wurde gelöscht.';
	// die needed else session msg won't display
	die(header("Location: " . WWW_ROOT . "/index.php"));
} else {
	$user = find_user_by_id($id);
}

$page_title = 'Konto löschen';
$h2 = 'Konto löschen';
include(SHARED_PATH . '/header_login.php');

?>


<div class="wrapper_delete_user">
	<div class="description_txt"">
		Benutzer
	</div>
	<div class="user_settings_txt">
		<?php echo h($user['username']); ?>
	</div>
</div>

<div class="side_text side_text_delete_user">
	Dieses Konto löschen?
</div>


<form action="<?php echo WWW_ROOT . '/delete_user.php?id=' . h(urlencode($user['id'])); ?>" method="post">
<div class="row">
	<div class="col-5 text-right">
		<input class="button button_delete" type="submit" value="Löschen">
	</div>
</form>
	<div class="col-7 order-first text-left margin">
		<a class="side_text side_text_delete_user_v2" href="#">nein, nicht löschen</a>
	</div>
</div>

<?php
include(SHARED_PATH . '/footer.php');
?>