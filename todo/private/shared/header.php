<?php
if(!isset($page_title)) {$page_title = 'To-Do List';}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo h($page_title) ?></title>
	<link rel="stylesheet" media="all" href="<?php echo WWW_ROOT . "/stylesheets/style.css" ?>">
</head>
<body>
	<header>
		<h2><?php echo h($h2) ?></h2>
	</header>

	<?php echo display_session_message(); ?>