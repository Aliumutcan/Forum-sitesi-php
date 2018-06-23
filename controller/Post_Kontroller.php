
<?php

if(!class_exists("Tum_Tablolar"))
{
    include("../model/Model.php");
}

function Post_Yeni_Kayit(){
	if($_POST["sifre"]!=$_POST["sifre2"]){Get_Hata_Sayfasi("Şifreler uyuşmadı tekrar deneyin...","uyari");return;}
	
	$model=new Tum_Tablolar();
	$kullanicilar=$model->Kullanicilar();
	$kullanicilar->adi=$_POST["adi"];
	$kullanicilar->soyadi=$_POST["soyadi"];
	$kullanicilar->eposta=$_POST["eposta"];
	$kullanicilar->sifre=sha1($_POST["sifre"]);
	$kullanicilar->kayit_tarihi=date("Y.m.d");
	$kullanicilar->unvan="üye";
	$kullanicilar->haberdar_olmak_istiyorum=$_POST["haberdar_olmak_istiyorum"]=="on"?TRUE:FALSE;
	$geri_donus= $kullanicilar->Insert("",[]);

	if($geri_donus==0){Get_Hata_Sayfasi("Bir hatada dolayı kayıt gerçekleştirilemedi.","hata");return;}
	if($geri_donus>0){Get_Hata_Sayfasi("Yayıt işleminiz başarılı birşekilde oluşturuldu","basarili");}

	Get_Yeni_Kayit();
}

function Post_Giris(){
	$model=new Tum_Tablolar();
	$kullanicilar=$model->Kullanicilar();
	$gelen_veriler=$kullanicilar->Select(["id"
		,"adi"
		,"soyadi"
		,"eposta"
		,"kayit_tarihi"
		,"haberdar_olmak_istiyorum"
		,"unvan"
		,"(select resim_yol from Galeri where resim_kategorisi='profil' and kategori_id=Kullanicilar.id) as resim"]
		,"where eposta=? and sifre=?"
		,[$_POST["eposta"],sha1($_POST["sifre"])]);
	
	if(is_null($gelen_veriler)) Get_Hata_Sayfasi("Kayıtlı kullanıcı bulunamadı.","uyari");
	else if(isset($gelen_veriler))
		{
			$konuacma=0;
			$mesajyazma=0;
			$engeller=$model->Engellenenler();
			$engeller=$engeller->Select([],"where kullanici_id=?",[$gelen_veriler[0]["id"]]);
			foreach ($engeller as $value) {
				if(strtotime(date("Y-m-d"))<=strtotime($value["engel_suresi"])){
					if($value["engel_tipi"]=="konu-acma")
						$konuacma++;
					else
						$mesajyazma++;
				}
			}
			$gelen_veriler[0]["konuacma"]=$konuacma;
			$gelen_veriler[0]["mesajyazma"]=$mesajyazma;
			$_SESSION['kullanici'] = $gelen_veriler;
		}
	else Get_Hata_Sayfasi("Bir hata ile karşılaşıldı.","hata");


	
	Onceki_Sayfa();
}

function Post_Yeni_Konu_Olustur(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}
	if($_SESSION['kullanici'][0]["konuacma"]>0)
		{Get_Hata_Sayfasi("Konu acma engeliniz bulunmaktadır.","hata");Onceki_Sayfa();return;}

	$model=new Tum_Tablolar();
	$konular=$model->Konular();
	$konular->id=intval($_POST["id"]);
	if(isset($_POST["konu_id"]))
		$konular->konu_id=intval($_POST["konu_id"]);
	$konular->baslik=$_POST["baslik"];
	$konular->kategori_id=intval($_POST["kategori"]);
	$konular->durum="true";
	$konular->icerik=$_POST["icerik"];
	$konular->tarih=date("Y.m.d");
	$konular->kullanici_id=intval($_SESSION["kullanici"][0]["id"]);

	if($konular->id>0)
		$cevap=$konular->Update("",[]);
	else
		$cevap= $konular->Insert("",[]);
	if ($cevap>0) 
		Get_Hata_Sayfasi("Konunuz oluşturuldu.","basarili");
	else if ($cevap<=0) 
		Get_Hata_Sayfasi("Bir hata oluştu tekrar deneyiniz.","hata");
	Get_Profil();

}



function Post_Sikayet_Olustur(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}

	$model=new Tum_Tablolar();
	$sikayetler=$model->Sikayetler();
	$sikayetler->aciklama=$_POST["aciklama"];
	$sikayetler->link=$_SERVER['HTTP_REFERER'].'#'.$_POST["sikayet_edilen_id"];
	$sikayetler->sikayet_eden_id=$_SESSION["kullanici"][0]["id"];
	$sikayetler->sikayet_edilen_id=$_POST["sikayet_edilen_id"];
	$sikayetler->tarih=date("d.m.Y");
	$sikayetler->durum="true";
	$cevap=$sikayetler->Insert();
	if($cevap>0){
		Get_Hata_Sayfasi("Şikayetiniz alındı","basarili");
	}else{
		Get_Hata_Sayfasi("İşleminiz başarısız. Tekrar deneyin","hata");
	}

	$geldigi_sayfa = $_SERVER['HTTP_REFERER']; 
	header("Location:$geldigi_sayfa");
}


function Post_Yeni_Mesaj_Olustur(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}
	if($_SESSION['kullanici'][0]["mesajyazma"]>0)
		{Get_Hata_Sayfasi("Mesaj yazma engeliniz bulunmaktadır.","hata");Onceki_Sayfa();return;}
	
	$model=new Tum_Tablolar();

	if (isset($_POST["icerik"]) && isset($_POST["id"])) {
		
		$mesaj=$model->Mesajlar();
		$mesaj->mesaj_id=intval($_POST["id"]);
		$mesaj->icerik=$_POST["icerik"];
		$mesaj->gonderen_id=$_SESSION["kullanici"][0]["id"];
		$mesaj->alan_id=intval($_POST["gonderen_id"]);
		$mesaj->durum="true";
		$mesaj->tarih=date("Y-m-d");
		$cevap= $mesaj->Insert("",[]);
		if($cevap>0) Get_Hata_Sayfasi("Mesaj Gönderildi.","basarili");
		else Get_Hata_Sayfasi("Mesaj göndermede hada oluştu.","uyari");
	}else if (isset($_POST["icerik"]) && isset($_POST["kullanici_id"])) {
		$mesaj=$model->Mesajlar();
		$mesaj->icerik=$_POST["icerik"];
		$mesaj->baslik=$_POST["baslik"];
		$mesaj->gonderen_id=$_SESSION["kullanici"][0]["id"];
		$mesaj->alan_id=intval($_POST["kullanici_id"]);
		$mesaj->durum="true";
		$mesaj->tarih=date("Y-m-d");
		$cevap= $mesaj->Insert("",[]);

		if($cevap>0) Get_Hata_Sayfasi("Mesaj Gönderildi.","basarili");
		else Get_Hata_Sayfasi("Mesaj göndermede hada oluştu.","uyari");

		Get_Mesajlar();
		return;
	}
	else if(isset($_POST["kullanici_id"]) && isset($_POST["kullanici_adi"]) ){
		Get_Mesajlar();
		return;
	}

	header("Location:".Kok_Dizine_Yonlendir().$_POST["id"]."/mesaj-detay/gelengiden.html");
	return;
}

function Post_Begeni_Ret(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");Onceki_Sayfa(); return;}

	if (!Kullanici_Kontrolu() && isset($_POST["id"]) && intval($_POST["id"])>0 && isset($_POST["button"])){
		
		$geldigi_sayfa = $_SERVER['HTTP_REFERER']; 
		header("Location:$geldigi_sayfa");
		return;
	}

	$model=new Tum_Tablolar();
	$konular=$model->Konular();
	$veriler=$konular->Select(["id","begenme","begenmeme"],"where id=?",[$_POST["id"]]);
	$konular->id=intval($_POST["id"]);

	if ($_POST["button"]=="Sevdim") {
		$konular->begenme=(intval($veriler[0]["begenme"])+1);
		$konular->Update("",[]);
		
		Get_Hata_Sayfasi("begeni eklendi","basarili");
	}else if($_POST["button"]=="Sevmedim"){
		$konular->begenmeme=(intval($veriler[0]["begenmeme"])+1);
		$konular->Update("",[]);
		
		Get_Hata_Sayfasi("begeni eklendi","basarili");
	}else
		return;

	Onceki_Sayfa();
}

function Post_Kategori_Duzenle(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}

	$model=new Tum_Tablolar();
	$kategori=$model->Kategoriler();
	$kategori->id=intval($_POST['id']);
	$kategori->kategori_adi=$_POST["kategori_adi"];
	$kategori->aciklama=$_POST["aciklama"];
	$kategori->durum="true";
	$cevap= $kategori->Update("",[]);
	if($cevap>0){
		Get_Hata_Sayfasi("Kategori güncellendi","basarili");
	}else{
		Get_Hata_Sayfasi("Kategori güncellenemedi","uyari");
	}


	$geldigi_sayfa = $_SERVER['HTTP_REFERER']; 
	header("Location:$geldigi_sayfa");
	return;
}

function Post_Kategori_Ekle(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}

	$model=new Tum_Tablolar();
	$kategori=$model->Kategoriler();
	$kategori->kategori_adi=$_POST["kategori_adi"];
	$kategori->aciklama=$_POST["aciklama"];
	$kategori->durum="true";
	$cevap= $kategori->Insert("",[]);
	if($cevap>0){
		Get_Hata_Sayfasi("Kategori eklenedi","basarili");
	}else{
		Get_Hata_Sayfasi("Kategori eklenemedi","uyari");
	}


	$geldigi_sayfa = $_SERVER['HTTP_REFERER']; 
	header("Location:$geldigi_sayfa");
	return;
}

function Post_Kullanici_Engelle(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}

	if (isset($_POST["engel_tipi"]) && isset($_POST["engel_tipi"])) {
		$model=new Tum_Tablolar();
		$engeller=$model->Engellenenler();
		

		$kullanici=$model->Konular();
		$kullanici=$kullanici->Select(["kullanici_id"],"where id=?",[$_POST["kullanici_id"]]);

		$engeller->kullanici_id=intval($kullanici[0]["kullanici_id"]);

		$engeller->engel_tipi=$_POST["engel_tipi"];
		$engeller->engel_suresi=$_POST["tarih"];
		$engeller->engelleme_tarihi=date("Y-m-d");
		$sonuc= $engeller->Insert("",[]);

		$sikayet=$model->Sikayetler();
		$sikayet->id=intval($_POST['sikayet_id']);
		$sikayet->durum="false";
		$sikayet->Update("",[]);
		if($sonuc>0)
			Get_Hata_Sayfasi("Kullanıcı engellendi.","basarili");
		else
			Get_Hata_Sayfasi("Bir hata oluştu tekrar deneyin","uyari");
	}
	
}
function Post_Profil_Resim_EkleDegis(){
	if(!Kullanici_Kontrolu()){Get_Hata_Sayfasi("Bilk önce giriş yapmanız gerekiyor","uyari");return;}
	
	if(isset($_FILES['dosya'])) {
	   Get_Hata_Sayfasi("Dosya yüklenmemiş.","uyari");
	   Onceki_Sayfa();
	} 

	$tip = $_FILES['dosya']['type'];
    $isim = $_FILES['dosya']['name'];
    $uzanti = explode('.', $isim);
    $uzanti = $uzanti[count($uzanti)-1];
    if($uzanti=="jpg" || $uzanti=="jpeg" || $uzanti=="png"){
    	$model=new Tum_Tablolar();
    	$galeri_kontrol=$model->Galeri();
    	$galeri_kontrol=$galeri_kontrol->Select([],"where kategori_id=? and resim_kategorisi='profil'",[intval($_SESSION["kullanici"][0]["id"])]);
    	if(count($galeri_kontrol)>0){
    		$dosya = $_FILES['dosya']['tmp_name'];
			copy($dosya, '../img/profil/' . $_FILES['dosya']['name']);

    		$galeri=$model->Galeri();
    		$galeri->id=intval($galeri_kontrol[0]["id"]);
    		$galeri->resim_yol="img/profil/".$_FILES['dosya']['name'];
    		$cevap=$galeri->Update("",[]);
    		

    		if($cevap>0)Get_Hata_Sayfasi("Resim başarılı birşekilde güncellendi","basarili");
    		else Get_Hata_Sayfasi("Başarısız resim güncelleme","hata");
    	}else 
    	{
    		$dosya = $_FILES['dosya']['tmp_name'];
			copy($dosya, '../img/profil/' . $_FILES['dosya']['name']);

    		$galeri=$model->Galeri();
    		$galeri->resim_kategorisi="profil";
    		$galeri->kategori_id=intval($_SESSION["kullanici"][0]["id"]);
    		$galeri->resim_yol="img/profil/".$_FILES['dosya']['name'];
    		$cevap=$galeri->Insert("",[]);
    		if($cevap>0)Get_Hata_Sayfasi("Resim başarılı birşekilde eklenedi".$cevap,"basarili");
    		else Get_Hata_Sayfasi("Başarısız resim ekleme","hata");
    	}
		
    }

    Onceki_Sayfa();

}

?>