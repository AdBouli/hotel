USE hotel;

CREATE TABLE hotel_users
(
	`id` int(6) NOT NULL AUTO_INCREMENT,
	`username` varchar(32) NOT NULL,
	`password` varchar(32) NOT NULL,
	`right` varchar(16) NOT NULL DEFAULT '*',
	`created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE hotel_types
(
	`id` int(6) NOT NULL AUTO_INCREMENT,
	`name` varchar(32) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE hotel_rooms
(
	`id` int(6) NOT NULL AUTO_INCREMENT,
	`num` int(3) NOT NULL,
	`person`int(1) NOT NULL DEFAULT 1,
	`floor` int(2) NOT NULL DEFAULT 0,
	`price` float(6, 2) NOT NULL,
	`type_id` int(6) NOT NULL,
	PRIMARY KEY (`id`),
	KEY `type_id` (`type_id`)
);

CREATE TABLE hotel_products
(
	`id` int(6) NOT NULL AUTO_INCREMENT,
	`name` varchar(32) NOT NULL,
	`price` float(6, 2) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE hotel_accounts
(
	`id` int(6) NOT NULL AUTO_INCREMENT,
	`name` varchar(32) NOT NULL,
	`firstname` varchar(32) NOT NULL,
	`address` varchar(255) NOT NULL DEFAULT 'vide',
	`phone` varchar(16) NOT NULL DEFAULT 'vide',
	`mail` varchar(128) NOT NULL DEFAULT 'vide',
	`created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE hotel_reservations
(
	`id` int(6) NOT NULL AUTO_INCREMENT,
	`account_id` int(6) NOT NULL,
	`room_id` int(6) NOT NULL,
	`dateStart` date NOT NULL,
	`dateEnd` date NOT NULL,
	`total` float(6, 2) NOT NULL,
	`paid` float(6, 2) NOT NULL DEFAULT 0,
	`user_id` int(6) NOT NULL DEFAULT 1,
	`created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY (`id`),
	KEY `account_id` (`account_id`),
	KEY `room_id` (`room_id`),
	KEY `user_id` (`user_id`)
);

CREATE TABLE hotel_orders
(
	`id` int(6) NOT NULL AUTO_INCREMENT,
	`reservation_id` int(6) NOT NULL,
	`total` float(6, 2) NOT NULL,
	`paid` int(1) NOT NULL DEFAULT 0,
	`user_id` int(6) NOT NULL DEFAULT 1,
	`created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`modified` timestamp NOT NULL,
	PRIMARY KEY (`id`),
	KEY `reservation_id` (`reservation_id`),
	KEY `user_id` (`user_id`)
);

CREATE TABLE hotel_products_orders
(
	`id` int(6) NOT NULL AUTO_INCREMENT,
	`product_id` int(6) NOT NULL,
	`order_id` int(6) NOT NULL,
	`quantity` int(2) NOT NULL,
	`total` float(6, 2) NOT NULL,
	`user_id` int(6) NOT NULL DEFAULT 1,
	`created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	UNIQUE KEY `hotel_products_orders_id_2` (`product_id`,`order_id`),
	KEY `product_id` (`product_id`),
	KEY `order_id` (`order_id`),
	KEY `user_id` (`user_id`)
);


CREATE TABLE hotel_reservations_history
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`action` varchar(8) NOT NULL,
	`user` varchar(32) NOT NULL,
	`reservation_id` int(6) NOT NULL,
	`account_id` int(6) NOT NULL,
	`room_id` int(6) NOT NULL,
	`account` text NOT NULL,
	`room` varchar(64) NOT NULL,
	`dates` varchar(32) NOT NULL,
	`total` varchar(8) NOT NULL,
	`paid` varchar(8) NOT NULL,
	`created` timestamp NOT NULL,
	`modified` timestamp NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE hotel_orders_history
(
	`id` int(6) NOT NULL AUTO_INCREMENT,
	`action` varchar(8) NOT NULL,
	`user` varchar(32) NOT NULL,
	`order_id` int(6) NOT NULL,
	`reservation_id` int(6) NOT NULL,
	`reservation` varchar(128) NOT NULL,
	`total` varchar(8) NOT NULL,
	`paid` varchar(8) NOT NULL,
	`created` timestamp NOT NULL,
	`modified` timestamp NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE hotel_products_orders_history
(
	`id` int(6) NOT NULL AUTO_INCREMENT,
	`action` varchar(8) NOT NULL,
	`user` varchar(32) NOT NULL,
	`product_order_id` int(6) NOT NULL,
	`product_id` int(6) NOT NULL,
	`order_id` int(6) NOT NULL,
	`product` varchar(64) NOT NULL,
	`order` varchar(128) NOT NULL,
	`quantity` varchar(8) NOT NULL,
	`total` varchar(8) NOT NULL,
	`created` timestamp NOT NULL,
	PRIMARY KEY (`id`)
);

INSERT INTO `hotel_users` (`username`, `password`, `right`) VALUES
('admin', 'aa36dc6e81e2ac7ad03e12fedcb6a2c0', 'all');