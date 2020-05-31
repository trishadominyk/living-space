<?php
include '../library/config.php';
include '../classes/class.space.php';
include '../classes/class.pending.php';

$spcid = (isset($_GET['spcid']) && $_GET['spcid'] != '') ? $_GET['spcid'] : '';
$rmid = (isset($_GET['rmid']) && $_GET['rmid'] != '') ? $_GET['rmid'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

$email = (isset($_GET['email']) && $_GET['email'] != '') ? $_GET['email'] : '';

//for new space
$name = (isset($_GET['name']) && $_GET['name'] != '') ? $_GET['name'] : '';
$address = (isset($_GET['address']) && $_GET['address'] != '') ? $_GET['address'] : '';
$city = (isset($_GET['city']) && $_GET['city'] != '') ? $_GET['city'] : '';
$type = (isset($_GET['type']) && $_GET['type'] != '') ? $_GET['type'] : '';
$lat = (isset($_GET['lat']) && $_GET['lat'] != '') ? $_GET['lat'] : '';
$lng = (isset($_GET['lng']) && $_GET['lng'] != '') ? $_GET['lng'] : '';
$contact = (isset($_GET['contact']) && $_GET['contact'] != '') ? $_GET['contact'] : '';
$desc = (isset($_GET['desc']) && $_GET['desc'] != '') ? $_GET['desc'] : '';

switch($action){
	case 'spacenew':
		spacenew($name, $address, $city, $type, $lat, $lng, $contact, $desc);
	break;
	case 'spacedelete':
		spacedelete($spcid);
	break;
	case 'spaceedit':
		spaceedit($spcid);
	break;
	
	case 'roomnew':
		roomnew($spcid);
	break;
	case 'roomedit':
	
	break;
	
	case 'pendingconfirm':
		pendingconfirm($email);
	break;
	case 'pendingdelete':
		pendingdelete($spcid, $rmid, $email);
	break;
}

function spacenew($name, $address, $city, $type, $lat, $lng, $contact, $desc){
	$space = new Spaces();
	$space->new_space($name, $address, $city, $type, $lat, $lng, $contact, $desc);
	
	header("location: ../index.php?mod=admin&sub=view");
	exit;
}

function roomnew($spcid){
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$tqty = $_POST['tqty'];
	$pqty = $_POST['pqty'];
	$price = $_POST['price'];
	$payment = $_POST['payment'];
	
	$space = new Spaces();
	$result = $space->new_room($name, $desc, $tqty, $pqty, $price, $payment, $spcid);
	$result = $space->update_spaceqty($spcid, $tqty);
	$result = $space->update_spaceavgprice($spcid, $price);
	
	$msg = ($result) ? "Your transaction is being processed.": "Error: cannot process transaction.";
	
	header("location: ../index.php?mod=admin&sub=info&id=$spcid&msg=$msg");
	exit;
}

function pendingconfirm($email){
	$pending = new Pending();
	$pending->confirm_pending($email);
	
	header("location: ../index.php?mod=admin&sub=pending");
	exit;
}

function pendingdelete($spcid, $rmid, $email){
	$pending = new Pending();
	$pending->delete_pending($email);
	
	$space = new Spaces();
	$space->update_spaceavailqty($spcid, 'ADD');
	$space->update_room($rmid, 'ADD');
	
	header("location: ../index.php?mod=admin&sub=pending");
	exit;
}