/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100418
 Source Host           : localhost:3306
 Source Schema         : laravel_laratrust

 Target Server Type    : MySQL
 Target Server Version : 100418
 File Encoding         : 65001

 Date: 23/01/2022 21:05:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tim_amenity
-- ----------------------------
DROP TABLE IF EXISTS `tim_amenity`;
CREATE TABLE `tim_amenity`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `amenity_group_id_foreign`(`group_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_amenity
-- ----------------------------
INSERT INTO `tim_amenity` VALUES (1, 1, 'Amenity 1', '2021-10-19 10:43:36', '2021-10-19 10:43:36');
INSERT INTO `tim_amenity` VALUES (2, 2, 'Amenit 1', NULL, NULL);
INSERT INTO `tim_amenity` VALUES (3, 1, 'Amenit 3', '2021-10-19 10:44:14', '2021-10-19 10:44:14');

-- ----------------------------
-- Table structure for tim_amenity_group
-- ----------------------------
DROP TABLE IF EXISTS `tim_amenity_group`;
CREATE TABLE `tim_amenity_group`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `amenity_group_name_unique`(`name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_amenity_group
-- ----------------------------
INSERT INTO `tim_amenity_group` VALUES (1, 'Group 1', '2021-10-19 10:42:28', '2021-10-19 10:42:28');
INSERT INTO `tim_amenity_group` VALUES (2, 'Group 2', '2021-10-19 10:42:28', '2021-10-19 10:42:28');

-- ----------------------------
-- Table structure for tim_categories
-- ----------------------------
DROP TABLE IF EXISTS `tim_categories`;
CREATE TABLE `tim_categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `categories_code_unique`(`code`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_categories
-- ----------------------------
INSERT INTO `tim_categories` VALUES (6, '001', 'Food', '2021-10-22 03:45:13', '2021-10-22 03:45:13');
INSERT INTO `tim_categories` VALUES (10, '004', 'Testing 2', '2021-10-31 01:50:18', '2021-10-31 01:50:18');
INSERT INTO `tim_categories` VALUES (11, '003', 'Computer', '2022-01-18 16:16:04', '2022-01-18 16:16:04');
INSERT INTO `tim_categories` VALUES (12, '000A', 'Drink', '2022-01-23 07:10:34', '2022-01-23 07:10:34');

-- ----------------------------
-- Table structure for tim_comments
-- ----------------------------
DROP TABLE IF EXISTS `tim_comments`;
CREATE TABLE `tim_comments`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `comments_post_id_foreign`(`post_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_comments
-- ----------------------------
INSERT INTO `tim_comments` VALUES (11, 1, 'Testing  Comments A', '2021-10-19 06:23:18', '2021-10-19 06:23:18');
INSERT INTO `tim_comments` VALUES (10, 2, 'Testing 2', '2021-10-19 06:21:54', '2021-10-19 06:21:54');
INSERT INTO `tim_comments` VALUES (9, 2, 'Testing 1', '2021-10-19 06:21:54', '2021-10-19 06:21:54');
INSERT INTO `tim_comments` VALUES (5, 2, 'Hi ItSolutionStuff.com Comment a', '2021-10-19 05:08:13', '2021-10-19 05:08:13');
INSERT INTO `tim_comments` VALUES (6, 2, 'Hi ItSolutionStuff.com Comment b', '2021-10-19 05:08:13', '2021-10-19 05:08:13');
INSERT INTO `tim_comments` VALUES (12, 1, 'Testing Comments A', '2021-10-19 06:23:18', '2021-10-19 06:23:18');

-- ----------------------------
-- Table structure for tim_failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `tim_failed_jobs`;
CREATE TABLE `tim_failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for tim_migrations
-- ----------------------------
DROP TABLE IF EXISTS `tim_migrations`;
CREATE TABLE `tim_migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_migrations
-- ----------------------------
INSERT INTO `tim_migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `tim_migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `tim_migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `tim_migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `tim_migrations` VALUES (5, '2021_10_10_155627_laratrust_setup_tables', 1);
INSERT INTO `tim_migrations` VALUES (6, '2021_10_19_032942_create_property_amenity_table', 2);
INSERT INTO `tim_migrations` VALUES (7, '2021_10_19_042140_create_posts_table', 3);
INSERT INTO `tim_migrations` VALUES (8, '2021_10_19_045317_create_posts_table', 4);
INSERT INTO `tim_migrations` VALUES (9, '2021_10_19_045718_create_comments_table', 4);
INSERT INTO `tim_migrations` VALUES (10, '2021_10_21_124459_create_products_table', 5);
INSERT INTO `tim_migrations` VALUES (11, '2021_10_21_160644_create_categories_table', 6);
INSERT INTO `tim_migrations` VALUES (12, '2021_10_22_131905_create_product_photos_table', 7);
INSERT INTO `tim_migrations` VALUES (13, '2021_10_25_054030_add_product_id_to_products', 8);
INSERT INTO `tim_migrations` VALUES (14, '2022_01_22_143318_create_tim_table_table', 9);

-- ----------------------------
-- Table structure for tim_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `tim_password_resets`;
CREATE TABLE `tim_password_resets`  (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_password_resets
-- ----------------------------
INSERT INTO `tim_password_resets` VALUES ('ngettim14@gmail.com', '$2y$10$3gG3/.tB976YKVncdQ5Xz.0OWIu8T7AHK5ZZsWOGD55w5kJMyU4Ou', '2021-10-11 04:45:47');

-- ----------------------------
-- Table structure for tim_permission_role
-- ----------------------------
DROP TABLE IF EXISTS `tim_permission_role`;
CREATE TABLE `tim_permission_role`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `permission_role_role_id_foreign`(`role_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of tim_permission_role
-- ----------------------------
INSERT INTO `tim_permission_role` VALUES (1, 1);
INSERT INTO `tim_permission_role` VALUES (1, 2);
INSERT INTO `tim_permission_role` VALUES (2, 1);
INSERT INTO `tim_permission_role` VALUES (2, 2);
INSERT INTO `tim_permission_role` VALUES (3, 1);
INSERT INTO `tim_permission_role` VALUES (3, 2);
INSERT INTO `tim_permission_role` VALUES (4, 1);
INSERT INTO `tim_permission_role` VALUES (4, 2);
INSERT INTO `tim_permission_role` VALUES (5, 1);
INSERT INTO `tim_permission_role` VALUES (5, 3);
INSERT INTO `tim_permission_role` VALUES (6, 1);
INSERT INTO `tim_permission_role` VALUES (6, 3);
INSERT INTO `tim_permission_role` VALUES (7, 1);
INSERT INTO `tim_permission_role` VALUES (7, 3);
INSERT INTO `tim_permission_role` VALUES (8, 1);
INSERT INTO `tim_permission_role` VALUES (9, 1);
INSERT INTO `tim_permission_role` VALUES (9, 2);
INSERT INTO `tim_permission_role` VALUES (9, 3);
INSERT INTO `tim_permission_role` VALUES (10, 1);
INSERT INTO `tim_permission_role` VALUES (10, 2);
INSERT INTO `tim_permission_role` VALUES (10, 3);
INSERT INTO `tim_permission_role` VALUES (11, 1);
INSERT INTO `tim_permission_role` VALUES (12, 1);
INSERT INTO `tim_permission_role` VALUES (13, 1);
INSERT INTO `tim_permission_role` VALUES (14, 1);
INSERT INTO `tim_permission_role` VALUES (15, 1);
INSERT INTO `tim_permission_role` VALUES (15, 5);
INSERT INTO `tim_permission_role` VALUES (15, 6);
INSERT INTO `tim_permission_role` VALUES (16, 1);
INSERT INTO `tim_permission_role` VALUES (16, 6);

-- ----------------------------
-- Table structure for tim_permission_user
-- ----------------------------
DROP TABLE IF EXISTS `tim_permission_user`;
CREATE TABLE `tim_permission_user`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`, `permission_id`, `user_type`) USING BTREE,
  INDEX `permission_user_permission_id_foreign`(`permission_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_permission_user
-- ----------------------------
INSERT INTO `tim_permission_user` VALUES (1, 1, 'App\\Models\\User');
INSERT INTO `tim_permission_user` VALUES (4, 1, 'App\\Models\\User');
INSERT INTO `tim_permission_user` VALUES (10, 1, 'App\\Models\\User');
INSERT INTO `tim_permission_user` VALUES (1, 3, 'App\\Models\\User');
INSERT INTO `tim_permission_user` VALUES (3, 3, 'App\\Models\\User');
INSERT INTO `tim_permission_user` VALUES (4, 3, 'App\\Models\\User');

-- ----------------------------
-- Table structure for tim_permissions
-- ----------------------------
DROP TABLE IF EXISTS `tim_permissions`;
CREATE TABLE `tim_permissions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_unique`(`name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_permissions
-- ----------------------------
INSERT INTO `tim_permissions` VALUES (1, 'users-create', 'Create Users', NULL, '2021-10-10 17:36:25', '2021-10-17 14:35:27');
INSERT INTO `tim_permissions` VALUES (2, 'user-view', 'View Users', NULL, '2021-10-10 17:36:25', '2021-10-17 14:45:16');
INSERT INTO `tim_permissions` VALUES (3, 'users-update', 'Update Users', 'Update Users', '2021-10-10 17:36:25', '2021-10-10 17:36:25');
INSERT INTO `tim_permissions` VALUES (4, 'users-delete', 'Delete Users', 'Delete Users', '2021-10-10 17:36:25', '2021-10-10 17:36:25');
INSERT INTO `tim_permissions` VALUES (5, 'payments-create', 'Create Payments', 'Create Payments', '2021-10-10 17:36:25', '2021-10-10 17:36:25');
INSERT INTO `tim_permissions` VALUES (6, 'payments-read', 'Read Payments', 'Read Payments', '2021-10-10 17:36:25', '2021-10-10 17:36:25');
INSERT INTO `tim_permissions` VALUES (7, 'payments-update', 'Update Payments', 'Update Payments', '2021-10-10 17:36:25', '2021-10-10 17:36:25');
INSERT INTO `tim_permissions` VALUES (8, 'payments-delete', 'Delete Payments', 'Delete Payments', '2021-10-10 17:36:25', '2021-10-10 17:36:25');
INSERT INTO `tim_permissions` VALUES (9, 'profile-read', 'Read Profile', 'Read Profile', '2021-10-10 17:36:25', '2021-10-10 17:36:25');
INSERT INTO `tim_permissions` VALUES (10, 'profile-update', 'Update Profile', 'Update Profile', '2021-10-10 17:36:25', '2021-10-10 17:36:25');
INSERT INTO `tim_permissions` VALUES (11, 'module_1_name-create', 'Create Module_1_name', 'Create Module_1_name', '2021-10-10 17:36:25', '2021-10-10 17:36:25');
INSERT INTO `tim_permissions` VALUES (12, 'module_1_name-read', 'Read Module_1_name', 'Read Module_1_name', '2021-10-10 17:36:25', '2021-10-10 17:36:25');
INSERT INTO `tim_permissions` VALUES (13, 'module_1_name-update', 'Update Module_1_name', 'Update Module_1_name', '2021-10-10 17:36:25', '2021-10-10 17:36:25');
INSERT INTO `tim_permissions` VALUES (14, 'module_1_name-delete', 'Delete Module_1_name', 'Delete Module_1_name', '2021-10-10 17:36:25', '2021-10-10 17:36:25');
INSERT INTO `tim_permissions` VALUES (15, 'Testing-Permissions', 'Testing Permissions - Display Name', 'Testing Permissions', '2021-10-18 04:34:07', '2021-10-18 04:34:07');
INSERT INTO `tim_permissions` VALUES (16, 'New Testing', 'New Testing', 'New Testing', '2021-10-18 04:36:38', '2021-10-21 08:50:59');

-- ----------------------------
-- Table structure for tim_personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `tim_personal_access_tokens`;
CREATE TABLE `tim_personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for tim_posts
-- ----------------------------
DROP TABLE IF EXISTS `tim_posts`;
CREATE TABLE `tim_posts`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_posts
-- ----------------------------
INSERT INTO `tim_posts` VALUES (1, 'Post 1', '2021-10-19 11:29:48', '2021-10-19 11:29:48');
INSERT INTO `tim_posts` VALUES (2, 'Post 2', '2021-10-19 11:29:48', '2021-10-19 11:29:48');

-- ----------------------------
-- Table structure for tim_product_photos
-- ----------------------------
DROP TABLE IF EXISTS `tim_product_photos`;
CREATE TABLE `tim_product_photos`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_photos_product_id_foreign`(`product_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_product_photos
-- ----------------------------
INSERT INTO `tim_product_photos` VALUES (29, 15, 'upload/images/product/gallery/163569081597.png');
INSERT INTO `tim_product_photos` VALUES (28, 14, 'upload/images/product/gallery/163532096611.png');
INSERT INTO `tim_product_photos` VALUES (27, 13, 'upload/images/product/gallery/163532008494.jpg');
INSERT INTO `tim_product_photos` VALUES (26, 12, 'upload/images/product/gallery/163531605099.jpg');
INSERT INTO `tim_product_photos` VALUES (30, 16, 'upload/images/product/gallery/163594944321.png');

-- ----------------------------
-- Table structure for tim_products
-- ----------------------------
DROP TABLE IF EXISTS `tim_products`;
CREATE TABLE `tim_products`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity_alert` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `product_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `products_code_unique`(`code`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_products
-- ----------------------------
INSERT INTO `tim_products` VALUES (14, 'Product A', 6, '14505540', '0', '0', '1200', 20, 1200, 'upload/images/product/163532096647.png', '', '2021-10-27 07:49:26', '2021-10-27 07:49:26', 1, 'PRO-0002');
INSERT INTO `tim_products` VALUES (12, 'Coca Cola 500ml', 8, '40879136', '0', '0', '0.61', 5, 100, 'upload/images/product/163531605023.jpg', '<p>Drinking</p>', '2021-10-27 06:27:30', '2021-10-27 06:27:30', 1, 'PRO-0000');
INSERT INTO `tim_products` VALUES (13, 'Noodle', 6, '93419904', '0', '0', '0.48', 10, 1250, 'upload/images/product/163532008489.png', '', '2021-10-27 07:34:44', '2021-10-27 07:34:44', 5, 'PRO-0001');
INSERT INTO `tim_products` VALUES (15, 'Lenovo Gaming', 10, '79251865', '2.1', '800', '910', 10, 95, 'upload/images/product/163569081578.png', '', '2021-10-31 14:33:35', '2021-10-31 14:33:35', 3, 'PRO-0003');
INSERT INTO `tim_products` VALUES (16, 'MSI', 10, '54876040', '2.2', '1200', '1350', 5, 50, 'upload/images/product/16359494435.jpg', '', '2021-11-03 14:24:03', '2021-11-03 14:24:03', 2, 'PRO-0004');
INSERT INTO `tim_products` VALUES (17, 'ABA', 12, '43420094', '0', '0', '1.5', 5, 100, 'upload/images/product/ ', '', '2022-01-23 07:11:14', '2022-01-23 07:11:14', 1, 'PRO-0005');
INSERT INTO `tim_products` VALUES (18, 'Anchor', 12, '94374248', '0', '0', '0.75', 5, 150, 'upload/images/product/ ', '', '2022-01-23 07:11:58', '2022-01-23 07:11:58', 1, 'PRO-0006');
INSERT INTO `tim_products` VALUES (19, 'COCACOLA', 12, '10154022', '0', '0', '0.61', 10, 250, 'upload/images/product/164292255355.png', '', '2022-01-23 07:21:33', '2022-01-23 07:22:33', 1, 'PRO-0008');
INSERT INTO `tim_products` VALUES (20, 'Noodle', 6, '08034757', '0', '0', '0.61', 10, 500, 'upload/images/product/ ', '', '2022-01-23 07:23:50', '2022-01-23 07:23:50', 1, 'PRO-0009');

-- ----------------------------
-- Table structure for tim_property
-- ----------------------------
DROP TABLE IF EXISTS `tim_property`;
CREATE TABLE `tim_property`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_sale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_rent` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `property_title_unique`(`title`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_property
-- ----------------------------
INSERT INTO `tim_property` VALUES (1, 'Testing 1', 'Descriptions 1', 'sole', 'sale', '200', '150', '2021-10-19 10:39:36', '2021-10-19 10:39:36');
INSERT INTO `tim_property` VALUES (2, 'Testing 2', 'description 2', 'pending', 'rent', '520', '450', '2021-10-19 10:39:36', '2021-10-19 10:39:36');

-- ----------------------------
-- Table structure for tim_property_amenity
-- ----------------------------
DROP TABLE IF EXISTS `tim_property_amenity`;
CREATE TABLE `tim_property_amenity`  (
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `amenity_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`property_id`, `amenity_id`) USING BTREE,
  INDEX `property_amenity_amenity_id_foreign`(`amenity_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of tim_property_amenity
-- ----------------------------
INSERT INTO `tim_property_amenity` VALUES (1, 2, '2021-10-19 10:45:06', '2021-10-19 10:45:06');
INSERT INTO `tim_property_amenity` VALUES (2, 3, '2021-10-19 10:45:06', '2021-10-19 10:45:06');
INSERT INTO `tim_property_amenity` VALUES (2, 2, '2021-10-19 10:45:06', '2021-10-19 10:45:06');

-- ----------------------------
-- Table structure for tim_role_user
-- ----------------------------
DROP TABLE IF EXISTS `tim_role_user`;
CREATE TABLE `tim_role_user`  (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`, `user_type`) USING BTREE,
  INDEX `role_user_role_id_foreign`(`role_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_role_user
-- ----------------------------
INSERT INTO `tim_role_user` VALUES (1, 1, 'App\\Models\\User');
INSERT INTO `tim_role_user` VALUES (3, 2, 'App\\Models\\User');
INSERT INTO `tim_role_user` VALUES (2, 3, 'App\\Models\\User');
INSERT INTO `tim_role_user` VALUES (1, 5, 'App\\Models\\User');
INSERT INTO `tim_role_user` VALUES (2, 6, 'App\\Models\\User');
INSERT INTO `tim_role_user` VALUES (1, 7, 'App\\Models\\User');
INSERT INTO `tim_role_user` VALUES (6, 9, 'App\\Models\\User');
INSERT INTO `tim_role_user` VALUES (3, 11, 'App\\Models\\User');
INSERT INTO `tim_role_user` VALUES (5, 12, 'App\\Models\\User');
INSERT INTO `tim_role_user` VALUES (6, 13, 'App\\Models\\User');

-- ----------------------------
-- Table structure for tim_roles
-- ----------------------------
DROP TABLE IF EXISTS `tim_roles`;
CREATE TABLE `tim_roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_unique`(`name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_roles
-- ----------------------------
INSERT INTO `tim_roles` VALUES (1, 'supper-admin', 'Supper Admin', 'Supper Admin', '2021-10-10 17:36:25', '2021-10-19 07:04:47');
INSERT INTO `tim_roles` VALUES (2, 'admin', 'Admin', 'Admin', '2021-10-10 17:36:25', '2021-10-12 17:39:36');
INSERT INTO `tim_roles` VALUES (3, 'user', 'User', 'User', '2021-10-10 17:36:25', '2021-10-10 17:36:25');
INSERT INTO `tim_roles` VALUES (5, 'user-sale', 'User Sale', 'User Sale Products', '2021-10-18 06:06:47', '2021-10-18 06:06:47');
INSERT INTO `tim_roles` VALUES (6, 'user-staff', 'User Staff', NULL, '2021-10-18 07:13:06', '2021-10-18 07:13:06');

-- ----------------------------
-- Table structure for tim_table
-- ----------------------------
DROP TABLE IF EXISTS `tim_table`;
CREATE TABLE `tim_table`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `is_active` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `tim_tim_table_code_unique`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tim_table
-- ----------------------------
INSERT INTO `tim_table` VALUES (1, '01', 'Table', NULL, NULL, 1);
INSERT INTO `tim_table` VALUES (2, '0002', 'Table2', NULL, NULL, NULL);
INSERT INTO `tim_table` VALUES (3, '003', 'Table 3', NULL, NULL, NULL);
INSERT INTO `tim_table` VALUES (4, '004', 'Table 4', NULL, NULL, 1);
INSERT INTO `tim_table` VALUES (5, '005', 'Table 5', NULL, NULL, NULL);
INSERT INTO `tim_table` VALUES (6, '006', 'Table 6', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for tim_users
-- ----------------------------
DROP TABLE IF EXISTS `tim_users`;
CREATE TABLE `tim_users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tim_users
-- ----------------------------
INSERT INTO `tim_users` VALUES (1, 'Nget Tim', 'ngettim14@gmail.com', NULL, '$2y$10$KE9emV4k95A5yA0QaRha/OyYMEcUyUVOwcEAtjk1WspE712sXuioy', '', 'upload/images/user/Nget Tim_1635929585_Nget Tim.jpg', '3IOqDv4Tkk82UtWNY2WumJH8E92b1HfmkjsvffU94KCcvQYtEiBDS3uZ7BDT', '2021-10-10 17:50:07', '2021-10-10 17:50:07');
INSERT INTO `tim_users` VALUES (3, 'Test Admin', 'admin@gmail.com', NULL, '$2y$10$8/DCJza4TMhyFdNerOhOZuYPuVLhAZMizR5U4GMW/o1DGfVr2syK.', '', '', '3TvtpqgoicKUhfqycLRmZlCZgxcT22IWrhJ7ItA7xx8rd45BD9sp5XnsSCh8', '2021-10-12 16:18:29', '2021-10-12 16:18:29');
INSERT INTO `tim_users` VALUES (5, 'Test Supper Admin', 'super@admin.com', NULL, '$2y$10$RsG0faMHuSfyspAn10gYz.xa/xQ6aEMuXEkI0zC5Rbkvy/s6p0tJ.', '', '', NULL, '2021-10-12 17:43:35', '2021-10-12 17:43:35');
INSERT INTO `tim_users` VALUES (6, 'Bro Tim', 'brotim@gmail.com', NULL, '$2y$10$c9z4dX66NMTVp2rJfnzB5e9h35/48L4EAIDQTPZ83wWyZW0lZNWm.', '(016) 897-954_', '', NULL, '2021-10-14 05:28:21', '2021-10-14 05:28:21');
INSERT INTO `tim_users` VALUES (7, 'Mr Jonh', 'jonh@gmail.com', NULL, '$2y$10$pnQJlft5pkvjd8hGH5lNH.8qOiQKWinT5rYZ9YNklEl1h5jAhdLnu', '(016) 897-965_', '', NULL, '2021-10-14 05:30:28', '2021-10-14 05:30:28');
INSERT INTO `tim_users` VALUES (11, 'I\'m Mr Ben', 'mr--ben@gmail.com', NULL, '$2y$10$Y3EzCuFinny6Tc.EJ40iQOlbg2A3vZ0wP70B.8GnPKxAQjRG8PqKS', '(016) 101-954_', '', NULL, '2021-10-31 07:05:25', '2021-10-31 07:28:47');
INSERT INTO `tim_users` VALUES (9, 'Mr Ben', 'ben@gmail.com', NULL, '$2y$10$wkdo.64SKX2NxTb115YVsubW/cQRefnY9I7.gQc.teJhidjpXXXau', '(016) 097-954_', '', NULL, '2021-10-19 07:28:44', '2021-10-19 07:28:44');

SET FOREIGN_KEY_CHECKS = 1;
