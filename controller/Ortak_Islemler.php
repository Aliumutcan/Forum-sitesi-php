<?php

	function Url_Duzenle($metin){

		$metin=str_replace(" ", "-", $metin);
		$metin=str_replace("/", "-", $metin);
		$metin=str_replace("ş", "s", $metin);
		$metin=str_replace("Ş", "s", $metin);
		$metin=str_replace("İ", "i", $metin);
		$metin=str_replace("ğ", "g", $metin);
		$metin=str_replace("Ğ", "G", $metin);
		$metin=str_replace("ö", "o", $metin);
		$metin=str_replace("Ö", "o", $metin);
		$metin=str_replace("ü", "u", $metin);
		$metin=str_replace("Ü", "u", $metin);
		$metin=str_replace("ç", "c", $metin);
		$metin=str_replace("Ç", "c", $metin);
		$metin=preg_replace("[0-9]", "", $metin);
		$metin=str_replace("ı", "i", $metin);
		$metin=str_replace("I", "i", $metin);
		return $metin;
	}

	function Kok_Dizine_Yonlendir(){
		$url=substr($_SERVER['REQUEST_URI'], 1,strlen($_SERVER['REQUEST_URI'])-6);
		if (strlen(strstr($url, '/'))>0) 
			$url_dizisi=explode('/',$url);
		else
			$url_dizisi[]=$url;
		$kok_dizin="";
		if (count($url_dizisi)>1) {
			for ($i=0; $i <count($url_dizisi) ; $i++)  
				$kok_dizin=$kok_dizin.'../';
		}
		return $kok_dizin;
	}
	function Kullanici_Kontrolu(){
		if (isset($_SESSION['kullanici']))
			return 1;
		else
			return 0;
		
	}

	function Onceki_Sayfa(){
		$geldigi_sayfa = $_SERVER['HTTP_REFERER']; 
		if(empty($geldigi_sayfa))
			$geldigi_sayfa="anasayfa.html";

		echo "Bir şekilde bu sayfaya yönlenemedi... URL: - ".$geldigi_sayfa;
		
		header("Location:$geldigi_sayfa");
	}

	function Get_Hata_Sayfasi($hata_mesaji,$hatakodu){
		//footerdan tetiklenen bir javascript ile bannerdaki giriş kısmının yenilenme hatasını çözebilirsin
		$_SESSION["Hata_kodu"]=constant("Hata_kodu::".$hatakodu);
		$_SESSION["hata_mesaji"]=$hata_mesaji;
		$_SESSION["hata_zamani"]=time()+5;
	}
abstract class Hata_kodu{
    const hata=-1;
    const uyari=0;
    const basarili=1;
}

?>