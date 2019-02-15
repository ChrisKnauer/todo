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
	<header>
		<div class="row vertical_center header_row"> <!-- start row -->
			<div class="col-7">
				<h2><?php echo h($h2) ?></h2>
			</div>

			<div class="col-5">
				<nav>
					<div class="row"> <!-- start row -->
						<div class="col text-right">
							<a href="<?php echo WWW_ROOT . '/show_user.php'; ?>"><svg class="user_svg" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/><path d="M0 0h24v24H0z" fill="none"/></svg></a>
						<!-- </div> -->
						<!-- <div class="col"> -->
							<a href="<?php echo WWW_ROOT . '/logout.php'; ?>"><svg class="user_svg" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10.09 15.59L11.5 17l5-5-5-5-1.41 1.41L12.67 11H3v2h9.67l-2.58 2.59zM19 3H5c-1.11 0-2 .9-2 2v4h2V5h14v14H5v-4H3v4c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/></svg></a>
						</div>
					</div> <!-- end row -->
				</nav>
			</div>
		</div> <!-- end row -->

		<!-- if on list.php, don't display link to list.php -->
		<?php if (strpos($_SERVER['REQUEST_URI'], "list") === false){;?>

			<a href="<?php echo WWW_ROOT . '/list.php' ?>"><img src="<?php echo WWW_ROOT . '/images/arrow_back.png'; ?>"></a>

		<?php }; ?>



	</header>

	<?php echo display_session_message(); ?>
