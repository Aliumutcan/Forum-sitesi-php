<?php

if(!class_exists("Veritabani_Islemleri"))
{
    include 'VeritabaniIslemleri.php';
}

class Konular extends Islemler{

	public $id=0;
	public $kategori_id=0;
	public $baslik="";
	public $icerik="";
	public $kullanici_id=0;
	public $tarih="";
	public $durum=0;
	public $goruntulenme=0;
	public $begenme=0;
	public $begenmeme=0;
	public $konu_id=0;
}
?>