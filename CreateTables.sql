| users | 

CREATE TABLE `users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` char(40) NOT NULL,
  `role` varchar(40) NOT NULL,
  PRIMARY KEY (`user_id`)
) 

| payment | 

CREATE TABLE `payment` (
  `payment_id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `reservation_id` mediumint(9) NOT NULL,
  `payment_type` varchar(10) NOT NULL,
  PRIMARY KEY (`payment_id`),
  UNIQUE KEY `payment_id` (`payment_id`)
)

| reservation | 

CREATE TABLE `reservation` (
  `reservation_id` mediumint(4) unsigned NOT NULL AUTO_INCREMENT,
  `checkin_date` date NOT NULL,
  `checkin_time` time NOT NULL,
  `checkout_time` time NOT NULL,
  `totalhours` time NOT NULL,
  `room_id` mediumint(9) NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  `payment_id` mediumint(8) unsigned NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`reservation_id`)
) 

| room  | 

CREATE TABLE `room` (
  `room_id` bigint(8) unsigned NOT NULL AUTO_INCREMENT,
  `max_occ` int(11) NOT NULL,
  `rate` double NOT NULL,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`room_id`)
) 

| room_reserve | 

CREATE TABLE `room_reserve` (
  `reservation_id` mediumint(9) unsigned NOT NULL,
  `room_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`reservation_id`)
)

