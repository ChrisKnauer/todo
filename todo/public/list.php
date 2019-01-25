<?php
// always use static strings with include/require. never dynamic!
require_once('../private/initialize.php');
$page_title = 'TODO';
$h2 = 'to-do list';
include(SHARED_PATH . '/header.php');
// create temporary db stand in 
$items = [
	["id" => "1", "description" => "clean room"],
	["id" => "2", "description" => "buy groceries"],
	["id" => "3", "description" => "go for a jog"]
]
?>

<nav>
	<a href="logout.php">Logout</a>
</nav>

<div id="content">

	<input type="text" name="item"> <a href="">add item</a>


	<table>
		<tr>
			<th>description</th>
			<th></th>
			<th></th>
		</tr>

	<?php // loop through fake-db
		foreach($items as $item) {
	?>
		<tr>
			<td><?php echo h($item["description"]); ?></td>
			<td><a href="<?php echo WWW_ROOT . "/edit.php?id=" . h(urlencode($item['id']))  ; ?>">edit</a></td> <!-- send item id to edit page -->
			<td><a href="">delete</a></td>
		</tr>
	<?php }; // end loop ?>

	</table>

</div>


<?php include(SHARED_PATH . '/footer.php'); ?>