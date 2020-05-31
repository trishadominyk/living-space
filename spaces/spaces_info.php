<div id="SUBSUB_CONTENT">
	<?php
		$list = $space->search_space($id);
		
		foreach($list as $value){
	?>
	<h2><a href="index.php?mod=spaces&sub=list"><?php echo file_get_contents("svg/back.svg");?></a><?php echo $value['spc_name'];?></h2>
	<table class="infotable">
		<tr><td><?php echo $value['typ_name'];?></td></tr>
		<tr><td><?php echo $value['spc_desc'];?></td></tr>
		<tr>
			<td><?php echo file_get_contents("svg/address.svg");?><?php echo $add = $value['spc_address'].", ".$value['cty_name']." CITY";?></td>
		</tr>
		<tr><td><?php echo file_get_contents("svg/price.svg");?><?php echo $avp = "Php ".$value['spc_avgprice'];?></td></tr>
		<tr><td><?php echo file_get_contents("svg/contact.svg");?><?php echo $value['spc_contact'];?></td></tr>
	</table>
	<?php
			$roomlist = $space->get_rooms($id);
			if($roomlist){
	?>
	<h3>Room Information</h3>
	<?php
				foreach($roomlist as $roomvalue){
	?>
	<table class="roomtable">
		<tr>
			<td>
				<b><?php echo $roomvalue['rm_name'];?></b>
			</td>
			<?php
				if($roomvalue['rm_aqty'] > 0){
			?>
			<td rowspan="4" class="view-button">
				<a href="index.php?mod=spaces&sub=apply&pro=<?php echo $roomvalue['rm_id'];?>&id=<?php echo $value['spc_id'];?>">
					<?php echo file_get_contents("svg/rooms.svg");?>
					Apply
				</a>
			</td>
			<?php
				}
			?>
		</tr>
		<tr><td><?php echo $roomvalue['rm_desc'];?></td></tr>
		<tr><td><?php echo file_get_contents("svg/price.svg");?>Php <?php echo $payment = $roomvalue['rm_price']." / ".$roomvalue['pay_name'];?></td></tr>
		<tr><td><?php echo file_get_contents("svg/persons.svg");?><?php echo $roomvalue['rm_pqty'];?> person(s)</td></tr>
		<tr>
		<td>
			<?php echo $icon = ($roomvalue['rm_aqty']) ? file_get_contents("svg/avail.svg") : file_get_contents("svg/full.svg");?>
			<?php echo $roomvalue['rm_aqty'];?> room(s) available
			</td>
		</tr>
	</table>
	<?php
				}
			}
		}
	?>
</div>