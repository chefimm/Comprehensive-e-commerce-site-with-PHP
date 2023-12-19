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
					
								
						else:
						
						echo $veri["Bilgi"];
						endif;
				
				
				
				endif;

				
      
      ?>
	   <?php if (isset($veri["sliderVerileri"])) :	 ?>
      <!--SLİDERİN LİSTELEME --> 
         
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-3 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> SLİDER YÖNETİMİ </h1></div>
             
                 <div class="col-xl-9 col-md-12 mb-12 text-left">
     	<div class="row">   
     
        
        	<div class="col-xl-12">
			<a href="<?php echo  URL; ?>/panel/SliderBabaFonksiyon/eklemeilk" class="btn btn-success">EKLE</a>
 

            </div>
        	
        
        </div>
     
     
    
     </div> 
             
             
             
              
 
          </div>  
		<div class="row  p-1 mt-2 pb-0">
                 
                 
                
                 
              <!--******* SLİDER BAŞLIYOR**************** -->                   
                 

       
       <?php 	
	  
	  foreach ($veri["sliderVerileri"] as $deger) :
	  
	  ?>
          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12  geneltext ">
		<div class="row  m-2 p-2  kategorieleman2">   
     	 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  pt-2 ">
		 <img src="<?php echo RESİMGORUNTULE."slider/".$deger["resim"]; ?>" class="img-responsive img-fluid"> </div>	
		 
		  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  pt-2 mt-2  kategorieleman2">
		 <?php echo $deger["sloganUst"]; ?></div>	
		 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  pt-2 kategorieleman">
		 <?php echo $deger["sloganAlt"]; ?></div>	
		 
             <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
			 <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-right"> 
              <a href="<?php echo URL."/panel/SliderBabaFonksiyon/guncellemeilk/".$deger["id"];?>" class="fas fa-edit mt-1   p-1  guncelbuton"></a></div>
			  
               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-left"> 
                <a onclick="silmedenSor('<?php echo URL."/panel/SliderBabaFonksiyon/silme/".$deger["id"];?>'); return false"  class="fas fa-trash-alt mt-1 p-1 text-danger  alertSilme"></a>                
                </div>             
             
             </div>  
  			</div>  

          
          
        </div>

                    </div>
      
      <?php
	  
	  
	  endforeach;
	   ?>    
   	
   
   <!-- Eleman -->     
                    
           <!--********SLİDER BİTİYOR*************** -->         
                    
 
           </div>    
    <?php  endif;    ?>  
	<!--SLİDERİN LİSTELEME -->  
				 
	 <!-- -------------------------- -->
	 
	  <!-- SLİDER GÜNCELLEME -->
       <?php if (isset($veri["sliderGuncelle"])) :	 ?>
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-3 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> SLİDER GÜNCELLEME </h1></div>
             
                 <div class="col-xl-9 col-md-12 mb-12 text-left">   
     
    
   				  </div> 
              
 
          </div>  
	    
       <div class="row  p-1 mt-2 pb-0">                 
              <!--******* SLİDER BAŞLIYOR**************** -->                   
                 
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12  geneltext text-center mx-auto ">
		<div class="row  m-2 p-2  kategorieleman2 mx-auto">      
     
        
     	 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  pt-2 ">
		 <img src="<?php echo RESİMGORUNTULE."slider/".$veri["sliderGuncelle"][0]["resim"]; ?>" class="img-responsive img-fluid"> </div>	
		 
		  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  p-2 mt-2  kategorieleman2">
				 <?php 	

						  Form::Olustur("1",array(
						 "action" => URL."/panel/SliderBabaFonksiyon/guncellemeson",
						 "method" => "POST",
						 "enctype" =>"multipart/form-data"							
						 )); 

						 Form::Olustur("2",array("type"=>"file","class"=>"form-control","name"=>"resim"));
				?>

			</div>	
			
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  p-2 mt-2  kategorieleman2">
				 <?php 	

			 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"sloganAlt","value"=>$veri["sliderGuncelle"][0]["sloganAlt"]));
				?>

			</div>	
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  p-2 mt-2  kategorieleman2">
				 <?php 	

			 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"sloganUst","value"=>$veri["sliderGuncelle"][0]["sloganUst"]));
				?>

			</div>
		
		 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  p-2  kategorieleman">
		    <?php 
 Form::Olustur("2",array("type"=>"hidden","value"=>$veri["sliderGuncelle"][0]["id"],"name"=>"sliderid"));				
		
			 Form::Olustur("2",array("type"=>"submit","value"=>"GÜNCELLE","class"=>"btn btn-success"));				 

					 
			Form::Olustur("kapat");	 ?>
		 </div>	
             

	   
    	</div>

                    </div>
   
      
                    
           <!--********SLİDER BİTİYOR*************** -->         
      
                 </div>
	  <?php  endif;    ?>    
	<!-- SLİDER GÜNCELLEME -->
	
	 <!-- -------------------------- -->
	 
	  <!-- SLİDER EKLEME -->
       <?php if (isset($veri["sliderEkleme"])) :	 ?>
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-3 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> SLİDER EKLEME </h1></div>
             
                 <div class="col-xl-9 col-md-12 mb-12 text-left">   
     
    
   				  </div> 
              
 
          </div>  
	    
       <div class="row  p-1 mt-2 pb-0">                 
              <!--******* SLİDER BAŞLIYOR**************** -->                   
                 
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12  geneltext text-center mx-auto ">
		<div class="row  m-2 p-2  kategorieleman2 mx-auto">      
     
        
     	 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  pt-2 text-center">
		<h1>LÜTFEN RESİM SEÇİN</h1></div>	
		 
		  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  p-2 mt-2  kategorieleman2">
				 <?php 	

						  Form::Olustur("1",array(
						 "action" => URL."/panel/SliderBabaFonksiyon/eklemeSon",
						 "method" => "POST",
						 "enctype" =>"multipart/form-data"							
						 )); 

						 Form::Olustur("2",array("type"=>"file","class"=>"form-control","name"=>"resim"));
				?>

			</div>	
			
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  p-2 mt-2  kategorieleman2">
				 <?php 	

			 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"sloganAlt"));
				?>

			</div>	
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  p-2 mt-2  kategorieleman2">
				 <?php 	

			 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"sloganUst"));
				?>

			</div>
		
		 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  p-2  kategorieleman">
		    <?php  					
			 Form::Olustur("2",array("type"=>"submit","value"=>"EKLE","class"=>"btn btn-success"));	
					 
			Form::Olustur("kapat");	 ?>
		 </div>	
             

	   
    	</div>

                  </div>
   
      
                    
           <!--********SLİDER BİTİYOR*************** -->         
      
                 </div>
	  <?php  endif;    ?>    
	<!-- SLİDER EKLEME -->
	
        
		
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->
     
     
     <?php require 'views/YonPanel/footer.php'; ?>