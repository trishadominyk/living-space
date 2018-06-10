	<?php
		$list = $space->search_space($id);
		
		foreach($list as $value){
	?>
	<h2>
		<a href="index.php?mod=admin&sub=view"><?php echo file_get_contents("svg/back.svg");?></a>
		<?php echo $value['spc_name'];?>
		<a href="index.php?mod=admin&sub=info&subsub=edit&id=<?php echo $value['spc_id'];?>"><?php echo file_get_contents("svg/settings.svg");?></a>
		<a data-confirm-link="Are you sure you want to delete item?" href="admin/process.php&action=spacedelete&spcid=<?php echo $value['spc_id'];?>"><?php echo file_get_contents("svg/delete.svg");?></a>
	</h2>
	<table class="infotable">
		<tr><td><?php echo $value['typ_name'];?></td></tr>
		<tr>
			<td><?php echo $value['spc_desc'];?></td>
			<td class="view-button"><?php echo file_get_contents("svg/rooms.svg");?><br><b><a href="index.php?mod=admin&sub=info&pro=newroom&id=<?php echo $id;?>">Add Room</a></b></td>
		</tr>
		<tr>
			<td><?php echo file_get_contents("svg/address.svg");?><?php echo $add = $value['spc_address'].", ".$value['cty_name']." CITY";?></td>
		</tr>
		<tr><td><?php echo file_get_contents("svg/price.svg");?><?php echo $avp = "Php ".$value['spc_avgprice'];?></td></tr>
		<tr><td><?php echo file_get_contents("svg/contact.svg");?><?php echo $value['spc_contact'];?></td></tr>
	</table>
	<?php
		}
		
		$roomlist = $space->get_rooms($id);
	?>
	<div class="room-info">
		<?php
			if($roomlist){
				switch($process){
					default:
						require_once 'room_info.php';
					break;
					case 'newroom':
						require_once 'room_new.php';
					break;
				}
			}
			else
				require_once 'room_new.php';
		?>
	</div>