/*
SQLyog Enterprise - MySQL GUI v8.12 
MySQL - 5.5.5-10.4.19-MariaDB : Database - ax
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`ax` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `ax`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role` int(11) DEFAULT NULL,
  `username` varchar(34) DEFAULT NULL,
  `firstName` varchar(25) DEFAULT NULL,
  `lastName` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(34) DEFAULT NULL,
  `picture` varchar(100) DEFAULT 'img/avatar.jpg',
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Data for the table `admin` */

insert  into `admin`(`id`,`role`,`username`,`firstName`,`lastName`,`email`,`password`,`picture`,`created`) values (15,1,'benjie','Benjie','Amoloza','admin@gmail.com','7815696ecbf1c96e6894b779456d330e','img/d.jpg','2022-02-03 16:39:31'),(17,0,'gsmaloto','Gener','Maloto','receptionist@agmail.com','7815696ecbf1c96e6894b779456d330e','img/avatar.jpg','2022-03-14 14:33:08');

/*Table structure for table `appoint` */

DROP TABLE IF EXISTS `appoint`;

CREATE TABLE `appoint` (
  `appId` int(12) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `clientId` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`appId`)
) ENGINE=InnoDB AUTO_INCREMENT=511 DEFAULT CHARSET=utf8mb4;

/*Data for the table `appoint` */

insert  into `appoint`(`appId`,`code`,`clientId`,`date`,`time`,`status`,`created`) values (459,'5ffc6259b354d73c1b22fd8ac4d1d74e',58,'2021-11-19','AM','cancel','2021-11-14 10:41:44'),(460,'d4578ff6a609664b743475c94e53d0ee',59,'2021-11-19','AM','cancel','2021-11-19 10:54:28'),(468,'f1db1d1d5794247bf29f104b598cbf3d',60,'2022-01-31','PM','cancel','2022-01-30 06:04:06'),(469,'b5d7d064b7f3917b8823fe174626cc65',60,'2022-01-31','AM','cancel','2022-01-30 06:05:00'),(470,'bd71dc4a1cc146e619e533781ca17987',60,'2022-01-30','PM','approve','2022-01-30 06:28:53'),(471,NULL,12,'2022-02-06','AM','approve','2022-01-31 09:26:44'),(472,NULL,33,'2022-02-06','AM','pending','2022-01-31 09:28:35'),(473,NULL,14,'2022-02-06','AM','approve','2022-01-31 09:29:31'),(474,NULL,11,'2022-02-06','AM','approve','2022-01-31 09:30:34'),(475,NULL,10,'2022-02-06','AM','approve','2022-01-31 09:30:49'),(476,NULL,9,'2022-02-06','AM','approve','2022-01-31 09:31:19'),(477,NULL,11,'2022-02-06','AM','approve','2022-01-31 09:31:37'),(478,NULL,12,'2022-02-06','AM','approve','2022-01-31 09:31:38'),(479,NULL,13,'2022-02-06','AM','approve','2022-01-31 09:31:39'),(480,NULL,14,'2022-02-06','AM','approve','2022-01-31 09:31:39'),(481,NULL,15,'2022-02-05','AM','approve','2022-01-31 09:32:15'),(482,NULL,16,'2022-02-05','AM','approve','2022-01-31 09:32:53'),(483,NULL,17,'2022-02-05','AM','approve','2022-01-31 09:32:53'),(484,NULL,18,'2022-02-05','AM','approve','2022-01-31 09:32:54'),(485,NULL,19,'2022-02-05','AM','approve','2022-01-31 09:32:55'),(486,NULL,20,'2022-02-05','AM','approve','2022-01-31 09:32:56'),(487,NULL,21,'2022-02-05','AM','approve','2022-01-31 09:32:57'),(488,NULL,22,'2022-02-05','AM','approve','2022-01-31 09:32:57'),(489,NULL,23,'2022-02-05','AM','approve','2022-01-31 09:32:58'),(490,NULL,24,'2022-02-05','AM','approve','2022-01-31 09:33:00'),(491,NULL,25,'2022-02-05','PM','approve','2022-01-31 09:33:34'),(492,NULL,26,'2022-02-05','PM','approve','2022-01-31 09:33:35'),(493,NULL,27,'2022-02-05','PM','approve','2022-01-31 09:33:35'),(494,NULL,28,'2022-02-05','PM','approve','2022-01-31 09:33:36'),(495,NULL,29,'2022-02-05','PM','approve','2022-01-31 09:33:37'),(496,NULL,30,'2022-02-05','PM','approve','2022-01-31 09:33:37'),(497,NULL,31,'2022-02-05','PM','approve','2022-01-31 09:33:38'),(498,NULL,32,'2022-02-05','PM','approve','2022-01-31 09:33:38'),(499,NULL,33,'2022-02-05','PM','approve','2022-01-31 09:33:40'),(500,NULL,34,'2022-02-05','PM','approve','2022-01-31 09:33:42'),(504,'ff28cd4b0fd018a0c5ea8594976f2174',70,'2022-02-06','PM','cancel','2022-01-31 06:31:02'),(505,'4459dcc34397c4184e834ea37a6d2501',70,'2022-02-09','PM','cancel','2022-02-03 08:02:47'),(506,'fb27e78182ebaf7e48d53aa2b9279b67',70,'2022-02-04','AM','cancel','2022-02-04 05:49:30'),(507,'67a6514dd0f9513d15bb99f6af735708',70,'2022-03-14','PM','cancel','2022-03-08 09:25:55'),(509,'6d2cd33c79e6475a01e1fb52f36a82f1',70,'2022-03-14','AM','cancel','2022-03-14 07:06:42'),(510,'a7bb98c87b49fbecdd61dcecf07a661c',70,'2022-03-16','PM','pending','2022-03-14 08:24:08');

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `clientId` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `contactNo` varchar(50) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `medicine` varchar(50) NOT NULL,
  `condition` varchar(50) NOT NULL,
  `goals` varchar(50) NOT NULL,
  `pregnant` varchar(50) NOT NULL,
  `civilStatus` varchar(50) NOT NULL,
  `emName` varchar(50) NOT NULL,
  `emContact` varchar(50) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `picture` varchar(100) NOT NULL DEFAULT 'avatar.jpg',
  `code` text DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`clientId`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4;

/*Data for the table `client` */

insert  into `client`(`clientId`,`username`,`password`,`firstName`,`lastName`,`email`,`gender`,`contactNo`,`address`,`medicine`,`condition`,`goals`,`pregnant`,`civilStatus`,`emName`,`emContact`,`payment`,`picture`,`code`,`created`) values (53,'Cena','7815696ecbf1c96e6894b779456d330e','John','Cena','j.pleto321@gmail.com','male','09325433245','Santa Cruz, Laguna','','','','','','','','','','',NULL),(54,'jblulate','fc4a8568957a41a66d07b050dd56d8d3','Jojo','Bulate','jblulate@gmail.com','male','09325433288','Santa Cruz, Laguna','','','','','','','','','','07f3751d1205b283dc55ba9fb87f3b75',NULL),(55,'adamcole','d5cbfe9ff07fef1ecc93861ce5dd4f3b','Benjie','Amoloza','male','male','09325433244','Santa Cruz, Laguna','','','','','','','','','','89987d84571d52e52397a2cc369ce360',NULL),(56,'komega','2f27ec7dbc36a3717847b28c4ac61acb','Kenny','Omega','komega32@gmail.com','male','09325433211','Santa Cruz, Laguna','','','','','','','','','','53d95c52e4cb0ce33fb91b977a3e25fe',NULL),(70,'gsmaloto','7815696ecbf1c96e6894b779456d330e','Gener','Maloto','genermaloto@gmail.com','male','09546411545','Sta. Cruz, Laguna','','','','','','','','','malone.jpg','',NULL),(71,'ben','202cb962ac59075b964b07152d234b70','Ben','tong','akonreyes11@gmail.com','male','09231231231','sta.cruz laguna','','','','','','','','','avatar.jpg','',NULL);

/*Table structure for table `healthdeclaration` */

DROP TABLE IF EXISTS `healthdeclaration`;

CREATE TABLE `healthdeclaration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientId` int(11) DEFAULT NULL,
  `q1` varchar(11) DEFAULT NULL,
  `q2` varchar(11) DEFAULT NULL,
  `q3` varchar(11) DEFAULT NULL,
  `q4` varchar(11) DEFAULT NULL,
  `q5` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

/*Data for the table `healthdeclaration` */

insert  into `healthdeclaration`(`id`,`clientId`,`q1`,`q2`,`q3`,`q4`,`q5`,`created`) values (1,38,'Yes','Yes','Yes','Yes','tes','2021-11-18 13:18:42'),(2,38,'Yes','Yes','No','No','ggg','2021-11-18 13:20:41'),(3,38,'No','No','No','No','Santa Cruz','2021-11-18 16:23:34'),(4,38,'Yes','No','Yes','No','Liliw','2021-11-18 18:01:36'),(5,38,'Yes','No','No','No','calamba','2021-11-18 18:51:47'),(6,52,'Yes','No','No','No','calamba','2021-11-18 18:58:29'),(7,38,'No','No','No','No','','2021-11-19 11:57:58'),(8,38,'No','No','No','No','','2021-11-19 13:28:38'),(9,58,'No','No','No','No','','2021-11-19 16:54:27'),(10,58,'No','No','No','No','','2021-11-19 17:06:40'),(11,58,'No','No','No','No','','2021-11-19 17:10:47'),(12,58,'No','No','No','No','','2021-11-19 17:41:44'),(13,59,'No','No','No','No','','2021-11-19 17:54:28'),(14,60,'No','No','No','No','','2021-11-19 18:11:33'),(15,60,'No','No','No','No','','2021-12-18 11:02:16'),(16,60,'No','No','No','No','','2021-12-18 11:10:31'),(17,60,'No','No','No','No','','2022-01-24 09:58:46'),(18,60,'No','No','No','No','','2022-01-25 14:30:50'),(19,60,'No','No','No','No','','2022-01-30 11:14:08'),(20,60,'No','No','No','No','','2022-01-30 12:08:43'),(21,60,'No','No','No','No','','2022-01-30 13:04:06'),(22,60,'No','No','No','No','','2022-01-30 13:05:00'),(23,60,'No','No','No','No','','2022-01-30 13:28:53'),(24,70,'No','No','No','No','','2022-01-31 13:31:02'),(25,70,'No','No','Yes','Yes','','2022-02-03 15:02:47'),(26,70,'Yes','No','No','No','','2022-02-04 12:49:30'),(27,70,'No','No','No','No','','2022-03-08 16:25:55'),(28,70,'No','No','No','No','','2022-03-12 12:25:07'),(29,70,'No','No','No','No','','2022-03-14 14:06:42'),(30,70,'No','No','No','No','','2022-03-14 15:24:08');

/*Table structure for table `income` */

DROP TABLE IF EXISTS `income`;

CREATE TABLE `income` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientId` int(11) DEFAULT NULL,
  `detail` varchar(50) DEFAULT NULL,
  `payment` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

/*Data for the table `income` */

insert  into `income`(`id`,`clientId`,`detail`,`payment`,`created`) values (2,13,'Session',70,'2022-01-01 03:48:03'),(3,15,'Session',70,'2022-01-13 03:49:00'),(4,16,'Session',70,'2022-01-01 03:49:08'),(5,60,'Session',70,'2022-01-11 03:49:28'),(6,60,'Membership',1250,'2022-02-25 03:50:28'),(7,13,'Membership',1250,'2021-12-05 03:49:08'),(11,70,'Session',70,'2022-01-31 06:31:43'),(12,70,'Session',70,'2022-02-04 05:51:24'),(13,70,'Session',70,'2022-03-09 04:44:47'),(14,70,'Session',70,'2022-03-12 05:25:27'),(15,60,'Session',70,'2022-03-14 05:22:03'),(16,70,'Session',70,'2022-03-14 05:22:50'),(17,70,'Session',70,'2022-03-14 05:27:48'),(18,70,'Session',70,'2022-03-14 05:48:55'),(19,70,'Session',70,'2022-03-14 05:56:54'),(20,70,'Session',70,'2022-03-14 05:58:15'),(21,70,'Session',70,'2022-03-14 06:00:26'),(22,70,'Session',70,'2022-03-14 06:07:13'),(23,70,'Session',70,'2022-03-14 06:07:56'),(24,70,'Session',70,'2022-03-14 06:19:43'),(25,70,'Session',70,'2022-03-14 06:20:07'),(26,70,'Session',70,'2022-03-14 06:23:31'),(27,70,'Session',70,'2022-03-14 06:24:42'),(28,70,'Session',70,'2022-03-14 06:26:43'),(29,70,'Session',70,'2022-03-14 06:27:18'),(30,70,'Session',70,'2022-03-14 06:27:40'),(31,70,'Session',70,'2022-03-14 06:40:05'),(32,70,'Session',70,'2022-03-14 07:08:03'),(33,60,'Membership',1250,'2022-03-14 07:29:12'),(34,33,'Session',70,'2022-03-14 08:14:03'),(35,70,'Session',70,'2022-03-14 08:14:35'),(36,60,'Membership',1250,'2022-03-14 08:41:25'),(37,60,'Membership',1250,'2022-03-14 08:41:34'),(38,60,'Membership',1250,'2022-03-14 08:41:43');

/*Table structure for table `membership` */

DROP TABLE IF EXISTS `membership`;

CREATE TABLE `membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientId` int(11) DEFAULT NULL,
  `status` varchar(5) DEFAULT 'p',
  `civil` varchar(25) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `eContactName` varchar(50) DEFAULT NULL,
  `eContactNum` varchar(15) DEFAULT NULL,
  `height` varchar(5) DEFAULT NULL,
  `weight` varchar(5) DEFAULT NULL,
  `expired` date DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `membership` */

insert  into `membership`(`id`,`clientId`,`status`,`civil`,`occupation`,`eContactName`,`eContactNum`,`height`,`weight`,`expired`,`created`) values (9,60,'c','married','213213','asdasd','213123213','5\'5','32','2023-01-30','2022-03-14 15:41:43');

/*Table structure for table `notif` */

DROP TABLE IF EXISTS `notif`;

CREATE TABLE `notif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fromId` int(11) DEFAULT NULL,
  `message` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;

/*Data for the table `notif` */

insert  into `notif`(`id`,`fromId`,`message`,`status`,`created`) values (63,0,'New appointment in 2022-03-16 and time is PM.',1,'2022-03-14 15:24:08');

/*Table structure for table `userlogs` */

DROP TABLE IF EXISTS `userlogs`;

CREATE TABLE `userlogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientId` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `userlogs` */

insert  into `userlogs`(`id`,`clientId`,`date`) values (1,60,'2022-01-31 05:29:54'),(2,60,'2022-01-31 05:30:59'),(3,60,'2022-01-31 05:48:58'),(4,68,'2022-01-31 06:07:10'),(5,68,'2022-01-31 06:15:55'),(6,70,'2022-01-31 06:29:44'),(7,70,'2022-01-31 06:30:28'),(8,70,'2022-01-31 06:32:24'),(9,70,'2022-01-31 15:47:43'),(10,70,'2022-02-03 07:53:34'),(11,70,'2022-02-14 04:55:10'),(12,70,'2022-03-07 07:35:52'),(13,70,'2022-03-08 08:57:07');

/*Table structure for table `webdetail` */

DROP TABLE IF EXISTS `webdetail`;

CREATE TABLE `webdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `coverImg` varchar(100) DEFAULT NULL,
  `about` varchar(500) NOT NULL,
  `max` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `webdetail` */

insert  into `webdetail`(`id`,`name`,`email`,`contact`,`coverImg`,`about`,`max`) values (1,'','axfitnessphilippines@gmail.com','0918 652 9383','asdasdasd','',10);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
