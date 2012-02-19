<?php

if(!isset($_POST['device_id'])){
	header("HTTP/1.0 400 Bad Request");
	die();
}
$matches['nickname'] = $_POST['device_id'];

require_once("nickname_register.php");
?>
