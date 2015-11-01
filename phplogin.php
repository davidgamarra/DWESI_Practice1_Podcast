<?php

$users = [
	"Juanito" => "1234",
	"Manolo" => "abcd",
	"Pedro" => "a1b2"
];

require './classes/AutoLoad.php';

$user = Request::post("username");
$pass = Request::post("password");

if(isset($users[$user]) && $users[$user] === $pass){
	$sesion = new Session();
	$sesion->setUser($user);
}
header("Location:index.php");
exit();