<?php


include("Ortak_Islemler.php");

include("Get_Kontroller.php");

include("Post_Kontroller.php");

include("Delete_Kontroller.php");


$methot=$_SERVER['REQUEST_METHOD'];
$url=substr($_SERVER['REQUEST_URI'], 1,strlen($_SERVER['REQUEST_URI'])-6);
$url_dizisi;

if (strlen(strstr($url, '/'))>0) 
	$url_dizisi=explode('/',$url);
else
	$url_dizisi[]=$url;


foreach ($url_dizisi as $value) {
	if(ord($value[0])>64 && ord($value[0])<123){$_SESSION["title"]=$value;break;}
}

include("../view/banner.php");
echo var_dump($_SESSION['kullanici']);
if ($methot=="GET") {
	if($url_dizisi[0]=="anasayfa")
		Get_Anasayfa();
	else if($url_dizisi[0]=="cikis")
		Get_Cikis();
	else if($url_dizisi[0]=="yeni-kayit")
		Get_Yeni_Kayit();
	else if($url_dizisi[0]=="profil")
		Get_Profil();
	else if($url_dizisi[0]=="konu-icerik")
		Get_Konu_Icerik($url_dizisi);
	else if(count($url_dizisi)>2 && $url_dizisi[0]=="yeni-konu-olustur" && $url_dizisi[2]=="guncelle"){
		if(intval($url_dizisi[1])>0)
			Get_Konu_Guncelle(intval($url_dizisi[1]));
	}
	else if($url_dizisi[0]=="yeni-konu-olustur"){
		if (isset($url_dizisi[1])) {
			$_GET["konu_id"]=$url_dizisi[1];
		}
			Get_Konu_Olustur();
	}
	else if(intval($url_dizisi[0])>0 && $url_dizisi[1]=="metinlerim")
		Get_Forum_Metinlerim($url_dizisi[0]);
	else if ($url_dizisi[0]=="sikayetler") 
		Get_Sikayetler();
	else if ($url_dizisi[0]=="mesajlar") 
		Get_Mesajlar();
	elseif ($url_dizisi[0]=="kategori-duzenle")
		Get_Kategori_Duzenle();
	
	elseif ($url_dizisi[0]>0 && $url_dizisi[1]=="mesaj-detay") 
		Get_Mesaj_Detay($url_dizisi[0]);
	elseif(count($url_dizisi)==3 && intval($url_dizisi[0])>0 && intval($url_dizisi[1])>0 && strlen($url_dizisi[2])>0)
		Get_Kategori_Icerigi($url_dizisi[0],$url_dizisi[1]);
	else if($url_dizisi[0]=="engelliler")
		Get_Engelliler();
	else if(count($url_dizisi)>1 && $url_dizisi[1]=="engel-kaldir")
		Delete_Engel_Kaldir();
	else
		include("../view/hata-sayfasi.php");

	
	
}
else if($methot=="POST"){

	if($url_dizisi[0]=="yeni-kayit")
		Post_Yeni_Kayit();
	else if($url_dizisi[0]=="giris")
		Post_Giris();
	else if($url_dizisi[0]=="yeni-konu-olustur")
		Post_Yeni_Konu_Olustur();
	else if ($url_dizisi[0]=="sikayet-islemleri")
		Delete_Sikayet_Kaldir();
	else if ($url_dizisi[0]=="yeni-mesaj-olustur") 
		Post_Yeni_Mesaj_Olustur();
	else if($url_dizisi[0]=="begeni-ret")
		Post_Begeni_Ret();
	else if($url_dizisi[0]=="mesaj-sil") 
		Delete_Mesaj_Sil();
	else if($url_dizisi[0]=="metin-sil") 
		Delete_Metin_Sil();
	else if($url_dizisi[0]=="kategori-sil")
		Delete_Kategori_Sil();
	else if($url_dizisi[0]=="kategori-guncelle")
		Post_Kategori_Duzenle();
	else if($url_dizisi[0]=="kategori-ekle")
		Post_Kategori_Ekle();
	else if($url_dizisi[0]=="sikayet-olustur")
		Post_Sikayet_Olustur();
	else if($url_dizisi[0]=="kullanici-engelle")
		Post_Kullanici_Engelle();
	else if($url_dizisi[0]=="resim-ekle-degis")
		Post_Profil_Resim_EkleDegis();
	else
		include("../view/hata-sayfasi.php");
}


if(time()<=$_SESSION["hata_zamani"])
	include("../view/hata.php");



include("../view/footer.php");

?>