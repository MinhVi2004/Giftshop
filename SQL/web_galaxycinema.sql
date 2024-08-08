-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 26, 2024 lúc 02:36 PM
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
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `MaBinhLuan` int(11) NOT NULL,
  `MaPhim` int(11) NOT NULL,
  `MaTaiKhoan` int(11) UNSIGNED NOT NULL,
  `NoiDung` varchar(255) NOT NULL,
  `NgayBinhLuan` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichchieu`
--

CREATE TABLE `lichchieu` (
  `MaLichChieu` int(11) NOT NULL,
  `MaPhongChieu` int(11) NOT NULL,
  `MaPhim` int(11) NOT NULL,
  `XuatChieu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lichchieu`
--

INSERT INTO `lichchieu` (`MaLichChieu`, `MaPhongChieu`, `MaPhim`, `XuatChieu`) VALUES
(1, 1, 1, '2024-05-22 09:00:00'),
(2, 2, 2, '2024-05-22 11:00:00'),
(3, 3, 1, '2024-05-22 13:00:40'),
(4, 4, 4, '2024-05-21 15:00:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaiphim`
--

CREATE TABLE `loaiphim` (
  `MaLoaiPhim` int(11) NOT NULL,
  `TenLoaiPhim` varchar(255) DEFAULT NULL,
  `MoTa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaiphim`
--

INSERT INTO `loaiphim` (`MaLoaiPhim`, `TenLoaiPhim`, `MoTa`) VALUES
(1, 'Hành động', 'Thể loại điện ảnh trong đó một hoặc nhiều nhân vật anh hùng bị đẩy vào một loạt những thử thách, thường bao gồm những kì công vật lý, các cảnh hành động kéo dài, yếu tố bạo lực và những cuộc rượt đuổi điên cuồng.'),
(2, 'Tình cảm', 'Thể loại phim về những câu chuyện tình lãng mạn được ghi lại trên các phương tiện thị giác để phát sóng trên sân khấu và trên TV với nội dung tập trung vào đam mê, cảm xúc, và sự liên hệ tình cảm lãng mạn của các nhân vật chính và cuộc hành trình mà tình yêu mạnh mẽ, chân thực và thuần khiết của họ đã đưa họ đến việc hẹn hò, tán tỉnh và cuối cùng là hôn nhân'),
(3, 'Phiêu lưu', 'Phim phiêu lưu thường chủ yếu lấy bối cảnh trong một thời kỳ lịch sử nhất định và thường bao gồm những câu chuyện lịch sử chuyển thể hoặc những anh hùng phiêu lưu giả tưởng trong phạm vi lịch sử.'),
(4, 'Tâm lý', 'Phim tâm lý là loại phim có cốt truyện gây xúc động mạnh với mục đích lay động cảm xúc mãnh liệt cũng như tạo tiền đề cho sự xây dựng đặc tính nhân vật được cặn kẽ, chi tiết.'),
(5, 'Hoạt hình', 'Phim hoạt hình hay phim hoạt họa là một hình thức sử dụng ảo ảnh quang học về sự chuyển động do nhiều hình ảnh tĩnh được chiếu tiếp diễn liên tục.'),
(6, 'Hài', 'Phim hài là thể loại phim nhấn mạnh vào tính hài hước, là một trong những dòng phim lâu đời nhất và cũng chính là một trong số những bộ phim câm đầu tiên trên thế giới. Những bộ phim hài thường là những câu chuyện có mục đích để giải trí.'),
(7, 'Kinh dị', 'Phim kinh dị là một thể loại điện ảnh đưa đến cho khán giả xem phim những cảm xúc tiêu cực, gợi cho người xem nỗi sợ hãi nguyên thủy nhất thông qua cốt truyện, nội dung phim, những hình ảnh rùng rợn, bí hiểm, ánh sáng mờ ảo, những âm thanh rùng rợn, nhiều cảnh máu me, chết chóc.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaive`
--

CREATE TABLE `loaive` (
  `MaLoaiVe` int(11) NOT NULL,
  `TenLoaiVe` varchar(255) NOT NULL,
  `DonGia` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaive`
--

INSERT INTO `loaive` (`MaLoaiVe`, `TenLoaiVe`, `DonGia`) VALUES
(1, 'Vé thường', 80000),
(2, 'Vé hội viên', 70000),
(3, 'Vé VIP', 120000);

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
(12, 'dvmv2017@gmail.com', 'a4e4f5592853b71ffc6888b73694c3b334f7be9185decfd4c0b31b44063e33e7f3e23dadd6e4310bbcbef107a5daa1dc0e23', 1716455819),
(15, 'dvmv2017@gmail.com', '6a95092dd84fbfe2615ed28f34fa810697cb7af713f2a0e648cc76678633993d5aac9a80f03a8bd7c1e5735c08ec7134f1aa', 1716456943),
(16, 'dvmv2017@gmail.com', '5cb46f9d1911f713d8f3c4115e077286a699a58a375d12f4d6ae0450724a08e2b032db04425894c468bcb153dfff2ec08587', 1716457667),
(20, 'dvmv2017@gmail.com', '24a81d7add27566dfd8f60b0e28e285e34a07612a3b315ba8dbb90e9f064ac460992582e93b8c0c9c5ca5ccd3315292efd88', 1716482396),
(21, 'dvmv2017@gmail.com', '38a460bba7c0c0648c8e15f44d5a6601037126dd79bbff19bea634c161bbddf405982a124ce3af2cb9382f47d9c3b3eda89e', 1716482397),
(22, 'dvmv2017@gmail.com', '739329a7a7de82eabe5d76d3d5fe50efa9db423338fd9da0d545a8300167beac20680f680de8bb8c69ca81bcbca283d593c5', 1716482397);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanquyen`
--

CREATE TABLE `phanquyen` (
  `VaiTro` varchar(255) NOT NULL,
  `Người dùng` tinyint(1) DEFAULT 0,
  `Phim` tinyint(1) DEFAULT 0,
  `Lịch Chiếu` tinyint(1) DEFAULT 0,
  `Phòng Chiếu` tinyint(1) DEFAULT 0,
  `Doanh Thu` tinyint(1) DEFAULT 0,
  `Bình Luận` tinyint(1) DEFAULT 0,
  `Vé` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phanquyen`
--

INSERT INTO `phanquyen` (`VaiTro`, `Người dùng`, `Phim`, `Lịch Chiếu`, `Phòng Chiếu`, `Doanh Thu`, `Bình Luận`, `Vé`) VALUES
('khách hàng', 0, 0, 0, 0, 0, 0, 0),
('nhân viên bán hàng', 0, 0, 0, 0, 0, 0, 1),
('quản lý', 1, 1, 1, 1, 1, 1, 1),
('Quản trị viên', 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phim`
--

CREATE TABLE `phim` (
  `MaPhim` int(11) NOT NULL,
  `TenPhim` varchar(255) NOT NULL,
  `AnhPhimNho` varchar(255) NOT NULL,
  `AnhPhimLon` varchar(255) NOT NULL,
  `Trailer` varchar(255) NOT NULL,
  `ThongTin` longtext DEFAULT NULL,
  `TuoiYeuCau` int(11) NOT NULL,
  `ThoiLuongPhim` int(11) NOT NULL,
  `NgayKhoiChieu` date DEFAULT NULL,
  `XuatXu` varchar(255) NOT NULL,
  `NhaSanXuat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phim`
--

INSERT INTO `phim` (`MaPhim`, `TenPhim`, `AnhPhimNho`, `AnhPhimLon`, `Trailer`, `ThongTin`, `TuoiYeuCau`, `ThoiLuongPhim`, `NgayKhoiChieu`, `XuatXu`, `NhaSanXuat`) VALUES
(1, 'Haikyu!!: Trận Chiến Bãi Phế Liệu', 'IMG/haikyuu-the-dumpster-battle-nho.jpg', 'IMG/haikyuu-the-dumpster-battle-lon.jpg', 'https://www.youtube.com/embed/DKwuwNQaP5w', 'Một trong những series manga và anime thể thao về bóng chuyền nổi tiếng nhất mọi thời đại. Cuộc đối đầu bóng chuyền giữa hai đối thủ đầy \"duyên nợ\" Cao trung Karasuno và THPT Nekoma hứa hẹn sẽ vô cùng kịch tính và không kém phần thú vị. Bạn sẽ theo team Quạ hay team Mèo?', 13, 85, '2024-05-15', 'Nhật Bản', 'TOHO Animation'),
(2, 'Hành Tinh Khỉ: Vương Quốc Mới', 'IMG/hanh-tinh-khi-nho.jpg', 'IMG/hanh-tinh-khi-lon.jpg', 'https://www.youtube.com/embed/8rmCpaOQiLQ', 'Kingdom Of The Planet Of The Apes lấy bối cảnh nhiều đời sau Caesar đại đế, hành tinh này là nơi loài khỉ thống trị, còn loài người dần lui về trong bóng tối. Khi một thủ lĩnh khỉ bạo chúa bắt đầu xây dựng đế chế của riêng mình, buộc thủ lĩnh một tộc khỉ khác phải bước vào hành trình tăm tối để tìm kiếm tự do, quyết định tương lai của loài người và khỉ.', 16, 144, '2024-05-14', 'Mỹ', '20th Century Fox'),
(4, 'Lật mặt 7', 'IMG/lm7-nho.jpg', 'IMG/lm7-lon.jpg', 'https://www.youtube.com/embed/nzLavaLXU_U', 'Qua những lát cắt đan xen, ẩn chứa nhiều nụ cười và cả nước mắt, \"Lật Mặt 7: Một Điều Ước\" là câu chuyện cảm động về đại gia đình bà Hai 73 tuổi - người mẹ đơn thân tự mình nuôi 5 người con khôn lớn. Khi trưởng thành, mỗi người đều có cuộc sống và gia đìn', 16, 120, '2024-05-01', 'Việt Nam', 'LyHaiOffical');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phim_loaiphim`
--

CREATE TABLE `phim_loaiphim` (
  `MaPhim` int(11) NOT NULL,
  `MaLoaiPhim` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phim_loaiphim`
--

INSERT INTO `phim_loaiphim` (`MaPhim`, `MaLoaiPhim`) VALUES
(1, 4),
(1, 5),
(2, 1),
(2, 3),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongchieu`
--

CREATE TABLE `phongchieu` (
  `MaPhongChieu` int(11) NOT NULL,
  `TenPhongChieu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phongchieu`
--

INSERT INTO `phongchieu` (`MaPhongChieu`, `TenPhongChieu`) VALUES
(1, 'Phòng 01'),
(2, 'Phòng 02'),
(3, 'Phòng 03'),
(4, 'Phòng 04'),
(5, 'Phòng 05'),
(6, 'Phòng 06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `MaTaiKhoan` int(11) UNSIGNED NOT NULL,
  `TenDangNhap` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `MatKhau` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `TrangThai` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 là bth, -1 là khóa',
  `NgayTao` datetime NOT NULL DEFAULT current_timestamp(),
  `VaiTro` varchar(255) DEFAULT 'khách hàng',
  `HoTen` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `SoDienThoai` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`MaTaiKhoan`, `TenDangNhap`, `MatKhau`, `TrangThai`, `NgayTao`, `VaiTro`, `HoTen`, `NgaySinh`, `SoDienThoai`, `Email`) VALUES
(10, 'minhvi1', '$2y$10$VXcU6W6f/Fa3aiaUDZg2jO7FpYfU5Yj6UeeYfiy.DkCOzJ1qYfPyu', 1, '2024-05-20 20:58:56', 'Khách Hàng', 'Khách hàng Minh Vi', '2004-11-22', '0123456789', 'dvmv2021@gmail.com'),
(11, 'minhvi2', '$2y$10$QYWOJf2Su2OUMLzbo9j6IuyQMJAUIcfV5BrkvALX7mrEkNFY5h1Zm', 1, '2024-05-21 15:06:35', 'nhân viên bán hàng', 'Nhân viên bán hàng\r\n', '2004-11-22', '0772912452', 'minhvi2@gmail.com'),
(12, 'minhvi3', '$2y$10$8JhJjMwZR8zgKIKNl0zzP.Iv3/JtJDivkAgrP7silS0zh2Uf5Olh2', 1, '2024-05-21 15:07:36', 'quản lý', 'Quản lý\r\n', '2004-11-22', '0772912452', 'minhvi3@gmail.com'),
(13, 'minhvi', '$2y$10$kSfmmC9ptHtG0WkIOZ8PhOzf7j9APTn/cz1Du0lv9QggaMfbCP0t2', 1, '2024-05-21 15:08:16', 'Quản trị viên', 'Admin Minh Vi', '2004-11-22', '0772912452', 'dvmv2017@gmail.com'),
(14, 'quynhnhu', '$2y$10$p3ym47nsyiTrW4eKor59a.o4lRPRD6qgu7i8nfKbB8/VG9e13xerS', 1, '2024-05-22 23:52:20', 'Khách Hàng', 'Dương Quỳnh Như', '2004-09-28', '0123455789', 'quynhnhu@gmail.com'),
(15, 'minhvi4', '$2y$10$75gZ/bppojMQbcz7wfzhF.U9hBWtREW1zIQVvCyjjG/.RJV3cpo.G', 1, '2024-05-23 01:48:03', 'Khách Hàng', 'KH MVi 4', '2004-11-22', '0123333333', 'khmvi4@gmail.com'),
(16, 'minhvi5', '$2y$10$3QBb1zXMtVfQqprex0..nOS6S2nN1PlcJjRu6nGcwV.DKhgKbwNk2', 1, '2024-05-23 01:51:11', 'Khách Hàng', 'KH mvi 5', '2004-11-22', '088888888', 'khmvi5@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ve`
--

CREATE TABLE `ve` (
  `MaVe` int(11) NOT NULL,
  `MaLoaiVe` int(11) NOT NULL,
  `MaNhanVien` int(11) UNSIGNED NOT NULL,
  `MaKhachHang` int(11) UNSIGNED NOT NULL,
  `Ghe` int(11) NOT NULL,
  `NgayBanVe` datetime NOT NULL,
  `MaLichChieu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ve`
--

INSERT INTO `ve` (`MaVe`, `MaLoaiVe`, `MaNhanVien`, `MaKhachHang`, `Ghe`, `NgayBanVe`, `MaLichChieu`) VALUES
(1, 1, 11, 10, 10, '2024-05-21 16:09:31', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`MaBinhLuan`),
  ADD KEY `MaPhim` (`MaPhim`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Chỉ mục cho bảng `lichchieu`
--
ALTER TABLE `lichchieu`
  ADD PRIMARY KEY (`MaLichChieu`),
  ADD KEY `MaPhongChieu` (`MaPhongChieu`,`MaPhim`),
  ADD KEY `FK_chitietchieuphim_Phim` (`MaPhim`);

--
-- Chỉ mục cho bảng `loaiphim`
--
ALTER TABLE `loaiphim`
  ADD PRIMARY KEY (`MaLoaiPhim`);

--
-- Chỉ mục cho bảng `loaive`
--
ALTER TABLE `loaive`
  ADD PRIMARY KEY (`MaLoaiVe`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phanquyen`
--
ALTER TABLE `phanquyen`
  ADD PRIMARY KEY (`VaiTro`);

--
-- Chỉ mục cho bảng `phim`
--
ALTER TABLE `phim`
  ADD PRIMARY KEY (`MaPhim`);

--
-- Chỉ mục cho bảng `phim_loaiphim`
--
ALTER TABLE `phim_loaiphim`
  ADD PRIMARY KEY (`MaPhim`,`MaLoaiPhim`),
  ADD KEY `MaLoaiPhim` (`MaLoaiPhim`);

--
-- Chỉ mục cho bảng `phongchieu`
--
ALTER TABLE `phongchieu`
  ADD PRIMARY KEY (`MaPhongChieu`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`MaTaiKhoan`),
  ADD UNIQUE KEY `TenDangNhap` (`TenDangNhap`),
  ADD KEY `Email` (`Email`),
  ADD KEY `FK_taikhoan_VaiTro` (`VaiTro`);

--
-- Chỉ mục cho bảng `ve`
--
ALTER TABLE `ve`
  ADD PRIMARY KEY (`MaVe`),
  ADD UNIQUE KEY `MaKhachHang` (`MaKhachHang`),
  ADD KEY `MaLoaiVe` (`MaLoaiVe`),
  ADD KEY `MaNhanVien` (`MaNhanVien`),
  ADD KEY `MaLichChieu` (`MaLichChieu`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `MaBinhLuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lichchieu`
--
ALTER TABLE `lichchieu`
  MODIFY `MaLichChieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `loaive`
--
ALTER TABLE `loaive`
  MODIFY `MaLoaiVe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `phim`
--
ALTER TABLE `phim`
  MODIFY `MaPhim` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `phongchieu`
--
ALTER TABLE `phongchieu`
  MODIFY `MaPhongChieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `MaTaiKhoan` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `ve`
--
ALTER TABLE `ve`
  MODIFY `MaVe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `FK_BinhLuan_MaPhim` FOREIGN KEY (`MaPhim`) REFERENCES `phim` (`MaPhim`),
  ADD CONSTRAINT `FK_BinhLuan_MaTaiKhoan` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `taikhoan` (`MaTaiKhoan`);

--
-- Các ràng buộc cho bảng `lichchieu`
--
ALTER TABLE `lichchieu`
  ADD CONSTRAINT `FK_chitietchieuphim_Phim` FOREIGN KEY (`MaPhim`) REFERENCES `phim` (`MaPhim`),
  ADD CONSTRAINT `FK_chitietchieuphim_PhongChieu` FOREIGN KEY (`MaPhongChieu`) REFERENCES `phongchieu` (`MaPhongChieu`);

--
-- Các ràng buộc cho bảng `phim_loaiphim`
--
ALTER TABLE `phim_loaiphim`
  ADD CONSTRAINT `phim_loaiphim_ibfk_1` FOREIGN KEY (`MaPhim`) REFERENCES `phim` (`MaPhim`),
  ADD CONSTRAINT `phim_loaiphim_ibfk_2` FOREIGN KEY (`MaLoaiPhim`) REFERENCES `loaiphim` (`MaLoaiPhim`);

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `FK_taikhoan_VaiTro` FOREIGN KEY (`VaiTro`) REFERENCES `phanquyen` (`VaiTro`);

--
-- Các ràng buộc cho bảng `ve`
--
ALTER TABLE `ve`
  ADD CONSTRAINT `FK_ve_MaKhachHang` FOREIGN KEY (`MaKhachHang`) REFERENCES `taikhoan` (`MaTaiKhoan`),
  ADD CONSTRAINT `FK_ve_MaLoaiVe` FOREIGN KEY (`MaLoaiVe`) REFERENCES `loaive` (`MaLoaiVe`),
  ADD CONSTRAINT `FK_ve_MaNhanVien` FOREIGN KEY (`MaNhanVien`) REFERENCES `taikhoan` (`MaTaiKhoan`),
  ADD CONSTRAINT `FK_ve_lichchieu` FOREIGN KEY (`MaLichChieu`) REFERENCES `lichchieu` (`MaLichChieu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
