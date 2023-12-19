-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 04 Kas 2023, 18:38:36
-- Sunucu sürümü: 8.0.31
-- PHP Sürümü: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `e-commerce`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uye_panel`
--

DROP TABLE IF EXISTS `uye_panel`;
CREATE TABLE IF NOT EXISTS `uye_panel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ad` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `soyad` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `mail` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `sifre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL DEFAULT '0',
  `telefon` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_turkish_ci NOT NULL,
  `durum` int NOT NULL DEFAULT '1',
  `tur` int NOT NULL DEFAULT '1',
  `grupid` int NOT NULL DEFAULT '100',
  `mailgrup` int NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_turkish_ci;

--
-- Tablo döküm verisi `uye_panel`
--

INSERT INTO `uye_panel` (`id`, `ad`, `soyad`, `mail`, `sifre`, `telefon`, `durum`, `tur`, `grupid`, `mailgrup`) VALUES
(12, 'dilekT', 'kal', 'dilek@hotmail.com', 'q5hzeovRZgN2pWwG7glMmgA=', '5555555555', 1, 1, 100, 100),
(10, 'Uye', 'Kalyon', 'Uye@gmail.com', 'q5ijvc1oc5CRiYGRgVnAJjYGUWOmwwA=', '4444444444', 1, 1, 5, 5),
(15, 'hakan', 'yılmaz', 'hak@gmail.com', 'q5ijvc1oU5CRUcAmNgZuecbfAA==', '3333333333', 1, 1, 2, 2),
(24, 'Mehmet', 'Haktan', 'Uye.1@windowslive.com', 'q5ijvc1oU5CRUcAmNgZuecbfAA==', '2222222222', 1, 1, 5, 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
