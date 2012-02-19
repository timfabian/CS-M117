CREATE TABLE rooms (
	room_id		INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	friendly_name	VARCHAR(64) NOT NULL,
	north_latitude	DOUBLE NOT NULL,
	south_latitude	DOUBLE NOT NULL,
	east_longitude	DOUBLE NOT NULL,
	west_longitude	DOUBLE NOT NULL
);

CREATE TABLE nicknames (
	device_id	INT NOT NULL,
	nickname	VARCHAR(64) NOT NULL,
	PRIMARY KEY ( `device_id` ),
	UNIQUE ( `nickname` )
);

CREATE TABLE messages (
	message_id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	room_id		INT NOT NULL,
	device_id	INT NOT NULL,
	timestamp	TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	message		VARCHAR(256) NOT NULL,
	Foreign Key (room_id) references rooms(room_id),
	Foreign Key (device_id) references nicknames(device_id)
);
