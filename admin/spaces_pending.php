<div id="SUBSUB-CONTENT">
	<div class="pending">
		<h2>Pending</h2>
		<?php 
		if($process == '')
			$list = $pending->get_pending();
		else
			$list = $pending->get_roompending($process);
		
		if($list){
		?>
		<table class="pendingtable">
			<tr class="theader">
				<td>Name</td>
				<td>Email</td>
				<td>Contact</td>
				<td>Date Added / Expire</td>
				<td>Space</td>
				<td>Room</td>
				<td colspan="2">Action</td>
			</tr>
		<?php
				foreach($list as $value){
		?>
			<tr>
				<td><?php echo $name = $value['pnd_fname']." ".$value['pnd_mname']." ".$value['pnd_lname'];?></td>
				<td><?php echo $value['pnd_email'];?></td>
				<td><?php echo $value['pnd_contact'];?></td>
				<td><?php echo $dates = $value['pnd_date_added']." / ".$value['pnd_date_expire'];?></td>
				<td><?php echo $value['spc_name'];?></td>
				<td><?php echo $value['rm_name'];?></td>
				<td><a href="admin/process.php?action=pendingconfirm&rmid=<?php echo $value['rm_id'];?>&email=<?php echo $value['pnd_email'];?>"><?php echo file_get_contents("svg/avail.svg");?></a></td>
				<td><a href="admin/process.php?action=pendingdelete&rmid=<?php echo $value['rm_id'];?>&spcid=<?php echo $value['spc_id'];?>&email=<?php echo $value['pnd_email'];?>"><?php echo file_get_contents("svg/delete.svg");?></a></td>
			</tr>
	<?php
			}
		}
		else{
	?>
			<tr>
				<td colspan="6">No current pending.</td>
			</tr>
	<?php
		}
	?>
		</table>
	</div>
	
	<div class="pending">
		<h2>Confirmed</h2>
		<?php 
			$list = $pending->get_confirmed();
			
			if($list){
			?>
			<table class="pendingtable">
				<tr class="theader">
					<td>Name</td>
					<td>Email</td>
					<td>Contact</td>
					<td>Date Added / Expire</td>
					<td>Space</td>
					<td>Room</td>
					<td>Action</td>
				</tr>
			<?php
					foreach($list as $value){
			?>
				<tr>
					<td><?php echo $name = $value['pnd_fname']." ".$value['pnd_mname']." ".$value['pnd_lname'];?></td>
					<td><?php echo $value['pnd_email'];?></td>
					<td><?php echo $value['pnd_contact'];?></td>
					<td><?php echo $dates = $value['pnd_date_added']." / ".$value['pnd_date_expire'];?></td>
					<td><?php echo $value['spc_name'];?></td>
					<td><?php echo $value['rm_name'];?></td>
					<td style="text-align: center;"><a href="admin/process.php?action=pendingdelete&rmid=<?php echo $value['rm_id'];?>&spcid=<?php echo $value['spc_id'];?>&email=<?php echo $value['pnd_email'];?>"><?php echo file_get_contents("svg/delete.svg");?></a></td>
				</tr>
		<?php
				}
			}
			else{
		?>
				<tr>
					<td colspan="6">No current pending.</td>
				</tr>
		<?php
			}
		?>
	</div>
</div>