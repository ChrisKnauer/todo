<?php

require_once("../private/initialize.php");

require_login();

$page_title = 'Einstellungen';
$h2 = 'Einstellungen';
include(SHARED_PATH . '/header_login.php');


$id = $_SESSION['user_id'];
$user = find_user_by_id($id);  // assoc. array

?>

<div class="wrapper_user_settings">
	<div class="row row_user_settings">
		<div class="border_user_settings vertical_center">
			<div class="col-10">
				<div class="description_txt"">
					Benutzer
				</div>
				<div class="user_settings_txt">
					<?php echo h($user['username']); ?>
				</div>
			</div>
			<div class="col-2">
				
			</div>
		</div>
	</div>
	<div class="row row_user_settings">
		<div class="border_user_settings vertical_center">
			<div class="col-10">
				<div class="description_txt">
					Passwort
				</div>
				<div class="user_settings_txt">
					******
				</div>
			</div>
			<div class="col-2">
				<a href="<?php echo WWW_ROOT . '/edit_user.php'; ?>">
					<svg class="arrow_right" xmlns="http://www.w3.org/2000/svg" width="7.4" height="12" viewBox="0 0 7.4 12">
	  					<path id="path" d="M8.6,7.4,10,6l6,6-6,6L8.6,16.6,13.2,12Z" transform="translate(-8.6 -6)" fill="#707070" fill-rule="evenodd"/>
					</svg>
				</a>
			</div>
		</div>
	</div>
	<div class="row row_user_settings vertical_center">
		<div class="col-10 description_txt description_txt_small">
			Benutzerkonto löschen
		</div>
		<div class="col-2">
			<a href="<? echo WWW_ROOT . "/delete_user.php"; ?>">
				<svg class="arrow_right" xmlns="http://www.w3.org/2000/svg" width="7.4" height="12" viewBox="0 0 7.4 12">
	  				<path id="path" d="M8.6,7.4,10,6l6,6-6,6L8.6,16.6,13.2,12Z" transform="translate(-8.6 -6)" fill="#707070" fill-rule="evenodd"/>
				</svg>
			</a>
		</div>
	</div>
</div>

<?php
include(SHARED_PATH . '/footer.php');
?>