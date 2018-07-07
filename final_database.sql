-- Final Database for CS364
-- Created by C2C Jack Kulp and C2C Christopher Darcy (fixed by C1C Spencer Adolph)
-- April 2018

-- Database = island_rush

DROP DATABASE IF EXISTS island_rush;
CREATE DATABASE island_rush;
USE island_rush;


-- User Table
CREATE TABLE IF NOT EXISTS `admins` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(50) NOT NULL,
  `adminPassword` varchar(72) DEFAULT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- insert admin
INSERT INTO `admins` VALUES (1, 'admin', '$2y$10$9RiuIs3Er77Rrp5pB/QfkOHaV/jilXngj41SUZHeT6H8PnUh91Pui');


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
    `gameBlueJoined` INT(1) NOT NULL, -- 0 or 1
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

-- for testing the html shit
INSERT INTO `units` VALUES (6, 'test_piece', 2, 2, 2)


-- Table for Game Board Allowed Positions (for troops and whatnot)
CREATE TABLE IF NOT EXISTS `positions` (
	`positionId`int(4) NOT NULL,
    `positionX` int(16) NOT NULL,
    `positionY` int(16) NOT NULL,
    PRIMARY KEY(`positionID`)
) ;

INSERT INTO `positions` VALUES (1, 400, 600);
INSERT INTO `positions` VALUES (2, 400, 600);
INSERT INTO `positions` VALUES (3, 400, 600);
INSERT INTO `positions` VALUES (4, 400, 600);
INSERT INTO `positions` VALUES (5, 400, 600);
INSERT INTO `positions` VALUES (6, 400, 600);
INSERT INTO `positions` VALUES (7, 400, 600);
INSERT INTO `positions` VALUES (8, 400, 600);
INSERT INTO `positions` VALUES (9, 400, 600);
INSERT INTO `positions` VALUES (10, 400, 600);
INSERT INTO `positions` VALUES (11, 400, 600);
INSERT INTO `positions` VALUES (12, 400, 600);
INSERT INTO `positions` VALUES (13, 400, 600);
INSERT INTO `positions` VALUES (14, 400, 600);
INSERT INTO `positions` VALUES (15, 400, 600);
INSERT INTO `positions` VALUES (16, 400, 600);
INSERT INTO `positions` VALUES (17, 400, 600);
INSERT INTO `positions` VALUES (18, 400, 600);
INSERT INTO `positions` VALUES (19, 400, 600);
INSERT INTO `positions` VALUES (20, 400, 600);
INSERT INTO `positions` VALUES (21, 400, 600);
INSERT INTO `positions` VALUES (22, 400, 600);
INSERT INTO `positions` VALUES (23, 400, 600);
INSERT INTO `positions` VALUES (24, 400, 600);
INSERT INTO `positions` VALUES (25, 400, 600);
INSERT INTO `positions` VALUES (26, 400, 600);
INSERT INTO `positions` VALUES (27, 400, 600);
INSERT INTO `positions` VALUES (28, 400, 600);
INSERT INTO `positions` VALUES (29, 400, 600);
INSERT INTO `positions` VALUES (30, 400, 600);
INSERT INTO `positions` VALUES (31, 400, 600);
INSERT INTO `positions` VALUES (32, 400, 600);
INSERT INTO `positions` VALUES (33, 400, 600);
INSERT INTO `positions` VALUES (34, 400, 600);
INSERT INTO `positions` VALUES (35, 400, 600);
INSERT INTO `positions` VALUES (36, 400, 600);
INSERT INTO `positions` VALUES (37, 400, 600);
INSERT INTO `positions` VALUES (38, 400, 600);
INSERT INTO `positions` VALUES (39, 400, 600);
INSERT INTO `positions` VALUES (40, 400, 600);
INSERT INTO `positions` VALUES (41, 400, 600);
INSERT INTO `positions` VALUES (42, 400, 600);
INSERT INTO `positions` VALUES (43, 400, 600);
INSERT INTO `positions` VALUES (44, 400, 600);
INSERT INTO `positions` VALUES (45, 400, 600);
INSERT INTO `positions` VALUES (46, 400, 600);
INSERT INTO `positions` VALUES (47, 400, 600);
INSERT INTO `positions` VALUES (48, 400, 600);
INSERT INTO `positions` VALUES (49, 400, 600);
INSERT INTO `positions` VALUES (50, 400, 600);
INSERT INTO `positions` VALUES (51, 400, 600);
INSERT INTO `positions` VALUES (52, 400, 600);
INSERT INTO `positions` VALUES (53, 400, 600);
INSERT INTO `positions` VALUES (54, 400, 600);
INSERT INTO `positions` VALUES (55, 400, 600);
INSERT INTO `positions` VALUES (56, 400, 600);
INSERT INTO `positions` VALUES (57, 400, 600);
INSERT INTO `positions` VALUES (58, 400, 600);
INSERT INTO `positions` VALUES (59, 400, 600);
INSERT INTO `positions` VALUES (60, 400, 600);
INSERT INTO `positions` VALUES (61, 400, 600);
INSERT INTO `positions` VALUES (62, 400, 600);
INSERT INTO `positions` VALUES (63, 400, 600);
INSERT INTO `positions` VALUES (64, 400, 600);
INSERT INTO `positions` VALUES (65, 400, 600);
INSERT INTO `positions` VALUES (66, 400, 600);
INSERT INTO `positions` VALUES (67, 400, 600);
INSERT INTO `positions` VALUES (68, 400, 600);
INSERT INTO `positions` VALUES (69, 400, 600);
INSERT INTO `positions` VALUES (70, 400, 600);
INSERT INTO `positions` VALUES (71, 400, 600);




-- Table of Units
CREATE TABLE IF NOT EXISTS `placements`(
	`placeId` int(16) NOT NULL AUTO_INCREMENT,
    `gameId` int(5) NOT NULL,
    `unitId` int(5) NOT NULL,
    `positionId` int(4) NOT NULL,
    PRIMARY KEY(`placeId`),
    FOREIGN KEY (unitId) REFERENCES units(unitId),
    FOREIGN KEY (gameId) REFERENCES games(gameId),
    FOREIGN KEY (positionId) REFERENCES positions(positionId)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- Insert placements into table.
INSERT INTO `placements` VALUES (1, 1, 1, 1);
-- INSERT INTO `placements` VALUES (2, 1, 2, 1);
-- INSERT INTO `placements` VALUES (3, 1, 1, 1);
-- INSERT INTO `placements` VALUES (4, 2, 5, 1);
-- INSERT INTO `placements` VALUES (5, 2, 3, 1);
-- INSERT INTO `placements` VALUES (6, 2, 4, 1);


-- SELECT gameRedJoined, gameBlueJoined FROM games WHERE gameId = 1;
-- UPDATE games SET gameRedJoined=1 WHERE gameId = 1;
UPDATE games SET gameBlueJoined=1 WHERE gameId = 1;
