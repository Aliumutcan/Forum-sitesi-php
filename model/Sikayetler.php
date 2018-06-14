<?php

if(!class_exists("Veritabani_Islemleri"))
{
    include 'VeritabaniIslemleri.php';
}

class Sikayetler extends Islemler{

	public $id=0;
	public $sikayet_eden_id=0;
	public $sikayet_edilen_id=0;
	public $aciklama="";
	public $tarih="";
	public $link="";

	
}
?>