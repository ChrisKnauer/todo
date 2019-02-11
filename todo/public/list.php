<?php
// always use static strings with include/require. never dynamic!
require_once('../private/initialize.php');

require_login();

$user_id = $_SESSION['user_id'];

if(is_post_request()) {

	// if add-item-form has been submitted
	if (isset($_POST['description'])) {
		
		$item_description = $_POST['description'];
		
		$result = insert_item($item_description, $user_id); // $result is true/false
		if($result === true) {
			// re-direct prevents re-submission on re-load
			header("Location: " . WWW_ROOT . "/list.php");
		} else {
			$errors = $result;
		}
	}

	// if delete-item-form has been submitted
	if (isset($_POST['delete'])) {

		$id = $_GET['id'];
		delete_item($id);
		header("Location: " . WWW_ROOT . "/list.php");
	}
}

$item_set = find_all_itmes_by_user_id($user_id);

$page_title = 'ToDo';
$h2 = 'Meine Liste';
include(SHARED_PATH . '/header_login.php');
?>

<div id="content">

	<?php echo display_errors($errors); ?>

	<form action="<?php echo WWW_ROOT . '/list.php'; ?>" method="post">
		<input type="text" name="description"> 
		<input type="submit" value="Add item">
	</form>

	<table>
		<tr>
			<!-- <th>description</th> -->
			<th></th>
			<th></th>
		</tr>

	<?php // loop through result set
		while ($item = mysqli_fetch_assoc($item_set)) {
	?>
		<tr>
			<td><?php echo h($item['description']); ?></td>
			<td><a href="<?php echo WWW_ROOT . "/edit.php?id=" . h(urlencode($item['id']))  ; ?>">edit</a></td> <!-- send item id to edit page -->
			<td>
				<form action="<?php echo WWW_ROOT . '/list.php?id=' . h(urlencode($item['id'])) ?>" method="post">
					<input name="delete" type="submit" value="Delete">
				</form>

			</td>
		</tr>
	<?php }; // end loop ?>

	</table>
	<!-- free up result set -->
	<?php  mysqli_free_result($item_set); ?>

</div>


<?php include(SHARED_PATH . '/footer.php'); ?>