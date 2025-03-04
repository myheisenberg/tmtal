-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 18 Şub 2024, 16:27:46
-- Sunucu sürümü: 10.3.37-MariaDB-cll-lve
-- PHP Sürümü: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `tmtalonl_admindashboard`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `tarih` datetime NOT NULL,
  `kullanici` varchar(255) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `ogretmenyetki` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `token`, `tarih`, `kullanici`, `sifre`, `admin`, `ogretmenyetki`) VALUES
(5, 'c4abe3ec01920999c7dfc53164a1dbc6', '2024-02-18 15:34:36', 'test', 'test123', 1, 0),
(6, '', '2024-02-18 16:22:40', 'deneme', 'deneme123', 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenciler`
--

CREATE TABLE `ogrenciler` (
  `id` int(11) NOT NULL,
  `numara` varchar(10) DEFAULT NULL,
  `adi` varchar(50) DEFAULT NULL,
  `soyadi` varchar(50) DEFAULT NULL,
  `sinifi` varchar(50) DEFAULT NULL,
  `okulagiristarihi` datetime DEFAULT NULL,
  `okulacikistarihi` datetime DEFAULT NULL,
  `ogrencikartid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ogrenciler`
--

INSERT INTO `ogrenciler` (`id`, `numara`, `adi`, `soyadi`, `sinifi`, `okulagiristarihi`, `okulacikistarihi`, `ogrencikartid`) VALUES
(1, '123456', 'Ali', 'Yılmaz', '10-A', '2024-02-18 08:15:00', '2024-02-18 16:05:00', 123456789),
(2, '234567', 'Ayşe', 'Kaya', '11-B', '2024-02-18 08:15:00', '2024-02-18 16:04:00', 987654321),
(3, '345678', 'Mehmet', 'Demir', '9-C', '2024-02-18 08:15:00', NULL, NULL),
(4, '456789', 'Fatma', 'Korkmaz', '10-B', '2024-02-18 08:15:00', '2024-02-17 16:09:32', NULL),
(5, '567890', 'Ahmet', 'Şahin', '11-A', '2024-02-18 08:15:00', NULL, NULL),
(6, '678901', 'Zeynep', 'Yıldız', '9-D', '2024-02-14 08:15:00', NULL, NULL),
(7, '123456', 'Ali', 'Yılmaz', '10-A', '2024-02-14 08:15:00', NULL, NULL),
(8, '234567', 'Ayşe', 'Kaya', '11-B', '2024-02-14 08:15:00', NULL, NULL),
(9, '345678', 'Mehmet', 'Demir', '9-C', '2024-02-14 08:15:00', NULL, NULL),
(10, '456789', 'Fatma', 'Korkmaz', '10-B', '2024-02-14 08:15:00', NULL, NULL),
(11, '567890', 'Ahmet', 'Şahin', '11-A', '2024-02-14 08:15:00', NULL, NULL),
(12, '678901', 'Zeynep', 'Yıldız', '9-D', '2024-02-14 08:10:00', NULL, NULL),
(13, '789012', 'Deniz', 'Çelik', '12-C', '2024-02-14 08:15:00', NULL, NULL),
(14, '890123', 'Burak', 'Aydın', '11-D', '2024-02-14 08:15:00', NULL, NULL),
(15, '901234', 'Selin', 'Yılmaz', '10-A', '2024-02-14 08:15:00', NULL, NULL),
(16, '112233', 'Emre', 'Demir', '9-B', '2024-02-14 08:15:00', NULL, NULL),
(17, '223344', 'Gizem', 'Öztürk', '11-C', '2024-02-14 08:15:00', NULL, NULL),
(18, '334455', 'Can', 'Koç', '12-B', '2024-02-14 08:15:00', NULL, NULL),
(19, '445566', 'Ebru', 'Şen', '9-A', '2024-02-14 08:15:00', NULL, NULL),
(20, '556677', 'Onur', 'Yıldırım', '10-D', '2024-02-14 08:15:00', NULL, NULL),
(21, '667788', 'Nur', 'Şahin', '11-A', '2024-02-14 08:15:00', NULL, NULL),
(22, '778899', 'Kaan', 'Erdem', '12-A', '2024-02-14 08:15:00', NULL, NULL),
(23, '889900', 'Ceren', 'Aydın', '9-C', '2024-02-14 08:15:00', NULL, NULL),
(24, '990011', 'Berk', 'Kara', '10-B', '2024-02-14 08:15:00', NULL, NULL),
(25, '001122', 'Esra', 'Koç', '11-D', '2024-02-14 08:15:00', NULL, NULL),
(26, '900', 'Yasin', 'DiÅŸi Kara', '11/B', NULL, NULL, 2147483647),
(27, '900', 'Yasin', 'DiÅŸi Kara', '11/B', NULL, NULL, 2147483647),
(28, '900', 'Yasin', 'Di?i Kara', '11/B', NULL, NULL, 2147483647),
(29, '900', 'Yasin', 'Dişi Kara', '11/B', NULL, NULL, 2147483647),
(30, '54545', 'ŞİĞÇÇ', 'Öçüğ', '19/C', NULL, NULL, 2147483647),
(31, '123', 'messi', 'messi1', '9/B', NULL, NULL, 12312313),
(32, '876', 'Mehmet', 'Kaya', '12/A', NULL, NULL, 2147483647),
(33, '876', 'Mehmet', 'Kaya', '12/A', NULL, NULL, 2147483647),
(34, '1', 'x', 'x', '1', NULL, NULL, 1),
(35, '1', 'b', 'b', '2', NULL, NULL, 3),
(36, '1', 'b', 'b', '2', NULL, NULL, 3),
(37, '6', 'p', 'ı', '343', NULL, NULL, 43),
(38, '11', 'muha', 'muha', '11', NULL, NULL, 11),
(39, '601', 'Yasin', 'Dişikara', '11-B', NULL, NULL, 1234567890);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogretmen`
--

CREATE TABLE `ogretmen` (
  `id` int(11) NOT NULL,
  `isim` varchar(255) DEFAULT NULL,
  `soyisim` varchar(255) DEFAULT NULL,
  `ogretmenkartid` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Tablo döküm verisi `ogretmen`
--

INSERT INTO `ogretmen` (`id`, `isim`, `soyisim`, `ogretmenkartid`) VALUES
(1, 'test', 'Kaya', '99998888'),
(2, 'test', 'Boz', '123456789');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ogretmen`
--
ALTER TABLE `ogretmen`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `ogrenciler`
--
ALTER TABLE `ogrenciler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Tablo için AUTO_INCREMENT değeri `ogretmen`
--
ALTER TABLE `ogretmen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
