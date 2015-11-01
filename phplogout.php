<?php
require './classes/AutoLoad.php';

$sesion = new Session();
$sesion->destroy();
header("Location:index.php");
exit();