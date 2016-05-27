USE hotel;

-- HOTEL_RESERVATIONS
delimiter |

CREATE TRIGGER histo_AI_reservations AFTER INSERT ON hotel_reservations
	FOR EACH ROW
	BEGIN
		DECLARE User varchar(32);
		DECLARE Account text;
		DECLARE Room varchar(64);
		DECLARE Dates varchar(32);
		-- Historisation
		SET User = (SELECT `username` FROM `hotel_users` WHERE `id` = NEW.user_id);
		SET Account = (SELECT CONCAT(`name`, ' - ', `firstname`, ' - ', `address`, ' - ', `phone`, ' - ', `mail`)
			FROM `hotel_accounts` WHERE `id` = NEW.account_id);
		SET Room = (SELECT CONCAT(R.`num`, ' - ', R.`person`, ' - ', R.`floor`, ' - ', T.`name`)
			FROM `hotel_rooms` R INNER JOIN `hotel_types` T ON T.`id` = R.`type_id` WHERE R.`id` = NEW.room_id);
		SET Dates = CONCAT(NEW.dateStart, ' - ', NEW.dateEnd);
		INSERT INTO  hotel_reservations_history (action, user, reservation_id, account_id, room_id, account, room, dates, total, paid, created, modified)
			VALUES ('INSERT', User, NEW.id, NEW.account_id, NEW.room_id, Account, Room, Dates, NEW.total, NEW.paid, NEW.created, NEW.modified);
	END;
|

delimiter ;

delimiter |

CREATE TRIGGER histo_AU_reservations AFTER UPDATE ON hotel_reservations
	FOR EACH ROW
	BEGIN
		DECLARE User varchar(32);
		DECLARE Account text;
		DECLARE Room varchar(64);
		DECLARE Dates varchar(32);
		-- Historisation
		SET User = (SELECT `username` FROM `hotel_users` WHERE `id` = NEW.user_id);
		SET Account = (SELECT CONCAT(`name`, ' - ', `firstname`, ' - ', `address`, ' - ', `phone`, ' - ', `mail`)
			FROM `hotel_accounts` WHERE `id` = NEW.account_id);
		SET Room = (SELECT CONCAT(R.`num`, ' - ', R.`person`, ' - ', R.`floor`, ' - ', T.`name`)
			FROM `hotel_rooms` R INNER JOIN `hotel_types` T ON T.`id` = R.`type_id` WHERE R.`id` = NEW.room_id);
		SET Dates = CONCAT(NEW.dateStart, ' - ', NEW.dateEnd);
		INSERT INTO  hotel_reservations_history (action, user, reservation_id, account_id, room_id, account, room, dates, total, paid, created, modified)
			VALUES ('UPDATE', User, NEW.id, NEW.account_id, NEW.room_id, Account, Room, Dates, NEW.total, NEW.paid, NEW.created, NEW.modified);
	END;
|

delimiter ;

delimiter |

CREATE TRIGGER histo_BD_reservations BEFORE DELETE ON hotel_reservations
	FOR EACH ROW
	BEGIN
		DECLARE User varchar(32);
		DECLARE Account text;
		DECLARE Room varchar(64);
		DECLARE Dates varchar(32);
		-- Historisation
		SET User = (SELECT `username` FROM `hotel_users` WHERE `id` = OLD.user_id);
		SET Account = (SELECT CONCAT(`name`, ' - ', `firstname`, ' - ', `address`, ' - ', `phone`, ' - ', `mail`)
			FROM `hotel_accounts` WHERE `id` = OLD.account_id);
		SET Room = (SELECT CONCAT(R.`num`, ' - ', R.`person`, ' - ', R.`floor`, ' - ', T.`name`)
			FROM `hotel_rooms` R INNER JOIN `hotel_types` T ON T.`id` = R.`type_id` WHERE R.`id` = OLD.room_id);
		SET Dates = CONCAT(OLD.dateStart, ' - ', OLD.dateEnd);
		INSERT INTO  hotel_reservations_history (action, user, reservation_id, account_id, room_id, account, room, dates, total, paid, created, modified)
			VALUES ('DELETE', User, OLD.id, OLD.account_id, OLD.room_id, Account, Room, Dates, OLD.total, OLD.paid, OLD.created, OLD.modified);
	END;
|

delimiter ;

-- HOTEL_ORDERS

delimiter |
CREATE TRIGGER setReservationTotal_histo_AI_orders AFTER INSERT ON hotel_orders
	FOR EACH ROW
	BEGIN
		DECLARE User varchar(32);
		DECLARE Reservation varchar(128);
		-- Set new reservation total
		UPDATE hotel_reservations SET total = total + NEW.total WHERE id = NEW.reservation_id;
		-- Historisation
		SET User = (SELECT `username` FROM `hotel_users` WHERE `id` = NEW.user_id);
		SET Reservation = (SELECT CONCAT(`dateStart`, ' - ', `dateEnd`, ' - ', `total`, ' - ', `paid`, ' - ', `user_id`, ' - ', `created`, ' - ', `modified`)
			FROM `hotel_reservations` WHERE `id` = NEW.reservation_id);
		INSERT INTO  hotel_orders_history (action, user, order_id, reservation_id, reservation, total, paid, created, modified)
			VALUES ('INSERT', User, NEW.id, NEW.reservation_id, Reservation, NEW.total, NEW.paid, NEW.created, NEW.modified);
	END
|

delimiter ;

delimiter |
CREATE TRIGGER setReservationTotal_histo_AU_orders AFTER UPDATE ON hotel_orders
	FOR EACH ROW
	BEGIN
		DECLARE User varchar(32);
		DECLARE Reservation varchar(128);
		-- Set new reservation total
		IF (OLD.total <> NEW.total) THEN
			UPDATE hotel_reservations SET total = total + NEW.total - OLD.total WHERE id = NEW.reservation_id;
		END IF;
		IF (OLD.paid < NEW.paid) THEN
			UPDATE hotel_reservations SET paid = paid + NEW.total WHERE id = NEW.reservation_id;
		END IF;
		-- Historisation
		SET User = (SELECT `username` FROM `hotel_users` WHERE `id` = NEW.user_id);
		SET Reservation = (SELECT CONCAT(`dateStart`, ' - ', `dateEnd`, ' - ', `total`, ' - ', `paid`, ' - ', `user_id`, ' - ', `created`, ' - ', `modified`)
			FROM `hotel_reservations` WHERE `id` = NEW.reservation_id);
		INSERT INTO  hotel_orders_history (action, user, order_id, reservation_id, reservation, total, paid, created, modified)
			VALUES ('UPDATE', User, NEW.id, NEW.reservation_id, Reservation, NEW.total, NEW.paid, NEW.created, NEW.modified);
	END
|

delimiter ;

delimiter |
CREATE TRIGGER setReservationTotal_histo_BD_orders BEFORE DELETE ON hotel_orders
	FOR EACH ROW
	BEGIN
		DECLARE User varchar(32);
		DECLARE Reservation varchar(128);
		-- Set new reservation total
		UPDATE hotel_reservations SET total = total - OLD.total WHERE id = OLD.reservation_id;
		IF (OLD.paid = 1) THEN
			UPDATE hotel_reservations SET paid = paid . OLD.total WHERE id = OLD.reservation_id;
		END IF;
		-- Historisation
		SET User = (SELECT `username` FROM `hotel_users` WHERE `id` = OLD.user_id);
		SET Reservation = (SELECT CONCAT(`dateStart`, ' - ', `dateEnd`, ' - ', `total`, ' - ', `paid`, ' - ', `user_id`, ' - ', `created`, ' - ', `modified`)
			FROM `hotel_reservations` WHERE `id` = OLD.reservation_id);
		INSERT INTO  hotel_orders_history (action, user, order_id, reservation_id, reservation, total, paid, created, modified)
			VALUES ('DELETE', User, OLD.id, OLD.reservation_id, Reservation, OLD.total, OLD.paid, OLD.created, OLD.modified);
	END
|

delimiter ;

-- HOTEL_PRODUCTS_ORDERS

delimiter |

CREATE TRIGGER setOrderTotal_histo_AI_products_orders AFTER INSERT ON hotel_products_orders
	FOR EACH ROW
	BEGIN
		DECLARE User varchar(32);
		DECLARE	Commande varchar(128);
		DECLARE	Product varchar(64);
		-- Set new order total
		UPDATE hotel_orders SET total = total + NEW.total WHERE id = NEW.order_id;
		-- Historisation
		SET User = (SELECT `username` FROM `hotel_users` WHERE `id` = NEW.user_id);
		SET Commande = (SELECT CONCAT(`reservation_id`, ' - ', `total`, ' - ', `paid`, ' - ', `user_id`, ' - ', `created`, ' - ', `modified`)
			FROM `hotel_orders` WHERE `id` = NEW.order_id);
		SET Product = (SELECT CONCAT(`name`, ' - ', `price`)
			FROM `hotel_products` WHERE `id` = NEW.product_id);
		INSERT INTO hotel_products_orders_history (action, user, product_order_id, product_id, order_id, product, `order`, quantity, total, created)
			VALUES ('INSERT', User, NEW.id, NEW.product_id, NEW.order_id, Product, Commande, NEW.quantity, NEW.total, NEW.created);
	END;
|

delimiter ;

delimiter |
CREATE TRIGGER setOrderTotal_histo_AU_products_orders AFTER UPDATE ON hotel_products_orders
	FOR EACH ROW
	BEGIN
		DECLARE User varchar(32);
		DECLARE	Commande varchar(128);
		DECLARE	Product varchar(64);
		-- Set new order total
		UPDATE hotel_orders SET total = total + NEW.total - OLD.total WHERE id = NEW.order_id;
		-- Historisation
		SET User = (SELECT `username` FROM `hotel_users` WHERE `id` = NEW.user_id);
		SET Commande = (SELECT CONCAT(`reservation_id`, ' - ', `total`, ' - ', `paid`, ' - ', `user_id`, ' - ', `created`, ' - ', `modified`)
			FROM `hotel_orders` WHERE `id` = NEW.order_id);
		SET Product = (SELECT CONCAT(`name`, ' - ', `price`)
			FROM `hotel_products` WHERE `id` = NEW.product_id);
		INSERT INTO hotel_products_orders_history (action, user, product_order_id, product_id, order_id, product, `order`, quantity, total, created)
			VALUES ('UPDATE', User, NEW.id, NEW.product_id, NEW.order_id, Product, Commande, NEW.quantity, NEW.total, NEW.created);
	END
|

delimiter ;

delimiter |
CREATE TRIGGER setOrderTotal_histo_BD_products_orders BEFORE DELETE ON hotel_products_orders
	FOR EACH ROW
	BEGIN
		DECLARE User varchar(32);
		DECLARE	Commande varchar(128);
		DECLARE	Product varchar(64);
		-- Set new order total
		UPDATE hotel_orders SET total = total - OLD.total WHERE id = OLD.order_id;
		-- Historisation
		SET User = (SELECT `username` FROM `hotel_users` WHERE `id` = OLD.user_id);
		SET Commande = (SELECT CONCAT(`reservation_id`, ' - ', `total`, ' - ', `paid`, ' - ', `user_id`, ' - ', `created`, ' - ', `modified`)
			FROM `hotel_orders` WHERE `id` = OLD.order_id);
		SET Product = (SELECT CONCAT(`name`, ' - ', `price`)
			FROM `hotel_products` WHERE `id` = OLD.product_id);
		INSERT INTO hotel_products_orders_history (action, user, product_order_id, product_id, order_id, product, `order`, quantity, total, created)
			VALUES ('DELETE', User, OLD.id, OLD.product_id, OLD.order_id, Product, Commande, OLD.quantity, OLD.total, OLD.created);
	END
|

delimiter ;