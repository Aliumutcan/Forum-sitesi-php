<?php

class Veritabani_Islemleri{

	public $baglanti_durum="";

	private function Baglanti_Olustur(){
		try {

			$baglanti2=new mysqli("localhost","root","password","forum");
			
			if ($baglanti2->connect_errno) {
				$this->baglanti_durum="0bağlantı başarısız";
				throw new Exception("baglanti hatası");
				exit();
			}
				$this->baglanti_durum="1bağlantı işlemi başarılı"; 
				$baglanti2->set_charset("utf8");
				return $baglanti2;
		} catch (Exception $e) {
			$this->baglanti_durum="0İşlem başarısız hata:";
		}
		
	}

	public function Select($tablo,$getirilecekler,$sart,$sart_parametreleri){
		$baglanti=self::Baglanti_Olustur();
		$sorgu_cumlesi="SELECT ";

		if (!empty($getirilecekler)) {
			for ($i=0; $i <count($getirilecekler) ; $i++) { 
				if ($i==(count($getirilecekler)-1)) {
					$sorgu_cumlesi=$sorgu_cumlesi." ".$getirilecekler[$i];
				}else
					$sorgu_cumlesi=$sorgu_cumlesi." ".$getirilecekler[$i].",";
			}
		}else
			$sorgu_cumlesi=$sorgu_cumlesi."* ";
		



		$sorgu_cumlesi=$sorgu_cumlesi." FROM ".get_class($tablo);
		if (strlen($sart)>0) 
			$sorgu_cumlesi=$sorgu_cumlesi." ".$sart;


		$kontrol = $baglanti->prepare($sorgu_cumlesi);
		$kod="";
		$dizidegerleri=array("kod");
		if (count($sart_parametreleri)>0) {
			
			foreach ($sart_parametreleri as $value){ 
				$dizidegerleri[]=$value;
				switch (gettype($value)) {
					case 'string':
						$kod=$kod."s";
						break;
					case 'integer':
						$kod=$kod."i";
						break;
					case 'double':
						$kod=$kod."d";
						break;
					case 'boolean ':
						$kod=$kod."i";
						break;
					default:
						return 0;
						break;
				}	
			}
			$dizidegerleri[0]=$kod;	
			//return $sorgu_cumlesi.var_dump($dizidegerleri);
			call_user_func_array(array($kontrol, 'bind_param'), self::refValues($dizidegerleri));
		}
		
		$kontrol->execute();
		$sonuc=$kontrol->get_result();
		$veriler=NULL;
		while ($data = $sonuc->fetch_assoc())
            $veriler[] = $data;
		$kontrol->close();
		$baglanti->close();
		return $veriler;
	}

	public function Delete($tablo,$sart,$sart_parametreleri){
		$baglanti=self::Baglanti_Olustur();
		$sorgu_cumlesi="DELETE FROM ".get_class($tablo)." ".$sart;
		$kontrol = $baglanti->prepare($sorgu_cumlesi);

		$dizidegerleri=array("kod");
		if (count($sart_parametreleri)>0) {
			$kod="";
			foreach ($sart_parametreleri as $value){ 
				$dizidegerleri[]=$value;
				switch (gettype($value)) {
					case 'string':
						$kod=$kod."s";
						break;
					case 'integer':
						$kod=$kod."i";
						break;
					case 'double':
						$kod=$kod."d";
						break;
					case 'boolean ':
						$kod=$kod."i";
						break;
					default:
						return 0;
						break;
				}	
			}
			$dizidegerleri[0]=$kod;		
		}

		call_user_func_array(array($kontrol, 'bind_param'), self::refValues($dizidegerleri));

		$kontrol->execute();
		$veriler= $kontrol->affected_rows;
		$kontrol->close();
		$baglanti->close();

		return $veriler;		
	}

	public function Insert($tablo,$sart,$sart_parametreleri){
		$baglanti=self::Baglanti_Olustur();
		$veriler;
		$sorgu="INSERT INTO ".get_class($tablo)." (";
		$sorguikinciparca="VALUES(";
		$kod="";

		foreach (get_object_vars($tablo) as $key => $value) {
			if($key=="id")
				continue;
			switch (gettype($value)) {
				case 'string':
					$kod=$kod."s";
					break;
				case 'integer':
					$kod=$kod."i";
					break;
				case 'double':
					$kod=$kod."d";
					break;
				case 'boolean':
					$kod=$kod."i";
					break;
				default:
					return 0;
					break;
			}			
			$sorguikinciparca=$sorguikinciparca."?,";
			$sorgu=$sorgu.$key.",";			
		}
		
		$sorgu= substr($sorgu,0 ,strlen($sorgu)-1);
		$sorguikinciparca= substr($sorguikinciparca,0 ,strlen($sorguikinciparca)-1);
		$sorgu=$sorgu.") ".$sorguikinciparca.")";
		$sorgu=$sorgu." ".$sart;
		$kontrol=$baglanti->prepare($sorgu);

		$dizidegerleri=array($kod);
		foreach (get_object_vars($tablo) as $key => $value) {
			if($key!="id")
				$dizidegerleri[]=$value;
		}

		if (count($sart_parametreleri)>0) {
			foreach ($sart_parametreleri as $value){ 
				$dizidegerleri[]=$value;
				switch (gettype($value)) {
					case 'string':
						$kod=$kod."s";
						break;
					case 'integer':
						$kod=$kod."i";
						break;
					case 'double':
						$kod=$kod."d";
						break;
					case 'boolean ':
						$kod=$kod."i";
						break;
					default:
						return 0;
						break;
				}	
			}
			$dizidegerleri[0]=$kod;		
		}
		call_user_func_array(array($kontrol, 'bind_param'), self::refValues($dizidegerleri));

		$kontrol->execute();
		$veriler= $kontrol->affected_rows;
		$kontrol->close();
		$baglanti->close();

		return $veriler;
	}

	public function Update($tablo,$sart,$sart_parametreleri){
		$baglanti=self::Baglanti_Olustur();
		$veriler;
		$sorgu_cumlesi="UPDATE ".get_class($tablo)." SET ";
		$sorgu_sarti=" ";
		$kod="";
		foreach (get_object_vars($tablo) as $key => $value) {
			
			if ($key=="id" && $value>0) {
				$sorgu_sarti=$sorgu_sarti."WHERE $key=$value ";
				continue;
			}else if($key=="id")continue;

			if ((gettype($value)=="string" && !empty($value)) || ((gettype($value)=="integer" || gettype($value)=="double" || gettype($value)=="boolean") && $value>0)) {
				$sorgu_cumlesi=$sorgu_cumlesi." $key=? ,";
				switch (gettype($value)) {
					case 'string':
						$kod=$kod."s";
						break;
					case 'integer':
						$kod=$kod."i";
						break;
					case 'double':
						$kod=$kod."d";
						break;
					case 'boolean ':
						$kod=$kod."i";
						break;
					default:
						return 0;
						break;
				}			
			}
			
		}
		$sorgu_cumlesi=substr($sorgu_cumlesi, 0,strlen($sorgu_cumlesi)-1);
		$sorgu_cumlesi=$sorgu_cumlesi.$sorgu_sarti;

		if (strrpos($sorgu_cumlesi, "WHERE") === 1 && strlen($sart)>1) 
			$sorgu_cumlesi=$sorgu_cumlesi." and ".$sart;
		else if(strlen($sart)>1)	
			$sorgu_cumlesi=$sorgu_cumlesi." WHERE ".$sart;

		$kontrol=$baglanti->prepare($sorgu_cumlesi);

		$dizidegerleri=array($kod);
		foreach (get_object_vars($tablo) as $key => $value) {
			if($key!="id" && ((gettype($value)=="string" && !empty($value)) || ((gettype($value)=="integer" || gettype($value)=="double") && $value>0)))
				$dizidegerleri[]=$value;
		}
		if (count($sart_parametreleri)>0) {
			foreach ($sart_parametreleri as $value){ 
				$dizidegerleri[]=$value;
				switch (gettype($value)) {
					case 'string':
						$kod=$kod."s";
						break;
					case 'integer':
						$kod=$kod."i";
						break;
					case 'double':
						$kod=$kod."d";
						break;
					case 'boolean ':
						$kod=$kod."i";
						break;
					default:
						return 0;
						break;
				}	
			}
			$dizidegerleri[0]=$kod;		
		}
		call_user_func_array(array($kontrol, 'bind_param'), self::refValues($dizidegerleri));


		$kontrol->execute();
		$veriler=$kontrol->affected_rows;
		$kontrol->close();
		$baglanti->close();

		return $veriler;

	}
 	public function Sql_cumlesi($sorgu_cumlesi,$parametreleri){
 		$baglanti=self::Baglanti_Olustur();
 		$kontrol = $baglanti->prepare($sorgu_cumlesi);
		$kod="";
 		$dizidegerleri=array("kod");
 		if (count($parametreleri)>0) {
			
			foreach ($parametreleri as $value){ 
				$dizidegerleri[]=$value;
				switch (gettype($value)) {
					case 'string':
						$kod=$kod."s";
						break;
					case 'integer':
						$kod=$kod."i";
						break;
					case 'double':
						$kod=$kod."d";
						break;
					case 'boolean ':
						$kod=$kod."i";
						break;
					default:
						return 0;
						break;
				}	
			}
			$dizidegerleri[0]=$kod;
			call_user_func_array(array($kontrol, 'bind_param'), self::refValues($dizidegerleri));
		}
		
		$kontrol->execute();
		$sonuc=$kontrol->get_result();
		$veriler=NULL;
		if ($sonuc==False) {
			$sonuc=$kontrol->affected_rows;
			return $sonuc;
		}
		while ($data = $sonuc->fetch_assoc())
            $veriler[] = $data;
		$kontrol->close();
		$baglanti->close();
		return $veriler;
 	}
	private function refValues($arr){
        if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
        {
            $refs = array();
            foreach($arr as $key => $value)
                $refs[$key] = &$arr[$key];
            return $refs;
        }
        return $arr;
    }


}

class Islemler{
	public function Select($getirilecekler,$sart,$sart_parametreleri){
		$model=new Veritabani_Islemleri();
		$sonuc= $model->Select($this,$getirilecekler,$sart,$sart_parametreleri);
		return $sonuc;
	}

	public function Delete($sart,$sart_parametreleri){
		$model=new Veritabani_Islemleri();
		$sonuc= $model->Delete($this,$sart,$sart_parametreleri);
		return $sonuc;
	}

	public function Insert($sart,$sart_parametreleri){
		$model=new Veritabani_Islemleri();
		$sonuc= $model->Insert($this,$sart,$sart_parametreleri);
		return $sonuc;
	}

	public function Update($sart,$sart_parametreleri){
		$model=new Veritabani_Islemleri();
		$sonuc= $model->Update($this,$sart,$sart_parametreleri);
		return $sonuc;
	}
	public function Sql_cumlesi($sorgu_cumlesi,$parametreleri){
		$model=new Veritabani_Islemleri();
		$sonuc= $model->Sql_cumlesi($sorgu_cumlesi,$parametreleri);
		return $sonuc;
	}
}

?>