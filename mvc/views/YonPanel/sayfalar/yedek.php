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
				
	  
	  if (isset($veri["veritabaniyedek"])) :

	 
	  ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> VERİTABANI YEDEK </h1></div>
              
 
          </div>
          <!-- BAŞLIK --> 	
      
         
            <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-xl-4 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>Veritabanı Yedeğini Al</h3></div>
         
             
             
              <div class="col-lg-12 col-md-12 col-sm-12 formeleman p-5">
	  
			  <?php 			  
			 					 
				
    	 Form::Olustur("1",array(
					 "action" => URL."/panel/yedekal",
					 "method" => "POST"				
					 ));
					 ?>
					 
  <div class="toggle-radio">
  <input type="radio" name="yedektercih" id="yes" value="local" checked >
  <input type="radio" name="yedektercih" id="no" value="pc">
  <div class="switch">
    <label for="yes">Local</label>
    <label for="no">Pc</label>
    <span></span>
  </div>

</div>
		
			
				</div> 
				<div class="col-lg-12 col-md-12 col-sm-12 formeleman ">
				<?php	
		
			 Form::Olustur("2",array("type"=>"submit","value"=>"YEDEĞİ AL","class"=>"btn btn-success","name"=>"sistembtn"));		
			 

					 
			Form::Olustur("kapat");	 ?></div>  
			
			   <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi"><?php 			  
			 					 
				
    				 $geldi= $PanelHarici->tekverial("ayarlar");
	
	  					echo "Son yedek zamanı :".  $geldi[0]["yedekzaman"];
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