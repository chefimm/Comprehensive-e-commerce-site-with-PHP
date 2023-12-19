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
	  
	  if (isset($veri["sistembakim"])) :

	 
	  ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> SİSTEM BAKIM </h1></div>
              
 
          </div>
          <!-- BAŞLIK --> 	
      
         
            <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-xl-4 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>Sistemin Bakımını Yap</h3></div>
         
             
             
              <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi"><?php 			  
			 					 
				
    	 Form::Olustur("1",array(
					 "action" => URL."/panel/bakimyap",
					 "method" => "POST"				
					 ));
				 	
		
			 Form::Olustur("2",array("type"=>"submit","value"=>"BAKIMI BAŞLAT","class"=>"btn btn-success","name"=>"sistembtn"));		
			 

					 
			Form::Olustur("kapat");	 ?></div>  
			
			   <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi"><?php 			  
			 					 
				
    				 $geldi= $PanelHarici->tekverial("ayarlar");
	
	  					echo "Son bakım zamanı :".  $geldi[0]["bakimzaman"];
              ?></div>  
			
			
			
	
             
             
             			</div>
                        
                        
  
                        
             
             
             </div>
              
 
      			 </div>
         </div>
         
           <!--  FORMUN İSKELETİ-->
      
      
      <?php 
	  
	
	  	  
	  endif; // bakım 
	  
	  //*****************************************************
	  
	 ?>
          
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>