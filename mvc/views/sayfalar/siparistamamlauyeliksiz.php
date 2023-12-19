<?php require 'views/header.php';  ?>


<?php



  if (isset($veri["bilgi"])) :			
			echo $veri["bilgi"];		
			
            endif;

if (isset($_COOKIE["urun"])) :  


 if (Session::get("siparistenmikod")==5050) : 
  
 ?>

	<div class="container" id="sipTamamlaİskelet" >
    
    	<div class="row">
        
        		<div class="col-xl-6 col-lg-6 col-md-6 " id="soltaraf">
                	<div class="row">
                     <!-- ÜYENİN TEMEL BİLGİLERİ GELİYOR -->
                    	<div class="col-xl-11 col-lg-11 col-md-11 siparisanaiskeletler">
                        	<div class="row" id="uyelik">
                            	<div class="col-md-12 siparisbaslik"><h4>ÜYELİK BİLGİLERİ</h4></div>
								<?php Form::Olustur("1",array("method"=>"POST","action"=>URL."/uye/odemeyap/uyeliksiz")); ?>
                                
                                
								
									 <div class="row uyeliksatir mt-7">									
									 <div class="col-xl-4 col-lg-4 col-md-4 pt-15">Ad</div>
									 <div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text", "id" => "sipAd", "name" => "ad","class"=>"form-control")) ?>
									 </div>
									 </div>
                             
									 <div class="row uyeliksatir">
								   	<div class="col-xl-4 col-lg-4 col-md-4 pt-15" >Soyad</div>
                           		 	<div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text", "id" => "sipSoyad","name" => "soyad","class"=>"form-control")) ?></div>
								 	</div>
									
									 <div class="row uyeliksatir">
									 <div class="col-xl-4 col-lg-4 col-md-4 pt-15" >Mail</div>
                           		 	 <div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text", "id" => "sipMail","name" => "mail", "class"=>"form-control")) ?></div>
								 	 </div>
									
									 <div class="row uyeliksatir">
									 <div class="col-xl-4 col-lg-4 col-md-4 pt-15" >Telefon</div>
                           		 	 <div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text", "id" => "sipTlf","name" => "telefon", "class"=>"form-control")) ?></div>
								 	 </div>
									 
									  <div class="row uyeliksatir">
									 <div class="col-xl-4 col-lg-4 col-md-4 pt-15" >Adres</div>
                           		 	 <div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text", "id" => "sipadres","name" => "adres","class"=>"form-control")) ?></div>
								 	 </div>
                               
								 
								
														 
								 	
									 <div class="row  float-right terciharkaplan Bilgitercih">									 
									 <div class="col-md-12 mx-auto "><?php Form::Olustur("2",array("type" => "radio", "name" => "bilgiTercih","checked"=>"checked","value"=>0)) ?> Üyelik Bilgilerimi Kullan		   
		  							 <?php Form::Olustur("2",array("type" => "radio", "name" => "bilgiTercih","value"=>1)) ?> Farklı Bilgiler Kullan</div>	
								 	</div>                                 
                            
                            </div>
                        </div>
						
					
						
						<!-- ÜYENİN FATURA BİLGİLERİ GELİYOR -->
														  
										<div class="col-xl-11 col-lg-11 col-md-11 siparisanaiskeletler">
											<div class="row" id="uyelik">
												<div class="col-md-12 siparisbaslik "><h4>FATURA BİLGİLERİ</h4></div>


													 <div class="row uyeliksatir">									
													 <div class="col-xl-4 col-lg-4 col-md-4 pt-15">Ad</div>
													 <div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text", "name" => "fatad","class"=>"form-control")) ?>
													 </div>
													 </div>

													 <div class="row uyeliksatir">
													<div class="col-xl-4 col-lg-4 col-md-4 pt-15" >Soyad</div>
													<div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text", "name" => "fatsoyad","class"=>"form-control")) ?></div>
													</div>

													<div class="row uyeliksatir">
													<div class="col-xl-4 col-lg-4 col-md-4 pt-15" >İl</div>
													<div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text","name" => "fatulke", "value"=>"Türkiye","class"=>"form-control")) ?></div>
													</div>

													<div class="row uyeliksatir">
													<div class="col-xl-4 col-lg-4 col-md-4 pt-15" >İlçe</div>
													<div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text","name" => "fatsehir", "value"=>"İzmir","class"=>"form-control")) ?></div>
													</div>

													<div class="row uyeliksatir">
													<div class="col-xl-4 col-lg-4 col-md-4 pt-15" >Adres</div>
													<div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text","name" => "fatadres", "class"=>"form-control")) ?></div>
													</div>

													 <div class="row float-right terciharkaplan faturatercih">									 
													 <div class="col-md-12 mx-auto"><?php Form::Olustur("2",array("type" => "radio", "name" => "faturaTercih","checked"=>"checked","value"=>0)) ?> Fatura Bilgilerim Aynı Olsun	   
													 <?php Form::Olustur("2",array("type" => "radio", "name" => "faturaTercih","value"=>1)) ?> Farklı Bilgiler Kullan</div>	
													</div>  



											</div>
										</div>						

									 

                    
                    </div>  
                
                </div>                
                 <!-- SEPETTEKİ ÜRÜNLERİ LİSTELENİYOR VE ÖDEME FORMU GELİYOR -->  
                
                <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="row" id="sagtaraf">  
						
						    
						
								 <!-- ÜYENİN TESLİMAT BİLGİLERİ GELİYOR -->
						<div class="col-xl-11 col-lg-11 col-md-11 siparisanaiskeletler">
                        	<div class="row" id="uyelik">
                            	<div class="col-md-12 siparisbaslik "><h4>TESLİMAT BİLGİLERİ</h4></div>
                               
								
									 <div class="row uyeliksatir">									
									 <div class="col-xl-4 col-lg-4 col-md-4 pt-15">Ad</div>
									 <div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text", "name" => "tesad", "class"=>"form-control")) ?>
									 </div>
									 </div>
                             
									 <div class="row uyeliksatir">
								   	<div class="col-xl-4 col-lg-4 col-md-4 pt-15" >Soyad</div>
                           		 	<div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text", "name" => "tessoyad","class"=>"form-control")) ?></div>
								 	</div>
									
									<div class="row uyeliksatir">
								   	<div class="col-xl-4 col-lg-4 col-md-4 pt-15" >İl</div>
                           		 	<div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text","name" => "tesulke", "value"=>"Türkiye","class"=>"form-control")) ?></div>
								 	</div>
									
									<div class="row uyeliksatir">
								   	<div class="col-xl-4 col-lg-4 col-md-4 pt-15" >İlçe</div>
                           		 	<div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text","name" => "tessehir", "value"=>"İzmir","class"=>"form-control")) ?></div>
								 	</div>
									<div class="row uyeliksatir">
								   	<div class="col-xl-4 col-lg-4 col-md-4 pt-15" >Adres</div>
                           		 	<div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text","name" => "tesadres", "class"=>"form-control")) ?></div>
								 	</div>
									
									 <div class="row  float-right terciharkaplan testercih">									 
									 <div class="col-md-12 mx-auto"><?php Form::Olustur("2",array("type" => "radio", "name" => "teslimatTercih","checked"=>"checked","value"=>0)) ?> Teslimat Bilgilerim Aynı Olsun	   
		  							 <?php Form::Olustur("2",array("type" => "radio", "name" => "teslimatTercih","value"=>1)) ?> Farklı Bilgiler Kullan</div>	
								 	</div>   
									
								                           
                            
                            </div>
                        </div>
						
						
                    	<div class="col-md-12" id="baslik"><h4>SEPETTEKİ ÜRÜNLERİNİZ</h4></div>
                        <div class="col-md-3" id="icbaslik">Ürün Ad</div>
                        <div class="col-md-3" id="icbaslik">Adet</div>
                        <div class="col-md-3" id="icbaslik">Birim Fiyat</div>
                        <div class="col-md-3" id="icbaslik">Toplam</div>
                        <!-- SEPETTEKİ ÜRÜNLER BURADA LİSTELENECEK -->
                      <?php  


                       $toplamAdet=0;
					   $toplamfiyat=0;
					   
					   
                       	foreach ($_COOKIE["urun"] as $id => $adet) :				
				
				 $GelenUrun=$Harici->UrunCek($id);
				 $GelenKategori=$Harici->UrunkategoriGetir($GelenUrun[0]["katid"]);
				
	 			echo'<div class="col-md-3" id="icurunler">'.$GelenUrun[0]["urunad"].'</div>
                        <div class="col-md-3" id="icurunler">'.$adet.'</div>
                        <div class="col-md-3" id="icurunler">'.number_format($GelenUrun[0]["fiyat"],2,'.',',').'</div>
                        <div class="col-md-3" id="icurunler">'.number_format($GelenUrun[0]["fiyat"]*$adet,2,',','.').'</div>';

				 
			 $toplamAdet  += $adet;
			 $toplamfiyat += $GelenUrun[0]["fiyat"]*$adet;			 
				
				endforeach; 
				
	
				
				echo'<div class="col-md-3" id="toplam">Toplam Adet</div>
                        <div class="col-md-3" id="toplam">'.$toplamAdet.'</div>
                        <div class="col-md-3" id="toplam">Toplam Tutar</div>
                        <div class="col-md-3" id="toplam">'.number_format($toplamfiyat,2,',','.').'</div>';	
				?>       
                        </div>
                        
                        <div class="row">
                        				
			<div class="col-md-12">
				<?php 
				
				Form::Olustur("2",array("type" => "submit","value"=>"ÖDEME ADIMINA GEÇ","class"=>"btn btn_5")); 
					  Form::Olustur("kapat");			
					?>            
            
			</div>	     
                        </div>
								
			
			
						
                        
                        
                
                </div>      
        
        	

        
        </div>
    
    
	
</div>

<?php
else:


	header("Location:".URL);
	
	endif;
	
	
	
	else:
	// BU SEPETTE ÜRÜN VARMI ONA BAKIYOR
	header("Location:".URL);
	
	
	
	endif;
	
	
?>


<?php require 'views/footer.php'; ?> 		
        
        
        
       