<?php

require_once("../private/initialize.php");

$title = "Registration";
$h2 = "Create User";

include(SHARED_PATH . "/header.php");

?>


<div id="content">

	<form action="" method="post">

		Username:<br>
		<input type="text" name="username"><br>
		Password:<br>
		<input type="password" name="password"><br>
		Confirm password:<br>
		<input type="password" name="confirm_password"><br>
		<input type="submit" value="Register"></input>

	</form><br>

	<a href="<?php echo WWW_ROOT . '/index.php'  ?>">Already have a username</a>

</div>


<?php include(SHARED_PATH . "/footer.php"); ?>