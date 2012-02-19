<?php

class Message {
	public $message_id;
	public $timestamp;
	public $nickname;
	public $message;

	function Message($message_id, $timestamp, $nickname, $message) {
		$this->message_id = $message_id;
		$this->timestamp = $timestamp;
		$this->nickname = $nickname;
		$this->message = $message;
	}
}

?>
