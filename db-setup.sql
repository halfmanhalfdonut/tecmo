DROP DATABASE IF EXISTS `BOWL_PICK` ;

CREATE DATABASE `BOWL_PICK` ;



 DROP TABLE IF EXISTS BOWL_PICK.USERS ;

 CREATE TABLE `BOWL_PICK`.`USERS` (
`user_id` INT( 7 ) NOT NULL AUTO_INCREMENT ,
`display_name` VARCHAR( 30 ) NOT NULL ,
`email` VARCHAR( 50 ) NOT NULL ,
`password` VARCHAR( 20 ) NOT NULL ,
`firstname` VARCHAR( 25 ) NOT NULL ,
`lastname` VARCHAR( 40 ) NOT NULL ,
`type` ENUM( 'regular', 'admin' ) NOT NULL ,
PRIMARY KEY ( `user_id` )
) ENGINE = MYISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS BOWL_PICK.TEAMS ;

CREATE TABLE `BOWL_PICK`.`TEAMS` (
`team_id` INT( 4 ) NOT NULL AUTO_INCREMENT ,
`name` VARCHAR( 50 ) NOT NULL ,
`logo` VARCHAR( 1000 ) NOT NULL ,
`wins` INT( 4 ) NOT NULL ,
`losses` INT( 4 ) NOT NULL ,
`link` VARCHAR( 1000 ) NOT NULL ,
PRIMARY KEY ( `team_id` )
) ENGINE = MYISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS BOWL_PICK.GAMES ;

CREATE TABLE `BOWL_PICK`.`GAMES` (
  `game_id` int(5) NOT NULL auto_increment,
  `home_id` int(4) NOT NULL,
  `away_id` int(4) NOT NULL,
  `home_score` int(4) NOT NULL,
  `away_score` int(4) NOT NULL,
  `winner` int(4) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`game_id`)
) ENGINE=MyISAM ;

DROP TABLE IF EXISTS BOWL_PICK.PICKS ;

 CREATE TABLE `BOWL_PICK`.`PICKS` (
`pick_id` INT( 6 ) NOT NULL AUTO_INCREMENT ,
`user_id` INT( 7 ) NOT NULL ,
`game_id` INT( 5 ) NOT NULL ,
`team_id` INT( 4 ) NOT NULL ,
PRIMARY KEY ( `pick_id` )
) ENGINE = MYISAM ;

DROP TABLE IF EXISTS BOWL_PICK.TIE ;

 CREATE TABLE `BOWL_PICK`.`TIE` (
`tie_id` INT( 6 ) NOT NULL AUTO_INCREMENT ,
`user_id` INT( 7 ) NOT NULL ,
`game_id` INT( 5 ) NOT NULL ,
`total` INT( 4 ) NOT NULL ,
PRIMARY KEY ( `tie_id` )
) ENGINE = MYISAM ;