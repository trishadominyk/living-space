<?php
include '../library/config.php';
include '../classes/class.space.php';
include '../classes/class.pending.php';

$spcid = (isset($_GET['spcid']) && $_GET['spcid'] != '') ? $_GET['spcid'] : '';
$rmid = (isset($_GET['rmid']) && $_GET['rmid'] != '') ? $_GET['rmid'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch($action){
	case 'spaceapply':
		spaceapply($spcid, $rmid);
	break;
}

function spaceapply($spcid, $rmid){
	$fname = strtoupper($_POST['fname']);
	$lname = strtoupper($_POST['lname']);
	$mname = strtoupper($_POST['mname']);
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	
	$pending = new Pending();
	$result = $pending->new_pending($fname, $mname, $lname, $email, $contact, $rmid);
	
	$space = new Spaces();
	$result = $space->update_room($rmid, 'DEDUCT');
	$result = $space->update_spaceavailqty($spcid, 'DEDUCT');
	
	$msg = ($result) ? "Your transaction is being processed.": "Error: cannot process transaction.";
	
	header("location: ../index.php?mod=spaces&sub=info&id=$spcid&msg=$msg");
	exit;
}