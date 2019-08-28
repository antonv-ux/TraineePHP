/*
SQLyog Ultimate v12.14 (64 bit)
MySQL - 5.6.41 : Database - transport
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`transport` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `transport`;

/*Table structure for table `tbl_tree` */

DROP TABLE IF EXISTS `tbl_tree`;

CREATE TABLE `tbl_tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ix_parent_id_name` (`parent_id`,`name`),
  KEY `fk_tree_tree` (`parent_id`),
  CONSTRAINT `fk_tree_tree` FOREIGN KEY (`parent_id`) REFERENCES `tbl_tree` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_tree` */

insert  into `tbl_tree`(`id`,`parent_id`,`name`) values 
(1,NULL,'Транспорт'),
(5,1,'Воздушный'),
(2,1,'Наземный'),
(3,2,'Автомобиль'),
(4,2,'Велосипед'),
(7,5,'Вертолет'),
(6,5,'Самолет');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
