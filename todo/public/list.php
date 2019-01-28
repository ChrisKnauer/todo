<?php
// always use static strings with include/require. never dynamic!
require_once('../private/initialize.php');

$item_set = find_all_items();


$page_title = 'TODO';
$h2 = 'to-do list';
include(SHARED_PATH . '/header.php');

?>

<nav>
	<a href="logout.php">Logout</a>
</nav>

<div id="content">

	<form action="" method="post">
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
			<td><a href="">delete</a></td>
		</tr>
	<?php }; // end loop ?>

	</table>
	<!-- free up result set -->
	<?php  mysqli_free_result($item_set); ?>

</div>


<?php include(SHARED_PATH . '/footer.php'); ?>