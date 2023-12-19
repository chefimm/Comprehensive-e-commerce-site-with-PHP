<?php require 'views/YonPanel/header.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid mt-3">

          <!-- Page Heading -->
          

          <div class="row ">
      <div class="col-xl-12 col-lg-12 col-md-12 mb-12 "> 
      
     
       
    
      
      <?php 
	  

	  	if (isset($veri["Bilgi"])) :
				
				
						if (is_array($veri["Bilgi"])) :
						
						?>
						 <script>
						 
		 BilgiPenceresi("<?php echo $veri["Bilgi"]["adres"]; ?>"," <?php echo $veri["Bilgi"]["baslik"]; ?>", "<?php echo $veri["Bilgi"]["metin"]; ?>","<?php echo $veri["Bilgi"]["durum"]; ?>");
		  </script>
					<?php	
					
					/*	foreach ($veri["Bilgi"] as $anahtar => $deger) :
						
						
			echo'<div class="alert alert-danger mt-5">'.$anahtar.'-'.$deger.'</div>';
						
					echo $veri["yonlen"];
						
						endforeach;
						
						echo $veri["Bilgi"]["adres"];*/
						
						else:
						
						echo $veri["Bilgi"];
						endif;
				
				
				
				endif;
				
		  if (isset($veri["YoneticiGuncelle"])) :

	
	  ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2 baslikana"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> YÖNETİCİ GÜNCELLE </h1></div>
<?php $PanelHarici->İcnavigasyon("yonetici","Yöneticiler","Yönetici Güncelle"); ?>                
 
          </div>
          <!-- BAŞLIK --> 	
      
         
            <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center" id="GuncelleformuAna"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-xl-4 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>Yönetici Güncelle</h3></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman  nocizgi">Yönetici Adı</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
					 
					  Form::Olustur("1",array(
					 "action" => URL."/panel/yonguncelle/son",
					 "method" => "POST"				
					 ));  
                    
 	 Form::Olustur("2",array("type"=>"yonad","class"=>"form-control","name"=>"yonadi","value"=>$veri["YoneticiGuncelle"][0]["ad"]));	       
                    
                 ?>  
                 </div>
                 
                 
                     
                 
                                                  
   <div class="col-lg-12 col-md-12 col-sm-12 formeleman  nocizgi">Genel Yetki</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
                    	 <?php 	
	
                    
 	 Form::OlusturSelect("1",array("name"=>"yetki","class"=>"form-control m-2"));	
	 
	 $yetkiler=array(
	 1 => "Tam Yetki",
	 2 => "Ürün Yetki",
	 3 => "Üye Yetki"
	 );
	 
	 
	 		 foreach ($yetkiler as $key => $deger) :
			 
				 if ($veri["YoneticiGuncelle"][0]["yetki"]==$key) :
				 
				 Form::OlusturOption(array("value"=>$key),"selected",$deger); 
				 else:
				  Form::OlusturOption(array("value"=>$key),false,$deger); 
				 
				 endif;
			
			
			 
			 endforeach;
	 			 
			
			 
	
 
 			  
			 Form::OlusturSelect("2",null);             
                    
                 ?>  
                 </div>
                 
                 
                 
                 
       <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Sipariş yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	
 <?php 	
Form::Olustur("2",array("type"=>"checkbox","name"=>"siparisYonetim"),false,$veri["YoneticiGuncelle"][0]["siparisYonetim"]==1 ? "checked" : NULL); ?>
</div>
       
       </div>
       
               </div>
               
                   <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Kategori yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	

Form::Olustur("2",array("type"=>"checkbox","name"=>"kategoriYonetim"),false,$veri["YoneticiGuncelle"][0]["kategoriYonetim"]==1 ? "checked" : NULL);   
                    
         
                    
                 ?></div>
       
       </div>
       
               </div>
               
                 
                 
             <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Üye yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
Form::Olustur("2",array("type"=>"checkbox","name"=>"uyeYonetim"),false,$veri["YoneticiGuncelle"][0]["uyeYonetim"]==1 ? "checked" : NULL);	
          
                    
                 ?></div>
       
       </div>
       
               </div>
                 
                              <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Ürün yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
Form::Olustur("2",array("type"=>"checkbox","name"=>"urunYonetim"),false,$veri["YoneticiGuncelle"][0]["urunYonetim"]==1 ? "checked" : NULL);	        
                    
                 ?></div>
       
       </div>
       
               </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Muhasebe yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
Form::Olustur("2",array("type"=>"checkbox","name"=>"muhasebeYonetim"),false,$veri["YoneticiGuncelle"][0]["muhasebeYonetim"]==1 ? "checked" : NULL);	
          
                    
                 ?></div>
       
       </div>
       
               </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Yönetici yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
	Form::Olustur("2",array("type"=>"checkbox","name"=>"yoneticiYonetim"),false,$veri["YoneticiGuncelle"][0]["yoneticiYonetim"]==1 ? "checked" : NULL);	
         
                    
                 ?></div>
       
       </div>
       
               </div>
               
                            <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Bülten yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
		Form::Olustur("2",array("type"=>"checkbox","name"=>"bultenYonetim"),false,$veri["YoneticiGuncelle"][0]["bultenYonetim"]==1 ? "checked" : NULL);	
         
                    
                 ?></div>
       
       </div>
       
       
               </div>
               
                            <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Sistem Ayar </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
		Form::Olustur("2",array("type"=>"checkbox","name"=>"sistemayarYonetim"),false,$veri["YoneticiGuncelle"][0]["sistemayarYonetim"]==1 ? "checked" : NULL);		
                    
       
                    
                 ?></div>
       
       </div>
       
               </div>
               
                            <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Sistem Bakım </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
Form::Olustur("2",array("type"=>"checkbox","name"=>"sistembakimYonetim"),false,$veri["YoneticiGuncelle"][0]["sistembakimYonetim"]==1 ? "checked" : NULL);     
                 ?></div>
       
       </div>
       
               </div>
                 
                                  
 
    <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-6 col-md-6 col-sm-6 text-right"><span id="sec" class="text-success">Tümünü Seç</span> </div>
       			<div class="col-lg-6 col-md-6 col-sm-6 text-left"><span id="kaldir" class="text-danger">Seçimi kaldır</span>	</div>
       
       </div>
       
               </div>
                             
           
         
                 
         
             
             
              <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi"><?php 		
			 Form::Olustur("2",array("type"=>"hidden","name" =>"yonid","value"=>$veri["YoneticiGuncelle"][0]["id"]));		
			 Form::Olustur("2",array("type"=>"submit","value"=>"YÖNETİCİ GÜNCELLE","class"=>"btn btn-success"));		

					 
			Form::Olustur("kapat");	 ?></div>  
             
             
             
             			</div>
                        
                        
  
                        
             
             
             </div>
              
 
      			 </div>
         </div>
         
           <!--  FORMUN İSKELETİ-->
      
      
      <?php 
	  
	
	  	  
	  endif; // YÖNETİCİ EKLEME
	  
	  //*****************************************************				
				
				
				
				
	  if (isset($veri["yoneticiekle"])) :

	
	  ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2 baslikana"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> YÖNETİCİ EKLE </h1></div>
 <?php $PanelHarici->İcnavigasyon("yonetici","Yöneticiler","Yönetici Ekle"); ?>                
 
          </div>
          <!-- BAŞLIK --> 	
      
         
            <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center" id="EklemeformuAna"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-xl-4 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>Yeni Yönetici Ekle</h3></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman  nocizgi">Yönetici Adı</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
					 
					  Form::Olustur("1",array(
					 "action" => URL."/panel/yonekle/son",
					 "method" => "POST"				
					 ));  
                    
 	 Form::Olustur("2",array("type"=>"yonad","class"=>"form-control","name"=>"yonadi"));	       
                    
                 ?>  
                 </div>
                 
                 
                 
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman  nocizgi">Şifre</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"password","class"=>"form-control","name"=>"sif1"));       
                    
                 ?>  
                 </div>
                 
                 
                                 
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman  nocizgi">Şifre (Tekrar)</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman  nocizgi">
                    	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"password","class"=>"form-control","name"=>"sif2"));            
                    
                 ?>  
                 </div>
                 
                 
                                                  
   <div class="col-lg-12 col-md-12 col-sm-12 formeleman  nocizgi">Genel Yetki</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
                    	 <?php 	
	
                    
 	 Form::OlusturSelect("1",array("name"=>"yetki","class"=>"form-control m-2"));				 
			
		
		  Form::OlusturOption(array("value"=>1),false,"Tam Yetki"); 	
		  Form::OlusturOption(array("value"=>2),false,"Ürün Yetki"); 	
		  Form::OlusturOption(array("value"=>3),false,"Üye Yetki");
 			  
			 Form::OlusturSelect("2",null);             
                    
                 ?>  
                 </div>
                 
                 
                 
                 
       <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Sipariş yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"checkbox","name"=>"siparisYonetim"));            
                    
                 ?></div>
       
       </div>
       
               </div>
               
                   <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Kategori yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"checkbox","name"=>"kategoriYonetim"));            
                    
                 ?></div>
       
       </div>
       
               </div>
               
                 
                 
             <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Üye yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"checkbox","name"=>"uyeYonetim"));            
                    
                 ?></div>
       
       </div>
       
               </div>
                 
                              <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Ürün yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"checkbox","name"=>"urunYonetim"));            
                    
                 ?></div>
       
       </div>
       
               </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Muhasebe yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"checkbox","name"=>"muhasebeYonetim"));            
                    
                 ?></div>
       
       </div>
       
               </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Yönetici yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"checkbox","name"=>"yoneticiYonetim"));            
                    
                 ?></div>
       
       </div>
       
               </div>
               
                            <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Bülten yönetimi </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"checkbox","name"=>"bultenYonetim"));            
                    
                 ?></div>
       
       </div>
       
       
               </div>
               
                            <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Sistem Ayar </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"checkbox","name"=>"sistemayarYonetim"));            
                    
                 ?></div>
       
       </div>
       
               </div>
               
                            <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-7 col-md-7 col-sm-7">Sistem Bakım </div>
       			<div class="col-lg-5 col-md-5 col-sm-5 text-left pt-1">	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"checkbox","name"=>"sistembakimYonetim"));            
                    
                 ?></div>
       
       </div>
       
               </div>
                 
        
        
                               <div class="col-lg-12 col-md-12 col-sm-12 formeleman  cizgi">
       <div class="row">
       			<div class="col-lg-6 col-md-6 col-sm-6 text-right"><span id="sec" class="text-success">Tümünü Seç</span> </div>
       			<div class="col-lg-6 col-md-6 col-sm-6 text-left"><span id="kaldir" class="text-danger">Seçimi kaldır</span>	</div>
       
       </div>
       
               </div>             
             
              <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
				  
			  <?php 		
		
			 Form::Olustur("2",array("type"=>"submit","value"=>"YÖNETİCİ EKLE","class"=>"btn btn-success"));		

					 
			Form::Olustur("kapat");	 ?></div> 
             
             			</div>             
             </div>              
 
      			 </div>
         </div>
         
           <!--  FORMUN İSKELETİ-->
      
      
      <?php 
	  
	
	  	  
	  endif; // YÖNETİCİ EKLEME
	  
	  //*****************************************************			
				
				
				

	 
	 // YÖNETİCİLER GELİYOR
	  if (isset($veri["data"])) :
	  
	
	   ?>
      

      
      <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-lg-8 col-xl-8 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> YÖNETİCİLER  </h1></div>
        
     <div class="col-lg- col-xl-4 col-md-12 mb-12 text-right"> 
                
        	<div class="col-xl-12 text-right">  <a href="<?php echo URL."/panel/yonekle/ilk";?>" class="btn btn-sm btn-success ">Yeni Yönetici Ekle</a>  </div>     
    
     </div>    
       
          </div>
          <!-- BAŞLIK --> 	
          
          
               <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12  mx-auto  text-center"> 
                
      	<!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        		 <div class="row arkaplan p-1 mt-2 pb-0 text-center mx-auto">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext">
                    <span><h5 class="text-danger">Kayıtlı Yönetici Sayısı : <?php echo count($veri["data"]); ?></h5></span> 
                    </div> 
                 
                  
                 
                 	<div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span>Yönetici Yetki</span> 
                    </div>
                    
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span >Yönetici Adı</span> 
                    </div>
                    
              
                    
                     <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 p-2 pt-3   geneltext bg-gradient-mvc">
                <span >İşlemler</span> 
                    </div>
                    
             
                    
                       <?php   foreach ($veri["data"] as $value) : ?>
           
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0">
                     
                                      
                        <?php 
						
		
							echo '<div class="row border border-light">
							     
<div class="col-lg-5 col-xl-5 col-md-5 col-sm-5 text-dark kalinyap p-2 mt-2 ">';

switch ($value["yetki"]) :

case "1":

echo '<span class="text-success">Tam Yetki</span>';

break;

case "2":

echo '<span class="text-danger">Ürün Yetki</span>';

break;

case "3":

echo '<span class="text-primary">Üye Yetki</span>';

break;

endswitch;



echo' </div>
<div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 text-dark kalinyap p-2 mt-2">'.$value["ad"].'</div>
<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 text-dark kalinyap p-2  text-center">';

if (Session::get("Adminid")!=$value["id"]) :

echo '

<a href="'.URL.'/panel/yonguncelle/ilk/'.$value["id"].'" class="fas fa-edit mr-2   guncelbuton"></a>';
?>
  <a onclick="silmedenSor('<?php echo URL."/panel/yonSil/".$value["id"];?>'); return false"  class="fas fa-trash-alt   text-danger  alertSilme"></a>

<?php


else:


echo '<a href="'.URL.'/panel/yonguncelle/ilk/'.$value["id"].'" class="fas fa-edit mr-2   guncelbuton"></a>
<a onclick="#" class="fas fa-trash-alt alertSilme "></a>';

endif;               

 
 echo' </div>
 </div>  
  </div>';	
					
					
	  					endforeach;
						
						
						 ?>
                 
                  
                 
                 
                 </div>
        
      	<!-- SİPARİŞİN İSKELETİ BİTİYOR -->
        </div>
        <?php endif; ?>  
          
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>