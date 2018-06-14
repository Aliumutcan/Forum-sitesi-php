-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 14 Haz 2018, 13:34:48
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

--
-- Tablo döküm verisi `Galeri`
--

INSERT INTO `Galeri` (`id`, `resim_yol`, `resim_kategorisi`, `kategori_id`) VALUES
(5, 'img/profil/exit.png', 'profil', 4),
(6, 'img/profil/Gnu_wallpaper.png', 'profil', 3);

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
(1, 'Genel', 'dasd asdasd asda', 'true'),
(2, 'Dünya', 'dasd asdasd asda', 'true'),
(3, 'Bilgisayar', 'dasd asdasd asda', 'true'),
(4, 'dasd', 'asdas', 'false'),
(5, 'yeni', 'Düzenlenedi', 'false');

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
(4, 'ilk başlık', '<p>ilk başlık d&uuml;zeltildi</p>\r\n', 3, 3, 0, 0, 2, 1, 'true', '2018-06-05'),
(8, '', '<p>asd aslkdj halskjdha sşkdy apıwudypaskhdaoısh dpah sad a</p>\r\n', 0, 3, 0, 0, 0, 0, 'false', '2018-06-05'),
(5, 'deneme başlığı', '<p>da sda sda sdas das dasd asd asd</p>\r\n', 1, 3, 0, 0, 3, 1, 'true', '2018-05-31'),
(6, 'sad asd asd', '<p>asd aıs dhakjsldlashdşasda sd as</p>\r\n', 1, 3, 0, 0, 0, 0, 'true', '2018-05-20'),
(7, 'kapalı konu', '<p>asd asıda ıhsda sda sd</p>\r\n', 1, 3, 0, 0, 0, 0, '0', '2018-05-20'),
(11, '', '<p>dasd asd asd asda sda sdasd asda</p>\r\n', 0, 3, 4, 0, 2, 1, 'false', '2018-06-05');

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
(1, 'Adem', 'Duysak', 'aliumutcankul05@gmail.com', 'asdas', '2018.04.21', 0, 1, 'Yonetici'),
(3, 'ali umutcan', 'KUL', 'deneme@gmail.com', '92429d82a41e930486c6de5ebda9602d55c39986', '2018.05.01', 0, 1, 'Yönetici'),
(4, 'ali', 'kul', 'aliumutcankul05@gmail.com', '58ea5752c604312084f29df3f56181af20d19c3b', '2018.06.12', 0, 1, 'üye');

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
(1, 'baslik1', 'icerik1', 1, 3, 0, 'false', '2018-05-21'),
(2, 'baslik1', 'icerik1', 3, 1, 1, 'true', '2018-05-21'),
(27, '', 'Mesajınız', 1, 3, 1, '1', '2018-05-31'),
(26, '', 'Mesajınız', 1, 3, 1, '1', '2018-05-31'),
(25, '', 'Mesajınız', 1, 3, 1, '1', '2018-05-31'),
(24, '', 'Mesajınız', 1, 3, 1, '1', '2018-05-31'),
(23, '', 'giden', 1, 3, 1, '1', '2018-05-31'),
(22, '', 'as das dasaaaaaaaaaaaaaaaaaa', 1, 3, 1, '1', '2018-05-21'),
(21, '', 'sad asd as das d', 1, 3, 1, '1', '2018-05-21'),
(20, '', 'Mesajınız', 1, 3, 1, '1', '2018-05-21'),
(28, '', 'askdjakshdkljahkshdlkahsdahslkdhaklsda', 3, 3, 0, '1', '2018-06-06');

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
(25, 'Acıklama', 'http://localhost/konu-icerik/4/1/ilk-baslik.html#11', 3, 11, '12.06.2018', 'false');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Tablo için AUTO_INCREMENT değeri `Galeri`
--
ALTER TABLE `Galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `Kategoriler`
--
ALTER TABLE `Kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Tablo için AUTO_INCREMENT değeri `Konular`
--
ALTER TABLE `Konular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Tablo için AUTO_INCREMENT değeri `Kullanicilar`
--
ALTER TABLE `Kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `Log`
--
ALTER TABLE `Log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `Mesajlar`
--
ALTER TABLE `Mesajlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Tablo için AUTO_INCREMENT değeri `Sikayetler`
--
ALTER TABLE `Sikayetler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
