<?php
require_once("../helpers/mysql.php");

if(!isset($_POST['device_id'])){
	header("HTTP/1.0 400 Bad Request");
	die();
}

$select_stmt = $dbh->prepare("
	SELECT
		*
	FROM
		`nicknames`
	WHERE
		`device_id` = :deviceid;
");
$insert_stmt = $dbh->prepare("
	INSERT INTO
		`nicknames` (
			`device_id`,
			`nickname`
		)
	VALUES 
		(
			:deviceid,
			:nickname
		);
");
$update_stmt = $dbh->prepare("
	UPDATE
		`nicknames`
	SET
		`nickname` = :nickname
	WHERE
		`device_id` = :deviceid
	LIMIT 1;
");
$select_stmt->bindParam(':deviceid', $_POST['device_id']);
$insert_stmt->bindParam(':deviceid', $_POST['device_id']);
$insert_stmt->bindParam(':nickname', $matches['nickname']);
$update_stmt->bindParam(':deviceid', $_POST['device_id']);
$update_stmt->bindParam(':nickname', $matches['nickname']);
$success = false;
if ($select_stmt->execute()) {
	if($row = $select_stmt->fetch() && $update_stmt->execute()) {
		$success = true;
	} elseif ($insert_stmt->execute()) {
		$success = true;
	}
}
$result = array(
	"success" => $success
);
header("Content-Type: application/json");
echo json_encode($result)."\n";
?>
