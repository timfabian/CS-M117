<?php
if (!isset($_GET['route'])) {
	header("HTTP/1.0 400 Bad Request");
}

switch($_GET['route']) {
	case "rooms":
		$_SERVER['REQUEST_URI'] = "/rooms/".$_REQUEST['roomid'];
		break;
	case "create_rooms":
		die();
		break;
	case "nickname_register":
		$_SERVER['REQUEST_URI'] = "/nickname/".$_REQUEST['nickname']."/register";
		break;
	case "nickname_unregister":
		$_SERVER['REQUEST_URI'] = "/nickname/".$_REQUEST['nickname']."/unregister";
		break;
}

require_once("index.php");

?>
