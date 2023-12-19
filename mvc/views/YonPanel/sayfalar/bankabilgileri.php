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
	  
	  if (isset($veri["BankaGuncelle"])) :

	  
	  if (!$_POST) :
	  
	  ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2 baslikana"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> HESAP GÜNCELLE </h1></div>
<?php $PanelHarici->İcnavigasyon("bankabilgileri","Banka Bilgileri","Hesap Güncelle"); ?>              
 
          </div>
          <!-- BAŞLIK --> 	
      
         
            <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-xl-4 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>Banka Hesabını Güncelle</h3></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Banka Adı</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
					 
					  Form::Olustur("1",array(
					 "action" => URL."/panel/bankaGuncelle/son",
					 "method" => "POST"				
					 ));  
                    
 	 Form::Olustur("2",array("type"=>"text","value"=>$veri["BankaGuncelle"][0]["banka_ad"],"class"=>"form-control","name"=>"banka_ad"));	       
                    
                 ?>  
                 </div>
                 
                 
                 
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Hesap Adı</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"text","value"=>$veri["BankaGuncelle"][0]["hesap_ad"],"class"=>"form-control","name"=>"hesap_ad"));	       
                    
                 ?>  
                 </div>
                 
                 
                                 
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Hesap No</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"text","value"=>$veri["BankaGuncelle"][0]["hesap_no"],"class"=>"form-control","name"=>"hesap_no"));	       
                    
                 ?>  
                 </div>
                 
                 
                                 
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman">İban no</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"text","value"=>$veri["BankaGuncelle"][0]["iban_no"],"class"=>"form-control","name"=>"iban_no"));	       
                    
                 ?>  
                 </div>
                
                  
                
             
             
             
              <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi"><?php 		
		
			 Form::Olustur("2",array("type"=>"submit","value"=>"GÜNCELLE","class"=>"btn btn-success"));		
			 
			 Form::Olustur("2",array("type"=>"hidden","name"=>"bankaid","value"=>$veri["BankaGuncelle"][0]["id"]));	 
					 
			Form::Olustur("kapat");	 ?></div>  
             
             
             
             			</div>
                        
                        
  
                        
             
             
             </div>
              
 
      			 </div>
         </div>
         
           <!--  FORMUN İSKELETİ-->
      
      
      <?php 	  
	  	 
	  
	  endif;
	  	  
	  endif; // BANKA  GÜNCELLEME 
	  
	  //*****************************************************
	  
	  
	  
	  if (isset($veri["BankaEkle"])) :

	  
	  if (!$_POST) :
	  
	  ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2 baslikana"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> YENİ HESAP EKLE </h1></div>
              
 <?php $PanelHarici->İcnavigasyon("bankabilgileri","Banka Bilgileri","Yeni Hesap Ekle"); ?>  
          </div>
          <!-- BAŞLIK --> 	
      
         
            <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-xl-4 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>Yeni Hesap Ekle</h3></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Banka Adı</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
					 
					  Form::Olustur("1",array(
					 "action" => URL."/panel/bankaEkle/son",
					 "method" => "POST"				
					 ));  
                    
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"banka_ad"));	       
                    
                 ?>  
                 </div>
                 
                 
                 
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Hesap Adı</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"hesap_ad"));	       
                    
                 ?>  
                 </div>
                 
                 
                                 
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Hesap No</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"hesap_no"));	       
                    
                 ?>  
                 </div>
                 
                 
                                 
                        <div class="col-lg-12 col-md-12 col-sm-12 formeleman">İban no</div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">
                    	 <?php 	
	
                    
 	 Form::Olustur("2",array("type"=>"text","class"=>"form-control","name"=>"iban_no"));	       
                    
                 ?>  
                 </div>
             
             
             
              <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi"><?php 		
		
			 Form::Olustur("2",array("type"=>"submit","value"=>"HESAP EKLE","class"=>"btn btn-success"));	
	 
					 
			Form::Olustur("kapat");	 ?></div>  
             
             
             
             			</div>
                        
                        
  
                        
             
             
             </div>
              
 
      			 </div>
         </div>
         
           <!--  FORMUN İSKELETİ-->
      
      
      <?php 	  
	  	 
	  
	  endif;
	  	  
	  endif; // BANKA BİLGİ EKLEME	
	 
	  //*****************************************************
	 
	 // VERİLERİN TÜMÜNÜN GÖRÜNDÜĞÜ YER
	  if (isset($veri["data"])) :
	  
	
	   ?>
      
      <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-lg-9 col-xl-9 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> HESAP NUMARALARI </h1></div>
              
 

             
        
     <div class="col-xl-3 col-lg-3 col-md-12 mb-12 text-right">
     	<div class="row">    

                   
 
<div class="col-xl-12 text-right">  <a href="<?php echo URL."/panel/bankaEkle/ilk";?>" class="btn btn-sm btn-success ">Hesap Ekle</a>  </div>
             
   
        
        </div>
     
     
    
     </div>    
       
          </div>
          <!-- BAŞLIK --> 	
          
          
              
                
      	<!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        		 <div class="row arkaplan p-1 mt-2 pb-0">
                                 
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span >Banka Adı</span> 
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span >Hesap adı</span> 
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span>Hesap No</span> 
                    </div>
                    
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span >İban No</span>                     
                    </div>                  
                 
                    
                     <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 p-2 pt-3   geneltext bg-gradient-mvc">
                <span >İşlemler</span> 
                    </div>
                    
                    <!--  ÜRÜNLER-->
                    
                    
                       <?php   foreach ($veri["data"] as $value) : ?>
           
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0">
                     
                                      
                        <?php 
						
		
							echo '<div class="row border border-light">
							     
<div class="col-lg-2 col-xl-2 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["banka_ad"].'</div>
<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["hesap_ad"].'</div>
<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["hesap_no"].'</div>
<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["iban_no"].'</div>

     
<div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2 text-right">


<a href="'.URL.'/panel/bankaGuncelle/ilk/'.$value["id"].'" class="fas fa-edit  guncelbuton"></a>

</div>
				   
<div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2 text-left">'; ?>

<a onclick="silmedenSor('<?php echo URL."/panel/bankaSil/".$value["id"];?>'); return false"  class="fas fa-trash-alt  text-danger  alertSilme"></a> 
              

 
 <?php echo' </div>
 </div> 
 
 
  </div>';	
					
					
	  					endforeach;
						
						
						 ?>
                 
                   <!-- -->     
                 
                 
                 </div>
        
      	<!-- SİPARİŞİN İSKELETİ BİTİYOR -->
         <?php
	
        
        endif;
		
		 
		

	
		
		?>  
          
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>