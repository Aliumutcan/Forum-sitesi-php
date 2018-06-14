<?php

if(!class_exists("Veritabani_Islemleri"))
{
    include 'VeritabaniIslemleri.php';
}

class Mesajlar extends Islemler{

	public $id=0;
	public $gonderen_id=0;
	public $alan_id=0;
	public $baslik="";
	public $icerik="";
	public $tarih="";
	public $durum=0;
	public $mesaj_id=0;
}
?>