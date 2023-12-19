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

				
      
      ?>
      
     <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-3 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> KATEGORİ YÖNETİMİ </h1></div>
             
                 <div class="col-xl-9 col-md-12 mb-12 text-right">
     	<div class="row">
        
        <div class="col-xl-4">
        
            	  <?php
	  
	  Form::Olustur("1",array(
					 "action" => URL."/panel/kategoriarama",
					 "method" => "POST"				
					 ));  
				
			 Form::OlusturSelect("1",array("name"=>"aramatercih","class"=>"form-control"));
			 
			 Form::OlusturOption(array("value"=>""),false,"Seçiniz");		
			 Form::OlusturOption(array("value"=>"ana"),false,"Ana kategori");			 	
			 Form::OlusturOption(array("value"=>"cocuk"),false,"Çocuk kategori");
			 Form::OlusturOption(array("value"=>"alt"),false,"Alt kategori");
		
			 Form::OlusturSelect("2",null);			
				
					 
					 ?>
        
        
        
        </div>
        
        	<div class="col-xl-4">
         	  <?php
	
					 
					 
 Form::Olustur("2",array("type"=>"text","name"=>"aramaverisi","class"=>"form-control","placeholder"=>"Kategori adı"));		 
					 
	  ?>		
		
  

            </div>
        	<div class="col-xl-4">
                   
         <?php    
             
	 Form::Olustur("2",array("type"=>"submit","value"=>"ARA","class"=>"btn btn-sm btn-mvc btn-block mt-1"));		
			 

					 
			Form::Olustur("kapat");	 ?>
             
             
            </div>
        
        </div>
     
     
    
     </div> 
             
             
             
              
 
          </div>
          <!-- BAŞLIK --> 	
 
 
 
 	<!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        		 <div class="row  p-1 mt-2 pb-0">
                 
                 
                 <?php if (isset($veri["anakategori"])) :	 ?>
                 
              <!--******* ANA KATEGORİLER**************** -->                   
                 
<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12  geneltext ">
		<div class="row  m-2 p-2  ">
        
<div class="col-xl-10 col-lg-10 col-md-6 col-sm-6 pt-3 bg-gradient-mvc">ANA KATEGORİLER</div>

        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 bg-gradient-mvc p-1"> <a href="<?php echo URL."/panel/kategoriEkle/ilk/ana/";?>" class="fas fa-plus-square m-0 p-1 eklemebuton "></a></div>

   
        	
        <!-- Eleman -->    
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">   
   		<div class="row kategorieleman">
     <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 pt-2 yescizgi Kategoriarkaplan"><h6 class="h6Eleman ">Kategori Adı</h6></div>
     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pt-2 Kategoriarkaplan"><h6 class="h6Eleman">İşlemler</h6></div>
      </div> 
   
   </div> 
       <!-- Eleman -->  
       
       <?php 
	   
	
	  
	  foreach ($veri["anakategori"] as $deger) :
	  
	  ?>
      
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">   
   		<div class="row kategorieleman">
        
          
     	 <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9  pt-2 yescizgi"><?php echo $deger["ad"];?> </div>
             <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3  ">
             <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-right"> 
              <a href="<?php echo URL."/panel/kategoriGuncelle/ilk/ana/".$deger["id"];?>" class="fas fa-edit mt-1   p-1  guncelbuton"></a></div>
               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-left"> 
                <a onclick="silmedenSor('<?php echo URL."/panel/kategoriSil/ana/".$deger["id"];?>'); return false"  class="fas fa-trash-alt mt-1 p-1 text-danger  alertSilme"></a>
            
            
 
                
                
                
                </div>
             
             
             </div>


  
  </div>  



          
             </div> 
   
   </div> 
      
      <?php
	  
	  
	  endforeach;
	   ?>    
   	

   
   <!-- Eleman -->      
   
   
   
   
          
          
        </div>

                    </div>
                    
           <!--********ANA KATEGORİLER BİTTİ*************** -->         
                    
         
   <!--*********ÇOCUK KATEGORİLER************** -->                   
                 
<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12  geneltext ">
		<div class="row  m-2 p-2  ">
        
<div class="col-xl-10 col-lg-10 col-md-6 col-sm-6 pt-3 bg-gradient-mvc">ÇOCUK KATEGORİLER</div>

        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 bg-gradient-mvc p-1"> <a href="<?php echo URL."/panel/kategoriEkle/ilk/cocuk";?>" class="fas fa-plus-square m-0 p-1 eklemebuton "></a></div>

   
        	
        <!-- Eleman -->    
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">   
   		<div class="row kategorieleman">
     <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 pt-2 yescizgi Kategoriarkaplan"><h6 class="h6Eleman ">Kategori Adı</h6></div>
     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pt-2 Kategoriarkaplan"><h6 class="h6Eleman">İşlemler</h6></div>
      </div> 
   
   </div> 
       <!-- Eleman -->      
   	
   <?php 
	   
	 
	  
	  foreach ($veri["cocukkategori"] as $deger) :
	  
	  ?>
      
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">   
   		<div class="row kategorieleman">
        
          
     	 <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9  pt-2 yescizgi"><?php echo $deger["ad"];?> </div>
             <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3  ">
             <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-right"> 
              <a href="<?php echo URL."/panel/kategoriGuncelle/ilk/cocuk/".$deger["id"];?>" class="fas fa-edit mt-1   p-1  guncelbuton"></a></div>
               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-left"> 
               
           <a onclick="silmedenSor('<?php echo URL."/panel/kategoriSil/cocuk/".$deger["id"];?>'); return false"  class="fas fa-trash-alt  mt-1 p-1 text-danger  alertSilme"></a>    
               
      </div>
             
             
             </div>


  
  </div>  



          
             </div> 
   
   </div> 
      
      <?php
	  
	  
	  endforeach;
	   ?>    
   	
   
   <!-- Eleman -->      
   
   
   
   
          
          
        </div>

                    </div>
                    
           <!--******ÇOCUK KATEGORİLER BİTTİ***************** -->      
           
           
             <!--*******ALT KATEGORİLER**************** -->                   
                 
<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12  geneltext ">
		<div class="row  m-2 p-2  ">
        
<div class="col-xl-10 col-lg-10 col-md-6 col-sm-6 pt-3 bg-gradient-mvc">ALT KATEGORİLER</div>

        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 bg-gradient-mvc p-1"> <a href="<?php echo URL."/panel/kategoriEkle/ilk/alt" ;?>" class="fas fa-plus-square m-0 p-1 eklemebuton "></a></div>

   
        	
        <!-- Eleman -->    
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">   
   		<div class="row kategorieleman">
     <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 pt-2 yescizgi Kategoriarkaplan"><h6 class="h6Eleman ">Kategori Adı</h6></div>
     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pt-2 Kategoriarkaplan"><h6 class="h6Eleman">İşlemler</h6></div>
      </div> 
   
   </div> 
       <!-- Eleman -->      
   	
   <?php 
	   
	 
	  
	  foreach ($veri["altkategori"] as $deger) :
	  
	  ?>
      
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">   
   		<div class="row kategorieleman">
        
          
     	 <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9  pt-2 yescizgi"><?php echo $deger["ad"];?> </div>
             <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3  ">
             <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-right"> 
              <a href="<?php echo URL."/panel/kategoriGuncelle/ilk/alt/".$deger["id"];?>" class="fas fa-edit mt-1   p-1  guncelbuton"></a></div>
               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-left"> 
               
                       <a onclick="silmedenSor('<?php echo URL."/panel/kategoriSil/alt/".$deger["id"];?>'); return false"  class="fas fa-trash-alt  mt-1 p-1 text-danger  alertSilme"></a>    
               
</div>
             
            
             </div>


  
  </div>  



          
             </div> 
   
   </div> 
      
      <?php
	  
	  
	  endforeach;
	   ?>    
   	
   
   <!-- Eleman -->      
   
   
   
   
          
          
        </div>

                    </div>
                    
           <!--*******ALT KATEGORİLER BİTTİ**************** -->                  
                     
      <?php  endif;        
               
               
               if (isset($veri["kategoriaramasonuc"])): 
			   ?>   
           <!--*********ARAMA SONUCU BAŞLIYOR************** -->                   
                 
<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12  geneltext mx-auto">
		<div class="row  m-2 p-2  ">
        
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 pt-3 pb-2 bg-gradient-mvc">ARAMA SONUCU <span class="text-warning">Kelime : <?php echo $veri["kelime"]; ?></span></div>



   
        	
        <!-- Eleman -->    
   <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">   
   		<div class="row kategorieleman">
     <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 pt-2 yescizgi Kategoriarkaplan"><h6 class="h6Eleman ">Kategori Adı</h6></div>
     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 pt-2 Kategoriarkaplan"><h6 class="h6Eleman">İşlemler</h6></div>
      </div> 
   
   </div> 
       <!-- Eleman -->      
   	
   <?php 
	   
	 
	  
	  foreach ($veri["kategoriaramasonuc"] as $deger) :
	  
	  
	  switch ($veri["kategorimiz"]) :
	  
	  case "ana":	  
	  $yol=$deger["ad"];
	  $link=$deger["id"];	  
	  break;
	  
	  case "cocuk":	  
	  $yol=$deger["anakatad"]."-".$deger["cocukad"];
	  $link=$deger["cocukid"];	  
	  break;
	  
	  case "alt":	  
	  $yol=$deger["anakatad"]."-".$deger["cocukkatad"]."-".$deger["altad"];
	  $link=$deger["altid"];	  
	  break;
	  
	  endswitch;
	  
	  ?>
      
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">   
   		<div class="row kategorieleman">
        
          
<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9  pt-3 yescizgi"><?php echo $yol; ?> </div>
             <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3  ">
             <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-right"> 
              <a href="<?php echo URL."/panel/kategoriGuncelle/".$veri["kategorimiz"]."/".$link;?>" class="fas fa-sync mt-2   p-1  guncelbuton"></a></div>
               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-left"> 
                <a href="<?php echo URL."/panel/kategoriSil/".$veri["kategorimiz"]."/".$link;?>" class="fas fa-times mt-1 p-1   silbuton"></a></div>
             
             
             </div>


  
  </div>  



          
             </div> 
   
   </div> 
      
      <?php
	  
	  
	  endforeach;
	   ?>    
   	
   
   <!-- Eleman -->      
   
   
   
   
          
          
        </div>

                    </div>
                    
           <!--******ARAMA SONUCU BİTTİ***************** -->          
                 <?php  endif; ?>       
               
               
                   
                   
                 
                 
                 
                 </div>
        
      	<!-- SİPARİŞİN İSKELETİ BİTİYOR -->
 
 
 
 

 
 
 
          
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>