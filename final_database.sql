-- Final Database for CS364
-- Created by C2C Jack Kulp and C2C Christopher Darcy (fixed by C1C Spencer Adolph)
-- April 2018

-- Database = island_rush

DROP DATABASE IF EXISTS island_rush;
CREATE DATABASE island_rush;
USE island_rush;


-- User Table
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) NOT NULL,
  `userPassword` varchar(72) DEFAULT NULL,
  `userAdmin` int(1) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Passwords store
INSERT INTO `users` VALUES (1, 'admin', '$2y$10$9RiuIs3Er77Rrp5pB/QfkOHaV/jilXngj41SUZHeT6H8PnUh91Pui', 1);
INSERT INTO `users` VALUES (2, 'user', '$2y$10$DmBkepx05Zm9HWfNpHInFuHFPDjpl1r7TU1r2Yk6YXWsBLrHCpPEe', 3);



-- Table of Games
CREATE TABLE IF NOT EXISTS `games`(
	`gameId` int(5) NOT NULL AUTO_INCREMENT,
    `gameSection` varchar(3) NOT NULL,
    `gameInstructor` varchar(50) NOT NULL,
    `gameRedLeader`  varchar(50), -- just a name for the cadet commander
    `gameBlueLeader`  varchar(50), -- just a name for the cadet commander
    `gameTurn`  varchar(5) NOT NULL, -- 'Red' or 'Blue'
    `gamePhase`  varchar(20) NOT NULL, -- ex: 'BuyTroops', 'PlaceTroops', 'Attack', 'Fortify'
    `gameRedRpoints` int(5) NOT NULL,
    `gameBlueRpoints` int(5) NOT NULL,
    `gameRedHybridPoints` int(5) NOT NULL,
    `gameBlueHybridpoints` int(5) NOT NULL,
    `gameRedJoined` INT(1) NOT NULL, -- 0 or 1
    `gameBlueJoined` INT(1) NOT NULL, -- O or 1
    PRIMARY KEY(`gameId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- Insert Default Games
INSERT INTO `games` VALUES (1, 'M1A', 'Darcy', 'Jacobs', 'Brown', 'Red', 'Attack', 10, 40, 0, 0, 0, 0);
INSERT INTO `games` VALUES (2, 'T2B', 'Kulp', 'Hillmann', 'George', 'Blue', 'Fortify', 0, 53, 0, 4, 0, 0);

-- Table of Units
CREATE TABLE IF NOT EXISTS `units`(
	`unitId` int(5) NOT NULL ,
    `unitName` varchar(20) NOT NULL,
    `unitMoves` int(3) NOT NULL,
    `unitAttack` int(3) NOT NULL,
    `unitDefense` int(3) NOT NULL,
    PRIMARY KEY(`unitId`)
);

-- Insert units into table.
INSERT INTO `units` VALUES (1, 'transport', 2, 0, 2);
INSERT INTO `units` VALUES (2, 'aircraft carrier', 2, 1, 3);
INSERT INTO `units` VALUES (3, 'destroyer', 2, 3, 4);
INSERT INTO `units` VALUES (4, 'submarine', 2, 4, 4);
INSERT INTO `units` VALUES (5, 'soldier', 1, 2, 2);

-- Table of Units
CREATE TABLE IF NOT EXISTS `placements`(
	`placeId` int(5) NOT NULL AUTO_INCREMENT,
    `gameId` int(5) NOT NULL,
    `unitId` int(5) NOT NULL,
    `placeX` int(2) NOT NULL,
    `placeY` int(2) NOT NULL,
    PRIMARY KEY(`placeId`),
    FOREIGN KEY (unitId) REFERENCES units(unitId),
    FOREIGN KEY (gameId) REFERENCES games(gameId)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- Insert placements into table.
INSERT INTO `placements` VALUES (1, 1, 1, 3, 5);
INSERT INTO `placements` VALUES (2, 1, 2, 5, 2);
INSERT INTO `placements` VALUES (3, 1, 1, 6, 1);
INSERT INTO `placements` VALUES (4, 2, 5, 0, 0);
INSERT INTO `placements` VALUES (5, 2, 3, 0, 0);
INSERT INTO `placements` VALUES (6, 2, 4, 0, 0);


-- Table for testing Ajax functionality (Spencer)
CREATE TABLE IF NOT EXISTS `test_table` (
	`testId` int(3) NOT NULL,
	`testValue` varchar(10),
    PRIMARY KEY(`testId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO `test_table` VALUES (1, "red");

SELECT * FROM test_table;
