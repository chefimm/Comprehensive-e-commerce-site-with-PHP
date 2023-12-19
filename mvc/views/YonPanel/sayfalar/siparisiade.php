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
	  
	
	 
	 // SİPARİŞLERİN TÜMÜNÜN GÖRÜNDÜĞÜ YER
	  if (isset($veri["data"])) :
	  
	  $siparisnum=array();
	 
	  foreach ($veri["data"] as $value) :	  
	  $siparisnum[]=$value["siparis_no"];	  
	  endforeach;	 
	
	  $temizsiparisnumaralari=array_unique($siparisnum,SORT_STRING);
	  
	   ?>
      
      
      
      <!-- BAŞLIK -->
      

 
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-lg-4 col-xl-4 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> İADE SİPARİŞLER </h1></div>
              
 
    <div class="col-lg-8 col-xl-8 col-md-12 mb-12 p-2"><h1 class="h3 mb-0 text-gray-800"> <?php 
	if (count($temizsiparisnumaralari)==0):
	echo "BEKLEYEN SİPARİŞ İADE TALEBİ YOK";
	else:
	echo "Onay Bekleyen siparişler : ".  count($temizsiparisnumaralari);
	endif;
	
	 ?></h1></div>  
             
        
         
       
          </div>
          <!-- BAŞLIK --> 	
          
          
        <?php 
		
		if (count($temizsiparisnumaralari)==0):
		?>
	<div class="row arkaplan p-1 mt-2 pb-0">
     	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2">
		<div class="alert alert-danger">BEKLEYEN ONAY YOK</div>
		</div>
                   
                 
                 
                 
                 </div>
	<?php 			 
	else:
				
		
	  foreach ($temizsiparisnumaralari as $value) :
	  
	 $veriler=$PanelHarici->joinislemi(
			array(
			"siparisler.kargodurum As kargodurum",
			"siparisler.odemeturu As odemeturu",
			"siparisler.tarih As tarih",
			"uye_panel.ad  As uyead",
			"adresler.adres  As adres",
			"adresler.id  As adresid"			
			),
			array(
			"siparisler",
			"uye_panel",
			"adresler"		
			),
			"(siparisler.siparis_no=$value) AND (siparisler.adresid=adresler.id) AND 	(siparisler.uyeid=uye_panel.id) LIMIT 1"
			);
	  
	 	  
	
	  
	?>
	  

                
      	<!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        		 <div class="row arkaplan p-1 mt-2 pb-0">
                 	<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">
                    <span>Sipariş No :</span> <span class="spantext"><?php echo $value; ?></span>
                    </div>
                    
                    <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">
                    <span>Üye Ad :</span> <span class="spantext"><?php  echo $veriler[0]["uyead"];  ?></span>
                    </div>
                    
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">
                    <span>Kargo Durumu :</span> <span class="spantext">
					
					<?php 
					switch ($veriler[0]["kargodurum"]) :
					
					case "0":
					echo "Tedarik Sürecinde"; 
					break;
					case "1":
					echo "Paketleniyor"; 
					break;
					case "2":
					echo "Kargoya verildi"; 
					break;
					
					endswitch;
					
					?>
                    
                    
                    </span>
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">
                    <span>Ödeme Türü :</span> <span class="spantext"><?php echo $veriler[0]["odemeturu"];?></span>
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 pt-3 geneltext bg-gradient-mvc">
                    <span>Tarih :</span> <span class="spantext"><?php echo $veriler[0]["tarih"];  ?></span>
                    </div>
                    
                    
                    
                       <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 geneltext bg-gradient-mvc" id="detaygoster">     
                 
                 
  <a class="btn btn-secondary p-1" data-value="<?php echo $value; ?>" data-value2="<?php echo $veriler[0]["adresid"];  ?>" data-toggle="modal" data-target="#exampleModalCenter" id="adres"><i class="fas fa-dolly"></i></a>
  
    <a class="btn btn-secondary p-1" data-value="<?php echo $value; ?>" data-value2="<?php echo $veriler[0]["adresid"];  ?>" data-toggle="modal" data-target="#exampleModalCenter" id="siparis"><i class="fas fa-print"></i></a>
                     
                    </div>   
                    
                    
                    
                    
   <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 geneltext bg-gradient-mvc" id="iadeonay">                     
  <a  data-value="<?php echo $value; ?>" class="btn btn-sm btn-dark btn-block mb-1">ONAYLA</a>
                    </div>
                    
                    <!--  ÜRÜNLER-->
           
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0">
                     
                     	<div class="row">                      
                        
<div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">ÜRÜN ADI</div>
<div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">ÜRÜN ADET</div>
<div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">ÜRÜN FİYAT</div>
<div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">TOPLAM FİYAT</div>
						</div>
                        
                        <?php 
					
					
	$urunlerial=$PanelHarici->Verial("siparisler","where siparis_no=".$value);
	$toplam=array();
	foreach ($urunlerial as $deger):
	
		echo '<div class="row border border-light">     
<div class="col-lg-3 text-dark kalinyap p-2">'.$deger["urunad"].'</div>
<div class="col-lg-3 text-dark kalinyap p-2">'.$deger["urunadet"].'</div>
<div class="col-lg-3 text-dark kalinyap p-2">
'.number_format($deger["urunfiyat"],2,",",".").' TL</div>
<div class="col-lg-3 text-dark kalinyap p-2">'.number_format($deger["toplamfiyat"],2,",",".").' TL</div>             
           </div> ';
	$toplam[]=$deger["toplamfiyat"];	
	endforeach;
											
			  ?>
      
      
              <!-- TOPLAM FİYAT -->
                     
                   	<div class="row"> 
                      
                    <div class="col-lg-9 text-dark kalinyap p-2"></div>    
                    <div class="col-lg-2  geneltext2 text-right p-2"><span>SİPARİŞ TOPLAMI :</span></div>  
                    <div class="col-lg-1  geneltext2 text-left kalinyap p-2"><span >
					
					<?php
					print_r(number_format(array_sum($toplam),2,",","."). " TL");
					
					 ?></span></div>        
                        
                    </div>    
                 <!-- TOPLAM FİYAT -->   
                 
               
			      
                     </div>
                 
                   <!--  ÜRÜNLER-->
                   
               
                   
                   
                 
                 
                 
                 </div>
        
      	<!-- SİPARİŞİN İSKELETİ BİTİYOR -->
			   
      
      
     				 <?php
				
	  					endforeach;						
			
        			endif;
         // SİPARİŞLERİN TÜMÜNÜN GÖRÜNDÜĞÜ YER
         

         endif; ?>  
          
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>