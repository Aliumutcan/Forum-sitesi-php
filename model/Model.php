<?php

include 'Kullanicilar.php';
include 'Engellenenler.php';
include 'Kategoriler.php';
include 'Konular.php';
include 'Log.php';
include 'Mesajlar.php';
include 'Sikayetler.php';
include 'Galeri.php';

class Tum_Tablolar{

	public function Kullanicilar(){
		return new Kullanicilar();
	}
	public function Engellenenler(){
		return new Engellenenler();
	}
	public function Kategoriler(){
		return new Kategoriler();
	}
	public function Konular(){
		return new Konular();
	}
	public function Log(){
		return new Log();
	}
	public function Mesajlar(){
		return new Mesajlar();
	}
	public function Sikayetler(){
		return new Sikayetler();
	}
	public function Galeri(){
		return new Galeri();
	}
}
?>