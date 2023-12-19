<?php require 'views/YonPanel/header.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid mt-3">

          <!-- Page Heading -->
          

          <div class="row">
      <div class="col-xl-12 col-md-12 mb-12 text-center">   
	
	    <!-- BAŞLIK -->     

 
       <div class="row text-center border-bottom-mvc mb-2">  
       
        	 <div class="col-lg-12 col-xl-12 col-md-12 mb-12 border-left-mvc text-center p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-search basliktext"></i> RAPORLAMA </h1></div>
         </div>       
 <div class="row text-left border-bottom-mvc mb-2 arama-bg-gradient"> 
 
      <div class="col-xl-11 col-md-9 mb-12 text-left   ">
     	<div class="row">
					
							
							<div class="col-xl-1 p-3 eleman1 noaltcizgi pt-4">
							Ödeme Türü
							
							</div>	
							<div class="col-xl-2 p-2 eleman2 noaltcizgi pt-3">
							 <?php 
							 
					 Form::Olustur("1",array(
					 "action" => URL."/panel/muhaseberapor",
					 "method" => "POST"				
					 )); 
					 
			 Form::OlusturSelect("1",array("name"=>"odemeturu","class"=>"form-control p-1"));	 Form::OlusturOption(array("value"=>""),false,"Seçiniz");	
			 Form::OlusturOption(array("value"=>"Nakit"),false,"Nakit");			 	
			 Form::OlusturOption(array("value"=>"Sanal Pos"),false,"Sanal Pos");
			 Form::OlusturSelect("2",null);	
							 ?>
							
							</div>	
							
						<div class="col-xl-2 p-3 eleman1 noaltcizgi pt-4">
							Sipariş Durumu				
							</div>	
							<div class="col-xl-2 p-2 eleman2 noaltcizgi pt-3">
							 <?php 						 
			 Form::OlusturSelect("1",array("name"=>"durum","class"=>"form-control p-1"));
			 Form::OlusturOption(array("value"=>""),false,"Seçiniz");
			 Form::OlusturOption(array("value"=>"0"),false,"İşlemde");	
			 Form::OlusturOption(array("value"=>"1"),false,"Tamamlanmış");
			 Form::OlusturOption(array("value"=>"2"),false,"İade");
			 Form::OlusturOption(array("value"=>"3"),false,"İade Onaylanmış");
			 Form::OlusturSelect("2",null);	
							 ?>
							
							</div>	
							<div class="col-xl-1 p-3 eleman1 noaltcizgi pt-4">
							Tarih
							
							</div>	
							
							
								<div class="col-xl-2 p-2 eleman2 noaltcizgi">
			<?php  Form::Olustur("2",array("type"=>"date","name"=>"tarih1","class"=>"form-control p-1 mt-2"));	?>
							
							</div>	
							<div class="col-xl-2 p-2 eleman2 noaltcizgi">
							 <?php 						 
	  Form::Olustur("2",array("type"=>"date","name"=>"tarih2","class"=>"form-control p-1 mt-2"));
							 ?>
							
							</div>	
		

        
        </div>

     
     
    
     </div>  
	 
	 		   <div class="col-lg-1 col-xl-1 col-md-12 mb-12 p-1">
	 <?php		
			 Form::Olustur("2",array("type"=>"submit","value"=>"ARA","class"=>"btn btn-sm arama-btn-mvc btn-block"));
			 	Form::Olustur("kapat");
	 ?>
	
	</div> 
       
          </div>
          <!-- BAŞLIK --> 	
		      
      <?php 
	  
	  
	  			if (isset($veri["varsayilan"])) :				
				
	echo '<div class="alert alert-danger p-2 mt-5"><h4 class="pt-3">LÜTFEN ARAMA KRİTERİ SEÇİNİZ</h4></div>';
				endif;
				
				if (isset($veri["Hata"])) :				
				
	echo '<div class="alert alert-info p-2 mt-5"><h4 class="pt-3">Arama kriterlerine göre eşleşen kayıt bulunamadı.</h4></div>';
				endif;
	  	
	 // SİPARİŞLERİN TÜMÜNÜN GÖRÜNDÜĞÜ YER
	  if (isset($veri["data"])) :
	  
	  $idler=array();
	 
	  foreach ($veri["data"] as $value) :	  
	  $idler[]=$value["id"];	  
	  endforeach;	
	  $son=join(",",$idler);
	  
	  Session::set("idler",$son);
				
	echo '<div class="alert alert-info p-1 mt-2"><h5 class="pt-2">'.$veri["aramakriter"].' <a href="'.URL.'/panel/muhasebeExcelAl" class="btn btn-primary btn-sm">EXCELE AKTAR</a></h5> </div>';
		
	  
	  ?>
	  
	  <!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        		 <div class="row">
				 	
                 	<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 p-2 pt-3 geneltext bg-gradient-mvc">
                    <span>Ürün Adı</span>					
                    </div>
                    
                    <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 p-2 pt-3 geneltext bg-gradient-mvc">
                    <span>Ürün Adet</span>
                    </div>
                    
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 p-2 pt-3 geneltext bg-gradient-mvc">
                    <span>Ürün Fiyat</span> 
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 p-2 pt-3 geneltext bg-gradient-mvc">
                    <span>Toplam Fiyat</span> 
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 p-2 pt-3 geneltext bg-gradient-mvc">
                    <span>Ödeme Türü</span>
                    </div>
                 </div> 
	  
	  <?php
	  

	$Toplamadet=0;
	$ToplamFiyat=0;
	
	 foreach ($veri["data"] as $value) :		 
	 ?>
	 
	  <!-- BURADA KRİTERE GÖRE GELEN ÜRÜNLER DÖNGÜ İÇERİSİNDE LİSTELENECEK-->
					
					<div class="row  table-striped table-dark table-borderless table-striped w-auto">
                 	<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 p-2 geneltext border border-bottom-0 border-right-0 ">
                    <span><?php echo $value["urunad"];?> </span>					
                    </div>
                    
                    <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 p-2 geneltext border border-bottom-0 border-right-0">
                    <span><?php echo $value["urunadet"];?></span>
                    </div>
                    
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 p-2 geneltext border border-bottom-0 border-right-0">
                    <span><?php echo $value["urunfiyat"];?></span> 
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 p-2 geneltext border border-bottom-0 border-right-0">
                    <span><?php echo  number_format($value["toplamfiyat"],2,",",".");?> TL</span> 
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 p-2 geneltext border border-bottom-0 border-right-0">
                    <span><?php echo $value["odemeturu"];?></span>
                    </div>
                   </div> 
				     <!-- BURADA KRİTERE GÖRE GELEN ÜRÜNLER DÖNGÜ İÇERİSİNDE LİSTELENECEK-->
	 
	
	 
	 <?php	 
	  $Toplamadet+=$value["urunadet"];
	  $ToplamFiyat+=$value["toplamfiyat"];
	  endforeach;	
	
	  
	?>
	  

                
      	
                              
                   
				   
				     <!-- BURADA FOREACH BİTECEK VE TOPLAM FİYAT İSKELETİ BAŞLAYACAK-->
					 
				<div class="row">	
				
				<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 p-2 pt-3 geneltext bg-gradient-mvc">
                    <span>TOPLAM ADET</span>					
                    </div>
				<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 p-2 pt-3 geneltext bg-gradient-mvc">
                    <span><?php echo $Toplamadet; ?></span>					
                    </div>
					
					<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 p-2 pt-3 geneltext bg-gradient-mvc">
                    <span>TOPLAM FİYAT</span>					
                    </div>
				<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 p-2 pt-3  geneltext bg-gradient-mvc">
                    <span><?php echo  number_format($ToplamFiyat,2,",","."); ?> TL</span>					
                    </div>
				
				 </div> 
           
                 
        
      	<!-- SİPARİŞİN İSKELETİ BİTİYOR -->              
   
                        
                       <?php 
					   
					   
					   
					   
					   
					/*
					
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
				*/							
			  ?>
      
      
              <!-- TOPLAM FİYAT -->
                     
                <?php
				//	print_r(number_format(array_sum($toplam),2,",","."). " TL");
					
					 ?>   
                 <!-- TOPLAM FİYAT -->  
                 
                 
                   <!--  ÜRÜNLER-->
              
                 
                 
           
			   
      
      
     				 <?php
				
	  								
			
        
         // SİPARİŞLERİN TÜMÜNÜN GÖRÜNDÜĞÜ YER
         

         endif; ?>  
          
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>