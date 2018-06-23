-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 24 Haz 2018, 00:32:52
-- Sunucu sürümü: 5.7.22-0ubuntu18.04.1
-- PHP Sürümü: 5.6.36-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `forum`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Engellenenler`
--

CREATE TABLE `Engellenenler` (
  `id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `engel_tipi` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `engel_suresi` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `engelleme_tarihi` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Engellenenler`
--

INSERT INTO `Engellenenler` (`id`, `kullanici_id`, `engel_tipi`, `engel_suresi`, `engelleme_tarihi`) VALUES
(21, 7, 'mesaj-yazma', '2018-07-06', '2018-06-23'),
(20, 7, 'konu-acma', '2018-07-02', '2018-06-23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Galeri`
--

CREATE TABLE `Galeri` (
  `id` int(11) NOT NULL,
  `resim_yol` varchar(50) NOT NULL,
  `resim_kategorisi` varchar(50) NOT NULL,
  `kategori_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Kategoriler`
--

CREATE TABLE `Kategoriler` (
  `id` int(11) NOT NULL,
  `kategori_adi` varchar(30) NOT NULL,
  `aciklama` varchar(500) NOT NULL,
  `durum` varchar(128) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Kategoriler`
--

INSERT INTO `Kategoriler` (`id`, `kategori_adi`, `aciklama`, `durum`) VALUES
(6, 'Genel', 'Genel kategorisi', 'true'),
(7, 'Bilgisayar', 'yok', 'true');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Konular`
--

CREATE TABLE `Konular` (
  `id` int(11) NOT NULL,
  `baslik` varchar(300) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `icerik` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `konu_id` int(11) NOT NULL,
  `goruntulenme` int(11) NOT NULL,
  `begenme` int(11) NOT NULL,
  `begenmeme` int(11) NOT NULL,
  `durum` varchar(20) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `tarih` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Konular`
--

INSERT INTO `Konular` (`id`, `baslik`, `icerik`, `kategori_id`, `kullanici_id`, `konu_id`, `goruntulenme`, `begenme`, `begenmeme`, `durum`, `tarih`) VALUES
(12, 'İlk konu başlığı', '<p>deneme konusu</p>\r\n', 6, 6, 0, 0, 2, 1, 'true', '2018-06-22'),
(13, '', '<p>ilk başlık denemeleri</p>\r\n', 0, 7, 12, 0, 0, 0, 'true', '2018-06-22'),
(14, 'bilgisayar konu deneme', '<p>deneme</p>\r\n', 7, 8, 0, 0, 0, 0, 'true', '2018-06-22');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Kullanicilar`
--

CREATE TABLE `Kullanicilar` (
  `id` int(11) NOT NULL,
  `adi` varchar(100) NOT NULL,
  `soyadi` varchar(50) NOT NULL,
  `eposta` varchar(150) NOT NULL,
  `sifre` varchar(130) NOT NULL,
  `kayit_tarihi` varchar(100) NOT NULL,
  `tesekkur_sayisi` int(11) NOT NULL,
  `haberdar_olmak_istiyorum` tinyint(1) NOT NULL,
  `unvan` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Kullanicilar`
--

INSERT INTO `Kullanicilar` (`id`, `adi`, `soyadi`, `eposta`, `sifre`, `kayit_tarihi`, `tesekkur_sayisi`, `haberdar_olmak_istiyorum`, `unvan`) VALUES
(6, 'Ali Umutcan', 'kul', 'deneme@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2018.06.22', 0, 1, 'Yönetici'),
(7, 'cihan', 'erol', 'deneme2@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2018.06.22', 0, 1, 'üye'),
(8, 'kullanici', 'kullanici', 'deneme3@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2018.06.22', 0, 1, 'üye'),
(9, 'kullanici2', 'kullanici', 'deneme4@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '2018.06.22', 0, 1, 'üye');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Log`
--

CREATE TABLE `Log` (
  `id` int(11) NOT NULL,
  `hata_aciklamasi` text NOT NULL,
  `hata_bulunan_yer` varchar(300) NOT NULL,
  `hata_kodu` int(11) NOT NULL,
  `hata_tipi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Mesajlar`
--

CREATE TABLE `Mesajlar` (
  `id` int(11) NOT NULL,
  `baslik` varchar(300) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `icerik` varchar(500) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `alan_id` int(11) NOT NULL,
  `gonderen_id` int(11) NOT NULL,
  `mesaj_id` int(11) NOT NULL,
  `durum` varchar(128) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Mesajlar`
--

INSERT INTO `Mesajlar` (`id`, `baslik`, `icerik`, `alan_id`, `gonderen_id`, `mesaj_id`, `durum`, `tarih`) VALUES
(31, 'mesaj denemesi', 'deneme deneme mesaj', 6, 7, 0, 'true', '2018-06-22');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Sikayetler`
--

CREATE TABLE `Sikayetler` (
  `id` int(11) NOT NULL,
  `aciklama` varchar(500) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `link` varchar(200) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `sikayet_eden_id` int(11) NOT NULL,
  `sikayet_edilen_id` int(11) NOT NULL,
  `tarih` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `durum` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `Sikayetler`
--

INSERT INTO `Sikayetler` (`id`, `aciklama`, `link`, `sikayet_eden_id`, `sikayet_edilen_id`, `tarih`, `durum`) VALUES
(26, 'uygunsuz konuşma', 'http://localhost/konu-icerik/12/1/ilk-konu-basligi.html#13', 8, 13, '22.06.2018', 'false');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `Engellenenler`
--
ALTER TABLE `Engellenenler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `Galeri`
--
ALTER TABLE `Galeri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `Kategoriler`
--
ALTER TABLE `Kategoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `Konular`
--
ALTER TABLE `Konular`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `Kullanicilar`
--
ALTER TABLE `Kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `Log`
--
ALTER TABLE `Log`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `Mesajlar`
--
ALTER TABLE `Mesajlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `Sikayetler`
--
ALTER TABLE `Sikayetler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `Engellenenler`
--
ALTER TABLE `Engellenenler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Tablo için AUTO_INCREMENT değeri `Galeri`
--
ALTER TABLE `Galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `Kategoriler`
--
ALTER TABLE `Kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Tablo için AUTO_INCREMENT değeri `Konular`
--
ALTER TABLE `Konular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Tablo için AUTO_INCREMENT değeri `Kullanicilar`
--
ALTER TABLE `Kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Tablo için AUTO_INCREMENT değeri `Log`
--
ALTER TABLE `Log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `Mesajlar`
--
ALTER TABLE `Mesajlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Tablo için AUTO_INCREMENT değeri `Sikayetler`
--
ALTER TABLE `Sikayetler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
