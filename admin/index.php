<?php
	if(!$user->get_session()){
?>
<script type="text/javascript">window.location.href='index.php?mod=login';</script>
<?php
	}
?>

<div id="SUB_NAV">
	<div class="admin-nav">
		<ul>
			<li><a href="index.php?mod=admin&sub=new">New Space</a></li>
			<li><a href="index.php?mod=admin&sub=view">Spaces</a></li>
			<li><a href="index.php?mod=admin&sub=pending">Pending</a></li>
			<li><a data-confirm-link="Are you sure you want to logout?" href="logout.php">Logout</a></li>
		</ul>
	</div>
</div>

<div id="SUB_CONTENT">
	<?php
		switch($sub){
			default:
				require_once 'spaces_list.php';
			break;
			case 'new':
				require_once 'spaces_new.php';
			break;
			case 'view':
				require_once 'spaces_list.php';
			break;
			case 'info':
				require_once 'spaces_info.php';
			break;
			case 'pending':
				require_once 'spaces_pending.php';
			break;
		}
	?>
</div>