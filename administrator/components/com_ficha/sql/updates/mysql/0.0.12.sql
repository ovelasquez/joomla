-- $Id: install.mysql.utf8.sql 24 2009-11-09 11:56:31Z mmff $

ALTER TABLE `#__ficha` ADD `catid` INT(11) NOT NULL DEFAULT '0';

ALTER TABLE `#__ficha` ADD `artid` INT(11) NOT NULL DEFAULT '0';

ALTER TABLE `#__ficha` ADD `entemisor` VARCHAR(255) NOT NULL;

ALTER TABLE `#__ficha` ADD `norma` VARCHAR(255) NOT NULL;

ALTER TABLE `#__ficha` ADD `objeto` VARCHAR(255) NOT NULL;

ALTER TABLE `#__ficha` ADD `vigencia` VARCHAR(255) NOT NULL;

ALTER TABLE `#__ficha` ADD `derogatoria` VARCHAR(255) ;

ALTER TABLE `#__ficha` ADD `nota` TEXT;

