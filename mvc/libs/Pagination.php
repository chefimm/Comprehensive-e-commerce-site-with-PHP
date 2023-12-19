<?php

class  Pagination {
	
	
	
	public $limit,$toplamsayfa,$sayfam,$gosterilecekadet;
	
	
	function paginationOlustur($verisayisi,$mevcutsayfa,$adet) {
		
	
		$this->gosterilecekadet=$adet;	
		
		$this->toplamsayfa=ceil($verisayisi / $this->gosterilecekadet);
			
		$this->sayfam=is_numeric($mevcutsayfa) ? $this->sayfam=$mevcutsayfa : $this->sayfam=1;
				
		if ($this->sayfam<1) $this->sayfam=1; 
		
		if ($this->sayfam > $this->toplamsayfa) $this->sayfam=$this->toplamsayfa; 
		
		$this->limit= ($this->sayfam -1) * $this->gosterilecekadet; 
		
		
		
	/*
	
	sayfa 1 =  $limit değeri = 0
	sayfa 2 =  $limit değeri = 2
	sayfa 3 =  $limit değeri = 4
	sayfa 4 =  $limit değeri = 6
					
		 		
		$limit,$gosterilecekadet
		  0         2 -- 2 kayıtta
		  2         2 -- 4.kayıtta
		  4         2 -- 6
		  6	        2 -- 8
	
	*/
	
		
	}
	
	
	public static function numaralar($toplamsayfa,$link) {
		
		
		        echo '<nav aria-label="Page navigation example">
                    
                    <ul class="pagination pagination-lg">';
					
					for ($s=1; $s<=$toplamsayfa; $s++) :
					echo '<li class="page-item ">
					<a class="page-link" href="'.URL.$link.$s.'">'.$s.'</a>
					
					</li>';
					
					endfor;
                    
               echo'</ul>
                    </nav>'; 
	
	
		
	}
	
	

	
}




?>