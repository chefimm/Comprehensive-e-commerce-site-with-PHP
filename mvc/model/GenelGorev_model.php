<?php

class GenelGorev_model extends Model {
	
	
	function __construct() {		
		parent:: __construct();
	}
	
		function Verial($tabloisim,$kosul) {
		
		return $this->db->listele($tabloisim,$kosul);	
		
	}
	
		function Guncelle($tabloisim,$sutunlar,$veriler,$kosul) {
		
		
		return $this->db->guncelle($tabloisim,$sutunlar,$veriler,$kosul);
	}
	
	
	function Eklemeİslemi($tabloisim,$sutunadlari,$veriler) {
		
		return $this->db->Ekle($tabloisim,$sutunadlari,$veriler);
	
		
		
	}
	
		function Silmeİslemi($tabloisim,$kosul) {
		
		return $this->db->sil($tabloisim,$kosul);		
		
	}
	

	
}




?>