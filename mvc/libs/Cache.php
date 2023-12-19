<?php

class  Cache {
	
	public $dosya,$saniye,$type;
	
	
	
	function cacheKontrol($saniye2=false) {
					include 'config/cache.php';
							
					$parcala=explode('/',$_SERVER['REQUEST_URI']);
		
		
					
					if (in_array(end($parcala),$cacheNo)) :
					
					$this->type=false;
					
					else:
					
					$this->type=true;
					endif;	
					
					
					
		if ($this->type):
			
		
		
		 if ($saniye2):
		 $this->saniye=$saniye2;	
		 else:		
		 $this->saniye=$CacheSure["saniye"];		
		 endif;
		
	
		$this->dosya=CACHEYOL.md5($_SERVER['REQUEST_URI']).".html";		
	
		if (file_exists($this->dosya) && (time() - $this->saniye < filemtime($this->dosya))):
		
		
		readfile($this->dosya);
		
		exit();
		
		endif;
			
		
		ob_start();
		
		
		
					
					endif;
	
	}
	
	function cacheOlustur() {
		
		if ($this->type):
		
			$dosya=fopen($this->dosya,"w");
			fwrite($dosya,ob_get_contents());
			fclose($dosya);
			ob_end_flush();
		
		endif;
		
	
		
		
	}
	
	

	
}




?>