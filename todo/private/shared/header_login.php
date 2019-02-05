
<a href="<?php echo WWW_ROOT . '/show_user.php'; ?>"> User: </a> <?php echo $_SESSION['username'] ?? ''; ?>

<nav>
	<a href="<?php echo WWW_ROOT . '/logout.php'; ?>">Logout</a>
</nav>