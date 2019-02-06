<?php

require_once("../private/initialize.php");

$page_title = 'USER';
$h2 = 'User details';
include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/header_login.php');


$id = $_SESSION['user_id'];
$user = find_user_by_id($id);  // assoc. array

?>

<div id="content">

	<a href="<?php echo WWW_ROOT . '/list.php' ?>">&laquo;Back to list</a> <br><br>

	Username: <?php echo h($user['username']); ?> <br><br>

	<a href="#">Update password</a> <br><br>
	<a href="<? echo WWW_ROOT . "/delete_user.php?id=" . h(urlencode($user['id'])); ?>">Delete user</a> <br>

</div>

<?php
include(SHARED_PATH . '/footer.php');
?>