<div id="SUBSUB_CONTENT">
	<?php
		if($city != '')
			$list = $space->filtersearch_space($city, $type, $sort);
		else
			$list = $space->get_spaces();
			
			if($list){
	?>
	<ul>
		<?php
			foreach($list as $value){
		?>
		<li>
			<div class="list-row">
				<h3><?php echo $value['spc_name'];?></h3>
				<table>
					<tr>
						<td><?php echo $value['spc_desc'];?></td>
						<td rowspan="3" class="view-button"><a href="index.php?mod=spaces&sub=info&id=<?php echo $value['spc_id'];?>"><?php echo file_get_contents("svg/rooms.svg");?><br>View Living Space</a></td>
					</tr>
					<tr><td><?php echo file_get_contents("svg/address.svg");?><?php echo $value['spc_address'];?></td></tr>
					<tr><td><?php echo file_get_contents("svg/price.svg");?><?php echo $pricce = "Php ".$value['spc_avgprice'];?> (average price)</td></tr>
					<tr><td class="<?php echo $value['spc_status'];?>"><p><?php echo $value['spc_status'];?></p></td></tr>
				</table>
			</div>
		</li>
		<?php
			}
		?>
	</ul>
	<?php
			}
		//}
	?>
</div>