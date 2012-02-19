<?php

class Room {
	public $name;
	public $id;
	public $north;
	public $south;
	public $east;
	public $west;

	function Room($name, $id, $north, $south, $east, $west) {
		$this->name = $name;
		$this->id = $id;
		$this->north = $north;
		$this->south = $south;
		$this->east = $east;
		$this->west = $west;
	}
}

?>
