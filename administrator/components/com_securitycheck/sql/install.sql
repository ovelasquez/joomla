DROP TABLE IF EXISTS `#__securitycheck`;
CREATE TABLE `#__securitycheck` (
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`Product` VARCHAR(35) NOT NULL,
`Type` VARCHAR(35),
`Installedversion` VARCHAR(30) DEFAULT '---',
`Vulnerable` VARCHAR(10) NOT NULL DEFAULT 'No',
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__securitycheck_db`;
CREATE TABLE `#__securitycheck_db` (
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`Product` VARCHAR(35) NOT NULL,
`Type` VARCHAR(35),
`Vulnerableversion` VARCHAR(10) DEFAULT '---',
`modvulnversion` VARCHAR(2) DEFAULT '==',
`Joomlaversion` VARCHAR(10) DEFAULT 'Notdefined',
`modvulnjoomla` VARCHAR(2) DEFAULT '==',
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
INSERT INTO `#__securitycheck_db` (`product`,`type`,`vulnerableversion`,`modvulnversion`,`Joomlaversion`,`modvulnjoomla`) VALUES 
('Joomla!','core','2.5.0','==','2.5.0','=='),
('com_dtregister','component','2.7.13','==','2.5.0','>='),
('Joomla!','core','2.5.1','<=','2.5.1','<='),
('Joomla!','core','2.5.1','<=','2.5.1','<='),
('Joomla!','core','2.5.2','<=','2.5.2','<='),
('Joomla!','core','2.5.2','<=','2.5.2','<='),
('Joomla!','core','2.5.3','<=','2.5.3','<='),
('Joomla!','core','2.5.3','<=','2.5.3','<='),
('com_virtuemart','component','2.0.2','==','2.5.0','>='),
('com_joodb','component','---','==','Notdefined','=='),
('com_virtuemart','component','2.0.2','==','2.5.0','>='),
('com_nbill','component','2.3.2','==','2.5.0','>='),
('com_jce','component','2.0.21','==','2.5.0','>='),
('com_jce','component','2.1.0','<=','2.5.0','>='),
('com_joomsport','component','---','==','Notdefined','=='),
('com_maianmedia','component','1.5.8.9','<=','2.5.0','>='),
('Joomla!','core','2.5.4','<=','2.5.4','<='),
('Joomla!','core','2.5.4','<=','2.5.4','<='),
('com_osproperty','component','2.0.2','==','2.5.0','>='),
('com_odudeprofile','component','2.8','<=','2.5.0','>='),
('com_movm','component','1.0','==','2.5.0','>='),
('com_rsgallery2','component','3.2.0','<','2.5.0','>='),
('com_joomgalaxy','component','1.2.0.4','==','2.5.0','>='),
('com_civicrm','component','---','==','2.5.0','>='),
('com_komento','component','1.0.2771','<','2.5.0','>='),
('com_spidercalendar','component','---','==','2.5.0','>='),
('com_icagenda','component','1.1.4','<=','2.5.0','>='),
('com_rokmodule','component','1.1','<=','2.5.0','>='),
('Joomla!','core','2.5.6','<=','2.5.6','<='),
('Joomla!','core','2.5.6','<=','2.5.6','<='),
('com_mijoftp-free','component','1.1.0','<','2.5.0','>='),
('com_aceftp','component','1.0.2','<=','2.5.0','>='),
('com_fss','component','1.9.1.1447','<=','2.5.0','>='),
('com_commedia','component','3.1','<=','2.5.0','>='),
('com_spidercatalog','component','1.1','==','2.5.0','>='),
('Joomla!','core','2.5.7','<=','2.5.7','<='),
('com_jnews','component','7.9.1','<','2.5.0','>='),
('com_sh404sef','component','3.7.0.1485','<','2.5.0','>='),
('com_kunena','component','2.0.3','<','2.5.0','>='),
('com_jooproperty','component','1.13.0','==','2.5.0','>='),
('com_bch','component','---','==','2.5.0','>='),
('com_aclassif','component','---','==','2.5.0','>='),
('com_ignitegallery','component','0.8.3.1','==','2.5.0','>='),
('com_events','component','1.5.0','==','2.5.0','>='),
('com_incapsula','component','1.4.6_b','<=','2.5.0','>='),
('com_kunena','component','2.0.3','==','2.5.0','>='),
('Joomla!','core','2.5.8','<=','2.5.8','<='),
('com_rsfiles','component','1.0.0 Rev 11','==','2.5.0','>='),
('com_civicrm','component','4.3.1','<=','2.5.0','>='),
('Joomla!','core','2.5.9','<=','2.5.9','<='),
('com_phocagallery','component','3.2.3','<=','2.5.0','>='),
('com_jnews','component','8.0.1','<=','2.5.0','>='),
('mod_xoranalogclock','module','1.0','==','2.5.0','>='),
('com_attachments','component','3.1.1','<','2.5.0','>='),
('com_aicontactsafe','component','2.0.19','<=','2.5.0','>='),
('Joomla!','core','2.5.13','<=','2.5.0','>='),
('com_sectionex','component','2.5.96','<=','2.5.0','>='),
('com_redshop','component','1.2','==','2.5.0','>='),
('com_joomsport','component','1.7.1','<','2.5.0','>='),
('com_virtuemart','component','2.0.22a','<=','2.5.0','>='),
('com_joomleague','component','2.0','<','2.5.0','>='),
('Joomla!','core','2.5.14','<=','2.5.0','>=');

CREATE TABLE IF NOT EXISTS `#__securitycheck_logs` (
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`ip` VARCHAR(35) NOT NULL,
`time` DATETIME NOT NULL,
`tag_description` VARCHAR(50),
`description` VARCHAR(300) NOT NULL,
`type` VARCHAR(50),
`uri` VARCHAR(100),
`component` VARCHAR(150) DEFAULT '---',
`marked` TINYINT(1) DEFAULT 0,
`original_string` VARCHAR(300),
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__securitycheck_file_permissions`;

DROP TABLE IF EXISTS `#__securitycheck_file_manager`;
CREATE TABLE IF NOT EXISTS `#__securitycheck_file_manager` (
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
`last_check` DATETIME,
`files_scanned` INT(10) DEFAULT 0,
`files_with_incorrect_permissions` INT(10) DEFAULT 0,
`estado` VARCHAR(40) DEFAULT 'IN_PROGRESS',
`estado_clear_data` VARCHAR(40) DEFAULT 'DELETING_ENTRIES',
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
INSERT INTO `#__securitycheck_file_manager` (`estado`,`estado_clear_data`) VALUES 
('ENDED','DELETING_ENTRIES');

DROP TABLE IF EXISTS `#__securitycheck_storage`;
CREATE TABLE IF NOT EXISTS `#__securitycheck_storage` (
`storage_key` varchar(255) NOT NULL,
`storage_value` longtext NOT NULL,
PRIMARY KEY (`storage_key`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;