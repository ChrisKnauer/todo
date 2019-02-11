<?php
if(!isset($page_title)) {$page_title = 'ToDo';}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo h($page_title) ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" media="all" href="<?php echo WWW_ROOT . "/stylesheets/style.css" ?>">
</head>
<body>
<div class="container-fluid">
	<header>
		<h2><?php echo h($h2) ?></h2>
		<nav>
			<a href="<?php echo WWW_ROOT . '/show_user.php'; ?>"> User: </a> <?php echo $_SESSION['username'] ?? ''; ?>
			<a href="<?php echo WWW_ROOT . '/logout.php'; ?>">Logout</a>
		</nav>
	</header>

	<?php echo display_session_message(); ?>

