-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 20, 2020 lúc 07:05 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `api_thesieutoc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `captcha`
--

CREATE TABLE `captcha` (
  `id` int(11) NOT NULL,
  `key_captcha` text NOT NULL,
  `value` text NOT NULL,
  `status_image` int(11) NOT NULL DEFAULT 0,
  `lifetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trans_log`
--

CREATE TABLE `trans_log` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `amount` bigint(20) NOT NULL,
  `seri` text NOT NULL,
  `pin` text NOT NULL,
  `type` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `trans_id` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `trans_log`
--

INSERT INTO `trans_log` (`id`, `name`, `amount`, `seri`, `pin`, `type`, `status`, `trans_id`, `date`) VALUES
(1, 'test', 50000, '8654235125432', '436346252225', 'Viettel', 1, '3316', '2019-05-17 10:11:03');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `trans_log`
--
ALTER TABLE `trans_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `captcha`
--
ALTER TABLE `captcha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `trans_log`
--
ALTER TABLE `trans_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
