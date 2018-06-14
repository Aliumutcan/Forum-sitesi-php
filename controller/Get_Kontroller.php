<?php

$dosya_yolu="../view";
if(!class_exists("Tum_Tablolar"))
{
    include("../model/Model.php");
}
$_GET["adet"]=0;
function Get_Anasayfa(){
	$model=new Tum_Tablolar();
	$konular=$model->Konular();
	$_GET["konular"]=$konular->Select(
		["id"
		,"baslik"
		,"kategori_id"
		,"tarih"
		,"(select adi from Kullanicilar where Kullanicilar.id=Konular.kullanici_id) as kullanici"
		,"(select count(id) from Konular where konu_id=Konular.id) as yanit"]
		,"where durum='true' and konu_id=0 order by kategori_id ASC"
		,[]);
	$kategoriler=$model->Kategoriler();
	$_GET["kategoriler"]=$kategoriler->Select(["id","kategori_adi"],"",[]);
    include("../view/index.php");
}
$_GET["suankisayfa"]=0;
function Get_Kategori_Icerigi($sayfa,$kategori_id){
	$_GET["suankisayfa"]=$sayfa;

	$sayfa=(intval($sayfa)-1)*20;
	$model=new Tum_Tablolar();
	$konular=$model->Konular();
	$_GET["konular"]=$konular->Select(
		["id"
		,"baslik"
		,"kategori_id"
		,"tarih"
		,"(select adi from Kullanicilar where Kullanicilar.id=Konular.kullanici_id) as kullanici"

		,"(select count(id) from Konular where konu_id=Konular.id) as yanit"]
		,"where durum='true' and konu_id=0 and kategori_id=? limit ?,20"
		,[$kategori_id,$sayfa]);
	$kategoriler=$model->Kategoriler();
	$_GET["kategoriler"]=$kategoriler->Select(["id","kategori_adi"],"",[]);
	$adet=$konular->Select(["count(id) as adet"],"where durum='true' and konu_id=0 and kategori_id=?",[$kategori_id]);
	$_GET["adet"]=intval($adet[0]["adet"])/20;
    include("../view/index.php");

}

function Get_Cikis(){
	if (isset($_SESSION["kullanici"])) {
		unset($_SESSION["kullanici"]);

		Get_Hata_Sayfasi("Başarılı bir şekilede çıkış yaptınız.","basarili");
		Onceki_Sayfa();
	}
	
}

function Get_Yeni_Kayit(){
    include("../view/kayit-formu.php");
}


function Get_Profil(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");Onceki_Sayfa(); return;}

    $kullanici_id=$_SESSION["kullanici"][0]["id"];
    $model=new Tum_Tablolar();
    $konular=$model->Konular();
    $mesajlar=$model->Mesajlar();
    $kategoriler=$model->Kategoriler();
    $_GET["konular"]= $konular->Select(["id","baslik"],"where kullanici_id=?",[$kullanici_id]);
    $_GET["giden_mesajlar"]= $mesajlar->Select([],"where durum='true' and gonderen_id=? and baslik!=''",[$kullanici_id]);
    $_GET["gelen_mesajlar"]= $mesajlar->Select([],"where durum='true' and alan_id=? and baslik!=''",[$kullanici_id]);
    $_GET["kategoriler"]= $kategoriler->Select([],"",[]);
    include("../view/profil.php");
        
}

function Get_Konu_Icerik($url_icerik){

	$sayfa=intval(($url_icerik[2]-1)*10);
	$id=intval($url_icerik[1]);

	$model=new Tum_Tablolar();
	$konu=$model->Konular();
	$konu_icerigi=$konu->Select([],"where id=? or konu_id=? limit ?,10",[$id,$id,$sayfa]);

	$kullanici_icin_sorgu="where ";
	$kullanici_icin_sart=[];
	foreach ($konu_icerigi as $value) {
		$kullanici_icin_sorgu=$kullanici_icin_sorgu." id=? or ";
		$kullanici_icin_sart[]=$value["kullanici_id"];
	}
	$kullanici_icin_sorgu=substr($kullanici_icin_sorgu, 0,count($kullanici_icin_sorgu)-4);
	
	$kullanicilar=$model->Kullanicilar()->Select(["id","adi","soyadi","tesekkur_sayisi"
		,"(SELECT COUNT(id) from Konular where Konular.kullanici_id=Kullanicilar.id) as 'toplam_mesaj'"
		,"(select resim_yol from Galeri where resim_kategorisi='profil' and kategori_id=Kullanicilar.id) as resim"]

		,$kullanici_icin_sorgu,$kullanici_icin_sart);

		for ($i=0; $i <count($kullanicilar); $i++) { 
		for ($a=0; $a <count($konu_icerigi) ; $a++) { 
			if($konu_icerigi[$a]["kullanici_id"]==$kullanicilar[$i]["id"])
				{$konu_icerigi[$a]["kullanici"]=$kullanicilar[$i];}
		}
	}
	$_GET["konu_icerigi"]=$konu_icerigi;
	include("../view/konu-icerigi.php");
}


function Get_Forum_Metinlerim($sayfa){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}

	$model=new Tum_Tablolar();
	$id=$_SESSION["kullanici"][0]["id"];
	$sayfa=($sayfa-1)*20;
	$konular=$model->Konular();
	$konu_verileri=$konular->Select(["id","baslik","icerik","(Select count(id) from Konular where konu_id=id) as 'toplam_mesajlar'"],"where durum='true' and kullanici_id=? limit ?,20",[$id,$sayfa]);
	$_GET["konu_verileri"]=$konu_verileri;
	include("../view/forum-metinlerim.php");
}

function Get_Konu_Olustur(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}

	$model=new Tum_Tablolar();
	$kategoriler=$model->Kategoriler();
	$_GET["kategoriler"]= $kategoriler->Select([],"",[]);
	include("../view/yeni-konu.php");
}
function Get_Konu_Guncelle($id){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}

	if(!isset($id))
		return;
	$model=new Tum_Tablolar();
	$konu=$model->Konular();
	$kategoriler=$model->Kategoriler();
	$guncellenecek=$konu->Select([],"where id=?",[$id]);
	$_GET["guncellenecek"]=$guncellenecek;
	$_GET["kategoriler"]= $kategoriler->Select([],"",[]);
	include("../view/yeni-konu.php");
}


function Get_Sikayetler(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}

	$model=new Tum_Tablolar();
	$sikayetler=$model->Sikayetler();
	$sikayetler=$sikayetler->Select([],"order by durum desc ",[]);
	$_GET["sikayetler"]=$sikayetler;
	include("../view/sikayetler.php");
}
function Get_Mesajlar(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}

	$model=new Tum_Tablolar();
	$mesajlar=$model->Mesajlar();
	$_GET["mesajlar"]=$mesajlar->Select([],"where durum='true' and mesaj_id=0 and (alan_id=? or gonderen_id=?)",[$_SESSION["kullanici"][0]["id"],$_SESSION["kullanici"][0]["id"]]);
	include("../view/gelengiden-mesaj.php");
	
}
function Get_Mesaj_Detay($id){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}

	$model=new Tum_Tablolar();
	$mesajlar=$model->Mesajlar();
	$mesajlar=$mesajlar->Select([],"where id=? or mesaj_id=? order by id",[intval($id),intval($id)]);
	$_GET["mesajlar"]=$mesajlar;
	$_GET["id"]=$id;
	$_GET["gonderilecek"]=0;
	if($_SESSION["kullanici"][0]["id"]==$_GET["mesajlar"][count($_GET["mesajlar"])-1]["gonderen_id"]){
		$_GET["gonderilecek"]=$_GET["mesajlar"][count($_GET["mesajlar"])-1]["alan_id"];
		$mesajlar->id=intval($id);
		$mesajlar->durum="true";
		$mesajlar->Update();
	}
	else $_GET["gonderilecek"]=$_GET["mesajlar"][count($_GET["mesajlar"])-1]["gonderen_id"];
	
	include("../view/gelengiden-mesaj-detay.php");
}

function Get_Kategori_Duzenle(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}

	$model=new Tum_Tablolar();
	$kategoriler=$model->Kategoriler();

	$veriler=$kategoriler->Select([],"where durum='true'",[]);
	$_GET["kategoriler"]=$veriler;

	include("../view/Kategori_Islemleri.php");
}

function Get_Engelliler(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}
	
	$model=new Tum_Tablolar();
	$engellenenler=$model->Engellenenler();
	$engellenenler=$engellenenler->Select(
		["*","(select adi from Kullanicilar where Kullanicilar.id=kullanici_id) as kullanici_adi","(select soyadi from Kullanicilar where Kullanicilar.id=kullanici_id) as kullanici_soyadi"],
		[],
		[]
	);
	$_GET["engelliler"]=$engellenenler;

	include("../view/engelliler.php");
}


?>