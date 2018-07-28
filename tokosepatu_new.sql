/*
SQLyog Professional v12.09 (64 bit)
MySQL - 10.1.21-MariaDB : Database - tokosepatu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tokosepatu` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `tokosepatu`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(8) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`username`,`password`) values ('admin','admin123');

/*Table structure for table `bank` */

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `id_bank` varchar(8) NOT NULL,
  `nama_bank` varchar(15) DEFAULT NULL,
  `no_rek` varchar(15) DEFAULT NULL,
  `logo` varchar(15) DEFAULT NULL,
  `atas_nama` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bank` */

insert  into `bank`(`id_bank`,`nama_bank`,`no_rek`,`logo`,`atas_nama`) values ('bca','Bank Central As','0689102389','bca.png','Haffsriyandra Yusuf'),('mandiri','Bank Mandiri','1230006900627','mandiri.png','Haffsriyandra Yusuf');

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(35) NOT NULL,
  `id_kategori` varchar(6) NOT NULL,
  `id_jenis` varchar(6) NOT NULL,
  `harga` double NOT NULL,
  `berat` int(4) NOT NULL,
  `gambar` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `barang` */

insert  into `barang`(`id_barang`,`nama_barang`,`id_kategori`,`id_jenis`,`harga`,`berat`,`gambar`,`deskripsi`) values ('18072478','adidas','KS-001','JS-009',300000,120,'209.jpg','<p>sepatu adidas terbaru 2018</p>'),('18077781','nike','KS-002','JS-006',180000,111,'268.jpg','<p>sepatu nike wanita terbaru 2018</p>'),('RAG-005','Raindoz RAG-005','KS-001','JS-002',164045,300,'232.jpg','<p>Sepatu Pria Raindoz RAG-005</p>'),('RAG-006','Raindoz RAG-006','KS-001','JS-005',172273,300,'206.jpg','Sepatu Pria Raindoz RAG-006'),('RAH-006','Raindoz  RAH-006','KS-002','JS-006',130619,300,'386.jpg','Sepatu Wanita Raindoz  RAH-006'),('RAK-031','Raindoz  RAK-031','KS-002','JS-006',149132,300,'380.jpg','Sepatu Wanita Raindoz  RAK-031'),('RAN-001','Raindoz  RAN-001','KS-002','JS-008',110049,300,'337.jpg','Sepatu Wanita Raindoz  RAN-001'),('RAN-002','Raindoz  RAN-002','KS-002','JS-008',110049,300,'339.jpg','Sepatu Wanita Raindoz  RAN-002'),('RAP-009','Raindoz RAP-009','KS-001','JS-001',157360,300,'267.jpg','Sepatu Pria Raindoz RAP-009'),('RAP-030','Raindoz  RAP-030','KS-002','JS-006',122391,300,'382.jpg','Sepatu Wanita Raindoz  RAP-030'),('RAP-038','Raindoz  RAP-038','KS-002','JS-006',129076,300,'395.jpg','Sepatu Wanita Raindoz  RAP-038'),('RAP-044','Raindoz  RAP-044','KS-002','JS-006',127534,300,'388.jpg','Sepatu Wanita Raindoz  RAP-044');

/*Table structure for table `detail_transaksi` */

DROP TABLE IF EXISTS `detail_transaksi`;

CREATE TABLE `detail_transaksi` (
  `id_detail` int(5) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(14) NOT NULL,
  `id_barang` varchar(8) NOT NULL,
  `harga` double DEFAULT NULL,
  `berat` int(4) DEFAULT NULL,
  `jumlah` int(2) NOT NULL,
  `subberat` int(4) NOT NULL,
  `subtotal` double NOT NULL,
  `size` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `detail_transaksi` */

insert  into `detail_transaksi`(`id_detail`,`id_transaksi`,`id_barang`,`harga`,`berat`,`jumlah`,`subberat`,`subtotal`,`size`) values (17,'201806306206','RAG-005',164045,300,1,300,164045,37),(18,'201806306206','RBA-001',152218,300,1,300,152218,39),(19,'201806306206','RSA-094',150675,300,2,600,301350,41),(20,'201806304895','RAG-005',164045,300,1,300,164045,37),(21,'201806304895','RBA-001',152218,300,1,300,152218,39),(22,'201806304895','RSA-094',150675,300,2,600,301350,41),(23,'201807054340','RAH-006',130619,300,2,600,261238,39),(24,'201807094283','RAP-009',157360,300,1,300,157360,37),(25,'201807137440','RBA-001',152218,300,1,300,152218,37),(26,'201807137440','RBA-014',151703,300,2,600,303406,37),(27,'201807167533','18072478',900000,120,2,240,1800000,37),(28,'201807169550','18072478',900000,120,1,120,900000,37),(29,'201807167064','18072478',900000,120,2,240,1800000,41),(30,'201807183611','18072478',900000,120,1,120,900000,37),(31,'201807194480','18072478',900000,120,20,2400,18000000,37);

/*Table structure for table `jenis` */

DROP TABLE IF EXISTS `jenis`;

CREATE TABLE `jenis` (
  `id_jenis` varchar(6) NOT NULL,
  `jenis_sepatu` varchar(20) NOT NULL,
  `id_kategori` varchar(6) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `jenis` */

insert  into `jenis`(`id_jenis`,`jenis_sepatu`,`id_kategori`) values ('JS-001','Sneakers','KS-001'),('JS-002','Flat Shoes','KS-002'),('JS-003','Boots','KS-001'),('JS-005','Formal','KS-001'),('JS-006','Sneakers','KS-002'),('JS-007','Wedges','KS-002'),('JS-008','High Heels','KS-002'),('JS-009','Futsal','KS-001');

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kategori` varchar(6) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`id_kategori`,`nama_kategori`) values ('KS-001','Pria'),('KS-002','Wanita');

/*Table structure for table `keranjang` */

DROP TABLE IF EXISTS `keranjang`;

CREATE TABLE `keranjang` (
  `id_keranjang` varchar(30) NOT NULL,
  `id_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(35) NOT NULL,
  `ukuran` int(2) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(2) NOT NULL,
  `berat` int(4) DEFAULT NULL,
  `subtotal` double NOT NULL,
  `subberat` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `keranjang` */

/*Table structure for table `konfirmasi` */

DROP TABLE IF EXISTS `konfirmasi`;

CREATE TABLE `konfirmasi` (
  `id_konfirmasi` int(4) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(14) NOT NULL,
  `id_pelanggan` varchar(12) DEFAULT NULL,
  `jumlah_transfer` double NOT NULL,
  `bukti_bayar` varchar(30) NOT NULL,
  PRIMARY KEY (`id_konfirmasi`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `konfirmasi` */

insert  into `konfirmasi`(`id_konfirmasi`,`id_transaksi`,`id_pelanggan`,`jumlah_transfer`,`bukti_bayar`) values (13,'201806304895','1806131007',635315,'ERD-5.jpg'),(18,'201807183611','1806239147',918000,'Screenshot.png'),(19,'201807194480','1806239147',18015000,'Screenshot.png');

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(12) NOT NULL,
  `nama_pelanggan` varchar(30) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_telepon` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`id_pelanggan`,`nama_pelanggan`,`jenis_kelamin`,`tgl_lahir`,`no_telepon`,`email`,`password`) values ('1806131007','dian yulianingsih','Perempuan','1996-07-10','083899051007','dianyulianingsih10@yahoo.co.id','$2y$10$KIQs0g9uYgtVKmk4MMX1WOlZy3YajMcKfLyWMIx3wKbo8wRwAKIXy'),('1806239147','yandra','Laki-laki','1995-06-06','083804879147','yandraa6@yahoo.com','$2y$10$xfYfU6QBoV5SfnmLrVg0sOFAR3PI7ckI81WVVsg3k4oOz61mRM2v.'),('1807052346','rista','Perempuan','1997-05-25','083872742346','rista@yahoo.co.id','$2y$10$i8nG1p4ojViUuUwgAiZPr..iD0hm1NGcxTxfEFD37zXEPNHo9ye3C'),('1807057068','yuda prastyo','Laki-laki','1994-06-06','083873167068','yuda@yahoo.com','$2y$10$OZitA7vUVy/Z2dxFKEtN/eMlrYkqHvV8adt57IDbfTStGS3NtnEUa'),('1807129012','andre','Laki-laki','2018-07-12','123456789012','andre@yahoo.com','$2y$10$UtVY9K5q1NgK8/DqBUpxWOMAr4yjsipDSTFTzJ/aazpZph83IQd1O'),('1807142121','black','Laki-laki','2018-07-07','098765432121','black@gmail.com','$2y$10$2xzS810lsGRYCTSdyWJmm.Uxlk31R7OrHVXGV8I7V8kZIRyTu7/Wu'),('1807152222','panji','Laki-laki','2018-07-05','222222222222','panji@yahoo.com','$2y$10$wbfIwxX9jDv5kROg9jyOGO2NIG1yiH9HnqtoX7EMRzChqPU69uawC'),('1807153333','pian','Laki-laki','2014-05-12','333333333333','piantherock@yahoo.com','$2y$10$zsXnXGcCVpkkUxE2iDXIRO.EKWkOrL2Osy9qdl/zUDfoaJv5bv6G6');

/*Table structure for table `stok` */

DROP TABLE IF EXISTS `stok`;

CREATE TABLE `stok` (
  `id_stok` int(3) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(8) NOT NULL,
  `ukuran` int(2) NOT NULL,
  `stok` int(3) NOT NULL,
  PRIMARY KEY (`id_stok`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `stok` */

insert  into `stok`(`id_stok`,`id_barang`,`ukuran`,`stok`) values (1,'18072478',37,25),(3,'18077781',38,15),(4,'18077781',39,15),(5,'18075201',41,15),(6,'18073016',37,1),(7,'18073016',38,2),(8,'18078269',37,5),(9,'18078269',38,5),(10,'18078269',39,5);

/*Table structure for table `tmp_brg` */

DROP TABLE IF EXISTS `tmp_brg`;

CREATE TABLE `tmp_brg` (
  `ukuran` int(2) DEFAULT NULL,
  `stok` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tmp_brg` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(14) NOT NULL,
  `id_pelanggan` varchar(12) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `subtotal` double NOT NULL,
  `nm_penerima` varchar(30) NOT NULL,
  `no_tlp` varchar(13) NOT NULL,
  `alamat_pengiriman` varchar(50) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `kode_pos` int(5) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kurir` varchar(15) NOT NULL,
  `service` varchar(25) NOT NULL,
  `ongkir` double NOT NULL,
  `status` int(2) NOT NULL,
  `resi` varchar(15) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id_transaksi`,`id_pelanggan`,`tgl_transaksi`,`subtotal`,`nm_penerima`,`no_tlp`,`alamat_pengiriman`,`kota`,`kode_pos`,`provinsi`,`kurir`,`service`,`ongkir`,`status`,`resi`) values ('201806304895','1806131007','2018-06-30',635613,'dian','083899051007','serdang raya','Jakarta Pusat',10560,'DKI Jakarta','jne','CTCYES',18000,4,'21214242424241'),('201807054340','1807057068','2018-07-05',280738,'yuda prastyo','083873167068','jl. serayu blok 6 kel.dadap kec.serong','Sukoharjo',43123,'Jawa Tengah','tiki','REG',19500,1,''),('201807129507','1807129012','2018-07-12',499165,'andre','123456789012','salemba','Buleleng',12131,'Bali','jne','OKE',24000,4,'12244442421212'),('201807137440','1807129012','2018-07-13',481624,'dina','12345678913','asdad','Bengkulu Tengah',21412,'Bengkulu','tiki','REG',26000,1,''),('201807167064','1806239147','2018-07-16',1839500,'asdsadf','3324242342344','sdffsgfsxccv','Kotawaringin Barat',24242,'Kalimantan Tengah','tiki','REG',39500,0,''),('201807169550','1806239147','2018-07-16',948500,'qwerty','121212121212','sasfsfaf','Murung Raya',21321,'Kalimantan Tengah','pos','Paket Kilat Khusus',48500,0,''),('201807183611','1806239147','2018-07-18',918000,'yandra','083804879147','salemba tengah','Jakarta Pusat',10440,'DKI Jakarta','jne','CTCYES',18000,4,'123123123123123'),('201807194480','1806239147','2018-07-19',18015000,'yandra','083804879147','salemba','Jakarta Pusat',10440,'DKI Jakarta','tiki','ECO',15000,4,'122321321321323');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
