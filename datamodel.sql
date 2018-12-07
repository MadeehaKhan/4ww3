 CREATE TABLE `reviews` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `p_id` int(10) unsigned NOT NULL,
  `value` smallint(5) unsigned NOT NULL,
  `review` varchar(1000) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reviews` (`p_id`),
  CONSTRAINT `fk_reviews` FOREIGN KEY (`p_id`) REFERENCES `parkings` (`id`) ON DELETE CASCADE
) ;

CREATE TABLE `parkings` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `descr` varchar(60) NOT NULL,
  `image` varchar(20) DEFAULT NULL,
  `fee` decimal(5,2) NOT NULL,
  `address` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ;