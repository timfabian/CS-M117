<?php
require_once("../classes/Message.php");
require_once("../helpers/mysql.php");

$messageid = 0;
if(isset($_GET['message_id'])) {
	$messageid = $_GET['message_id'];
}

$stmt = $dbh->prepare("
		SELECT
			`m`.`message_id`,
			`m`.`timestamp`,
			`m`.`message`,
			`n`.`nickname`
		FROM
			`messages` as `m`
		LEFT OUTER JOIN
			`nicknames` as `n`
		ON
			`m`.`device_id` = `n`.`device_id`
		WHERE
			`room_id` = :roomid AND
			`message_id` > :messageid
		ORDER BY `timestamp`
		");
$stmt->bindParam(':roomid', $matches['roomid']);
$stmt->bindParam(':messageid', $messageid);

if ($stmt->execute()) {
	while($row = $stmt->fetch()) {
		$messages[] = new Message($row['message_id'],$row['timestamp'],$row['nickname'],$row['message']);
		unset($row);
	}
}
$result = array(
	"roomid" => $matches['roomid'],
	"number" => count($messages)."", //cast to string, to be consistent
	"results" => $messages
);


?>
