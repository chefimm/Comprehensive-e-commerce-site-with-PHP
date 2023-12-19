<?php

class adminpanel_model extends Model {
	
	public $basliklar,$icerikler;
	
	function __construct() {		
		parent:: __construct();
	}
	
	function bakim($deger) {
		
		return $this->db->sistembakim($deger);
		
	}	
	function yedek($deger) {
		
		return $this->db->veritabaniyedek($deger);
		
	}	
	
	function Verial($tabloisim,$kosul) {
		
		return $this->db->listele($tabloisim,$kosul);
		
	}
	function SpesifikVerial($tabloisim) {
		
		return $this->db->spesifiklistele($tabloisim);
		
	}
	
	
	
	
	function Guncelle($tabloisim,array $sutunlar,array $veriler,$kosul) {
		
		
		return $this->db->guncelle($tabloisim,$sutunlar,$veriler,$kosul);
	}
	
	function Arama($tabloisim,$kosul) {		
		
		
		return $this->db->arama($tabloisim,$kosul);
	}
	function AramaSayiAl($tabloisim,$kosul) {		
		
		
		return $this->db->aramasayi($tabloisim,$kosul);
	}
	
	function Sil($tabloisim,$kosul) {
		
		return $this->db->sil($tabloisim,$kosul);
		
	}
	function Ekleme($tabloisim,$sutunlar,$veriler) {
		
		
		return $this->db->Ekle($tabloisim,$sutunlar,$veriler);
	}
	
	function TopluEkleme($tabloisim,$sutunlar,$veriler) {
		
		
		return $this->db->topluEkle($tabloisim,$sutunlar,$veriler);
	}
	
	
	
	function GirisKontrol($tabloisim,$kosul) {
		
		return $this->db->giriskontrol($tabloisim,$kosul);		
		
	}
	
		function sayfalama($tabload) {
		
		return $this->db->sayfalamaAdet($tabload);
		
	}
	function tekliveri($sutun,$kosul) {
		
		return $this->db->teklistele($sutun,$kosul);
		
	}
	
		function joinislemi($istenilenveriler,$tablolar,$kosul) {
		
		
		return $this->db->joinislemi($istenilenveriler,$tablolar,$kosul);
	}
	
	function ExcelAyarCek($tabloisim,$kosul,$bolum) {
	
		switch ($bolum):

		case "bulten":	
			foreach ($this->db->listele($tabloisim,$kosul) as $degerler):
			$this->icerikler[]=array($degerler["mailadres"]);
			endforeach;		
		break;
			
	endswitch;
		
	}
	
	function ExcelAyarCek2($tabloisim) {
	
		
	$this->icerikler[]=$this->db->spesifiklistele($tabloisim);
			

		
	}
	
	function TopluislemBaslat() {		
	return $this->db->beginTransaction();	
		
	}
	
	function TopluislemTamamla() {
	return $this->db->commit();
	}	
	
	function İslemlerigerial() {
	return $this->db->rollBack();
	}	
	
	
	
}




?>