<?php

require_once('../private/initialize.php');

require_login();

$h2 = 'Eintrag ändern';
include(SHARED_PATH . '/header_login.php');
// if no id is set redirect to list.php
if (!isset($_GET['id'])) {
	header("Location:" . WWW_ROOT . "/list.php");
}

$id = $_GET['id'];

// if it's a post request..process the form
if(is_post_request()) {

	// handle vals sent from edit.php-form
	$item = [];
	$item['id'] = $id;
	$item['description'] = $_POST['description'];

	// call update_item
	$result = update_item($item);

	if($result === true) {
		// redirect to list.php
		header("Location:" . WWW_ROOT . "/list.php");
	} else {
		$errors = $result;
	}

} else {
	// if it's not a post request...use the one from db and use it to insert into form field
	$item = find_item_by_id($id);
	// if get request, and the items user id is not equal sessions user id, then redirect to list
	// can't use strict equal because not same type (string vs int)
	if($item['user_id'] != $_SESSION['user_id']) {
		header("Location:" . WWW_ROOT . "/list.php");
	};
}
?>



<?php echo display_errors($errors); ?>

<form action="<?php WWW_ROOT . '/edit.php' ?>" method="post">
	<!-- if txt is larger than, then display textarea -->
	<?php if (strlen(h($item['description'])) > 22) {;?>

		<textarea name="description"><?php echo h($item['description']) ?></textarea>

	<?php } else { ;  ?>

		<input type="text" name="description" value="<?php echo h($item['description']) ?>">

	<?php } ;  ?>

	<input class="button float-right" type="submit" value="ändern">

</form>



<?php include(SHARED_PATH . '/footer.php'); ?>