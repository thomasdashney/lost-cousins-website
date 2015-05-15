--
-- MySQL 5.6.14
-- Fri, 15 May 2015 21:17:29 +0000
--

CREATE TABLE `emails` (
   `id` mediumint(8) unsigned not null auto_increment,
   `email` varchar(255),
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;