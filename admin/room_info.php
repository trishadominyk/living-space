<h3>Room Information</h3>
	<?php
		$roomlist = $space->get_rooms($id);
		
		foreach($roomlist as $roomvalue){
	?>
	<table class="roomtable" style="border-bottom: 1px #ceccc7 solid;">
		<tr>
			<td><b><?php echo $roomvalue['rm_name'];?></b></td>
		</tr>
		<tr><td style="color: #f89c62;"><b><?php echo $pend = $pending->get_numberpending($roomvalue['rm_id']);?></b> reservations pending.</td></td>
		<tr>
			<td><?php echo $roomvalue['rm_desc'];?></td>
			<td class="view-button"><a href="index.php?mod=admin&sub=pending&pro=<?php echo $roomvalue['rm_id'];?>&id=<?php echo $value['spc_id'];?>"><?php echo file_get_contents("svg/rooms.svg");?><br>View Pending</td>
		</tr>
		<tr>
			<td><?php echo file_get_contents("svg/price.svg");?>Php <?php echo $payment = $roomvalue['rm_price']." / ".$roomvalue['pay_name'];?></td>
		</tr>
		<tr>
			<td><?php echo file_get_contents("svg/persons.svg");?><?php echo $roomvalue['rm_pqty'];?> person(s)</td>
		</tr>
		<tr>
			<td>
				<?php echo $icon = ($roomvalue['rm_aqty']) ? file_get_contents("svg/avail.svg") : file_get_contents("svg/full.svg");?>
				<?php echo $roomvalue['rm_aqty'];?> room(s) available
			</td>
		</tr>
	</table>
	<?php
		}
	?>