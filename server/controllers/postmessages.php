<?php
require_once("../classes/Message.php");
require_once("../helpers/mysql.php");

if(!isset($_POST['device_id']) || !(isset($_POST['message']))) {
	header("HTTP/1.0 400 Bad Request");
	die();
}
$success = false;
$insert_stmt = $dbh->prepare("
	INSERT INTO
		`messages` (
			`room_id`,
			`device_id`,
			`message`
		)
	VALUES 
		(
			:roomid,
			:deviceid,
			:message
		);
");
$insert_stmt->bindParam(':roomid', $matches['roomid']);
$insert_stmt->bindParam(':deviceid', $_POST['device_id']);
$insert_stmt->bindParam(':message', $_POST['message']);
if ($insert_stmt->execute()) {
	$success = true;
}
$postresult = array(
	"success" => $success,
	"roomid" => $matches['roomid']
);

if(isset($_REQUEST['message_id'])) {
	$_GET['message_id'] = $_REQUEST['message_id'];
	require_once("getmessages.php");
	$postresult["messages"] = $result;
}

$result = $postresult;

?>
