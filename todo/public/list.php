<?php
// always use static strings with include/require. never dynamic!
require_once('../private/initialize.php');

if(is_post_request()) {

	// if add-item-form has been submitted
	if (isset($_POST['description'])) {
		
		$item_description = $_POST['description'];
		insert_item($item_description); // $result is true/false
	}

	// if delete-item-form has been submitted
	if (isset($_POST['delete'])) {

		$id = $_GET['id'];
		delete_item($id);
		header("Location: " . WWW_ROOT . "/list.php");
	}
}

$item_set = find_all_items();

$page_title = 'TODO';
$h2 = 'to-do list';
include(SHARED_PATH . '/header.php');

?>

<nav>
	<a href="logout.php">Logout</a>
</nav>

<div id="content">

	<form action="<?php echo WWW_ROOT . '/list.php'; ?>" method="post">
		<input type="text" name="description"> 
		<input type="submit" value="Add item">
	</form>


	<table>
		<tr>
			<th>description</th>
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