<?php


if(!class_exists("Veritabani_Islemleri"))
{
    include 'VeritabaniIslemleri.php';
}

class Kullanicilar extends Islemler{

	public $id=0;
	public $adi="";
	public $soyadi="";
	public $eposta="";
	public $sifre="";
	public $tesekkur_sayisi=0;
	public $kayit_tarihi="";
	public $haberdar_olmak_istiyorum=false;
	public $unvan="";
}
?>