-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 05, 2025 lúc 04:50 PM
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
-- Cơ sở dữ liệu: `shop_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '123'),
(3, 'bao', '123'),
(4, 'dat', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'Đang xử lý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `price`, `image_01`, `image_02`, `image_03`, `quantity`) VALUES
(24, 'Bộ Bàn Gỗ Phòng Làm Việc Cao Cấp', 'Bàn gỗ cao cấp làm từ gỗ hiếm giá thành khá cao kháng được nước, chống trầy ', 2999000, 'bàngỗphònglàmviệc.png', 'bàngỗphònglàmviệc.png', 'bàngỗphònglàmviệc.png', 0),
(25, 'Ghế Nhựa Đúc', 'Làm bằng nhựa, an toàn khi sử dụng, bền và tiện lợi', 100000, 'ghế nhựa đúc.jpg', 'ghế nhựa đúc.jpg', 'ghế nhựa đúc.jpg', 0),
(26, 'Giường Đôi Cao Cấp Gia Đình', 'Giường làm từ chất liệu cao cấp, bền,  an toàn cho sức khỏe, hiện đại sang trọng', 3999000, 'giuong.webp', 'giuong.webp', 'giuong.webp', 0),
(27, 'Đèn Treo Phong Cách Lâu Đài', 'Đèn thiết kế theo phong cách cổ, trang trí độc đáo chống nước chất liệu tốt, bền', 699000, 'đèn treo tường phong cách cổ đại.jpeg', 'đèn treo tường phong cách cổ đại.jpeg', 'đèn treo tường phong cách cổ đại.jpeg', 0),
(28, 'Tranh Treo In Bông Hoa 3D', 'Tranh cao cấp trang trí phòng khách phong cách hiện đại ', 299000, 'tranh treo tường bông hoa in 3d.jpg', 'tranh treo tường bông hoa in 3d.jpg', 'tranh treo tường bông hoa in 3d.jpg', 0),
(29, 'Tủ Quần Áo Gỗ Đơn Giản', 'Làm bằng gỗ sòi cứng, bền, thích hợp trang trí nhà cửa phong cách đơn giản nhưng cầu kì', 799000, 'tủ quần áo gỗ đơn giản 1m6.jpg', 'tủ quần áo gỗ đơn giản 1m6.jpg', 'tủ quần áo gỗ đơn giản 1m6.jpg', 0),
(30, 'Sofa Cao Cấp Phòng Khách', 'Sofa làm từ chất liệu cao cấp chống trầy vệ sinh dễ dàn dành cho phòng khách', 4999000, 'sofada.jpg', 'sofada.jpg', 'sofada.jpg', 0),
(31, 'Bàn Gaming Fufutech X-Razer Chân đen Mặt đen', 'Màu sắc: Full đen\r\nKích thước chuẩn: D120xR60 cm\r\nKích thước khác: Thiết kế theo yêu cầu\r\nChất liệu:\r\n+ Khung chân sắt kích thước 4x4cm, dày 1,2 ly sơn tĩnh điện\r\n+ Mặt bàn gỗ MDF phủ Melamine chống mối mọt, ẩm mốc, cong vênh\r\nĐặc điểm:\r\n+ Mặt bàn cạnh khuyết\r\n+ Nút chân cao su chống trơn trượt và trầy sàn\r\n+ Lỗ đi dây tích hợp, giúp đi dây gọn hơn\r\n+ Kết cấu ổn định\r\n+ An toàn khi sử dụng\r\n+ Dễ dàng vệ sinh', 1285, 'ban-gaming-fufutech-x-razer-11-7896.jpg', 'ban-gaming-fufutech-x-razer-9-2086.jpg', 'ban-gaming-fufutech-x-razer-1-2236.jpg', 5),
(32, 'Bàn giám đốc kèm tủ phụ - BGDTP002', 'Bàn Giám đốc kèm Tủ phụ là sự lựa chọn hoàn hảo cho những người quản lý và giám đốc văn phòng.\r\n Với thiết kế sang trọng và chất liệu cao cấp,\r\n bàn giám đốc có tủ phụ sẽ mang lại không gian làm việc đẳng cấp và hiện đại cho người sử dụng.', 3500000, 'ban-giam-doc-bgdtp002-2.webp', 'ban-giam-doc-bgdtp002-1.webp', 'ban-giam-doc-bgdtp002-2.webp', 0),
(33, 'Bàn ăn mặt sứ BARTON - Gỗ óc chó', 'Gỗ óc chó có mức độ đa năng và linh hoạt mà không loại gỗ nào sánh bằng. ', 29000000, 'w_02.jpg', 'w_06.jpg', 'w_10.jpg', 0),
(34, ' Bàn Học Gỗ Tự Nhiên IK KIDS – M120 cao cấp HOT', 'Bàn Học Gỗ Tự Nhiên IK KIDS \r\n', 4200000, 'ban-hoc-go-tu-nhien-IKKIDS-M120-510x436.png', 'ban-hoc-dep-IKKIDS-M120-510x765.jpg', 'ban-hoc-sinh-bang-go-IKKIDS-M120-510x765.jpg', 0),
(35, 'Ghế Gaming Razer Enki – Quartz (RZ38-03720200-R3U1)', 'Thương hiệu: Razer.\r\nChất liệu: kim loại cao cấp.\r\nTrọng lượng tối đa: 136kg.\r\nMàu sắc: Hồng.', 1390000, 'ghe-gaming-razer-enki-quartz4.jpg', 'ghe-gaming-razer-enki-quartz1.jpg', 'ghe-gaming-razer-enki-quartz.jpg', 0),
(36, 'Ghế Gaming Corsair T3 RUSH Grey – Charcoal (CF-9010056-WW)', 'Thương hiệu: Corsair\r\nChất liệu: Vải mềm cao cấp, bọt đệm Polyurethane\r\nTải trọng tối đa: 120kg\r\nChiều cao tối đa: 188cm\r\nPhần kê tay: 4D\r\nKích thước kê tay: 26cm x 10cm x 2.65cm\r\nGóc ngả: 90°-180°\r\nKích thước ghế: 56cm x 58cm', 6789, 'ghe-gaming-corsair-t3-rush-grey-charcoal-2.jpg', 'ghe-gaming-corsair-t3-rush-grey-charcoal-4.jpg', 'ghe-gaming-corsair-t3-rush-grey-charcoal-5.jpg', 0),
(37, 'Ghế Gami Crom All Black', 'Thương hiệu: Gami.\r\nChất liệu: Lưới Solidmesh USA và nhôm.\r\nTrọng lượng tối đa: 150kg.\r\nMàu sắc: Đen.', 6350, 'Ghe-Gami-Crom-All-Black-11.jpg', 'Ghe-Gami-Crom-All-Black-13.jpg', 'Ghe-Gami-Crom-All-Black-10.jpg', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(12, 'tranquocbao', '2280600236@gmail.com', 'bao123'),
(15, 'TranQuocBao', 'quocbao200477@gmail.com', '0a9b851d'),
(16, 'phan đạt', 'datphna@gmail.com', '14edbaa3'),
(17, 'đạt ', 'miradesd@gmail.com', '80c36524');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
