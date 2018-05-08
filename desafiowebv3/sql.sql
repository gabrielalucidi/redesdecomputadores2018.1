mysql -u root -p
CREATE DATABASE db_challengeWebCERN;
CREATE USER 'challengeWebCERN'@'localhost' IDENTIFIED BY 'pwd';
GRANT ALL ON db_challengeWebCERN.* TO 'challengeWebCERN'@'localhost';
FLUSH PRIVILEGES;
mysql -u challengeWebCERN -p
use db_challengeWebCERN

CREATE TABLE IF NOT EXISTS `preference` (
  `user` int(10) unsigned NOT NULL,
  `setting` varchar(60) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`user`,`setting`)
);