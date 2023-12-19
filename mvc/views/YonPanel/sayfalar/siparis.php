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
	  
	  if (isset($veri["KargoGuncelle"])) :
	  
	
	  
	  if (!$_POST) :
	  
	  ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2 baslikana"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> KARGO DURUMU GÜNCELLE </h1></div>
			 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2">			 
 <?php $PanelHarici->İcnavigasyon("siparisler","Siparişler","Kargo Güncelleme"); ?>	 		
			 
			 </div>
              
 
          </div>
          <!-- BAŞLIK --> 	
      
      <?php
	  
	  Form::Olustur("1",array(
					 "action" => URL."/panel/kargoguncelle/son",
					 "method" => "POST"				
					 ));  
	  ?>
      
            <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-xl-4 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>Kargo Durum Güncelle</h3></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Mevcut Sipariş Durumu</div>
                     <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi">
					 <?php 	
			 Form::OlusturSelect("1",array("name"=>"durum","class"=>"form-control"));
			 	
			 Form::OlusturOption(array("value"=>"0"),$veri["KargoGuncelle"][0]["kargodurum"]=="0" ? "selected" : false,"Tedarik Sürecinde");
			 	
			 Form::OlusturOption(array("value"=>"1"),$veri["KargoGuncelle"][0]["kargodurum"]=="1" ? "selected" : false,"Paketleniyor");
			 
			 Form::OlusturOption(array("value"=>"2"),$veri["KargoGuncelle"][0]["kargodurum"]=="2" ? "selected" : false,"Kargoya Verildi");	
			  
			 Form::OlusturSelect("2",null);	?></div>
             
             
              <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi"><?php 		
		
			 Form::Olustur("2",array("type"=>"submit","value"=>"GÜNCELLE","class"=>"btn btn-success"));		
			 
			 Form::Olustur("2",array("type"=>"hidden","name"=>"sipno","value"=>$veri["KargoGuncelle"][0]["siparis_no"]));	 
					 
			Form::Olustur("kapat");	 ?></div>  
             
             
             
             			</div>
                        
                        
  
                        
             
             
             </div>
              
 
      			 </div>
         </div>
         
           <!--  FORMUN İSKELETİ-->
      
      
      <?php 
	  
	  	 
				
		 
	  
	  
	  
	  endif;
	  	  
	  endif; // KARGO DURUM GÜNCELLEME 
	  
	
	 
	 
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
       
        	 <div class="col-lg-2 col-xl-2 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> SİPARİŞLER </h1></div>
              
 
    <div class="col-lg-3 col-xl-3 col-md-12 mb-12 p-2"><h1 class="h3 mb-0 text-gray-800">Toplam sipariş : <?php echo count($temizsiparisnumaralari); ?></h1></div>  
             
        
     <div class="col-xl-7 col-md-12 mb-12 text-right">
     	<div class="row">
        
        <div class="col-xl-4">
        
            	  <?php
	  
	  Form::Olustur("1",array(
					 "action" => URL."/panel/siparisarama",
					 "method" => "POST"				
					 ));  
				
			 Form::OlusturSelect("1",array("name"=>"aramatercih","class"=>"form-control","id"=>"aramaselect"));
			 	
			 Form::OlusturOption(array("value"=>"sipno"),false,"Sipariş numarası");
			 	
			 Form::OlusturOption(array("value"=>"uyebilgi"),false,"Üye Bilgisi");
		
			 Form::OlusturSelect("2",null);			
				
					 
					 ?>
        
        
        
        </div>
        
        	<div class="col-xl-4">
         	  <?php
	
					 
					 
 Form::Olustur("2",array("type"=>"text","name"=>"aramaverisi","class"=>"form-control","id"=>"aramakutusu"));		 
					 
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
          
          
        <?php 
			
		
	  foreach ($temizsiparisnumaralari as $value) :
	  
	 $veriler=$PanelHarici->joinislemi(
			array(
			"siparisler.kargodurum As kargodurum",
			"siparisler.odemeturu As odemeturu",
			"siparisler.tarih As tarih",
			"uye_panel.ad  As uyead",
			"uye_panel.tur  As uyetur",
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
                    <span>Üye Ad :</span>
										
					<?php
					if ($veriler[0]["uyetur"]==2) :
					echo '<span class="text-warning">'.$veriler[0]["uyead"].'</span>';
					else:
					echo '<span class="spantext">'.$veriler[0]["uyead"].'</span>';
					endif;
					?>
					
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
                    
                    
                    
                    
   <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 geneltext bg-gradient-mvc">     
                 

                     
                      
                    <a href="<?php echo URL."/panel/kargoguncelle/ilk/".$value; ?>" class="btn btn-sm btn-success btn-block mb-1">GÜNCELLE</a>
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
			
        
         // SİPARİŞLERİN TÜMÜNÜN GÖRÜNDÜĞÜ YER
         

         endif; ?>  
          
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>