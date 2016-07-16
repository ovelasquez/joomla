-- $Id: install.mysql.utf8.sql 24 2009-11-09 11:56:31Z chdemko $

DROP TABLE IF EXISTS `#__ficha`;

CREATE TABLE `#__ficha` (
  `id` int(11) NOT NULL auto_increment,
  `greeting` varchar(25) NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

INSERT INTO `#__ficha` (`greeting`) VALUES
	('Ficha!'),
	('Ficha Chaup!');

