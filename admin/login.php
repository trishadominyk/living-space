<?php
	$msg = " ";

	if(isset($_REQUEST['submit'])){
		extract($_REQUEST);
		$login = $user->user_login($email, md5($password));

		if($login){
?>
			<script type="text/javascript">window.location.href='index.php?mod=admin';</script>
<?php
		}
		else{
			$msg = "<h4>Incorrect Username or Password</h4>";
		}
	}
?>
<div class="login">		
	<div class="container">
		<?php echo $msg ?>
				
		<form id="login" action="" method="POST" name="login" class="form">
			<input id="userid" name="email" type="input" class="validate" autocomplete="off" placeholder="Email">
			<input id="password" name="password" type="password" class="validate" autocomplete="off" placeholder="Password">
			<input id="button" type="submit" name="submit" value="LOG IN"/>
		</form>
	</div>
</div>