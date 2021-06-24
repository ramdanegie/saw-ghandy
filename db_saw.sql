/*
Navicat MySQL Data Transfer

Source Server         : mysql_local
Source Server Version : 100411
Source Host           : localhost:3306
Source Database       : db_saw

Target Server Type    : MYSQL
Target Server Version : 100411
File Encoding         : 65001

Date: 2021-06-16 11:38:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for alternatif
-- ----------------------------
DROP TABLE IF EXISTS `alternatif`;
CREATE TABLE `alternatif` (
  `kode` varchar(20) NOT NULL,
  `aktif` bit(1) DEFAULT NULL,
  `alternatif` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of alternatif
-- ----------------------------
INSERT INTO `alternatif` VALUES ('A001', '', 'Pendaftar 1', '-');
INSERT INTO `alternatif` VALUES ('A002', '', 'Pendaftar 2', '-');

-- ----------------------------
-- Table structure for kriteria
-- ----------------------------
DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria` (
  `kode` varchar(20) NOT NULL,
  `aktif` bit(1) DEFAULT NULL,
  `kriteria` varchar(255) DEFAULT NULL,
  `atribut` varchar(255) DEFAULT NULL,
  `bobot` float DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of kriteria
-- ----------------------------
INSERT INTO `kriteria` VALUES ('C1', '', 'Character', 'benefit', '25');
INSERT INTO `kriteria` VALUES ('C2', '', 'Capacity', 'cost', '20');
INSERT INTO `kriteria` VALUES ('C3', '', 'Capital', 'benefit', '15');
INSERT INTO `kriteria` VALUES ('C4', '', 'Collateral', 'cost', '15');
INSERT INTO `kriteria` VALUES ('C5', '', 'Condition', 'benefit', '10');
INSERT INTO `kriteria` VALUES ('C6', '', 'Cashflow', 'cost', '10');
INSERT INTO `kriteria` VALUES ('C7', '', 'Culture', 'benefit', '5');

-- ----------------------------
-- Table structure for loginuser
-- ----------------------------
DROP TABLE IF EXISTS `loginuser`;
CREATE TABLE `loginuser` (
  `id` int(11) NOT NULL,
  `aktif` bit(1) DEFAULT NULL,
  `namauser` varchar(255) DEFAULT NULL,
  `katasandi` varchar(255) DEFAULT NULL,
  `namalengkap` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of loginuser
-- ----------------------------
INSERT INTO `loginuser` VALUES ('1', '', 'admin', 'admin', 'Administrator');
INSERT INTO `loginuser` VALUES ('2', '', 'user', 'user', 'User');
INSERT INTO `loginuser` VALUES ('3', '', 'user2', 'user', 'User');
INSERT INTO `loginuser` VALUES ('4', '', 'user3', 'user', 'User');
INSERT INTO `loginuser` VALUES ('5', '', 'user4', 'user', 'User');
INSERT INTO `loginuser` VALUES ('6', '', 'user5', 'user', 'User');
INSERT INTO `loginuser` VALUES ('7', '', 'user6', 'user', 'User');
INSERT INTO `loginuser` VALUES ('8', '', 'user7', 'user', 'User');
INSERT INTO `loginuser` VALUES ('9', '', 'user8', 'user', 'User');
INSERT INTO `loginuser` VALUES ('10', '', 'user9', 'user', 'User');
INSERT INTO `loginuser` VALUES ('11', '', 'user10', 'user', 'User');
INSERT INTO `loginuser` VALUES ('12', '', 'user11', 'user', 'User');
INSERT INTO `loginuser` VALUES ('13', '', 'user12', 'user', 'User');
INSERT INTO `loginuser` VALUES ('14', '', 'user13', 'user', 'User');

-- ----------------------------
-- Table structure for nilaialternatif
-- ----------------------------
DROP TABLE IF EXISTS `nilaialternatif`;
CREATE TABLE `nilaialternatif` (
  `id` int(11) NOT NULL,
  `aktif` bit(1) DEFAULT b'0',
  `characterfk` varchar(20) DEFAULT '',
  `capacityfk` varchar(20) DEFAULT '',
  `capitalfk` varchar(20) DEFAULT '',
  `collateralfk` varchar(20) DEFAULT '',
  `conditionfk` varchar(20) DEFAULT '',
  `cashflowfk` varchar(20) DEFAULT '',
  `alternatiffk` varchar(20) DEFAULT '',
  `culturefk` varchar(20) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of nilaialternatif
-- ----------------------------
INSERT INTO `nilaialternatif` VALUES ('1', '', 'N003', 'N009', 'N013', 'N018', 'N022', 'N027', 'A001', 'N033');
INSERT INTO `nilaialternatif` VALUES ('2', '', 'N005', 'N008', 'N011', 'N017', 'N023', 'N027', 'A002', 'N031');

-- ----------------------------
-- Table structure for nilaicrips
-- ----------------------------
DROP TABLE IF EXISTS `nilaicrips`;
CREATE TABLE `nilaicrips` (
  `kode` varchar(20) NOT NULL,
  `aktif` bit(1) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nilai` float DEFAULT NULL,
  `kriteriafk` varchar(20) DEFAULT '',
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of nilaicrips
-- ----------------------------
INSERT INTO `nilaicrips` VALUES ('N001', '', 'Sangat Buruk', '5', 'C1');
INSERT INTO `nilaicrips` VALUES ('N002', '', 'Buruk', '25', 'C1');
INSERT INTO `nilaicrips` VALUES ('N003', '', 'Cukup', '50', 'C1');
INSERT INTO `nilaicrips` VALUES ('N004', '', 'Baik', '75', 'C1');
INSERT INTO `nilaicrips` VALUES ('N005', '', 'Sangat Baik', '100', 'C1');
INSERT INTO `nilaicrips` VALUES ('N006', '', 'Sangat Tidak Mampu', '5', 'C2');
INSERT INTO `nilaicrips` VALUES ('N007', '', 'Tidak Mampu', '25', 'C2');
INSERT INTO `nilaicrips` VALUES ('N008', '', 'Cukup', '50', 'C2');
INSERT INTO `nilaicrips` VALUES ('N009', '', 'Mampu', '75', 'C2');
INSERT INTO `nilaicrips` VALUES ('N010', '', 'Sangat Mampu', '100', 'C2');
INSERT INTO `nilaicrips` VALUES ('N011', '', 'Sangat Tidak Mampu', '5', 'C3');
INSERT INTO `nilaicrips` VALUES ('N012', '', 'Tidak mampu', '25', 'C3');
INSERT INTO `nilaicrips` VALUES ('N013', '', 'Cukup', '50', 'C3');
INSERT INTO `nilaicrips` VALUES ('N014', '', 'Mampu', '75', 'C3');
INSERT INTO `nilaicrips` VALUES ('N015', '', 'Sangat Mampu', '100', 'C3');
INSERT INTO `nilaicrips` VALUES ('N016', '', '10%', '5', 'C4');
INSERT INTO `nilaicrips` VALUES ('N017', '', '>=10%', '25', 'C4');
INSERT INTO `nilaicrips` VALUES ('N018', '', '>=20%', '50', 'C4');
INSERT INTO `nilaicrips` VALUES ('N019', '', '>=30%', '75', 'C4');
INSERT INTO `nilaicrips` VALUES ('N020', '', '>=40%', '100', 'C4');
INSERT INTO `nilaicrips` VALUES ('N021', '', 'Sangat Mundur', '5', 'C5');
INSERT INTO `nilaicrips` VALUES ('N022', '', 'Mundur', '25', 'C5');
INSERT INTO `nilaicrips` VALUES ('N023', '', 'Statis', '50', 'C5');
INSERT INTO `nilaicrips` VALUES ('N024', '', 'Maju', '75', 'C5');
INSERT INTO `nilaicrips` VALUES ('N025', '', 'Sangat Maju', '100', 'C5');
INSERT INTO `nilaicrips` VALUES ('N026', '', '10 juta', '5', 'C6');
INSERT INTO `nilaicrips` VALUES ('N027', '', '20 juta', '25', 'C6');
INSERT INTO `nilaicrips` VALUES ('N028', '', '30 juta', '50', 'C6');
INSERT INTO `nilaicrips` VALUES ('N029', '', '40 juta', '75', 'C6');
INSERT INTO `nilaicrips` VALUES ('N030', '', '50 juta', '100', 'C6');
INSERT INTO `nilaicrips` VALUES ('N031', '', 'Blacklist', '25', 'C7');
INSERT INTO `nilaicrips` VALUES ('N032', '', 'Netral', '50', 'C7');
INSERT INTO `nilaicrips` VALUES ('N033', '', 'Whitelist', '100', 'C7');
