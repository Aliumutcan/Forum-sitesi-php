<?php

if(!class_exists("Veritabani_Islemleri"))
{
    include 'VeritabaniIslemleri.php';
}

class Galeri extends Islemler{

	public $id=0;
	public $resim_yol="";
	public $resim_kategorisi="";
	public $kategori_id=0;
}
?>