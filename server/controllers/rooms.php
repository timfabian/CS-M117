<?php
require_once("../classes/Room.php");
require_once("../helpers/mysql.php");

if (!isset($_GET['lat']) || !isset($_GET['lon'])) {
	header("HTTP/1.0 400 Bad Request");
	die();
}

$stmt = $dbh->prepare("
		SELECT
			`room_id`,
			`friendly_name`,
			`north_latitude`,
			`south_latitude`,
			`east_longitude`,
			`west_longitude`
		FROM
			`rooms`
		WHERE
			`north_latitude` <= :lat AND
			`south_latitude` >= :lat AND
			`east_longitude` <= :lon AND
			`west_longitude` >= :lon
		");
$stmt->bindParam(':lat', $_GET['lat']);
$stmt->bindParam(':lon', $_GET['lon']);
if ($stmt->execute()) {
	while($row = $stmt->fetch()) {
		$rooms[] = new Room(
				$row['friendly_name'],
				$row['room_id'],
				$row['north_latitude'],
				$row['south_latitude'],
				$row['east_longitude'],
				$row['west_longitude']
		);
	}
}


$result = array(
	"number" => count($rooms),
	"rooms" => $rooms
);

header("Content-Type: application/json");
echo json_encode($result)."\n";
?>
