<div class="search">
	<h1>
		Find your next home.
	</h1>
	<form name="citysearch" method="post" action="index.php?mod=spaces">
		<div class="row">
			<select name="city" class="search-text" required>
				<?php
					$list = $space->get_cities();
					
					foreach($list as $value){
				?>
					<option value="<?php echo $value['cty_id'];?>"><?php echo $value['cty_name'];?></option>
				<?php
					}
				?>
			</select>
			<input type="submit" class="search-button" name="submit" value="Search"/>
		</div>
	</form>
</div>

<div class="ls-info">
	<p><b>Begin your search with Living Space.</b></p> 
	<p>Living Space is a search engine with extensive comparisons. 
	Users easily decide on Living which space best suits their needs. Fast. Simple.</p>
</div>

<?php
	if(!$user->get_session()){
?>
<div class="login-button">
	<p>User?</p>
	<b><a href="index.php?mod=admin"><?php echo file_get_contents("svg/user.svg");?><br>Log In</a></b>
</div>
<?php
	}
?>