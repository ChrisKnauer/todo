<?php
// always use static strings with include/require. never dynamic!
require_once('../private/initialize.php');

require_login();

$user_id = $_SESSION['user_id'];

if(is_post_request()) {

	// if add-item-form has been submitted
	if (isset($_POST['description'])) {
		
		$item_description = $_POST['description'];
		
		$result = insert_item($item_description, $user_id); // $result is true/false
		if($result === true) {
			// re-direct prevents re-submission on re-load
			header("Location: " . WWW_ROOT . "/list.php");
		} else {
			$errors = $result;
		}
	}

	// if delete-item-form has been submitted
	if (isset($_POST['delete'])) {

		$id = $_GET['id'];
		delete_item($id);
		header("Location: " . WWW_ROOT . "/list.php");
	}
}

$item_set = find_all_itmes_by_user_id($user_id);

$page_title = 'ToDo';
$h2 = 'Meine Liste';
include(SHARED_PATH . '/header_login.php');
?>

<div id="content">

	<?php echo display_errors($errors); ?>

	<form action="<?php echo WWW_ROOT . '/list.php'; ?>" method="post">
		<div class="row">
			<div class="col-10 no_right_padding">
			<input class="input_add_item" type="text" name="description" placeholder="Neuer Eintrag"> 
			</div>
			<div class="col-2 no_left_padding">
				<label>
					<input class="hide" type="submit">
					<svg class="add_item_svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45.057" height="45.705" viewBox="0 0 45.057 45.705">
						  <defs>
						    <filter id="teal_circle" x="0" y="0.648" width="45.057" height="45.057" filterUnits="userSpaceOnUse">
						      <feOffset dy="6" input="SourceAlpha"/>
						      <feGaussianBlur stdDeviation="3" result="blur"/>
						      <feFlood flood-opacity="0.239"/>
						      <feComposite operator="in" in2="blur"/>
						      <feComposite in="SourceGraphic"/>
						    </filter>
						    <linearGradient id="linear-gradient" x1="0.5" y1="1" x2="0.5" gradientUnits="objectBoundingBox">
						      <stop offset="0"/>
						      <stop offset="0.14" stop-opacity="0.631"/>
						      <stop offset="1" stop-opacity="0"/>
						    </linearGradient>
						    <linearGradient id="linear-gradient-2" x1="0.5" y1="1" x2="0.5" gradientUnits="objectBoundingBox">
						      <stop offset="0" stop-color="#fff" stop-opacity="0"/>
						      <stop offset="0.23" stop-color="#fff" stop-opacity="0.012"/>
						      <stop offset="0.36" stop-color="#fff" stop-opacity="0.039"/>
						      <stop offset="0.47" stop-color="#fff" stop-opacity="0.102"/>
						      <stop offset="0.57" stop-color="#fff" stop-opacity="0.18"/>
						      <stop offset="0.67" stop-color="#fff" stop-opacity="0.278"/>
						      <stop offset="0.75" stop-color="#fff" stop-opacity="0.412"/>
						      <stop offset="0.83" stop-color="#fff" stop-opacity="0.561"/>
						      <stop offset="0.91" stop-color="#fff" stop-opacity="0.741"/>
						      <stop offset="0.98" stop-color="#fff" stop-opacity="0.929"/>
						      <stop offset="1" stop-color="#fff"/>
						    </linearGradient>
						  </defs>
						  <g id="Add_item" data-name="Add item" transform="translate(-114.648 -51)">
						    <g transform="matrix(1, 0, 0, 1, 114.65, 51)" filter="url(#teal_circle)">
						      <path id="teal_circle-2" data-name="teal circle" d="M13.529,0A13.529,13.529,0,1,1,0,13.529,13.529,13.529,0,0,1,13.529,0Z" transform="translate(9 3.65)" fill="#35a6e8"/>
						    </g>
						    <g id="ic_add_white" transform="translate(132.357 63.357)">
						      <path id="ic_add_white-2" data-name="ic_add_white" d="M3433.639,985.508h-4.131v4.131h-1.377v-4.131H3424v-1.377h4.131V980h1.377v4.131h4.131Z" transform="translate(-3424 -980)" fill="#fff"/>
						    </g>
						    <g id="Group_334" data-name="Group 334" transform="translate(120 51)" opacity="0.12">
						      <path id="gradient_border_2" data-name="gradient border 2" d="M3420.025,959.3a16.721,16.721,0,1,1-16.721,16.721,16.721,16.721,0,0,1,16.721-16.721m0-.3a17.025,17.025,0,1,0,17.025,17.025A17.025,17.025,0,0,0,3420.025,959Z" transform="translate(-3403 -959)" fill="url(#linear-gradient)"/>
						      <path id="gradient_border_1" data-name="gradient border 1" d="M3420.025,959.3a16.721,16.721,0,1,1-16.721,16.721,16.721,16.721,0,0,1,16.721-16.721m0-.3a17.025,17.025,0,1,0,17.025,17.025A17.025,17.025,0,0,0,3420.025,959Z" transform="translate(-3403 -959)" fill="url(#linear-gradient-2)"/>
						    </g>
						  </g>
					</svg>
				</label>
			</div>

		</div> <!-- end row -->
	</form>

	<table> <!-- TODO: take out table -->


	<?php // loop through result set
		while ($item = mysqli_fetch_assoc($item_set)) {
	?>

		<div class="row vertical_center row_item">
			<div class="col-2">
				<form action="<?php echo WWW_ROOT . '/list.php?id=' . h(urlencode($item['id'])) ?>" method="post">

					<label>
						<input class="hide" name="delete" type="submit">
						<svg id="Trash" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
						  <rect id="rectangle" width="20" height="20" fill="none"/>
						  <path id="path" d="M14.285,6.111H5.714v9.333A1.5,1.5,0,0,0,7.143,17h5.714a1.5,1.5,0,0,0,1.429-1.556V6.111M11.785,3H8.214L7.5,3.778H5.714A.748.748,0,0,0,5,4.555v.779H15V4.555a.748.748,0,0,0-.715-.777H12.5L11.785,3" fill="#d14545" fill-rule="evenodd" opacity="0.54"/>
						</svg>
					</label>

				</form>
			</div>
			<div class="col-8 item_txt">
				<?php echo h($item['description']); ?>
			</div>
			<div class="col-2">
				<a href="<?php echo WWW_ROOT . "/edit.php?id=" . h(urlencode($item['id']))  ; ?>"><!-- send item id to edit page -->
					<svg class="edit_item_svg" xmlns="http://www.w3.org/2000/svg" width="19.69" height="19.69" viewBox="0 0 19.69 19.69">
					<path id="Path_5" data-name="Path 5" d="M3,18.586v4.1H7.1l12.1-12.1-4.1-4.1ZM22.371,7.419a1.089,1.089,0,0,0,0-1.542L19.811,3.317a1.089,1.089,0,0,0-1.542,0l-2,2,4.1,4.1,2-2Z" transform="translate(-3 -2.997)" fill="#6fadd1"/>
					</svg>
				</a> 
			</div>
		</div> <!-- end row -->

	<?php }; // end loop ?>

	</table>
	<!-- free up result set -->
	<?php  mysqli_free_result($item_set); ?>

</div>


<?php include(SHARED_PATH . '/footer.php'); ?>