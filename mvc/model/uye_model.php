<?php

class uye_model extends Model {
	
	
	function __construct() {		
		parent:: __construct();
	}
	
	
	
	function GirisKontrol($tabloisim,$kosul) {
		
		return $this->db->giriskontrol($tabloisim,$kosul);		
		
	}	
		
	function Ekleİslemi($tabloisim,$sutunadlari,$veriler) {
		
		return $this->db->Ekle($tabloisim,$sutunadlari,$veriler);	
		
		
	}
	
	
	function UyeliksizekleİslemiToptan($tabloisim,$sutunadlari,$veriler,$adres,$tabloisim3,$sutunadlari3,$veriler3) {
		
		return $this->db->UyeliksizAlisveris($tabloisim,$sutunadlari,$veriler,$adres,$tabloisim3,$sutunadlari3,$veriler3);	
		
		
	}
	
	
	function VerileriAl($tabloisim,$kosul) {
		
		return $this->db->listele($tabloisim,$kosul);		
		
	}
	
	function Silmeİslemi($tabloisim,$kosul) {
		
		return $this->db->sil($tabloisim,$kosul);		
		
	}	
	
	function Guncelleİslemi($tabloisim,$sutunlar,$veriler,$kosul) {
		
		
		return $this->db->guncelle($tabloisim,$sutunlar,$veriler,$kosul);	}
	


	
	function TopluislemBaslat() {		
	return $this->db->beginTransaction();	
		
	}
	
	function TopluislemTamamla() {
	return $this->db->commit();
	}	
	
	function SiparisTamamlama($veriler) {
	
	return $this->db->siparisTamamla($veriler);
		
	} // SİPARİŞ TAMAMLAMA


		function tekliveri($sutun,$kosul) {
		
		return $this->db->teklistele($sutun,$kosul);
		
	}

	
}




?>