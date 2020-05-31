<?php
include 'library/config.php';
include 'classes/class.space.php';
include 'classes/class.user.php';
include 'classes/class.pending.php';

$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$sub = (isset($_GET['sub']) && $_GET['sub'] != '') ? $_GET['sub'] : '';
$subsub = (isset($_GET['subsub']) && $_GET['subsub'] != '') ? $_GET['subsub'] : '';
$process = (isset($_GET['pro']) && $_GET['pro'] != '') ? $_GET['pro'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';

	//search filters
$city = (isset($_POST['city']) && $_POST['city'] != '') ? $_POST['city'] : '';
$type = (isset($_POST['type']) && $_POST['type'] != '') ? $_POST['type'] : '';
$sort = (isset($_POST['sort']) && $_POST['sort'] != '') ? $_POST['sort'] : '';

$space = new Spaces();
$user = new User();
$pending = new Pending();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="cache-control" content="no-cache">
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">

		<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

		<title>Living Space</title>
	</head>

	<body>
		<div>
			<div class="row justify-content-md-center">
				<nav class="navbar sticky-top">
					<a class="navbar-brand" href="index.php"><?php echo file_get_contents("svg/ls_logo.svg");?></a>
					<?php 
					if($user->get_session()){
						?>
						<b><a href="index.php?mod=admin" style="float: right; color: #1e676a; font-size: 10px; padding-right: 1%;"><?php echo file_get_contents("svg/user.svg");?><br><?php echo $_SESSION['username'];?></a></b>
						<?php
					}
					?>
				</nav>
			</div>

			<div class="row">
				<?php
				switch($module){
					default:
					require_once 'main.php';
					break;
					case 'spaces':
					require_once 'spaces/index.php';
					break;
					case 'admin':
					require_once 'admin/index.php';
					break;
					case 'login':
					require_once 'admin/login.php';
					break;
				}
				?>
			</div>
		</div>

		<!---<script src="js/viewmap.js" type="text/javascript"></script>--->
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

		<script type="text/javascript">
			$(document).ready(function () {
				$('a[data-confirm-link]').click(function () {
					if (confirm($(this).data('confirm-link')))
						window.location = $(this).attr('href');
					return false;
				});
			});
		</script>
	</body>
</html>