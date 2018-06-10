<?php
class Pending{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}
	
	public function get_pending(){
		$sql = "SELECT P.pnd_id, P.pnd_fname, P.pnd_mname, P.pnd_lname, P.pnd_email, P.pnd_contact, P.pnd_date_added, P.pnd_date_expire, P.pnd_status, R.rm_id, R.rm_name, S.spc_id, S.spc_name
				FROM (tbl_pending P
				INNER JOIN tbl_room R ON P.rm_id = R.rm_id)
				INNER JOIN tbl_space S ON R.spc_id = S.spc_id
				WHERE P.pnd_status <> 'CONFIRMED'";
		$result = mysqli_query($this->db,$sql);
		
		while($row = mysqli_fetch_assoc($result))
			$list[] = $row;
		
		return $list;
	}
	
	public function get_confirmed(){
		$sql = "SELECT P.pnd_id, P.pnd_fname, P.pnd_mname, P.pnd_lname, P.pnd_email, P.pnd_contact, P.pnd_date_added, P.pnd_date_expire, P.pnd_status, R.rm_id, R.rm_name, S.spc_id, S.spc_name
				FROM (tbl_pending P
				INNER JOIN tbl_room R ON P.rm_id = R.rm_id)
				INNER JOIN tbl_space S ON R.spc_id = S.spc_id
				WHERE P.pnd_status <> 'PENDING'";
		$result = mysqli_query($this->db,$sql);
		
		while($row = mysqli_fetch_assoc($result))
			$list[] = $row;
		
		return $list;
	}
	
	public function get_roompending($id){
		$sql = "SELECT P.pnd_id, P.pnd_fname, P.pnd_mname, P.pnd_lname, P.pnd_email, P.pnd_contact, P.pnd_date_added, P.pnd_date_expire, P.pnd_status, R.rm_id, R.rm_name, S.spc_id, S.spc_name
				FROM (tbl_pending P
				INNER JOIN tbl_room R ON P.rm_id = R.rm_id)
				INNER JOIN tbl_space S ON R.spc_id = S.spc_id
				WHERE P.rm_id = $id AND P.pnd_status <> 'CONFIRMED'";
		$result = mysqli_query($this->db,$sql);
		
		while($row = mysqli_fetch_assoc($result))
			$list[] = $row;
		
		return $list;
	}
	
	public function get_numberpending($id){
		$sql = "SELECT COUNT(pnd_id) AS totalpending FROM tbl_pending
				WHERE rm_id = $id AND pnd_status <> 'CONFIRMED'";
		$result = mysqli_query($this->db,$sql);
		
		if($result){
			$row = mysqli_fetch_assoc($result);
			$value = $row['totalpending'];
		}
		
		return $value;
	}
	
	public function new_pending($fname, $mname, $lname, $email, $contact, $rmid){
		$sql = "SELECT * FROM tbl_pending WHERE pnd_email = '$email'";
		$check=$this->db->query($sql);
		
		$count_row = $check->num_rows;
		if($count_row == 0){
			$expire = date('Y-m-d', strtotime("+30 days"));
			
			$sql = "INSERT INTO tbl_pending(pnd_fname, pnd_mname, pnd_lname, pnd_email, pnd_contact, pnd_date_added, pnd_date_expire, rm_id) 
					VALUES('$fname', '$mname', '$lname', '$email', '$contact', CURDATE(), '$expire', $rmid)";
			
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Cannot Insert Data");
			return $result;
		}
		else
			return false;
	}
	
	public function delete_pending($email){
		$sql="DELETE FROM tbl_pending WHERE pnd_email='$email'";
		$result=mysqli_query($this->db,$sql);
		return;
	}
	
	public function confirm_pending($email){
		$sql = "SELECT * FROM tbl_pending WHERE pnd_email = '$email'";
		$check = $this->db->query($sql);
		
		$count_row = $check->num_rows;
		if($count_row == 1){
			$sql = "UPDATE tbl_pending SET pnd_status = 'CONFIRMED'
					WHERE pnd_email = '$email'";
			
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Error: Cannot Edit Pending Data");
			
			return $result;
		}
		else
			return false;
	}
}