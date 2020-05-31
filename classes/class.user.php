<?php
class User{
	public $db;
	
	public function __construct(){
		$this->db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		if(mysqli_connect_errno()){
			echo "Database connection error.";
			exit;
		}
	}
	
	public function get_users(){
		$sql = "SELECT * FROM tbl_user";
		$result = mysqli_query($this->db,$sql);
		
		while($row = mysqli_fetch_assoc($result))
			$list[] = $row;
		
		return $list;
	}
	
	public function new_user($fname, $lname, $id, $password){
		$sql = "SELECT * FROM tbl_user WHERE usr_userid = '$id'";
		$check = $this->db->query($sql);
		
		$count_row = $check->num_rows;
		if($count_row == 0){
			$newpassword = md5($password);
			
			$sql = "INSERT INTO tbl_user(usr_userid, usr_password, usr_firstname, usr_lastname) 
					VALUES('$id', '$newpassword', '$fname', '$lname')";
			$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Error: Cannot Insert Data");
			
			return $result;
		}
		else
			return false;
	}
	
	public function search_user($val){
		$sql = "SELECT * FROM tbl_user
				WHERE usr_id = $val OR usr_userid = '$val' OR usr_firstname LIKE '%$val%' OR usr_lastname LIKE '%$val%'";
		
		$check = $this->db->query($sql);
		
		$count_row = $check->num_rows;
		if($count_row == 0)
			return false;
		else {
			$result = mysqli_query($this->db,$sql);
			
			while($row = mysqli_fetch_assoc($result))
				$list[] = $row;
		
			return $list;
		}
	}
	
	public function edit_user($id, $newuserid, $password, $firstname, $lastname){
		$sql = "SELECT * FROM tbl_user WHERE usr_id = $id";
		$check = $this->db->query($sql);
		
		$count_row = $check->num_rows;
		if($count_row == 1){
			$sqlcheck = "SELECT * FROM tbl_user WHERE usr_userid = '$newuserid'";
			$checkuserid = $this->db->query($sqlcheck);
			
			$count_row_check = $checkuserid->num_rows;
			if($count_row_check == 0){
				$newpassword = md5($password);
				
				$sqlupdate = "UPDATE tbl_user 
							SET usr_userid = '$newuserid', usr_password = '$newpassword', usr_firstname = '$firstname', usr_lastname = '$lastname'";
				
				$result = mysqli_query($this->db,$sqlupdate) or die(mysqli_error() . "Error: Cannot Edit Data");
			
				return $result;
			}
			else
				return false;
		}
		else
			return false;
	}
	
	public function delete_user($id){
		$sql = "DELETE FROM tbl_user WHERE usr_id = $id";
		
		$result = mysqli_query($this->db,$sql) or die(mysqli_error() . "Error: Cannot Delete Data");
			
		return $result;
	}
	
	public function user_login($email, $password){
		$sql = "SELECT * FROM tbl_user 
				WHERE usr_email = '$email' AND usr_password = '$password'";
		$result = mysqli_query($this->db,$sql);
		$userdata = mysqli_fetch_array($result);
		$count_row = $result->num_rows;
		
		if($count_row == 1){
			$_SESSION['login'] = true;
			$_SESSION['email'] = $userdata['usr_email'];
			$_SESSION['username'] = $userdata['usr_firstname']." ".$userdata['usr_lastname'];
			return true;
		}
		else
			return false;
	}
	
	public function get_session(){
		if(isset($_SESSION['login']) && $_SESSION['login'] == true)
			return true;
		else
			return false;
	}
}