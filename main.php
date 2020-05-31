<div class="container-fluid">
	<div class="row">
		<div class="search">
			<h1 class="text-left">
				Find your next home.
			</h1>
			<form name="citysearch" method="post" action="index.php?mod=spaces">
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
			</form>
		</div>
	</div>

	<div class="row">
		<div class="ls-info">
			<div class="text-left"><p><b>Begin your search with Living Space.</b></p> 
				<p>Living Space is a search engine with extensive comparisons. 
				Users easily decide on Living which space best suits their needs. Fast. Simple.</p></div>
			</div>
		</div>

		<?php
		if(!$user->get_session()){
			?>
			<div class="row">
				<div class="login-button">
					<p>User?</p>
					<b><a href="index.php?mod=admin"><?php echo file_get_contents("svg/user.svg");?><br>Log In</a></b>
				</div>
			</div>
			<?php
		}
		?>
	</div>