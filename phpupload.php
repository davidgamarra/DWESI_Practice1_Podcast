<?php
require './classes/AutoLoad.php';

$sesion = new Session();
$user = $sesion->getUser();

$name = Request::post("name");
$category = Request::post("category");
$music = new FileUpload("music");
$music->setDestination("./data/audio/");
$music->setName($user."_".$category."_".$name);
if($music->upload() == 1){
	$image = new FileUpload("image");
	$image->setDestination("./data/img/");
	$image->setName($user."_".$category."_".$name);
	$image->upload();
	header("Location:upload.php?uploaded=correct");
	exit();
} else {
	header("Location:upload.php?uploaded=incorrect");
	exit();
}