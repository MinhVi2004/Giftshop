-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 20, 2025 lúc 03:26 AM
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
-- Cơ sở dữ liệu: `giftshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `MaDH` varchar(255) NOT NULL,
  `MaSP` varchar(255) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaLucMua` bigint(30) NOT NULL,
  `ThanhTien` bigint(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`MaDH`, `MaSP`, `SoLuong`, `GiaLucMua`, `ThanhTien`) VALUES
('DH001', 'SP001', 4, 1231231123, 4924924492),
('DH001', 'SP002', 6, 999999999, 5999999994),
('DH002', 'SP001', 1, 1231231123, 1231231123),
('DH003', 'SP001', 4, 1231231123, 4924924492),
('DH004', 'SP002', 1, 999999999, 999999999),
('DH005', 'SP001', 1, 1231231123, 1231231123),
('DH006', 'SP001', 5, 1231231123, 6156155615),
('DH007', 'SP002', 7, 999999999, 6999999993),
('DH008', 'SP001', 1, 1231231123, 1231231123),
('DH009', 'SP001', 1, 1231231123, 1231231123),
('DH009', 'SP003', 1, 9999999999, 9999999999),
('DH010', 'SP001', 1, 1231231123, 1231231123),
('DH010', 'SP002', 4, 999999999, 3999999996),
('DH010', 'SP003', 1, 9999999999, 9999999999),
('DH011', 'SP001', 1, 1231231123, 1231231123),
('DH012', 'SP002', 1, 999999999, 999999999);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhgiasanpham`
--

CREATE TABLE `danhgiasanpham` (
  `MaDG` varchar(255) NOT NULL,
  `MaTK` varchar(255) NOT NULL,
  `MaSP` varchar(255) NOT NULL,
  `DanhGia` enum('1','2','3','4','5') NOT NULL,
  `TrangThaiDG` enum('Bình Thường','Vô Hiệu Hóa') NOT NULL DEFAULT 'Bình Thường'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachi`
--

CREATE TABLE `diachi` (
  `MaDC` varchar(255) NOT NULL,
  `MaTK` varchar(255) NOT NULL,
  `TinhThanhPho` varchar(255) NOT NULL,
  `QuanHuyen` varchar(255) NOT NULL,
  `PhuongXa` varchar(255) NOT NULL,
  `DiaChiNha` varchar(255) NOT NULL,
  `ChiTietDC` varchar(255) NOT NULL,
  `SoDienThoai` varchar(255) NOT NULL,
  `HoTen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `diachi`
--

INSERT INTO `diachi` (`MaDC`, `MaTK`, `TinhThanhPho`, `QuanHuyen`, `PhuongXa`, `DiaChiNha`, `ChiTietDC`, `SoDienThoai`, `HoTen`) VALUES
('DC001', 'TK001', 'Hồ Chí Minh', 'Hóc Môn', 'Tân Xuân', '63/2e, đường số 07', '63/2e, đường số 07, Tân Xuân, Hóc Môn,Hồ Chí Minh, Việt Nam', '0911253098', 'Minh Vi Admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `MaDH` varchar(255) NOT NULL,
  `MaKM` varchar(255) DEFAULT NULL,
  `MaTK` varchar(255) NOT NULL,
  `MaDC` varchar(255) NOT NULL,
  `TongGiaTri` bigint(30) NOT NULL,
  `TienGiamGia` bigint(30) NOT NULL,
  `TongThanhToan` bigint(30) NOT NULL,
  `NgayDatHang` datetime NOT NULL,
  `TrangThaiDH` enum('Chưa Xác Nhận','Đã Xác Nhận','Hoàn Thành','Hủy') NOT NULL DEFAULT 'Chưa Xác Nhận'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`MaDH`, `MaKM`, `MaTK`, `MaDC`, `TongGiaTri`, `TienGiamGia`, `TongThanhToan`, `NgayDatHang`, `TrangThaiDH`) VALUES
('DH001', 'KM001', 'TK001', 'DC001', 10924924486, 546246224, 10378678262, '2025-02-09 11:24:08', 'Hoàn Thành'),
('DH002', 'KM001', 'TK001', 'DC001', 1231231123, 61561556, 1169669567, '2025-02-09 14:52:19', 'Hủy'),
('DH003', 'KM001', 'TK001', 'DC001', 4924924492, 246246224, 4678678268, '2025-02-10 15:05:47', 'Chưa Xác Nhận'),
('DH004', NULL, 'TK001', 'DC001', 999999999, 0, 0, '2025-02-10 15:06:00', 'Hủy'),
('DH005', NULL, 'TK001', 'DC001', 1231231123, 0, 1231231123, '2025-02-10 15:09:46', 'Chưa Xác Nhận'),
('DH006', NULL, 'TK001', 'DC001', 6156155615, 0, 6156155615, '2025-02-10 15:15:42', 'Đã Xác Nhận'),
('DH007', 'KM001', 'TK001', 'DC001', 6999999993, 349999999, 6649999994, '2025-02-10 15:16:15', 'Đã Xác Nhận'),
('DH008', 'KM001', 'TK001', 'DC001', 1231231123, 61561556, 1169669567, '2025-02-11 01:21:21', 'Hoàn Thành'),
('DH009', 'KM001', 'TK001', 'DC001', 11231231122, 561561556, 10669669566, '2025-02-12 15:43:09', 'Hoàn Thành'),
('DH010', 'KM001', 'TK001', 'DC001', 15231231118, 761561555, 14469669563, '2025-02-13 00:26:21', 'Hoàn Thành'),
('DH011', 'KM001', 'TK001', 'DC001', 1231231123, 61561556, 1169669567, '2025-02-19 08:36:22', 'Hoàn Thành'),
('DH012', 'KM001', 'TK001', 'DC001', 999999999, 49999999, 950000000, '2025-02-19 09:56:38', 'Chưa Xác Nhận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `MaTK` varchar(255) NOT NULL,
  `MaSP` varchar(255) NOT NULL,
  `SoLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`MaTK`, `MaSP`, `SoLuong`) VALUES
('TK001', 'SP001', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `MaKM` varchar(255) NOT NULL,
  `TenKM` varchar(255) NOT NULL,
  `MoTaKM` varchar(255) NOT NULL,
  `PhanTramGiamGia` int(11) NOT NULL,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date NOT NULL,
  `TrangThaiKM` enum('Bình Thường','Vô Hiệu Hóa','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`MaKM`, `TenKM`, `MoTaKM`, `PhanTramGiamGia`, `NgayBatDau`, `NgayKetThuc`, `TrangThaiKM`) VALUES
('KM001', 'Giảm giá đầu năm 2025', 'Giảm đến hết năm các đơn hàng.', 5, '2025-02-10', '2025-12-31', 'Bình Thường');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `MaLoaiSP` varchar(255) NOT NULL,
  `TenLoaiSP` varchar(255) NOT NULL,
  `MoTaLoaiSP` varchar(255) NOT NULL,
  `TrangThaiLoaiSP` enum('Bình Thường','Vô Hiệu Hóa') NOT NULL DEFAULT 'Bình Thường'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisanpham`
--

INSERT INTO `loaisanpham` (`MaLoaiSP`, `TenLoaiSP`, `MoTaLoaiSP`, `TrangThaiLoaiSP`) VALUES
('LSP001', 'Quà Tặng', 'Quà Tặng', 'Bình Thường'),
('LSP002', 'Bánh Kẹo', 'Bánh Kẹo', 'Bình Thường'),
('LSP003', 'Bánh Sinh Nhật', 'Bánh Sinh Nhật', 'Bình Thường'),
('LSP004', 'Quần Áo', 'Quần Áo', 'Bình Thường');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisp_sp`
--

CREATE TABLE `loaisp_sp` (
  `MaLoaiSP` varchar(255) NOT NULL,
  `MaSP` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisp_sp`
--

INSERT INTO `loaisp_sp` (`MaLoaiSP`, `MaSP`) VALUES
('LSP001', 'SP001'),
('LSP001', 'SP003'),
('LSP002', 'SP002'),
('LSP003', 'SP001'),
('LSP004', 'SP002');

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

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` varchar(255) NOT NULL,
  `TenSP` varchar(255) NOT NULL,
  `AnhSP` varchar(255) NOT NULL,
  `MoTaSP` varchar(255) NOT NULL,
  `TrangThaiSP` enum('Bình Thường','Vô Hiệu Hóa') NOT NULL DEFAULT 'Bình Thường',
  `GiaSP` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `AnhSP`, `MoTaSP`, `TrangThaiSP`, `GiaSP`) VALUES
('SP001', 'Son Goku', 'https://res.cloudinary.com/dzom7z5wm/image/upload/v1739040854/GiftShopSanPham/sanpham_SP001.jpg', 'Son Goku siêu mạnh.', 'Bình Thường', 1231231123),
('SP002', 'KungFu Panda', 'https://res.cloudinary.com/dzom7z5wm/image/upload/v1739040892/GiftShopSanPham/sanpham_SP002.jpg', 'KungFu Panda siêu vui.', 'Bình Thường', 999999999),
('SP003', 'Quỳnh Như', 'https://res.cloudinary.com/dzom7z5wm/image/upload/v1739349750/GiftShopSanPham/sanpham_SP003.jpg', 'Khùn đin', 'Vô Hiệu Hóa', 9999999999);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaTK` varchar(255) NOT NULL,
  `TenDangNhap` varchar(255) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NgayTao` datetime NOT NULL,
  `TrangThai` enum('Bình Thường','Vô Hiệu Hóa') NOT NULL DEFAULT 'Bình Thường',
  `PhanQuyen` enum('Quản Lý','Khách Hàng') NOT NULL DEFAULT 'Khách Hàng',
  `MaFacebook` varchar(255) DEFAULT NULL,
  `MaGmail` varchar(255) DEFAULT NULL,
  `HoTen` varchar(255) NOT NULL,
  `OTP` varchar(255) DEFAULT NULL,
  `SoDienThoaiTK` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`MaTK`, `TenDangNhap`, `MatKhau`, `Email`, `NgayTao`, `TrangThai`, `PhanQuyen`, `MaFacebook`, `MaGmail`, `HoTen`, `OTP`, `SoDienThoaiTK`) VALUES
('TK001', 'minhvi1', '$2y$10$QZinkaBzPF.VmMdjQgkxGOvKHhI4n3lORnmaJEq1kWLmoOzdFzBTa', 'dvmv2017@gmail.com', '2025-01-18 02:30:40', 'Bình Thường', 'Quản Lý', NULL, NULL, 'Minh Vi Admin', NULL, '0911253098'),
('TK002', 'minhvi123', '$2y$10$pWqopcUb5C9jOwN/7Y6R8ujqR2aDSVjqLFcBpw9g2gGaI2cBxDGZ.', 'dvmv2021@gmail.com', '2025-02-19 10:14:46', 'Bình Thường', 'Khách Hàng', NULL, NULL, 'Dương Văn Minh Vi', '', '0772912452');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbao`
--

CREATE TABLE `thongbao` (
  `MaTB` varchar(255) NOT NULL,
  `MaTK` varchar(255) NOT NULL,
  `TieuDe` varchar(255) NOT NULL,
  `NoiDung` varchar(255) NOT NULL,
  `NgayThongBao` datetime NOT NULL,
  `TrangThaiTB` enum('Bình Thường','Vô Hiệu Hóa') NOT NULL,
  `DaDoc` enum('Đã Đọc','Chưa Đọc') NOT NULL DEFAULT 'Chưa Đọc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thongbao`
--

INSERT INTO `thongbao` (`MaTB`, `MaTK`, `TieuDe`, `NoiDung`, `NgayThongBao`, `TrangThaiTB`, `DaDoc`) VALUES
('TB001', '', 'Khuyến Mãi', 'Giảm 5 phần trăm cho mỗi đơn hàng mua từ trang chính của GiftShop.', '2025-02-09 02:01:43', 'Bình Thường', 'Đã Đọc'),
('TB002', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Cửa hàng đã nhận được đơn đặt hàng của bạn, và sẽ chuẩn bị đơn hàng trong thời gian sớm nhất !', '2025-02-09 11:24:08', 'Bình Thường', 'Đã Đọc'),
('TB003', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn đã được chuẩn bị và đã giao cho đơn vị vận chuyển !', '2025-02-09 12:06:26', 'Bình Thường', 'Đã Đọc'),
('TB004', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn đã được chuẩn bị và đã giao cho đơn vị vận chuyển !', '2025-02-09 12:06:46', 'Bình Thường', 'Đã Đọc'),
('TB005', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn được giao đến bạn thành công !', '2025-02-09 14:51:58', 'Bình Thường', 'Đã Đọc'),
('TB006', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Cửa hàng đã nhận được đơn đặt hàng của bạn, và sẽ chuẩn bị đơn hàng trong thời gian sớm nhất !', '2025-02-09 14:52:19', 'Bình Thường', 'Đã Đọc'),
('TB007', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn đã bị hủy!', '2025-02-09 15:11:42', 'Bình Thường', 'Đã Đọc'),
('TB008', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Cửa hàng đã nhận được đơn đặt hàng của bạn, và sẽ chuẩn bị đơn hàng trong thời gian sớm nhất !', '2025-02-10 15:05:47', 'Bình Thường', 'Đã Đọc'),
('TB009', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Cửa hàng đã nhận được đơn đặt hàng của bạn, và sẽ chuẩn bị đơn hàng trong thời gian sớm nhất !', '2025-02-10 15:06:00', 'Bình Thường', 'Đã Đọc'),
('TB010', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Cửa hàng đã nhận được đơn đặt hàng của bạn, và sẽ chuẩn bị đơn hàng trong thời gian sớm nhất !', '2025-02-10 15:09:46', 'Bình Thường', 'Đã Đọc'),
('TB011', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn đã bị hủy!', '2025-02-10 15:10:16', 'Bình Thường', 'Đã Đọc'),
('TB012', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Cửa hàng đã nhận được đơn đặt hàng của bạn, và sẽ chuẩn bị đơn hàng trong thời gian sớm nhất !', '2025-02-10 15:15:42', 'Bình Thường', 'Đã Đọc'),
('TB013', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Cửa hàng đã nhận được đơn đặt hàng của bạn, và sẽ chuẩn bị đơn hàng trong thời gian sớm nhất !', '2025-02-10 15:16:15', 'Bình Thường', 'Đã Đọc'),
('TB014', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn đã được chuẩn bị và đã giao cho đơn vị vận chuyển !', '2025-02-10 15:17:02', 'Bình Thường', 'Đã Đọc'),
('TB015', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn đã được chuẩn bị và đã giao cho đơn vị vận chuyển !', '2025-02-10 15:17:06', 'Bình Thường', 'Đã Đọc'),
('TB016', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Cửa hàng đã nhận được đơn đặt hàng của bạn, và sẽ chuẩn bị đơn hàng trong thời gian sớm nhất !', '2025-02-11 01:21:21', 'Bình Thường', 'Đã Đọc'),
('TB017', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Cửa hàng đã nhận được đơn đặt hàng của bạn, và sẽ chuẩn bị đơn hàng trong thời gian sớm nhất !', '2025-02-12 15:43:09', 'Bình Thường', 'Đã Đọc'),
('TB018', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Cửa hàng đã nhận được đơn đặt hàng của bạn, và sẽ chuẩn bị đơn hàng trong thời gian sớm nhất !', '2025-02-13 00:26:22', 'Bình Thường', 'Đã Đọc'),
('TB019', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Cửa hàng đã nhận được đơn đặt hàng của bạn, và sẽ chuẩn bị đơn hàng trong thời gian sớm nhất !', '2025-02-19 08:36:22', 'Bình Thường', 'Đã Đọc'),
('TB020', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn đã được chuẩn bị và đã giao cho đơn vị vận chuyển !', '2025-02-19 08:40:26', 'Bình Thường', 'Đã Đọc'),
('TB021', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn được giao đến bạn thành công !', '2025-02-19 08:45:08', 'Bình Thường', 'Đã Đọc'),
('TB022', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn đã được chuẩn bị và đã giao cho đơn vị vận chuyển !', '2025-02-19 08:45:52', 'Bình Thường', 'Đã Đọc'),
('TB023', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn được giao đến bạn thành công !', '2025-02-19 08:57:55', 'Bình Thường', 'Đã Đọc'),
('TB024', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn đã được chuẩn bị và đã giao cho đơn vị vận chuyển !', '2025-02-19 09:03:33', 'Bình Thường', 'Đã Đọc'),
('TB025', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn được giao đến bạn thành công !', '2025-02-19 09:04:38', 'Bình Thường', 'Đã Đọc'),
('TB026', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn đã được chuẩn bị và đã giao cho đơn vị vận chuyển !', '2025-02-19 09:07:10', 'Bình Thường', 'Đã Đọc'),
('TB027', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Đơn hàng của bạn được giao đến bạn thành công !', '2025-02-19 09:14:08', 'Bình Thường', 'Đã Đọc'),
('TB028', 'TK001', 'Cập nhật trạng thái đơn hàng', 'Cửa hàng đã nhận được đơn đặt hàng của bạn, và sẽ chuẩn bị đơn hàng trong thời gian sớm nhất !', '2025-02-19 09:56:38', 'Bình Thường', 'Đã Đọc');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`MaDH`,`MaSP`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `danhgiasanpham`
--
ALTER TABLE `danhgiasanpham`
  ADD PRIMARY KEY (`MaDG`),
  ADD UNIQUE KEY `MaTK` (`MaTK`),
  ADD UNIQUE KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `diachi`
--
ALTER TABLE `diachi`
  ADD PRIMARY KEY (`MaDC`),
  ADD KEY `MaTK` (`MaTK`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDH`),
  ADD KEY `MaKM` (`MaKM`,`MaTK`),
  ADD KEY `MaTK` (`MaTK`),
  ADD KEY `MaDC` (`MaDC`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD KEY `MaTK` (`MaTK`,`MaSP`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`MaKM`);

--
-- Chỉ mục cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`MaLoaiSP`);

--
-- Chỉ mục cho bảng `loaisp_sp`
--
ALTER TABLE `loaisp_sp`
  ADD KEY `MaSP` (`MaSP`),
  ADD KEY `MaLoaiSP` (`MaLoaiSP`,`MaSP`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MaTK`),
  ADD KEY `Email` (`Email`),
  ADD KEY `TenDangNhap` (`TenDangNhap`);

--
-- Chỉ mục cho bảng `thongbao`
--
ALTER TABLE `thongbao`
  ADD PRIMARY KEY (`MaTB`),
  ADD KEY `MaTK` (`MaTK`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`MaDH`) REFERENCES `donhang` (`MaDH`) ON DELETE CASCADE,
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`);

--
-- Các ràng buộc cho bảng `danhgiasanpham`
--
ALTER TABLE `danhgiasanpham`
  ADD CONSTRAINT `danhgiasanpham_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `danhgiasanpham_ibfk_3` FOREIGN KEY (`MaTK`) REFERENCES `taikhoan` (`MaTK`);

--
-- Các ràng buộc cho bảng `diachi`
--
ALTER TABLE `diachi`
  ADD CONSTRAINT `diachi_ibfk_1` FOREIGN KEY (`MaTK`) REFERENCES `taikhoan` (`MaTK`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_2` FOREIGN KEY (`MaTK`) REFERENCES `taikhoan` (`MaTK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donhang_ibfk_3` FOREIGN KEY (`MaDC`) REFERENCES `diachi` (`MaDC`),
  ADD CONSTRAINT `donhang_ibfk_4` FOREIGN KEY (`MaKM`) REFERENCES `khuyenmai` (`MaKM`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `giohang_ibfk_2` FOREIGN KEY (`MaTK`) REFERENCES `taikhoan` (`MaTK`);
--
-- Các ràng buộc cho bảng `loaisp_sp`
--
ALTER TABLE `loaisp_sp`
  ADD CONSTRAINT `loaisp_sp_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `loaisp_sp_ibfk_2` FOREIGN KEY (`MaLoaiSP`) REFERENCES `loaisanpham` (`MaLoaiSP`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$

--
-- Sự kiện cập nhật trạng thái khuyến mãi hàng ngày
--
CREATE EVENT `daily_update_status` 
ON SCHEDULE EVERY 1 DAY STARTS TIMESTAMP(CURRENT_DATE, '00:00:00') 
ON COMPLETION NOT PRESERVE ENABLE 
DO 
UPDATE khuyenmai
SET TrangThaiKM = 'Vô Hiệu Hóa'
WHERE status = 'Bình Thường' AND scheduled_time <= NOW()$$

--
-- Sự kiện cập nhật trạng thái thông báo hàng ngày
--
CREATE EVENT `daily_update_status_thongbao`
ON SCHEDULE EVERY 1 DAY STARTS TIMESTAMP(CURRENT_DATE, '00:00:00') 
ON COMPLETION NOT PRESERVE ENABLE 
DO 
UPDATE thongbao
SET TrangThaiTB = 'Vô Hiệu Hóa'
WHERE TrangThaiTB = 'Bình Thường' AND NgayThongBao <= NOW()$$

DELIMITER ;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
