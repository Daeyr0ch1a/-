CREATE DATABASE photo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE photo;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `comments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `Text` text NOT NULL,
  `PoS_date` date NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UID` (`UID`),
  KEY `PID` (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `photos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UID` int(11) NOT NULL,
  `Imag` text NOT NULL,
  `Text` text NOT NULL,
  `Tags` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UID` (`UID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `photos` (`ID`, `UID`, `Imag`, `Text`, `Tags`) VALUES
(1, 0, 'Images/1.jpg', 'Круто', 'Круто'),
(2, 0, 'Images/2.jpg', 'Круто', 'Круто'),
(3, 1, 'Images/3.jpg', 'Круто', 'Круто'),
(4, 1, 'Images/4.jpg', 'Круто', 'Круто'),
(5, 2, 'Images/5.jpg', 'Круто', 'Круто'),
(6, 2, 'Images/6.jpg', 'Круто', 'Круто'),
(7, 0, '', '', 'Круто');

CREATE TABLE `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Password` text NOT NULL,
  `E-mail` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`ID`, `Name`, `Password`, `E-mail`) VALUES
(0, 'Test', 'Test123', 'Test@hotmail.com'),
(1, '1111', '11111', '111111'),
(2, '222', '22222', 'FautOut@ew.com');

ALTER TABLE `comments`
  ADD CONSTRAINT `comments_fk_user` FOREIGN KEY (`UID`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `comments_fk_photo` FOREIGN KEY (`PID`) REFERENCES `photos` (`ID`);

ALTER TABLE `photos`
  ADD CONSTRAINT `photos_fk_user` FOREIGN KEY (`UID`) REFERENCES `user` (`ID`);

COMMIT;
