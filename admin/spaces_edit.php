<?php
	$list = $space->search_space($id);
	
	if($list){
		foreach($list as $value){
?>
<h2><a href="index.php?mod=admin&sub=info&id=<?php echo $value['spc_id'];?>"><?php echo file_get_contents("svg/back.svg");?></a>Edit</h2>
<form name="editspace" method="post" action="admin/process.php?action=spaceedit&spcid=<?php echo $id;?>">
	<table class="infotable">
		<tr><td>Name <input type="text" class="input-text" name="name" value="<?php echo $value['spc_name'];?>" required placeholder="Name"></td></tr>
		<tr>
			<td>Type 
				<select name="type">
			<?php
				$typelist = $space->get_types();
				foreach($typelist as $typevalue){
					if($value['typ_id'] == $typevalue['typ_id']){
			?>
			<option value="<?php echo $typevalue['typ_id'];?>" selected><?php echo $typevalue['typ_name'];?></option>
			<?php
					}
					else{
			?>
			<option value="<?php echo $typevalue['typ_id'];?>"><?php echo $typevalue['typ_name'];?></option>
			<?php
					}
				}
			?>
				</select>
			</td>
		</tr>
		<tr><td>Description <input type="text" class="input-text" name="desc" value="<?php echo $value['spc_desc'];?>" required placeholder="Description"></td></td></tr>
		<tr>
			<td>Address <input type="text" class="input-text" name="address" value="<?php echo $value['spc_address'];?>" required placeholder="Address"></td>
		</tr>
		<tr><td>Contact Number <input type="text" class="input-text" name="contact" value="<?php echo $value['spc_contact'];?>" required placeholder="Contact"></td></tr>
		<tr><td><input type="submit" class="search-button" name="submit" value="Save"/></td></tr>
	</table>
</form>
<?php		
		}
	}
	else{
		$roomlist = $space->get_roominfo($process);
		if($list){
			foreach($roomlist as $roomvalue){
?>

<?php
			}
		}
	}
?>