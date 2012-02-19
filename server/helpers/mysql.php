<?php
require_once("config.php");
try {
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass, array(PDO::ATTR_PERSISTENT => true));
} catch (PDOException $e) {
	print "Could not connect to database.\n";
}
?>
