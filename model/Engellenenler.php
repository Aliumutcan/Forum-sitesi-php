<?php

if(!class_exists("Veritabani_Islemleri"))
{
    include 'VeritabaniIslemleri.php';
}

class Engellenenler extends Islemler{

	public $id=0;
	public $kullanici_id=0;
	public $engel_tipi=0;
	public $engel_suresi="";
	public $engelleme_tarihi="";
}
?>