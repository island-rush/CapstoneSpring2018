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
    `gameCurrentTeam`  varchar(5) NOT NULL, -- 'Red' or 'Blue'
    `gameTurn` int(4) NOT NULL, -- 0, 1, 2, 3, ....changes each team's turn (hopefully?)
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
INSERT INTO `games` VALUES (1, 'M1A', 'Darcy', 'Jacobs', 'Brown', 'Red', 0, 'Attack', 10, 40, 0, 0, 0, 0);
INSERT INTO `games` VALUES (2, 'T2B', 'Kulp', 'Hillmann', 'George', 'Blue', 0, 'Fortify', 0, 53, 0, 4, 0, 0);

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
INSERT INTO `units` VALUES (6, 'test_piece', 2, 2, 2);


-- Table for Game Board Allowed Positions (for troops and whatnot)
CREATE TABLE IF NOT EXISTS `positions` (
	`positionId`int(4) NOT NULL,
    `positionIsland` varchar(16) NOT NULL,
    PRIMARY KEY(`positionID`)
) ;

-- 55 empty water positions? (1-55 top left going right, then restart row on the left counting (because float divs)
INSERT INTO `positions` VALUES (1, 'water');
INSERT INTO `positions` VALUES (2, 'water');
INSERT INTO `positions` VALUES (3, 'water');
INSERT INTO `positions` VALUES (4, 'water');
INSERT INTO `positions` VALUES (5, 'water');
INSERT INTO `positions` VALUES (6, 'water');
INSERT INTO `positions` VALUES (7, 'water');
INSERT INTO `positions` VALUES (8, 'water');
INSERT INTO `positions` VALUES (9, 'water');
INSERT INTO `positions` VALUES (10, 'water');
INSERT INTO `positions` VALUES (11, 'water');
INSERT INTO `positions` VALUES (12, 'water');
INSERT INTO `positions` VALUES (13, 'water');
INSERT INTO `positions` VALUES (14, 'water');
INSERT INTO `positions` VALUES (15, 'water');
INSERT INTO `positions` VALUES (16, 'water');
INSERT INTO `positions` VALUES (17, 'water');
INSERT INTO `positions` VALUES (18, 'water');
INSERT INTO `positions` VALUES (19, 'water');
INSERT INTO `positions` VALUES (20, 'water');
INSERT INTO `positions` VALUES (21, 'water');
INSERT INTO `positions` VALUES (22, 'water');
INSERT INTO `positions` VALUES (23, 'water');
INSERT INTO `positions` VALUES (24, 'water');
INSERT INTO `positions` VALUES (25, 'water');
INSERT INTO `positions` VALUES (26, 'water');
INSERT INTO `positions` VALUES (27, 'water');
INSERT INTO `positions` VALUES (28, 'water');
INSERT INTO `positions` VALUES (29, 'water');
INSERT INTO `positions` VALUES (30, 'water');
INSERT INTO `positions` VALUES (31, 'water');
INSERT INTO `positions` VALUES (32, 'water');
INSERT INTO `positions` VALUES (33, 'water');
INSERT INTO `positions` VALUES (34, 'water');
INSERT INTO `positions` VALUES (35, 'water');
INSERT INTO `positions` VALUES (36, 'water');
INSERT INTO `positions` VALUES (37, 'water');
INSERT INTO `positions` VALUES (38, 'water');
INSERT INTO `positions` VALUES (39, 'water');
INSERT INTO `positions` VALUES (40, 'water');
INSERT INTO `positions` VALUES (41, 'water');
INSERT INTO `positions` VALUES (42, 'water');
INSERT INTO `positions` VALUES (43, 'water');
INSERT INTO `positions` VALUES (44, 'water');
INSERT INTO `positions` VALUES (45, 'water');
INSERT INTO `positions` VALUES (46, 'water');
INSERT INTO `positions` VALUES (47, 'water');
INSERT INTO `positions` VALUES (48, 'water');
INSERT INTO `positions` VALUES (49, 'water');
INSERT INTO `positions` VALUES (50, 'water');
INSERT INTO `positions` VALUES (51, 'water');
INSERT INTO `positions` VALUES (52, 'water');
INSERT INTO `positions` VALUES (53, 'water');
INSERT INTO `positions` VALUES (54, 'water');
INSERT INTO `positions` VALUES (55, 'water');
-- 10 for big left? (missing the G)
INSERT INTO `positions` VALUES (56, 'special_island13');
INSERT INTO `positions` VALUES (57, 'special_island13');
INSERT INTO `positions` VALUES (58, 'special_island13');
INSERT INTO `positions` VALUES (59, 'special_island13');
INSERT INTO `positions` VALUES (60, 'special_island13');
INSERT INTO `positions` VALUES (61, 'special_island13');
INSERT INTO `positions` VALUES (62, 'special_island13');
INSERT INTO `positions` VALUES (63, 'special_island13');
INSERT INTO `positions` VALUES (64, 'special_island13');
INSERT INTO `positions` VALUES (65, 'special_island13');
-- 10 for big right
INSERT INTO `positions` VALUES (66, 'special_island14');
INSERT INTO `positions` VALUES (67, 'special_island14');
INSERT INTO `positions` VALUES (68, 'special_island14');
INSERT INTO `positions` VALUES (69, 'special_island14');
INSERT INTO `positions` VALUES (70, 'special_island14');
INSERT INTO `positions` VALUES (71, 'special_island14');
INSERT INTO `positions` VALUES (72, 'special_island14');
INSERT INTO `positions` VALUES (73, 'special_island14');
INSERT INTO `positions` VALUES (74, 'special_island14');
INSERT INTO `positions` VALUES (75, 'special_island14');
-- 4 for island1
INSERT INTO `positions` VALUES (76, 'special_island1');
INSERT INTO `positions` VALUES (77, 'special_island1');
INSERT INTO `positions` VALUES (78, 'special_island1');
INSERT INTO `positions` VALUES (79, 'special_island1');
-- 4 for island2
INSERT INTO `positions` VALUES (80, 'special_island2');
INSERT INTO `positions` VALUES (81, 'special_island2');
INSERT INTO `positions` VALUES (82, 'special_island2');
INSERT INTO `positions` VALUES (83, 'special_island2');
-- 3 for island3
INSERT INTO `positions` VALUES (84, 'special_island3');
INSERT INTO `positions` VALUES (85, 'special_island3');
INSERT INTO `positions` VALUES (86, 'special_island3');
-- 4 for island4
INSERT INTO `positions` VALUES (87, 'special_island4');
INSERT INTO `positions` VALUES (88, 'special_island4');
INSERT INTO `positions` VALUES (89, 'special_island4');
INSERT INTO `positions` VALUES (90, 'special_island4');
-- 4 for island5
INSERT INTO `positions` VALUES (91, 'special_island5');
INSERT INTO `positions` VALUES (92, 'special_island5');
INSERT INTO `positions` VALUES (93, 'special_island5');
INSERT INTO `positions` VALUES (94, 'special_island5');
-- 3 for island6
INSERT INTO `positions` VALUES (95, 'special_island6');
INSERT INTO `positions` VALUES (96, 'special_island6');
INSERT INTO `positions` VALUES (97, 'special_island6');
-- 3 for island7
INSERT INTO `positions` VALUES (98, 'special_island7');
INSERT INTO `positions` VALUES (99, 'special_island7');
INSERT INTO `positions` VALUES (100, 'special_island7');
-- 3 for island8
INSERT INTO `positions` VALUES (101, 'special_island8');
INSERT INTO `positions` VALUES (102, 'special_island8');
INSERT INTO `positions` VALUES (103, 'special_island8');
-- 4 for island9
INSERT INTO `positions` VALUES (104, 'special_island9');
INSERT INTO `positions` VALUES (105, 'special_island9');
INSERT INTO `positions` VALUES (106, 'special_island9');
INSERT INTO `positions` VALUES (107, 'special_island9');
-- 4 for island10
INSERT INTO `positions` VALUES (108, 'special_island10');
INSERT INTO `positions` VALUES (109, 'special_island10');
INSERT INTO `positions` VALUES (110, 'special_island10');
INSERT INTO `positions` VALUES (111, 'special_island10');
-- 3 for island11
INSERT INTO `positions` VALUES (112, 'special_island11');
INSERT INTO `positions` VALUES (113, 'special_island11');
INSERT INTO `positions` VALUES (114, 'special_island11');
-- 4 for island12
INSERT INTO `positions` VALUES (115, 'special_island12');
INSERT INTO `positions` VALUES (116, 'special_island12');
INSERT INTO `positions` VALUES (117, 'special_island12');
INSERT INTO `positions` VALUES (118, 'special_island12');
INSERT INTO `positions` VALUES (119, 'special_island12');


-- Table of Units
CREATE TABLE IF NOT EXISTS `placements`(
	`placementId` int(16) NOT NULL AUTO_INCREMENT,
    `gameId` int(5) NOT NULL,
    `unitId` int(5) NOT NULL,
    `teamId` varchar(10) NOT NULL,
    `positionId` int(4) NOT NULL,
    PRIMARY KEY(`placementId`),
    FOREIGN KEY (unitId) REFERENCES units(unitId),
    FOREIGN KEY (gameId) REFERENCES games(gameId),
    FOREIGN KEY (positionId) REFERENCES positions(positionId)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- Insert placements into table.
INSERT INTO `placements` VALUES (1, 1, 6, 'red', 1);
INSERT INTO `placements` VALUES (2, 1, 6, 'red', 1);
INSERT INTO `placements` VALUES (3, 1, 6, 'red', 1);
INSERT INTO `placements` VALUES (4, 1, 6, 'red', 1);

INSERT INTO `placements` VALUES (5, 1, 6, 'red', 119);

-- this shows overflow mechanics (may change to 9 per position possible)
-- INSERT INTO `placements` VALUES (5, 1, 6, 'red', 1);


-- Table of Movements
CREATE TABLE IF NOT EXISTS `movements`(
	`movementId` int(16) NOT NULL AUTO_INCREMENT,
    `movementFromPosition` int(4) NOT NULL,  -- meat of what is used
    `movementNowPlacement` int(16) NOT NULL,  -- used for undo moves
    `movementGameId` int(5) NOT NULL,  -- which game is the movement
    `movementTurn` int(5) NOT NULL,  -- need what phase/turn movement was made (only undo current phase/turn)
    `movementPhase` varchar(20) NOT NULL,
    PRIMARY KEY(`movementId`),
    FOREIGN KEY (movementGameId) REFERENCES games(gameId),
    FOREIGN KEY (movementFromPosition) REFERENCES positions(positionId),
    FOREIGN KEY (movementNowPlacement) REFERENCES placements(placementId)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


-- this used for easy testing alone
UPDATE games SET gameBlueJoined=1 WHERE gameId = 1;

SELECT * FROM placements;

-- SELECT * FROM placements NATURAL JOIN units WHERE (gameId = 1) AND (temporaryPositionId)
