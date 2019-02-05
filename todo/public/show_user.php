<?php

require_once("../private/initialize.php");

$page_title = 'USER';
$h2 = 'User details';
include(SHARED_PATH . '/header.php');
include(SHARED_PATH . '/header_login.php');

?>

<div id="content">

	<a href="<?php echo WWW_ROOT . '/list.php' ?>">&laquo;Back to list</a> <br><br>

	Username: xxxxx <br><br>

	<a href="#">Update password</a> <br><br>
	<a href="#">Delete user</a> <br>

</div>

<?php
include(SHARED_PATH . '/footer.php');
?>