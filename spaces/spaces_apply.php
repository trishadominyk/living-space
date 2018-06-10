<div>
	<h2><a data-confirm-link="Changes made will be lost! Continue?" href="index.php?mod=spaces&sub=list"><?php echo file_get_contents("svg/back.svg");?></a>Application</h2>
	<p>Please fill out form details for pending reservation of a room slot. <br>Pay in order to confirm slot. Payments not made within a month(30 days) will forfeit slot.</p>
	
	<h3>Room Information</h3>
	<table class="roomtable">
	<?php
		$list = $space->get_roominfo($process);
		foreach($list as $roomvalue){
	?>
		<tr><td><b><?php echo $roomvalue['rm_name'];?></b></td></tr>
		<tr><td><?php echo file_get_contents("svg/price.svg");?>Php <?php echo $payment = $roomvalue['rm_price']." / ".$roomvalue['pay_name'];?></td></tr>
		<tr>
			<td>
				<?php echo $icon = ($roomvalue['rm_aqty']) ? file_get_contents("svg/avail.svg") : file_get_contents("svg/full.svg");?>
				<?php echo $roomvalue['rm_aqty'];?> room(s) available
			</td>
		</tr>
	<?php
		}
	?>
	</table>
	
	<form name="applyspace" method="post" action="spaces/process.php?action=spaceapply&spcid=<?php echo $id;?>&rmid=<?php echo $process;?>">
		<h3>Personal Information</h3>
		<div class="row">
			<input type="text" class="input-text" name="fname" required placeholder="Firstname">
		</div>
		<div class="row">
			<input type="text" class="input-text" name="mname" required placeholder="Middlename">
		</div>
		<div class="row">
			<input type="text" class="input-text" name="lname" required placeholder="Lastname">
		</div>
		<br>
		<h3>Contact Information</h3>
		<div class="row">
			<input type="text" class="input-text" name="email" required placeholder="Email">
		</div>
		<div class="row">
			<input type="text" class="input-text" name="contact" required placeholder="Contact Number">
		</div>
		
		<input type="submit" class="search-button" name="submit" value="Submit"/>
	</form>
</div>