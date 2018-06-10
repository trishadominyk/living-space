<?php
class Spaces{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}
	
	public function get_spaces(){
		$sql = "SELECT S.spc_id, S.spc_name, S.spc_desc, S.spc_contact, S.spc_address, S.spc_lat, S.spc_long, S.spc_avgprice, S.spc_numrooms, S.spc_roomavail, S.spc_status,
				T.typ_name, C.cty_name
				FROM (tbl_space S
				INNER JOIN tbl_type T ON S.typ_id = T.typ_id)
				INNER JOIN tbl_city C ON S.cty_id = C.cty_id
				ORDER BY S.spc_name ASC";
		
		$result = mysqli_query($this->db,$sql);
		
		while($row = mysqli_fetch_assoc($result))
			$list[] = $row;
		
		return $list;
	}
	
	public function new_space($name, $address, $city, $type, $lat, $lng, $contact, $desc){
		$sql = "SELECT * FROM tbl_space WHERE spc_name = '$name'";
		$check=$this->db->query($sql);
		
		$count_row = $check->num_rows;
		if($count_row == 0){
			$sql = "INSERT INTO tbl_space(spc_name, spc_address, cty_id, typ_id, spc_lat, spc_long, spc_contact, spc_desc) 
					VALUES('$name', '$address', $city, $type, $lat, $lng, '$contact', '$desc')";
			
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
			return $result;
		}
		else
			return false;
	}
	
	public function filtersearch_space($city, $type, $sort){
		switch ($sort){
			default:
				$order = "ORDER BY S.spc_name ASC";
			break;
			case 'price':
				$order = "ORDER BY S.spc_avgprice ASC";
			break;
		}
		
		if($type == '')
			$sql = "SELECT S.spc_id, S.spc_name, S.spc_desc, S.spc_contact, S.spc_address, S.spc_lat, S.spc_long, S.spc_avgprice, S.spc_numrooms, S.spc_roomavail, S.spc_status,
					T.typ_name, C.cty_name
					FROM (tbl_space S
					INNER JOIN tbl_type T ON S.typ_id = T.typ_id)
					INNER JOIN tbl_city C ON S.cty_id = C.cty_id
					WHERE S.cty_id = $city ".$order;
		else
			$sql = "SELECT S.spc_id, S.spc_name, S.spc_desc, S.spc_contact, S.spc_address, S.spc_lat, S.spc_long, S.spc_avgprice, S.spc_numrooms, S.spc_roomavail, S.spc_status,
					T.typ_name, C.cty_name
					FROM (tbl_space S
					INNER JOIN tbl_type T ON S.typ_id = T.typ_id)
					INNER JOIN tbl_city C ON S.cty_id = C.cty_id
					WHERE S.cty_id = $city AND S.typ_id = $type ".$order;
		
		$check = $this->db->query($sql);
		$count_row = $check->num_rows;
		if($count_row == 0)
				return false;
		else{
			$result = mysqli_query($this->db,$sql);
		
			while($row = mysqli_fetch_assoc($result))
				$list[] = $row;
		
			return $list;
		}
	}
	
	public function search_space($val){
		$sql = "SELECT S.spc_id, S.spc_name, S.spc_desc, S.spc_contact, S.spc_address, S.spc_lat, S.spc_long, S.spc_avgprice, S.spc_numrooms, S.spc_roomavail, S.spc_status,
				T.typ_name, C.cty_name
				FROM (tbl_space S
				INNER JOIN tbl_type T ON S.typ_id = T.typ_id)
				INNER JOIN tbl_city C ON S.cty_id = C.cty_id
				WHERE S.spc_id = $val OR S.spc_name LIKE '%$val%'";
		$check = $this->db->query($sql);
		$count_row = $check->num_rows;
		if($count_row == 0)
				return false;
		else{
			$result = mysqli_query($this->db,$sql);
		
			while($row = mysqli_fetch_assoc($result))
				$list[] = $row;
		
			return $list;
		}
	}
	
	public function update_spaceavailqty($id, $type){
		$sql = "SELECT * FROM tbl_space WHERE spc_id = $id";
		$check = $this->db->query($sql);
		
		$count_row = $check->num_rows;
		if($count_row == 1){
			if($type == 'ADD')
				$sql = "UPDATE tbl_space SET spc_roomavail = spc_roomavail + 1
						WHERE spc_id = $id";
			else if($type == 'DEDUCT')
				$sql = "UPDATE tbl_space SET spc_roomavail = spc_roomavail - 1
						WHERE spc_id = $id";
			
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Error: Cannot Edit Space Data");
			
			return $result;
		}
		else
			return false;
	}
	
	public function update_spaceqty($id, $qty){
		$sql = "SELECT * FROM tbl_space WHERE spc_id = $id";
		$check = $this->db->query($sql);
		
		$count_row = $check->num_rows;
		if($count_row == 1){
			$sql = "UPDATE tbl_space SET spc_numrooms = spc_numrooms + $qty, spc_roomavail = spc_roomavail + $qty
					WHERE spc_id = $id";
			
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Error: Cannot Edit Space Data");
			
			return $result;
		}
		else
			return false;
	}
	
	public function update_spaceavgprice($id, $price){
		$total = 0;
		$rooms = 0;
		$average = 0;
		
		$sql = "SELECT * FROM tbl_space WHERE spc_id = $id";
		
		$check = $this->db->query($sql);
		$count_row = $check->num_rows;
		if($count_row == 1){
			$sql = "SELECT * FROM tbl_room WHERE spc_id = $id";
		
			$result = mysqli_query($this->db,$sql);
			if($result){
				while($row = mysqli_fetch_assoc($result)){
					$total = $total + $row['rm_price'];
					
					$rooms = $rooms + 1;
				}
				
				$average = $total / $rooms;
			}

			$sql = "UPDATE tbl_space SET spc_avgprice = $average
					WHERE spc_id = $id";
			
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Error: Cannot Edit Space Data");
			
			return $result;
		}
		else
			return false;
	}
	
	public function get_cities(){
		$sql = "SELECT * FROM tbl_city ORDER BY cty_name ASC";
		
		$result = mysqli_query($this->db,$sql);
		
		while($row = mysqli_fetch_assoc($result))
			$list[] = $row;
		
		return $list;
	}
	
	public function get_types(){
		$sql = "SELECT * FROM tbl_type";
		
		$result = mysqli_query($this->db,$sql);
		
		while($row = mysqli_fetch_assoc($result))
			$list[] = $row;
		
		return $list;
	}
	
	public function get_rooms($id){
		$sql = "SELECT R.rm_id, R.rm_name, R.rm_desc, R.rm_price, R.rm_status, R.rm_tqty, R.rm_aqty, R.rm_pqty, P.pay_name
				FROM (tbl_room R 
				INNER JOIN tbl_payment P ON R.pay_id = P.pay_id)
				WHERE R.spc_id = $id";
		
		$result = mysqli_query($this->db,$sql);
		
		while($row = mysqli_fetch_assoc($result))
			$list[] = $row;
		
		return $list;
	}
	
	public function get_roominfo($id){
		$sql = "SELECT R.rm_name, R.rm_desc, R.rm_price, R.rm_status, R.rm_tqty, R.rm_aqty, R.rm_pqty, P.pay_name
				FROM (tbl_room R 
				INNER JOIN tbl_payment P ON R.pay_id = P.pay_id)
				WHERE R.rm_id = $id";
		
		$result = mysqli_query($this->db,$sql);
		
		while($row = mysqli_fetch_assoc($result))
			$list[] = $row;
		
		return $list;
	}
	
	public function new_room($name, $desc, $tqty, $pqty, $price, $pay, $space){
		$sql = "SELECT * FROM tbl_room WHERE rm_name = '$name'";
		$check=$this->db->query($sql);
		
		$count_row = $check->num_rows;
		if($count_row == 0){
			$sql = "INSERT INTO tbl_room(rm_name, rm_price, rm_pqty, rm_tqty, rm_aqty, spc_id, pay_id, rm_desc) 
					VALUES('$name', $price, $pqty, $tqty, $tqty, $space, $pay, '$desc')";
			
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
			return $result;
		}
		else
			return false;
	}
	
	public function update_room($rmid, $type){
		$sql = "SELECT * FROM tbl_room WHERE rm_id = $rmid";
		$check = $this->db->query($sql);
		
		$count_row = $check->num_rows;
		if($count_row == 1){
			if($type == 'DEDUCT')
				$sql = "UPDATE tbl_room SET rm_aqty = rm_aqty - 1
						WHERE rm_id = $rmid";
			else if($type == 'ADD')
				$sql = "UPDATE tbl_room SET rm_aqty = rm_aqty + 1
						WHERE rm_id = $rmid";
						
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Error: Cannot Edit Room Data");
			return $result;
		}
		else
			return false;
	}
	
	public function get_payments(){
		$sql = "SELECT * FROM tbl_payment";
		
		$result = mysqli_query($this->db,$sql);
		
		while($row = mysqli_fetch_assoc($result))
			$list[] = $row;
		
		return $list;
	}
}