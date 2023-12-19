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
	  

	 
	 
	
	  if (isset($veri["data"])) :
	  
	
	   ?> 

      
      <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-lg-4 col-xl-4 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-comment basliktext"></i> ÜYE YORUMLARI </h1></div>
              
 
    <div class="col-lg-8 col-xl-8 col-md-12 mb-12 p-2"><h1 class="h3 mb-0 text-gray-800">Toplam yorum : <?php echo $veri["toplamveri"]; ?></h1></div>  
             
        </div>
   
          <!-- BAŞLIK --> 	
          
          
              
                
      	<!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        		 <div class="row arkaplan p-1 mt-2 pb-0">
                 	<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span>Üye Adı</span> 
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span >Ürün adı</span> 
                    </div>
                    
                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span >Yorum</span> 
                    </div>
                    
                    <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span>Tarih</span> 
                    </div>
                    
                    <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span >Durum</span> 
                    
                    </div>
                    
                    <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
                    <span >İşlem</span> 
                    
                    </div>
                    
         
                    
                    <!--  ÜRÜNLER-->
                    
                    
                       <?php   foreach ($veri["data"] as $value) : ?>
           
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0">
                     
                                      
                        <?php 
						
		
							echo '<div class="row border border-light">
							     
<div class="col-lg-2 col-xl-2 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["ad"].'</div>
<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["urunad"].'</div>

<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["icerik"].'</div>
<div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2">'.$value["tarih"].'</div> 
<div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2">';
echo $value["durum"]==1 ? '<span class="text-success">Onaylı</span>' : '<span class="text-danger">Onaysız</span>';

echo'</div> 


     
<div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 text-dark kalinyap p-2 text-right">

	<div class="row">
	
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-dark kalinyap  text-center">';
		
echo $value["durum"]==1 ? '' : '<a onclick=\'uyeyorumkontrol("'.$value["id"].'","1")\'  class="fas fa-check mt-1 ajaxolumlubuton text-success" ></a>';		
		
	
		
		
		echo'</div>
		
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-dark kalinyap  text-center">	
 <a  onclick=\'uyeyorumkontrol("'.$value["id"].'","2")\' class="fas fa-trash-alt    ajaxolumsuzbuton text-danger"></a> 
		</div>
		
	</div>



 </div>

</div>
				   

 
 
  </div>';	
					
					
	  					endforeach;
						
						
						 ?>
                 
                   <!-- -->     
                 
                 
                 </div>
        
      	<!-- SİPARİŞİN İSKELETİ BİTİYOR -->
         <?php
	
	
		 
        
		Pagination::numaralar($veri["toplamsayfa"],"/panel/musteriyorumlar/");
        
        endif;
		
		 
		

	
		
		?>  
          
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>