<?php
include 'library/config.php';
include 'classes/class.space.php';

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

$space = new Spaces();

$list = $space->get_spaces();

header("Content-type: text/xml");

foreach($list as $value){
	$node = $dom->createElement("marker");
	$newnode = $parnode->appendChild($node);
	$newnode->setAttribute("name", $value['spc_name']);
	$newnode->setAttribute("address", $value['spc_address']);
	$newnode->setAttribute("contact", $value['spc_contact']);
	$newnode->setAttribute("lat", $value['spc_lat']);
	$newnode->setAttribute("lng", $value['spc_long']);
	$newnode->setAttribute("type", $value['typ_name']);
}

echo $dom->saveXML();