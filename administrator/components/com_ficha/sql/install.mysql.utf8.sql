-- $Id: install.mysql.utf8.sql 24 2009-11-09 11:56:31Z chdemko $

DROP TABLE IF EXISTS `#__ficha`;
 
CREATE TABLE `#__ficha` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `greeting` VARCHAR(255) NOT NULL,
  `catid` INT(11) NOT NULL DEFAULT '0',
  `artid` INT(11) NOT NULL DEFAULT '0',
  `entemisor` VARCHAR(255) NOT NULL,
  `norma` VARCHAR(255) NOT NULL,
  `objeto` VARCHAR(255) NOT NULL,
  `vigencia` VARCHAR(255) NOT NULL,
  `derogatoria` TEXT NULL,
  `nota` TEXT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
 
INSERT INTO `#__ficha` (`greeting`) VALUES
        ('Hello World!'),
        ('Good bye World!');