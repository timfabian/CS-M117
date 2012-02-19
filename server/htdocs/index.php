<?php
$routes = array(
	"#^/rooms(\?.*)?$#" => "rooms.php",
	"#^/rooms/create$#" => "createroom.php",
	"#^/rooms/(?P<roomid>\d+)(\?.*)?$#" => "messages.php",
	"#^/nickname/(?P<nickname>\w+)/register$#" => "nickname_register.php",
	"#^/nickname/(?P<nickname>\w+)/unregister$#" => "nickname_unregister.php"
);

foreach ($routes as $route => $include) {
	if (preg_match($route,$_SERVER['REQUEST_URI'],$matches)){
		if (file_exists("../controllers/".$include)) {
			require("../controllers/".$include);
			die();
		}
		echo "<pre>";
		echo $_SERVER['REQUEST_URI']."\n";
		print_r($matches);
		echo "\nInclude: ".($include);
		echo "</pre>";
	}
}

?>
