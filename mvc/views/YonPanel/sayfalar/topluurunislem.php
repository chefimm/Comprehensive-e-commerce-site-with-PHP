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
				
	
 //************** TOPLU ÜRÜN EKLEME ************************************
  if (isset($veri["topluekleme"])) : ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2 baslikana"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> TOPLU ÜRÜN EKLEME </h1></div>
        <?php $PanelHarici->İcnavigasyon("urunler","Ürünler","Toplu Ürün Ekleme"); ?>            
 
          </div>
          <!-- BAŞLIK --> 	
      
      <?php
	  
	  Form::Olustur("1",array(
					 "action" => URL."/panel/topluurunekle/son",
					 "method" => "POST",
					 "enctype" => "multipart/form-data"
					 ));  
	  ?>
      
            <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-xl-4 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>DOSYALARI YÜKLE</h3></div>
                <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
					<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<?php
 Form::Olustur("2",array("type"=>"radio","name"=>"dosyatercih","value"=>"xml")); 
				 ?>
				Xml
							</div>
							
							
							<div class="col-lg-6 col-md-6 col-sm-6">
								<?php
 Form::Olustur("2",array("type"=>"radio","name"=>"dosyatercih","value"=>"json")); 
				 ?>
				Json
							</div>
					
					
					
					</div>
				
			
				
		
				
				
				</div>    
              
					
<?php echo '<div class="col-lg-12 col-md-12 col-sm-12 formeleman">';
  	
 Form::Olustur("2",array("type"=>"file","name"=>"dosya","class"=>"form-control m-2"));                  
       echo '</div>';      
					

?>
<div class="col-lg-12 col-md-12 col-sm-12 formeleman">RESİMLERİN DOSYASI (ZİP)</div>  
<?php echo '<div class="col-lg-12 col-md-12 col-sm-12 formeleman">';
  	
 Form::Olustur("2",array("type"=>"file","name"=>"zipdosya","class"=>"form-control m-2"));                  
       echo '</div>';    ?>


             
              <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi"><?php 		
		
 Form::Olustur("2",array("type"=>"submit","value"=>"YÜKLE","class"=>"btn btn-success"));		
			 
 			 
			Form::Olustur("kapat");	 ?></div>  
             
             
             
             			</div>
                        
                        
  
                        
             
             
             </div>
              
 
      			 </div>
         </div>
          <?php  endif; ?>
           <!--  FORMUN İSKELETİ-->    
  
  
  
  <?php
 //************** TOPLU ÜRÜN GÜNCELLEME ************************************  
  
  
    if (isset($veri["topluguncelle"])) : ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2 baslikana"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> TOPLU ÜRÜN GÜNCELLEME</h1></div>
              
    <?php $PanelHarici->İcnavigasyon("urunler","Ürünler","Toplu Ürün Güncelleme"); ?>  
          </div>
          <!-- BAŞLIK --> 	
      
      <?php
	  
	  Form::Olustur("1",array(
					 "action" => URL."/panel/topluurunguncelleme/son",
					 "method" => "POST",
					 "enctype" => "multipart/form-data"
					 ));  
	  ?>
      
            <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-xl-4 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>DOSYALARI YÜKLE</h3></div>
                <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
					<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<?php
 Form::Olustur("2",array("type"=>"radio","name"=>"dosyatercih","value"=>"xml")); 
				 ?>
				Xml
							</div>
							
							
							<div class="col-lg-6 col-md-6 col-sm-6">
								<?php
 Form::Olustur("2",array("type"=>"radio","name"=>"dosyatercih","value"=>"json")); 
				 ?>
				Json
							</div>
					
					
					
					</div>
				
			
				
		
				
				
				</div>    
              
					
<?php echo '<div class="col-lg-12 col-md-12 col-sm-12 formeleman">';
  	
 Form::Olustur("2",array("type"=>"file","name"=>"dosya","class"=>"form-control m-2"));                  
       echo '</div>';      
					

?>
<div class="col-lg-12 col-md-12 col-sm-12 formeleman">RESİMLERİN DOSYASI (ZİP)</div>  
<?php echo '<div class="col-lg-12 col-md-12 col-sm-12 formeleman">';
  	
 Form::Olustur("2",array("type"=>"file","name"=>"zipdosya","class"=>"form-control m-2"));                  
       echo '</div>';    ?>


             
              <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi"><?php 		
		
 Form::Olustur("2",array("type"=>"submit","value"=>"YÜKLE","class"=>"btn btn-success"));		
			 
 			 
			Form::Olustur("kapat");	 ?></div>  
             
             
             
             			</div>
                        
                        
  
                        
             
             
             </div>
              
 
      			 </div>
         </div>
          <?php  endif; ?>
           <!--  FORMUN İSKELETİ-->    
  
 <?php 
  //************** TOPLU ÜRÜN GÜNCELLEME ************************************  
  
  
    if (isset($veri["toplusilme"])) : ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2 baslikana"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> TOPLU ÜRÜN SİLME</h1></div>
   <?php $PanelHarici->İcnavigasyon("urunler","Ürünler","Toplu Ürün Silme"); ?>               
 
          </div>
          <!-- BAŞLIK --> 	
      
      <?php
	  
	  Form::Olustur("1",array(
					 "action" => URL."/panel/topluurunsilme/son",
					 "method" => "POST",
					 "enctype" => "multipart/form-data"
					 ));  
	  ?>
      
            <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-xl-4 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>DOSYALARI YÜKLE</h3></div>
                <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
					<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<?php
 Form::Olustur("2",array("type"=>"radio","name"=>"dosyatercih","value"=>"xml")); 
				 ?>
				Xml
							</div>
							
							
							<div class="col-lg-6 col-md-6 col-sm-6">
								<?php
 Form::Olustur("2",array("type"=>"radio","name"=>"dosyatercih","value"=>"json")); 
				 ?>
				Json
							</div>
					
					
					
					</div>
				
			
				
		
				
				
				</div>    
              
					
<?php echo '<div class="col-lg-12 col-md-12 col-sm-12 formeleman">';
  	
 Form::Olustur("2",array("type"=>"file","name"=>"dosya","class"=>"form-control m-2"));                  
       echo '</div>';      
					

?>


             
              <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi"><?php 		
		
 Form::Olustur("2",array("type"=>"submit","value"=>"YÜKLE","class"=>"btn btn-success"));		
			 
 			 
			Form::Olustur("kapat");	 ?></div>  
             
             
             
             			</div>
                        
                        
  
                        
             
             
             </div>
              
 
      			 </div>
         </div>
          <?php  endif; ?>
           <!--  FORMUN İSKELETİ-->     
  
  
  
  
        </div>
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->
		

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>