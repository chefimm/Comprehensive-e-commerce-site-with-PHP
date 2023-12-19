<?php require 'views/YonPanel/header.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid mt-3">

          <!-- Page Heading -->
          

          <div class="row">
      <div class="col-xl-12 col-md-12 mb-12 text-center"> 
      
     
       
    
      
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
	  
	  if (isset($veri["sistemayar"])) :

	
	  ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> SİSTEM AYARLARI </h1></div>
              
 
          </div>
          <!-- BAŞLIK --> 	
      
         
     <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-lg-10 col-xl-10 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>Sistem ayarlarını güncelle</h3></div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                    		<div class="row">
                           			 <!-- SOL -->
                            		<div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 bloklararasi">
                                    		<div class="row">
					
 					     <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">Mail Host</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger">															           	 <?php 	
					 
												Form::Olustur("1",array(
											 "action" => URL."/panel/ayarguncelle",
											 "method" => "POST"												
											 )); 



							 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"mailhost","value"=>$veri["sistemayar"][0]["mail_host"]));	   	 
					 
					 
					  ?>
					 
					 
					
                    
                    </div>
                    
                   	<div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">Mail Adres</div>
                    
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"mailadres","value"=>$veri["sistemayar"][0]["mail_adres"]));	   	 
					 
					 
					  ?> </div>
                    
                    <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">Mail Şifre</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger"><?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"mailsifre","value"=>$veri["sistemayar"][0]["mail_sifre"]));	   	 
					 
					 
					  ?>
                    </div>
                    
                    <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">Mail Port</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger"> <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"mailport","value"=>$veri["sistemayar"][0]["mail_port"]));	   	 
					 
					 
					  ?> </div>
                    
                   
                      
                      
                               <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">PANEL- Üyeler Sayfalama Adet</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"uyeSayfaGorAdet","value"=>$veri["sistemayar"][0]["uyelerGoruntuAdet"]));	    	 
					 
					 
					  ?></div>
                      
                                                <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">PANEL- Üyeler Arama Adet</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"uyeAramaAdet","value"=>$veri["sistemayar"][0]["uyelerAramaAdet"]));	    	 
					 
					 
					  ?></div>
                      
                                                <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">PANEL- Ürünler Sayfalama Adet</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"urunlerSayfaGorAdet","value"=>$veri["sistemayar"][0]["urunlerGoruntuAdet"]));	    	 
					 
					 
					  ?></div>
                      
                                                <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">PANEL- Ürünler Arama Adet</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"urunlerAramaAdet","value"=>$veri["sistemayar"][0]["urunlerAramaAdet"]));	    	 
					 
					 
					  ?></div>
                      
                                                <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">PANEL- Ürünler Kategori Adet</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"urunlerKategoriAdet","value"=>$veri["sistemayar"][0]["urunlerKategoriAdet"]));	    	 
					 
					 
					  ?></div>
                      
                      
                              
                                                <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">SİTE- Ürünler Görüntü Adet</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"SiteUrunlerAdet","value"=>$veri["sistemayar"][0]["ArayuzUrunlerGoruntuAdet"]));	    	 
					 
					 
					  ?></div>
                      
                              
                                                <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">PANEL- Üye Panel Yorum Adet</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"uyeYorumAdet","value"=>$veri["sistemayar"][0]["uyeYorumAdet"]));	    	 
					 
					 
					  ?></div>
					  
				          <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">PANEL- Bülten Adet</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"bultenadet","value"=>$veri["sistemayar"][0]["bultenGoruntuAdet"]));	    	 
					 
					 
					  ?></div>
					  
					  
				     <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">PANEL- Sms Api Key</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"apikey","value"=>$veri["sistemayar"][0]["apikey"]));	   	 
					 
					 
					  ?></div>
					  
					      <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">PANEL- Sms Güvenlik Key</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"guvkey","value"=>$veri["sistemayar"][0]["guvkey"]));	   	 
					 
					 
					  ?></div>
					  
					      <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2">PANEL- Sms Başlık</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"smsbaslik","value"=>$veri["sistemayar"][0]["smsbaslik"]));	   	 
					 
					 
					  ?></div>
                    
                    
             
              
                    
                    
            								</div>
                                 
                                    
                                    
                                    </div>
                            		 <!-- SOL -->
                                     
                                      <!-- SAĞ -->
                           			 <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 ">
                                     	<div class="row">
                                        
                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Sayfa Title</div>
         <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
  <?php  Form::Olustur("3",array("class"=>"form-control","name"=>"sayfatitle","rows"=>7),$veri["sistemayar"][0]["title"]);  ?>   </div>   
         
         
                                                 <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Sayfa Açıklama</div>
         <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger"> <?php  Form::Olustur("3",array("class"=>"form-control","name"=>"sayfaaciklama","rows"=>7),$veri["sistemayar"][0]["sayfaAciklama"]);  ?> </div> 
         
                                                 <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Anahtar Kelime</div>
         <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger"><?php  Form::Olustur("3",array("class"=>"form-control","name"=>"anahtarkelime","rows"=>7),$veri["sistemayar"][0]["anahtarKelime"]);  ?> </div>  
		 
		 
					  
					  
			
                                        
                                     
                                     </div>
                                     </div>
                            			 <!-- SAĞ -->
                            
                            </div> <!-- İÇ ROW --></div> <!-- İÇ ANASI -->
                    
                    
         
                    
                      
              
          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeBtn">
          
          <?php 
 Form::Olustur("2",array("type"=>"hidden","value"=>$veri["sistemayar"][0]["id"],"class"=>"btn btn-success","name"=>"kayitid"));				
		
			 Form::Olustur("2",array("type"=>"submit","value"=>"SİSTEM GÜNCELLE","class"=>"btn btn-success"));		
			 

					 
			Form::Olustur("kapat");	 ?>
          
          </div>
               
                              
                              
                              
                              
                                 
             
             
             			</div> <!-- ROWWW -->
                        
                        
  
                        
             
             
             </div>
              
 
      			 </div>
         </div>
      
      
      <?php 
	  
	
	  	  
	  endif; 
	  
	//***********************************************************
	 if (isset($veri["Urunekleme"])) :

	 
	  ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> ÜRÜN EKLEME </h1></div>
              
 
          </div>
          <!-- BAŞLIK --> 	
      
         
            <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-lg-10 col-xl-10 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>Ürün Ekleme</h3></div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                    		<div class="row">
                           			 <!-- SOL -->
                            		<div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 bloklararasi">
                                    		<div class="row">
 					<div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Ürün Adı</div>
                    <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">
                        	 <?php 	
					 
					  Form::Olustur("1",array(
					 "action" => URL."/panel/urunekle",
					 "method" => "POST",
					 "enctype" =>"multipart/form-data"							
					 )); 
					
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"urunad"));	   	 
					 
					 
					  ?>
                    
                    </div>
                    
                   	<div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Kategori</div>
                    <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger"> <?php
 		
			 Form::OlusturSelect("1",array("name"=>"katid","class"=>"form-control"));
			 
			foreach ($veri["data2"] as $deger):
	Form::OlusturOption(array("value"=>$deger["id"]),false,$deger["ad"]);		
			
			endforeach;		
			  
			 Form::OlusturSelect("2",null);	 
					 
					 
					  ?></div>
                    
                    <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Kumaş</div>
                    <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">
                    <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"kumas"));	   	 
					 
					 
					  ?></div>
                    
                    <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Üretim yeri</div>
                    <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"uretimyeri"));	   	 
					 
					 
					  ?></div>
                    
                    <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Renk</div>
                    <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"renk"));	   	 
					 
					 
					  ?></div>                   
                    
                    <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Fiyat</div>
                    <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"fiyat"));	   	 
					 
					 
					  ?></div>
                    
                    <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Stok</div>
                    <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">  <?php 
										
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"stok"));	   	 
					 
					 
					  ?></div>
                    
                    <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 uruneklemeElemanlar">Durum</div>
                    <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 uruneklemeElemanlarDiger">
                    <?php
 		
			 Form::OlusturSelect("1",array("name"=>"durum","class"=>"form-control"));
			 
			
	Form::OlusturOption(array("value"=>"0"),false,"Standart");		
	Form::OlusturOption(array("value"=>"1"),false,"En çok Satanlar");		
	Form::OlusturOption(array("value"=>"2"),false,"Öne çıkanlar");				
		
			  
			 Form::OlusturSelect("2",null);	 
					 
					 
					  ?>
                    
                    
                    </div>
                    
                        <div class="col-lg-4 col-xl-4 col-md-9 col-sm-12" >
 <?php  Form::Olustur("2",array("type"=>"file","class"=>"form-control","name"=>"res[]"));	   	  ?>          
                        
                        
                        </div>
                     <div class="col-lg-4 col-xl-4 col-md-9 col-sm-12" > <?php  Form::Olustur("2",array("type"=>"file","class"=>"form-control","name"=>"res[]"));	   	  ?> </div>
                     <div class="col-lg-4 col-xl-4 col-md-9 col-sm-12 " > <?php  Form::Olustur("2",array("type"=>"file","class"=>"form-control","name"=>"res[]"));	   	  ?> </div> 
              
                    
                    
            								</div>
                                 
                                    
                                    
                                    </div>
                            		 <!-- SOL -->
                                     
                                      <!-- SAĞ -->
                           			 <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 ">
                                     	<div class="row">
                                        
                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Ürün Açıklama</div>
         <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
  <?php  Form::Olustur("3",array("class"=>"form-control","name"=>"urunaciklama","rows"=>4));  ?>   </div>   
         
         
                                                 <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Ürün Özellik</div>
         <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger"> <?php  Form::Olustur("3",array("class"=>"form-control","name"=>"urunozellik","rows"=>4));  ?> </div> 
         
                                                 <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">Ürün Ekstra Bilgi</div>
         <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger"><?php  Form::Olustur("3",array("class"=>"form-control","name"=>"urunekstra","rows"=>4));  ?> </div>                                   
                                        
                                     
                                     </div>
                                     </div>
                            			 <!-- SAĞ -->
                            
                            </div> <!-- İÇ ROW --></div> <!-- İÇ ANASI -->
                    
                    
         
                    
                      
              
          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeBtn">
          
          <?php 		
		
			 Form::Olustur("2",array("type"=>"submit","value"=>"ÜRÜN EKLE","class"=>"btn btn-success"));		
			 

					 
			Form::Olustur("kapat");	 ?>
          
          </div>
               
                              
                              
                              
                              
                                 
             
             
             			</div> <!-- ROWWW -->
                        
                        
  
                        
             
             
             </div>
              
 
      			 </div>
         </div>
         
           <!--  FORMUN İSKELETİ-->
      
      
      <?php 
	
	  	  
	  endif; 
	  
	  //**************************************************************
	
	
	
	 
	 
	 
	  if (isset($veri["data"])) :
	  
	  
	   ?>
      
      
      
      <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-lg-2 col-xl-2 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> ÜRÜNLER </h1></div>
              
 
    <div class="col-lg-2 col-xl-2 col-md-12 mb-12 p-2">
    <h5 class=" mb-0 pt-1 text-gray-800">Toplam Ürün : <?php echo count($veri["data"]); ?></h5></div>  
       <div class="col-lg-2 col-xl-2 col-md-12 mb-12 pt-1">
       <a href="<?php echo URL."/panel/Urunekleme";?>" class="btn btn-sm btn-success btn-block">Yeni Ürün Ekle</a>
   </div>
             
        
     <div class="col-lg-6 col-xl-6 col-md-12 mb-12 text-right">
     	<div class="row">
        
    <div class="col-xl-4 ">
    <?php 
    	  Form::Olustur("1",array(
					 "action" => URL."/panel/katgoregetir",
					 "method" => "POST"								
					 ));  
					 
	 Form::OlusturSelect("1",array("name"=>"katid","class"=>"form-control","id"=>"dene"));
			 
			 foreach ($veri["data2"] as $deger):
			 
			  Form::OlusturOption(array("value"=>$deger["id"]),false,$deger["ad"]);
			 
			 
			 
			 endforeach;
		
		
			  
			 Form::OlusturSelect("2",null);	
			 
	
			 ?>
    
    
    
    
    </div>
    
    
    <div class="col-xl-2 ">
    
    <?php 
	
			 Form::Olustur("2",array("type"=>"submit","value"=>"GETİR","class"=>"btn btn-sm btn-mvc btn-block mt-1"));		 
			 Form::Olustur("kapat");
			 ?>
     </div>
        
        	<div class="col-xl-4">
         	  <?php
	
			  Form::Olustur("1",array(
					 "action" => URL."/panel/urunarama",
					 "method" => "POST"				
					 ));  
						 
					 
 Form::Olustur("2",array("type"=>"text","name"=>"arama","class"=>"form-control","placeholder"=>"Herhangi bir kriter"));		 
					 
	  ?>		
		
  

            </div>
        	<div class="col-xl-2">
                   
         <?php    
             
	 Form::Olustur("2",array("type"=>"submit","value"=>"ARA","class"=>"btn btn-sm btn-mvc btn-block mt-1"));		
			 

					 
			Form::Olustur("kapat");	 ?>
             
             
            </div>
        
        </div>
     
     
    
     </div>    
       
          </div>
          <!-- BAŞLIK --> 	
          
          
              
                
      	<!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        		 <div class="row arkaplan p-1 mt-2 pb-0">
                 	<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span>Ürün Ad</span> 
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span >Bölüm</span> 
                    </div>
                    
                    <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span >Kumas</span> 
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span>Renk</span> 
                    </div>
                    
                    <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span >Fiyat</span> 
                    
                    </div>
                    
                    <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span >Stok</span> 
                    
                    </div>
                      <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span >Satış Adeti</span> 
                    
                    </div>
                    
                     <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 p-2 pt-3   geneltext bg-gradient-mvc">
                <span >İşlemler</span> 
                    </div>
                    
                    <!--  ÜRÜNLER-->
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0" id="geldi">
                    
                    </div>
                    
                    
                       <?php   foreach ($veri["data"] as $value) : ?>
           
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0">
                     
                                      
                        <?php 
					
							echo '<div class="row border border-light">
							     
<div class="col-lg-2 col-xl-2 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["urunad"].'</div>
<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 text-dark kalinyap p-2">';

echo $value["durum"]==0 ? "<span class='text-info'>Standart</span>" : "";
echo $value["durum"]==1 ? "<span class='text-danger'>En Çok Satan</span>" : "";
echo $value["durum"]==2 ? "<span class='text-success'>Öne Çıkanlar</span>" : "";


 echo'</div>
<div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["kumas"].'</div>
<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["renk"].'</div>
<div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["fiyat"].'</div> 
<div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["stok"].'</div> 
<div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["satisadet"].'</div> 
     
<div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2 text-right">
<a href="'.URL.'/panel/urunGuncelle/'.$value["id"].'" class="fas fa-sync mt-1 guncelbuton"></a></div>
				   
				<div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2 text-left">               
 <a href="'.URL.'/panel/urunSil/'.$value["id"].'" class="fas fa-times   silbuton"></a>  </div>
 </div> 
 
 
  </div>';	
					
					
	  					endforeach;
						
						
						 ?>
                 
                   <!-- -->     
                 
                 
                 </div>
        
      	<!-- SİPARİŞİN İSKELETİ BİTİYOR -->
        
        <?php endif; ?>  
          
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>