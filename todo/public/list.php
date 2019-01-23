<?php
// always use static strings with include/require. never dynamic!
require_once('../private/initialize.php');
$page_title = 'TODO';
$h2 = 'to-do list';
include(SHARED_PATH . 'header.php');
?>


<nav>
	<a href="logout.php">Logout</a>
</nav>

<div id="content">

</div>


<?php include(SHARED_PATH . 'footer.php'); ?>