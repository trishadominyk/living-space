<div class="SUBSUB-CONTENT">
	<div class="admin-list">
		<?php
			$list = $space->get_spaces();
			if($list){
				foreach($list as $value){
		?>
		<div class="list-row">
			<h3><?php echo $value['spc_name'];?></h3>
			<table>
				<tr>
					<td><?php echo file_get_contents("svg/address.svg");?><?php echo $value['spc_address'];?></td>
					<td rowspan="2" class="view-button"><a href="index.php?mod=admin&sub=info&id=<?php echo $value['spc_id'];?>"><?php echo file_get_contents("svg/rooms.svg");?><br>View Living Space</a></td>
				</tr>
				<tr><td><?php echo file_get_contents("svg/price.svg");?><?php echo $pricce = "Php ".$value['spc_avgprice'];?> (average price)</td></tr>
			</table>
		</div>
		<?php
				}
			}
		?>
	</div>
</div>