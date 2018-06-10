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
		
		<title>Living Space</title>
		
		<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Slab" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
		
		<!---<script src="js/viewmap.js" type="text/javascript"></script>--->
		<script type="text/javascript">
			$(document).ready(function () {
				$('a[data-confirm-link]').click(function () {
					if (confirm($(this).data('confirm-link')))
						window.location = $(this).attr('href');
					return false;
				});
			});
		</script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js">
		</script>
	</head>
	
	<body>
		<div id="MAIN_NAV">
			<div class="nav_logo">
				<a href="index.php"><?php echo file_get_contents("svg/ls_logo.svg");?></a>
				<?php 
					if($user->get_session()){
				?>
				<b><a href="index.php?mod=admin" style="float: right; color: #1e676a; font-size: 10px; padding-right: 1%;"><?php echo file_get_contents("svg/user.svg");?><br><?php echo $_SESSION['username'];?></a></b>
				<?php
					}
				?>
			</div>
		</div>
		
		<div id="MAIN_CONTENT">
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
	</body>
</html>