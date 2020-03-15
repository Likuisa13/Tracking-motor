/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.8-MariaDB : Database - tracking
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tracking` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `tracking`;

/*Table structure for table `kendaraan` */

DROP TABLE IF EXISTS `kendaraan`;

CREATE TABLE `kendaraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merk` varchar(20) DEFAULT NULL,
  `plat_nomor` varchar(10) DEFAULT NULL,
  `pengguna` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kendaraan` */

insert  into `kendaraan`(`id`,`merk`,`plat_nomor`,`pengguna`) values 
(1,'Supra 125','AB 1002 NB','Mita'),
(2,'Vario 110','AB 3455 RB','Martin'),
(3,'Mio J','AB 1124 NB','Ibu');

/*Table structure for table `lokasi` */

DROP TABLE IF EXISTS `lokasi`;

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) NOT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `batas` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kendaraan` (`id_kendaraan`),
  CONSTRAINT `lokasi_ibfk_1` FOREIGN KEY (`id_kendaraan`) REFERENCES `kendaraan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `lokasi` */

insert  into `lokasi`(`id`,`id_kendaraan`,`latitude`,`longitude`,`batas`) values 
(1,1,'-7.782811','110.367002',4);

/*Table structure for table `riwayat` */

DROP TABLE IF EXISTS `riwayat`;

CREATE TABLE `riwayat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lokasi` int(11) DEFAULT NULL,
  `latitude_now` varchar(20) DEFAULT NULL,
  `longitude_now` varchar(20) DEFAULT NULL,
  `jarak_now` double DEFAULT NULL,
  `status` enum('Di Izinkan','Di Larang') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_lokasi` (`id_lokasi`),
  CONSTRAINT `riwayat_ibfk_1` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `riwayat` */

insert  into `riwayat`(`id`,`id_lokasi`,`latitude_now`,`longitude_now`,`jarak_now`,`status`) values 
(1,1,'-7.749381','110.355452',3,'Di Izinkan'),
(2,1,'-7.749381','-7.749381',5,'Di Larang');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `roles` enum('admin','pengguna') DEFAULT NULL,
  `is_login` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`nama`,`username`,`password`,`roles`,`is_login`) values 
(1,'Administrator','admin','*4ACFE3202A5FF5CF467898FC58AAB1D615029441  ','admin',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
