<div>
	<h2><a data-confirm-link="Changes made will be lost! Continue?" href="index.php?mod=admin&sub=info&id=<?php echo $id;?>"><?php echo file_get_contents("svg/back.svg");?></a>New Room</h2>
	<form name="newroom" method="post" action="admin/process.php?action=roomnew&spcid=<?php echo $id;?>&rmid=<?php echo $id;?>">
		<h3>Room Information</h3>
		<div class="row">
			<input type="text" class="input-text" name="name" required placeholder="Room Name">
		</div>
		<div class="row">
			<input type="text" class="input-text" name="desc" required placeholder="Description">
		</div>
		<div class="row">
			<input type="number" class="input-text" name="tqty" required placeholder="Quantity">
		</div>
		<div class="row">
			<input type="number" class="input-text" name="pqty" required placeholder="People Accomodated">
		</div>
		<br>
		<h3>Payment Information</h3>
		<div class="row">
			<input type="number" min="0" step="0.1" class="input-text" name="price" required placeholder="Price">
		</div>
		<div class="row">
			<select name="payment" required>
				<?php
					$list = $space->get_payments();
					
					foreach($list as $value){
				?>
				<option value="<?php echo $value['pay_id'];?>"><?php echo $value['pay_name'];?></option>
				<?php
					}
				?>
			</select>
		</div>
		
		<input type="submit" class="search-button" name="submit" value="Save New Room"/>
	</form>
</div>