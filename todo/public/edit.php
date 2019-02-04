<?php

require_once('../private/initialize.php');
$h2 = 'Edit Item';
include(SHARED_PATH . '/header.php');
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
		//var_dump($errors); // testing 
	}


} else {
	// if it's not a post request...use the one from db and use it to insert into form field
	$item = find_item_by_id($id);
}
?>

<div id='content'>

	<?php echo display_errors($errors); ?>

	<form action="<?php WWW_ROOT . '/edit.php' ?>" method="post">
		
		<input type="text" name="description" value="<?php echo h($item['description']) ?>">
		<button>Edit</button>

	</form>

</div>



<?php include(SHARED_PATH . '/footer.php'); ?>