<?php

if(!class_exists("Tum_Tablolar"))
{
    include("../model/Model.php");
}

function Delete_Mesaj_Sil(){
	if(!Kullanici_Kontrolu())
		return;


	$mesaj_id=intval($_POST["id"]);
	$model=new Tum_Tablolar();
	$mesajlar=$model->Mesajlar();
	$mesajlar->id=$mesaj_id;
	$cevap=$mesajlar->Delete("where mesaj_id=? or id=?",[$mesaj_id,$mesaj_id]);
	if($cevap>0){
		Get_Hata_Sayfasi("Mesajınız silindi","basarili");
	}else{
		Get_Hata_Sayfasi("Mesajınız silinemedi","hata");
	}

	Onceki_Sayfa();	
}

function Delete_Metin_Sil(){
	if(!Kullanici_Kontrolu())
		return;


	$konu_id=intval($_POST["id"]);
	$model=new Tum_Tablolar();
	$konular=$model->Konular();
	$konular->id=$konu_id;
	$konular->durum="false";
	$cevap=$konular->Update("",[]);
	if($cevap>0){
		Get_Hata_Sayfasi("Metininiz silindi","basarili");
	}else{
		Get_Hata_Sayfasi("Metininiz silinemedi","hata");
	}
	Onceki_Sayfa();	
	return;
	
}

function Delete_Kategori_Sil(){
	if(!Kullanici_Kontrolu())
		return;

	$model=new Tum_Tablolar();
	$kategori=$model->Kategoriler();
	$kategori->id=intval($_POST["id"]);
	$kategori->durum="false";
	$cevap=$kategori->Update("",[]);
	if($cevap>0){
		Get_Hata_Sayfasi("Kategori silindi","basarili");
	}else{
		Get_Hata_Sayfasi("Kategori silinemedi","hata");
	}
	Onceki_Sayfa();	
	return;
}
function Delete_Sikayet_Kaldir(){
	$id=[];
	if(isset($_POST["id"]))
	{
		$sorgu_cumlesi="delete from Sikayetler where ";
		foreach ($_POST["id"] as $value) {
			$sorgu_cumlesi=$sorgu_cumlesi."id=? or ";
			$id[]=intval($value);
		}
		$sorgu_cumlesi=substr($sorgu_cumlesi, 0,count($sorgu_cumlesi)-5);
	
		$model=new Tum_Tablolar();
		$sikayetler=$model->Sikayetler();
		$guncelle=$sikayetler->Sql_cumlesi($sorgu_cumlesi,$id);
		if($guncelle>0)
			Get_Hata_Sayfasi("Seçilenler başarılı bir şekilde silindi","basarili");
		else
			Get_Hata_Sayfasi("Bir hata oluştu tekrar deneyin","hata");
	}
	if (isset($_POST["engel_tipi"]) && isset($_POST["engel_tipi"])) {Post_Kullanici_Engelle();}
	Onceki_Sayfa();
	
}
function Delete_Engel_Kaldir($id){
	$model=new Tum_Tablolar();
	$engel= $model->Engellenenler();
	$engel->id=$id;
	$cevap= $engel->Delete("",[]);	
	if($cevap>0){
		Get_Hata_Sayfasi("Başrılı şekilde silindi.","basarili");
	}
	else{
		Get_Hata_Sayfasi("Bir hata oluştu.","hata");
	}

	Onceki_Sayfa();
}

?>