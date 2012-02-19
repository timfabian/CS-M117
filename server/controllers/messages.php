<?php
switch($_SERVER['REQUEST_METHOD'])
{
	case 'POST':
		require_once("postmessages.php");
		break;
	case 'GET':
	default:
		require_once("getmessages.php");
		break;
}

header("Content-Type: application/json");
echo json_encode($result)."\n";
?>
