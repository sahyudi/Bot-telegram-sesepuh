/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50621
 Source Host           : localhost:3306
 Source Schema         : sesepuh

 Target Server Type    : MySQL
 Target Server Version : 50621
 File Encoding         : 65001

 Date: 16/11/2019 09:52:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_member
-- ----------------------------
DROP TABLE IF EXISTS `tbl_member`;
CREATE TABLE `tbl_member`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_ses` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `rank` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telegram_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_member
-- ----------------------------
INSERT INTO `tbl_member` VALUES (1, 'sahyudi', 'S01', '1', '10', 384920975);
INSERT INTO `tbl_member` VALUES (2, 'nurmi', 'S02', '1', '9', 730432281);
INSERT INTO `tbl_member` VALUES (3, 'Rifqi', 'S03', '1', '8', NULL);
INSERT INTO `tbl_member` VALUES (4, 'Syifa', 'S04', '1', '7', NULL);
INSERT INTO `tbl_member` VALUES (5, 'Fariz', 'S05', '1', '6', NULL);
INSERT INTO `tbl_member` VALUES (6, 'Testing Loh Yah', 'S06', '1', '5', NULL);
INSERT INTO `tbl_member` VALUES (7, 'Boy Kurniawan', 'S07', '1', '4', NULL);
INSERT INTO `tbl_member` VALUES (8, 'Sentia', 'S08', '1', '3', NULL);
INSERT INTO `tbl_member` VALUES (9, 'Anwar', 'S09', '1', '2', NULL);
INSERT INTO `tbl_member` VALUES (10, 'Rifqi', 'S99', '1', '1', NULL);
INSERT INTO `tbl_member` VALUES (11, 'Dzikri', 'S14', '1', '1', 248480466);

-- ----------------------------
-- Table structure for tbl_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `tbl_transaksi`;
CREATE TABLE `tbl_transaksi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `tgl_transaksi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` int(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_transaksi
-- ----------------------------
INSERT INTO `tbl_transaksi` VALUES (1, 4, '2019-11-15', 100);
INSERT INTO `tbl_transaksi` VALUES (2, 9, '2019-11-15', 100);
INSERT INTO `tbl_transaksi` VALUES (3, 2, '2019-11-15', 10);
INSERT INTO `tbl_transaksi` VALUES (5, 5, '2019-11-15', 1000);
INSERT INTO `tbl_transaksi` VALUES (8, 1, '2019-11-15', 100);
INSERT INTO `tbl_transaksi` VALUES (9, 11, '2019-11-16', 50);
INSERT INTO `tbl_transaksi` VALUES (10, 1, '2019-11-16', 100);
INSERT INTO `tbl_transaksi` VALUES (11, 2, '2019-11-16', 100);

-- ----------------------------
-- Table structure for tbl_user
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `image` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES (3, 'Poetra Geranting', 'sahyudi.dev@gmail.com', 'profile.jpg', '$2y$10$T5ZqS.TkqHNpAQZqHMPbd.VAO82D/g6zAzO986NiijgnqWI3Pg4/6', 1, 1, 1564673261);
INSERT INTO `tbl_user` VALUES (4, 'Admin yudi', 'yudi@gmail.com', 'default.jpg', '$2y$10$55tT6STVQcVSL1nzK3DSvOeCXCuW/r8NCQolG8UfzsPTRw3l3NzWm', 2, 1, 1570747573);
INSERT INTO `tbl_user` VALUES (5, 'Dea', 'dea@sesepuh.id', 'default.jpg', '$2y$10$flEffMqVS3rUeZ10s2Nibul4ZN6cSmM4nM02.TXyq1gIGGZYLpZKK', 1, 1, 1573204842);
INSERT INTO `tbl_user` VALUES (6, 'Nurmi', 'dea@sesepuh.id', 'default.jpg', '$2y$10$flEffMqVS3rUeZ10s2Nibul4ZN6cSmM4nM02.TXyq1gIGGZYLpZKK', 1, 1, 1573204842);
INSERT INTO `tbl_user` VALUES (7, 'Furqon', 'dea@sesepuh.id', 'default.jpg', '$2y$10$flEffMqVS3rUeZ10s2Nibul4ZN6cSmM4nM02.TXyq1gIGGZYLpZKK', 1, 1, 1573204842);
INSERT INTO `tbl_user` VALUES (8, 'Syifa', 'dea@sesepuh.id', 'default.jpg', '$2y$10$flEffMqVS3rUeZ10s2Nibul4ZN6cSmM4nM02.TXyq1gIGGZYLpZKK', 1, 1, 1573204842);
INSERT INTO `tbl_user` VALUES (9, 'Rifqi', 'dea@sesepuh.id', 'default.jpg', '$2y$10$flEffMqVS3rUeZ10s2Nibul4ZN6cSmM4nM02.TXyq1gIGGZYLpZKK', 1, 1, 1573204842);

-- ----------------------------
-- Table structure for tbl_user_access_menu
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_access_menu`;
CREATE TABLE `tbl_user_access_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user_access_menu
-- ----------------------------
INSERT INTO `tbl_user_access_menu` VALUES (1, 1, 1);
INSERT INTO `tbl_user_access_menu` VALUES (8, 1, 2);
INSERT INTO `tbl_user_access_menu` VALUES (9, 1, 3);
INSERT INTO `tbl_user_access_menu` VALUES (14, 2, 2);
INSERT INTO `tbl_user_access_menu` VALUES (15, 1, 5);
INSERT INTO `tbl_user_access_menu` VALUES (16, 1, 6);
INSERT INTO `tbl_user_access_menu` VALUES (17, 1, 7);

-- ----------------------------
-- Table structure for tbl_user_book
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_book`;
CREATE TABLE `tbl_user_book`  (
  `id` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_buy` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `author` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `title` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `publisher` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `years` int(4) NOT NULL,
  `isbn` int(22) NOT NULL,
  `qty` int(11) NOT NULL,
  `descrip` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user_book
-- ----------------------------
INSERT INTO `tbl_user_book` VALUES (0, 1570701777, '2019-10-10', 'Salim A. Fillah', 'Lapis - Lapis Keberkahan', '2017', 0, 12356, 1, 'Baik untuk dibaca', 3);

-- ----------------------------
-- Table structure for tbl_user_menu
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_menu`;
CREATE TABLE `tbl_user_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user_menu
-- ----------------------------
INSERT INTO `tbl_user_menu` VALUES (1, 'Admin');
INSERT INTO `tbl_user_menu` VALUES (2, 'User');
INSERT INTO `tbl_user_menu` VALUES (3, 'Menu');
INSERT INTO `tbl_user_menu` VALUES (4, 'test');
INSERT INTO `tbl_user_menu` VALUES (5, 'Member');
INSERT INTO `tbl_user_menu` VALUES (6, 'Book');
INSERT INTO `tbl_user_menu` VALUES (7, 'Dashboard');

-- ----------------------------
-- Table structure for tbl_user_role
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_role`;
CREATE TABLE `tbl_user_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user_role
-- ----------------------------
INSERT INTO `tbl_user_role` VALUES (1, 'Administrator');
INSERT INTO `tbl_user_role` VALUES (2, 'Member');

-- ----------------------------
-- Table structure for tbl_user_sub_menu
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user_sub_menu`;
CREATE TABLE `tbl_user_sub_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `url` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `icon` varchar(128) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tbl_user_sub_menu
-- ----------------------------
INSERT INTO `tbl_user_sub_menu` VALUES (1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1);
INSERT INTO `tbl_user_sub_menu` VALUES (2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1);
INSERT INTO `tbl_user_sub_menu` VALUES (3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1);
INSERT INTO `tbl_user_sub_menu` VALUES (4, 3, 'Menu Managament', 'menu', 'fas fa-fw fa-folder', 1);
INSERT INTO `tbl_user_sub_menu` VALUES (5, 3, 'Submenu Managament', 'menu/submenu', 'fas fa-fw fa-folder-open', 1);
INSERT INTO `tbl_user_sub_menu` VALUES (6, 3, 'Youtube', 'youtube', 'fab fa-fw fa-youtube', 1);
INSERT INTO `tbl_user_sub_menu` VALUES (7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1);
INSERT INTO `tbl_user_sub_menu` VALUES (8, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1);
INSERT INTO `tbl_user_sub_menu` VALUES (9, 5, 'List', 'member', 'fas fa-fw fa-users', 1);
INSERT INTO `tbl_user_sub_menu` VALUES (10, 6, 'List Buku', 'book', 'fas fa-fw fa-book', 1);
INSERT INTO `tbl_user_sub_menu` VALUES (11, 5, 'Form', 'member/createform', 'fab fa-fw fa-wpforms', 1);
INSERT INTO `tbl_user_sub_menu` VALUES (12, 7, 'Home', 'dashboard', 'fab fa-fw fa-wpforms', 1);

SET FOREIGN_KEY_CHECKS = 1;
