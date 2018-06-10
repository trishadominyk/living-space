CREATE DATABASE db_space;

USE db_space;

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`(
	`usr_id` int(4) unsigned NOT NULL auto_increment,
	`usr_email` varchar(200) NOT NULL default '',
	`usr_password` varchar(80) NOT NULL default '',
	`usr_firstname` varchar (120) NOT NULL default '',
	`usr_lastname` varchar (120) NOT NULL default '',
	
	PRIMARY KEY(`usr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1001;

DROP TABLE IF EXISTS `tbl_space`;
CREATE TABLE `tbl_space`(
	`spc_id` int(5) unsigned NOT NULL auto_increment,
	`spc_name` varchar(50) NOT NULL default '',
	`spc_desc` varchar(200) NOT NULL default '',
	`spc_contact` varchar(20) NOT NULL default '',
	`spc_address` varchar(150) NOT NULL default '',
	`cty_id` int(4) NOT NULL default '0',
	`typ_id` int(3) NOT NULL default '0',
	`spc_lat` float(10,6) NOT NULL default '0.000000',
	`spc_long` float(10,6) NOT NULL default '0.000000',
	`spc_avgprice` decimal(10,2) NOT NULL default '0.00',
	`spc_numrooms` int(3) NOT NULL default '0',
	`spc_roomavail` int(3) NOT NULL default '0',
	`spc_status` varchar(10) NOT NULL default '',
	
	FOREIGN KEY(`cty_id`) REFERENCES `tbl_city`,
	FOREIGN KEY(`typ_id`) REFERENCES `tbl_type`,
	PRIMARY KEY(`spc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10001;

DROP TABLE IF EXISTS `tbl_city`;
CREATE TABLE `tbl_city`(
	`cty_id` int(4) unsigned NOT NULL auto_increment,
	`cty_name` varchar(50) NOT NULL default '',
	
	PRIMARY KEY(`cty_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2001;

DROP TABLE IF EXISTS `tbl_type`;
CREATE TABLE `tbl_type`(
	`typ_id` int(3) unsigned NOT NULL auto_increment,
	`typ_name` varchar(50) NOT NULL default '',
	
	PRIMARY KEY(`typ_id`)
) ENGINE=MyISAM AUTO_INCREMENT=101;

DROP TABLE IF EXISTS `tbl_room`;
CREATE TABLE `tbl_room`(
	`rm_id` int(6) unsigned NOT NULL auto_increment,
	`rm_name` varchar(50) NOT NULL default '',
	`rm_desc` varchar(200) NOT NULL default '',
	`rm_price` decimal(10,2) NOT NULL default '0.00',
	`rm_status` varchar(10) NOT NULL default 'AVAILABLE',
	`rm_pqty` int(3) NOT NULL default '0',
	`rm_tqty` int(5) NOT NULL default '0',
	`rm_aqty` int(5) NOT NULL default '0',
	`spc_id` int(5) NOT NULL default '0',
	`pay_id` int(3) NOT NULL default '0',
	
	FOREIGN KEY(`spc_id`) REFERENCES `tbl_space`,
	FOREIGN KEY(`pay_id`) REFERENCES `tbl_payment`,
	PRIMARY KEY(`rm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100001;

DROP TABLE IF EXISTS `tbl_payment`;
CREATE TABLE `tbl_payment`(
	`pay_id` int(3) unsigned NOT NULL auto_increment,
	`pay_name` varchar(50) NOT NULL default '',
	
	PRIMARY KEY(`pay_id`)
) ENGINE=MyISAM AUTO_INCREMENT=501;

DROP TABLE IF EXISTS `tbl_pending`;
CREATE TABLE `tbl_pending`(
	`pnd_id` int(4) unsigned NOT NULL auto_increment,
	`pnd_fname` varchar(50) NOT NULL default '',
	`pnd_lname` varchar(50) NOT NULL default '',
	`pnd_mname` varchar(50) NOT NULL default '',
	`pnd_email` varchar(100) NOT NULL default '',
	`pnd_contact` varchar(50) NOT NULL default '',
	`pnd_date_added` date NOT NULL default '0000-00-00',
	`pnd_date_expire` date NOT NULL default '0000-00-00',
	`rm_id` int(6) NOT NULL default '0',
	`pnd_status` varchar(10) NOT NULL default 'PENDING',
	
	FOREIGN KEY(`rm_id`) REFERENCES `tbl_room`,
	PRIMARY KEY(`pnd_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9001;

INSERT INTO tbl_type(typ_name) 
	VALUES ('DORMITORY');
INSERT INTO tbl_type(typ_name) 
	VALUES ('CONDOMINIUM');

INSERT INTO tbl_city(cty_name) 
	VALUES ('BACOLOD');
INSERT INTO tbl_city(cty_name) 
	VALUES ('TALISAY');
INSERT INTO tbl_city(cty_name) 
	VALUES ('SILAY');