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
('com_attachments','component','---','==','2.5.0','>='),
('com_aicontactsafe','component','2.0.19','<=','2.5.0','>='),
('Joomla!','core','2.5.13','<=','2.5.0','>=');