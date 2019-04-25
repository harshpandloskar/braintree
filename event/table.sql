USE `creatsm3_eventticketing`;

SET SQL_SAFE_UPDATES = 0;

-- SELECT * FROM `booking` WHERE userName = 'rajendraarora16';
-- DROP TABLE IF EXISTS `users`;
-- CREATE TABLE `users` ( 
-- --     UserNameID int(9) NOT NULL auto_increment,
-- --     userName VARCHAR(40) NOT NULL,
-- --     userEmail VARCHAR(40) NOT NULL,
-- --     userFullName VARCHAR(40) NOT NULL,
-- --     pass VARCHAR(40) NOT NULL, 
-- --     PRIMARY KEY(UserNameID) 
-- -- );

-- DROP TABLE IF exists `booking`;

-- CREATE TABLE `booking` ( 
--     UserNameID int(9) NOT NULL auto_increment,
--     userName VARCHAR(40) NOT NULL,
--     userEmail VARCHAR(40) NOT NULL,
--     bookingID VARCHAR(100) NOT NULL,
--     seatNum VARCHAR(100) NOT NULL,
--     eventName VARCHAR(100) NOT NULL,
--     eventDay VARCHAR(40) NOT NULL,
--     eventTime VARCHAR(40) NOT NULL,
-- 	bookingStatus VARCHAR(100) NOT NULL,
--     waitingStatus VARCHAR(100) NOT NULL,
--     PRIMARY KEY(UserNameID) 
-- );

-- DROP TABLE IF EXISTS `ticket_tbl`;

-- CREATE TABLE if not exists `ticket_tbl` ( 
--     `UserNameID` int(9) NOT NULL auto_increment,
--     `events` VARCHAR(100) NOT NULL,
--     `ticket_limit` INT UNSIGNED NOT NULL,
--     `isWaitingList` VARCHAR(10) NOT NULL,
--     PRIMARY KEY(UserNameID) 
-- );

-- INSERT INTO `ticket_tbl` VALUES('', 'A Flair to Remember', '2', 'N');
-- INSERT INTO `ticket_tbl` VALUES('', 'A Series of Fortunate Events', '2', 'N');
-- INSERT INTO `ticket_tbl` VALUES('', 'Effortless Events', '2', 'N');
-- INSERT INTO `ticket_tbl` VALUES('', 'Belle of the Ball', '2', 'N');
-- INSERT INTO `ticket_tbl` VALUES('', 'Picture Perfect', '2', 'N');
-- INSERT INTO `ticket_tbl` VALUES('', 'Ceremony Events', '2', 'N');
-- INSERT INTO `ticket_tbl` VALUES('', 'Corporate Affairs', '2', 'N');
-- INSERT INTO `ticket_tbl` VALUES('', 'Corroboree', '2', 'N');
-- INSERT INTO `ticket_tbl` VALUES('', 'Dream Wedding', '2', 'N');
-- INSERT INTO `ticket_tbl` VALUES('', 'Celebrations', '2', 'N');
-- DROP TABLE IF EXISTS `users`;
-- DROP TABLE IF EXISTS `notification`;
-- CREATE TABLE IF NOT EXISTS `notification` (
-- 	UserNameID int(9) NOT NULL auto_increment,
--     userEmail VARCHAR(100) NOT NULL,
--     shouldDisplay VARCHAR(10) NOT NULL,
--     notificationMsg VARCHAR(100) NOT NULL,
--     PRIMARY KEY(UserNameID)
-- );
-- UPDATE `ticket_tbl` SET ticket_limit='1' WHERE events='Dirty Grandpa';
-- UPDATE `ticket_tbl` SET shouldDisplay='Y' WHERE userEmail='rajendra@gmail.com';
-- UPDATE `notification` SET shouldDisplay='Y', notificationMsg='Your ticket is confirmed from queue' WHERE userEmail='C@gmail.com';
SELECT * FROM `users`;