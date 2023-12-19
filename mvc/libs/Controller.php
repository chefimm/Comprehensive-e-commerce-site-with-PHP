<?php

class  Controller {
	
	

	// ihtyiacımız olan model'i dahil ediyoruz
	public function Modelyukle($name) {
		
		$yol='model/'.$name.'_model.php';
		
		if (file_exists($yol)) :
		
		require $yol;
		
		$modelsinifName=$name.'_model';
		
		$this->model= new $modelsinifName();
		
		endif;
		
		
	}
	
	public function RouterModelyukle($name) {
		
		$yol='model/'.$name.'_model.php';
		
		if (file_exists($yol)) :
		
		require $yol;
		
		$modelsinifName=$name.'_model';
		
		return new $modelsinifName();
		
		endif;
		
		
	}
	
	
	function KutuphaneYukle(array $ad) {
		
		foreach ($ad as $deger):
		
		$this->$deger = new $deger();			
			
		endforeach;		
		
		
	}
	

	

	
}




?>