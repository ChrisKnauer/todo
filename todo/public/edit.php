<?php

require_once('../private/initialize.php');
$h2 = 'Edit Item';
include(SHARED_PATH . '/header.php');
// set default id if no id is sent
if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	$id = 1;
}

echo h($id);

?>

<div id='content'>

	<form>
		
		<input type="text" name="">
		<button>Edit</button>

	</form>

</div>



<?php include(SHARED_PATH . '/footer.php'); ?>