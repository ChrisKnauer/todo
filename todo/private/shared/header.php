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
		<span class="logo"><?php echo "ToDo" ?></span>
		<h2><?php echo h($h2) ?></h2>
	</header>

	<?php echo display_session_message(); ?>