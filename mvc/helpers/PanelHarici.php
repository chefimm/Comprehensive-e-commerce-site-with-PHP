<?php


class  PanelHarici  extends Model {
	

	public $sonuc,$siparisYonetim,$kategoriYonetim,$uyeYonetim,$urunYonetim,$muhasebeYonetim,$yoneticiYonetim,$bultenYonetim,$sistemayarYonetim,$sistembakimYonetim,$yoneticiYetki;
	
	
	function __construct() {	
	
	parent::__construct();

	$this->sonuc=$this->db->listele("yonetim", "where id=".Session::get("Adminid"));

	@$this->siparisYonetim=$this->sonuc[0]["siparisYonetim"];
	@$this->kategoriYonetim=$this->sonuc[0]["kategoriYonetim"];
	@$this->uyeYonetim=$this->sonuc[0]["uyeYonetim"];
	@$this->urunYonetim=$this->sonuc[0]["urunYonetim"];
	@$this->muhasebeYonetim=$this->sonuc[0]["muhasebeYonetim"];
	@$this->yoneticiYonetim=$this->sonuc[0]["yoneticiYonetim"];
	@$this->bultenYonetim=$this->sonuc[0]["bultenYonetim"];
	@$this->sistemayarYonetim=$this->sonuc[0]["sistemayarYonetim"];
	@$this->sistembakimYonetim=$this->sonuc[0]["sistembakimYonetim"];
	@$this->yoneticiYetki=$this->sonuc[0]["yetki"];
	
	}		

	
	function MenuKontrol() {
		
		if ($this->siparisYonetim==1) :
		?>
		
		
		
		     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsesiparisler" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-donate"></i>
          <span>Sipariş Yönetimi</span>
        </a>
        <div id="collapsesiparisler" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
		   <a class="collapse-item" href="<?php echo URL."/panel/siparisler";  ?>">Siparişler</a>
            <a class="collapse-item" href="<?php echo URL."/panel/siparisiade";  ?>">İade İşlemleri</a>
            <a class="collapse-item" href="<?php echo URL."/panel/siparisdetayliarama";  ?>">Detaylı Arama</a>
            
          </div>
        </div>
      </li>
       
        
        <?php
		
		endif;
		
		
		
			if ($this->kategoriYonetim==1) :
		?>
        
        <li class="nav-item">
        <a class="nav-link" href="<?php echo URL."/panel/kategoriler";  ?>">
          <i class="fas fa-sliders-h"></i>
          <span>Kategori Yönetimi</span></a>
      </li>
        
        <?php
		
		endif;
		
		
      		if ($this->uyeYonetim==1) :
		?>
        
           <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseuyeler" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-user"></i>
          <span>Üye Yönetimi</span>
        </a>
        <div id="collapseuyeler" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo URL."/panel/uyeler";  ?>">Üyeler</a>
            <a class="collapse-item" href="<?php echo URL."/panel/musteriyorumlar";  ?>">Üye Yorumları</a>
            
          </div>
        </div>
      </li>
        
        <?php
		
		endif;
    
      
      	if ($this->urunYonetim==1) :
		?>
        
    <li class="nav-item">
        <a class="nav-link" href="<?php echo URL."/panel/urunler";  ?>">
          <i class="fas  fa-award"></i>
          <span>Ürün Yönetimi</span></a>
      </li>
        
        <?php
		
		endif;
      
	  
	    
      	if ($this->muhasebeYonetim==1) :
		?>
        
               <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsemuhasebe" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-hand-holding-usd"></i>
          <span>Muhasebe</span>
        </a>
        <div id="collapsemuhasebe" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo URL."/panel/muhaseberapor"; ?>">Muhasebe</a>
            <a class="collapse-item" href="<?php echo URL."/panel/bankabilgileri"; ?>">Banka Bilgileri</a>
            
          </div>
        </div>
      </li>
        
        <?php
		
		endif;
		
		
		     	if ($this->yoneticiYonetim==1) :
		?>
        
		          <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepazarlama" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-compass"></i>
          <span>Pazarlama Yönetimi</span>
        </a>
        <div id="collapsepazarlama" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo URL."/panel/smsislemleri";  ?>">Sms İşlemleri</a>
            <a class="collapse-item" href="<?php echo URL."/panel/mailislemleri";  ?>">Mail İşlemleri</a>
            
          </div>
        </div>
      </li>
		
		
	
        
        <?php
		
		endif;
   
      
      
      
          	if ($this->yoneticiYonetim==1) :
		?>
        
   <li class="nav-item">
        <a class="nav-link" href="<?php echo URL."/panel/yonetici";  ?>">
          <i class="fas fa-lock"></i>
          <span>Yönetici Yönetimi</span></a>
      </li>
        
        <?php
		
		endif;
     
           
          	if ($this->bultenYonetim==1) :
		?>
        
     <li class="nav-item">
        <a class="nav-link" href="<?php echo URL."/panel/bulten";  ?>">
          <i class="fas  fa-envelope-square"></i>
          <span>Bülten Yönetimi</span></a>
      </li>
        
        <?php
		
		endif;
		
		
		if ($this->sistemayarYonetim==1) :
		?>
		
		
		        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsetasarim" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas  fa-paint-brush"></i>
          <span>Tasarım Yönetimi</span>
        </a>
        <div id="collapsetasarim" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">		  
		  
            <a class="collapse-item" href="<?php echo URL."/panel/slideryonetimi";  ?>">Slider</a>
			
          <a class="collapse-item" href="<?php echo URL."/panel/renkyonetimi";  ?>">Renk Yönetimi</a>
	 
            
          </div>
        </div>
      </li>
        
        <?php
		
		endif;
		
		
      
      
       if ($this->sistemayarYonetim==1) :
		?>
		
		
		        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsesistemayar" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas  fa-wrench"></i>
          <span>Sistem Ayarları</span>
        </a>
        <div id="collapsesistemayar" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">		  
		  
            <a class="collapse-item" href="<?php echo URL."/panel/sistemayar";  ?>">Ayarlar</a>
			
          <a class="collapse-item" href="<?php echo URL."/panel/sistembakim";  ?>">Bakım</a>
	 <a class="collapse-item" href="<?php echo URL."/panel/veritabaniyedek";  ?>">Yedek</a>
            
          </div>
        </div>
      </li>
        
        <?php
		
		endif;
		?>
		
		
		        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapselogin" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas  fa-user-circle"></i>
          <span>Kullanıcı İşlem</span>
        </a>
        <div id="collapselogin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
		  
            <a class="collapse-item" href="<?php echo URL."/panel/sifredegistir"; ?>">Şifre Değiştir</a>
			<a class="collapse-item" href="<?php echo URL."/panel/cikis"; ?>">Çıkış</a>
			
			            
          </div>
        </div>
      </li>
    
     <?php
   
		
	} // MENÜ KONTROL	
	
	function YetkisineBak ($alan) {
		
		if ($this->$alan!=1) :
		
		header("Location:".URL."/panel");
		
		exit();		
		
		endif;
		
		
		
		
	}
	
function kategorilerial ($istenilenveriler,$tablolar,$kosul) {	
			
		return $this->db->joinislemi($istenilenveriler,$tablolar,$kosul);
	}
	
function tekverial($tabload) {	
	
	return $this->db->listele($tabload);
	
	}
	
	function joinislemi($istenilenveriler,$tablolar,$kosul) {
		
		
		return $this->db->joinislemi($istenilenveriler,$tablolar,$kosul);
	}



	function Verial($tabloisim,$kosul) {
		
		return $this->db->listele($tabloisim,$kosul);
		
	}
	
	function İcnavigasyon($analink,$anaisim,$bulununanyer) {
	
	echo '
	<div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2 navigasyonunanasi">
	<a href="'.URL.'/panel/'.$analink.'" class="navigasyon">'.$anaisim.'</a> / '.$bulununanyer."</div>";
	
	}
	
 
}




?>