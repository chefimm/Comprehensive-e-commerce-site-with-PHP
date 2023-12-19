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
				
					  
	  if (isset($veri["renkdegistir"])) :

	
	  ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> RENK YÖNETİMİ</h1></div>
              
 
          </div>
          <!-- BAŞLIK --> 	
      
         
            <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-xl-4 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>Renkleri Değiştir</h3></div>
					
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Header Renk</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
					 
					  Form::Olustur("1",array(
					 "action" => URL."/panel/renkyonetimison",
					 "method" => "POST"				
					 ));  
                    
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control jscolor","name"=>"header","value"=>$veri["renkdegistir"][0]["header"]));	       
                    
                 ?>  
                 </div>
                 
                 
                 
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Sepetiniz</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control jscolor","name"=>"sepetiniz","value"=>$veri["renkdegistir"][0]["sepetiniz"]));       
                    
                 ?>  
                 </div>
                 
                 
                                 
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Kategori İç</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control jscolor","name"=>"kategoriic","value"=>$veri["renkdegistir"][0]["kategoriic"]));            
                    
                 ?>  
                 </div>
				 
				         <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Sepete Ekle Buton</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control jscolor","name"=>"sepeteeklebuton","value"=>$veri["renkdegistir"][0]["sepeteeklebuton"]));            
                    
                 ?>  
                 </div>
         
             
             
              <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi"><?php 		
		
			 Form::Olustur("2",array("type"=>"submit","value"=>"RENKLERİ GÜNCELLE","class"=>"btn btn-success"));	
			  Form::Olustur("2",array("type"=>"hidden","class"=>"form-control","name"=>"kayitid","value"=>$veri["renkdegistir"][0]["id"]));   
					 
			Form::Olustur("kapat");	 ?></div>  
             
             
             
             			</div>
                        
                        
  
                        
             
             
             </div>
              
 
      			 </div>
         </div>
         
           <!--  FORMUN İSKELETİ-->
      
      
      <?php 
	  
	
	  	  
	  endif; // RENK DEĞİŞTİRME
	  
	  //*****************************************************
	  
	?>
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>