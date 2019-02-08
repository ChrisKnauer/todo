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

$page_title = 'Delete User';
$h2 = 'Delete user';
include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/header_login.php');

?>

<div id="content">

	<a href="<?php echo WWW_ROOT. '/list.php' ?>">&laquo; Back to List</a>

	<p>Are you sure you want to delete this user account?</p>
	<p><?php echo h($user['username']); ?></p>

	<form action="<?php echo WWW_ROOT . '/delete_user.php?id=' . h(urlencode($user['id'])); ?>" method="post">

		<input type="submit" value="Delete User">

	</form>

</div>

<?php
include(SHARED_PATH . '/footer.php');
?>