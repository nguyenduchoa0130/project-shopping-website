-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th1 02, 2021 lúc 05:44 AM
-- Phiên bản máy phục vụ: 5.7.31
-- Phiên bản PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `happyshopping`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_account`
--
DROP TABLE IF EXISTS `tbl_account_otp`;
CREATE TABLE IF NOT EXISTS `tbl_account_otp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `tbl_account`;
CREATE TABLE IF NOT EXISTS `tbl_account` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `tbl_image_product`;
CREATE TABLE IF NOT EXISTS `tbl_image_product` (
  `id_img` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` longblob,
  `id_product` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_img`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--


DROP TABLE IF EXISTS tbl_category;
CREATE TABLE IF NOT EXISTS tbl_category (
  id_category int(11) NOT NULL AUTO_INCREMENT,
  name_category varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  icon_category varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'fas fa-folder',
  PRIMARY KEY (id_category)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

DROP TABLE IF EXISTS tbl_product;
CREATE TABLE IF NOT EXISTS tbl_product (
  id_product int(11) NOT NULL AUTO_INCREMENT,
  name_product varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  price decimal(10,0) NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL DEFAULT '1',
  number_liked int(11) NOT NULL DEFAULT '0',
  quantity int(11) NOT NULL DEFAULT '0',
  produced_at varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  description text COLLATE utf8_unicode_ci,
  id_category int(11) DEFAULT NULL,
  PRIMARY KEY (id_product),
  KEY FK_PRODUCT_CATEGORY (id_category)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--



-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product_img`
--


DROP TABLE IF EXISTS tbl_image_product;
CREATE TABLE IF NOT EXISTS tbl_image_product (
  id_img int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  image longblob,
  number_order int(11) DEFAULT NULL,
  id_product int(11) DEFAULT NULL,
  PRIMARY KEY (id_img)
) ENGINE=MyISAM AUTO_INCREMENT=126 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product_img`
--


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



