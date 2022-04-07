/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100408
 Source Host           : localhost:3306
 Source Schema         : web0304

 Target Server Type    : MySQL
 Target Server Version : 100408
 File Encoding         : 65001

 Date: 06/04/2022 10:48:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `category_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `category_deleted` int NULL DEFAULT 0,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'IP', 'iPhone', 0);
INSERT INTO `category` VALUES (2, 'SS', 'Samsung', 0);
INSERT INTO `category` VALUES (3, 'OP', 'OPPO', 0);
INSERT INTO `category` VALUES (4, 'XI', 'Xiaomi', 0);
INSERT INTO `category` VALUES (5, 'SO', 'Sony', 0);

-- ----------------------------
-- Table structure for feedback
-- ----------------------------
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback`  (
  `feedback_id` int NOT NULL AUTO_INCREMENT,
  `feedback_firstname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `feedback_lastname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `feedback_email` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `feedback_phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `feedback_subjectname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `feedback_note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`feedback_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of feedback
-- ----------------------------

-- ----------------------------
-- Table structure for galery
-- ----------------------------
DROP TABLE IF EXISTS `galery`;
CREATE TABLE `galery`  (
  `galery_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NULL DEFAULT NULL,
  `galery_thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`galery_id`) USING BTREE,
  INDEX `product_id`(`product_id` ASC) USING BTREE,
  CONSTRAINT `galery_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of galery
-- ----------------------------

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`  (
  `order_details_id` int NOT NULL AUTO_INCREMENT,
  `orders_id` int NULL DEFAULT NULL,
  `product_id` int NULL DEFAULT NULL,
  `order_details_price` int NULL DEFAULT NULL,
  `order_details_num` int NULL DEFAULT NULL,
  `order_details_totalmoney` int NULL DEFAULT NULL,
  PRIMARY KEY (`order_details_id`) USING BTREE,
  INDEX `orders_id`(`orders_id` ASC) USING BTREE,
  INDEX `product_id`(`product_id` ASC) USING BTREE,
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`orders_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_details
-- ----------------------------

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `orders_id` int NOT NULL AUTO_INCREMENT,
  `orders_fullname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `orders_email` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `orders_phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `orders_address` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `orders_note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `orders_status` int NULL DEFAULT NULL,
  `orders_totalmoney` int NULL DEFAULT NULL,
  PRIMARY KEY (`orders_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NULL DEFAULT NULL,
  `product_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `product_purchase_price` int NULL DEFAULT NULL,
  `product_price` int NULL DEFAULT NULL,
  `product_discount` int NULL DEFAULT NULL,
  `product_thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `product_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `product_amount` int NULL DEFAULT 1,
  `product_public` int NULL DEFAULT 0,
  `product_deleted` int NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`) USING BTREE,
  INDEX `category_id`(`category_id` ASC) USING BTREE,
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (1, 2, 'Galaxy note 10', 8000000, 9000000, NULL, 'Galaxy_note_10_4.png', NULL, 1, 1, 0, '2022-04-05 10:45:39', NULL);
INSERT INTO `product` VALUES (2, 2, 'Galaxy note 20', 11000000, 12500000, 12000000, 'galaxy-note-20.png', NULL, 1, 1, 0, '2022-04-05 10:47:28', NULL);

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, 'admin');
INSERT INTO `role` VALUES (2, 'user');
INSERT INTO `role` VALUES (3, 'customer');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NULL DEFAULT NULL,
  `user_fullname` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `user_email` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `user_phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `user_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `user_password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `user_address` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `user_deleted` int NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE,
  INDEX `role_id`(`role_id` ASC) USING BTREE,
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 1, 'Nguyễn Tấn Toại', 'nttoai89@gmail.com', '0985956340', 'nttoai', 'e10adc3949ba59abbe56e057f20f883e', 'Số 25, Võ Thị Sáu, Đông Xuyên, tp.Long Xuyên. An Giang', 0, '2022-04-04 05:47:54', NULL);
INSERT INTO `user` VALUES (2, 2, 'Người dùng user', 'ndu@gmail.com', '0911532540', 'ndu', '52c69e3a57331081823331c4e69d3f2e', 'Số 117, Hưng Lợi, Ninh Kiều, Cần Thơ', 0, '2022-04-04 05:49:34', NULL);
INSERT INTO `user` VALUES (3, 3, 'Khách hàng', 'kh@gmail.com', '0999999999', 'kh', '52c69e3a57331081823331c4e69d3f2e', NULL, 0, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
