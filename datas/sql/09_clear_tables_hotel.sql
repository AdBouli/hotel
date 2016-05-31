USE hotel;

DELETE FROM `hotel_products_orders`;
ALTER TABLE `hotel_products_orders` AUTO_INCREMENT = 1;

DELETE FROM `hotel_orders`;
ALTER TABLE `hotel_orders` AUTO_INCREMENT = 1;

DELETE FROM `hotel_reservations`;
ALTER TABLE `hotel_reservations` AUTO_INCREMENT = 1;

DELETE FROM `hotel_accounts`;
ALTER TABLE `hotel_accounts` AUTO_INCREMENT = 1;

DELETE FROM `hotel_products`;
ALTER TABLE `hotel_products` AUTO_INCREMENT = 1;

DELETE FROM `hotel_rooms`;
ALTER TABLE `hotel_rooms` AUTO_INCREMENT = 1;

DELETE FROM `hotel_types`;
ALTER TABLE `hotel_types` AUTO_INCREMENT = 1;

DELETE FROM `hotel_types` WHERE `id` <> 1;
ALTER TABLE `hotel_types` AUTO_INCREMENT = 1;