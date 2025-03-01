-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 07, 2025 lúc 08:30 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_galaxycinema`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `expires`) VALUES
(26, '', '2b75b8b155e61af8b0874e0d41e8386b5c2c02f2e6be55a0624a2b97282671db4ff67860973a535fe320e96e026c1764d15e', 2024),
(27, 'dvmv2017@gmail.com', '1b07894746ab8feda5e6191178b8c59a689cf4440c16a8e90975e0e710536e653abee96f1917cf14a1f535ac80eeb0486326', 2024),
(28, 'dvmv2017@gmail.com', 'e4a0f8d08a0962e3efe316f9071b5a7224c0ccdcdd40ce99cd9a32ae5e4386310d69d3aff6e9928b4f07fe5efd4ee198f27a', 2024),
(29, 'dvmv2017@gmail.com', '50f8de27d46069bbe830a3d810182532b50b2b078e6746418afbb3b608efa2e053fc0a24e3477f44a1af53d23d149ef68044', 2024),
(30, 'dvmv2017@gmail.com', '177eb4d4238acf8d9f5d2a05493c622a77a9d80a2b461d3411a016e16615d9806dfdd29dc78762118af3ae03ca2a270c0311', 2024),
(31, 'dvmv2017@gmail.com', 'dda0891d022b6d97c31b247a92e25e6ab00f62c96f7ec5fbf15db4b5650abb915786f01bc4efc3fa7dae5b56c8cce3e7809f', 2024),
(32, 'dvmv2021@gmail.com', '7ec52bad93abf88981c70a96ee76b002d9a217ffe7413b5e8511fda5eb6aaae1c908294de8d762c15a9ebb8c037ac6783487', 2024),
(33, 'dvmv2021@gmail.com', 'edbe6a09b824bdfcec290c57d390e29733360cf815b71e32c2f66425d8b47eae2274193348b38fe6c3051b65460950ac54db', 2024),
(34, 'dvmv2017@gmail.com', '15b74ca82ab9fd1391f015606ffd63a777c877a64e2e482c8e5a8a4b2a203ef7cd309e9e27a0b2d7d7e7aa92d96af622bbfe', 2024),
(35, 'lypobfkfi@emlhub.com', '924b95603bed0d90cccb8b586dc0f9bfb5e595a4fd07881d4e98f71655f90aa579420c50d2f34f06270bee6b8ad8b3de9e6d', 2024),
(36, 'lypobfkfi@emlhub.com', '415b286990498d3f7441886ec38cf3fd269990d09845e040ccb2007d911e04450456514da3f79ccfbdc1662255fc198871d2', 2024);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
