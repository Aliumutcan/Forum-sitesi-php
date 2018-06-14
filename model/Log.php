<?php

if(!class_exists("Veritabani_Islemleri"))
{
    include 'VeritabaniIslemleri.php';
}

class Log extends Islemler{

	public $id=0;
	public $hata_kodu=0;
	public $hata_bulunan_yer="";
	public $hata_aciklamasi="";
	public $hata_tipi=0;
}
?>