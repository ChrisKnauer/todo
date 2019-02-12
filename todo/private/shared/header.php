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
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet"> 
	<link rel="stylesheet" media="all" href="<?php echo WWW_ROOT . "/stylesheets/style.css" ?>">
</head>
<body>
<div class="container-fluid">
	<header class=header_welcome>
		<div class="logo"><?php echo "<span id='to'>To</span><span id='do'>Do</span>"; ?></div>
		<div class="h2_welcome">
			<h2><?php echo h($h2) ?></h2>
		</div>
	</header>

	<?php echo display_session_message(); ?>