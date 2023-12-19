<?php require 'views/header.php';  ?>


<?php

/* BU SAYFANIN GÖRÜNTÜLENMESİNDE OTURUM KONTROLÜ YANI SIRA SEPETTE ÜRÜN VARMI DİYE KONTROL
EDİLECEK VE SEPETTE ÜRÜN YOK İSE BU SAYFA GÖRÜNTÜLENEMEYECEK */ 

  if (isset($veri["bilgi"])) :			
			echo $veri["bilgi"];		
			
            endif;

if (isset($_COOKIE["urun"])) :  


 if (Session::get("kulad") && Session::get("uye")) : 
 Session::OturumKontrol("uye_panel",Session::get("kulad"),Session::get("uye"));
 
 ?>

	<div class="container" id="sipTamamlaİskelet" >
    
    	<div class="row">
        
        		<div class="col-xl-6 col-lg-6 col-md-6 " id="soltaraf">
                	<div class="row">
                     <!-- ÜYENİN TEMEL BİLGİLERİ GELİYOR -->
                    	<div class="col-xl-11 col-lg-11 col-md-11 siparisanaiskeletler">
                        	<div class="row" id="uyelik">
                            	<div class="col-md-12 siparisbaslik"><h4>ÜYELİK BİLGİLERİ</h4></div>
								<?php Form::Olustur("1",array("method"=>"POST","action"=>URL."/uye/odemeyap")); ?>
                                
                                
                                <?php $sonuc=$Harici->UyeBilgileriniGetir(); ?>
								
									 <div class="row uyeliksatir mt-7">									
									 <div class="col-xl-4 col-lg-4 col-md-4 pt-15">Ad</div>
									 <div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text", "id" => "sipAd", "name" => "ad", "value"=>$sonuc[0]["ad"],"class"=>"form-control")) ?>
									 </div>
									 </div>
                             
									 <div class="row uyeliksatir">
								   	<div class="col-xl-4 col-lg-4 col-md-4 pt-15" >Soyad</div>
                           		 	<div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text", "id" => "sipSoyad","name" => "soyad", "value"=>$sonuc[0]["soyad"],"class"=>"form-control")) ?></div>
								 	</div>
									
									 <div class="row uyeliksatir">
									 <div class="col-xl-4 col-lg-4 col-md-4 pt-15" >Mail</div>
                           		 	 <div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text", "id" => "sipMail","name" => "mail", "value"=>$sonuc[0]["mail"],"class"=>"form-control")) ?></div>
								 	 </div>
									
									 <div class="row uyeliksatir">
									 <div class="col-xl-4 col-lg-4 col-md-4 pt-15" >Telefon</div>
                           		 	 <div class="col-xl-7 col-lg-7 col-md-7" id="input"><?php Form::Olustur("2",array("type" => "text", "id" => "sipTlf","name" => "telefon", "value"=>$sonuc[0]["telefon"],"class"=>"form-control")) ?></div>
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
						
						 <!-- ÜYENİN ADRESLERİ GELİYOR -->  
                      	<div class="col-xl-11 col-lg-11 col-md-11 siparisanaiskeletler">
                        <div class="row" id="uyelik2">
                            	<div class="col-md-12 siparisbaslik"><h4>ADRESLER</h4></div> 
                                
                                 <?php 
								 
								 foreach ($Harici->UyeAdresleriniGetir() as $deger) :
								 echo ' <div class="col-xl-12 col-lg-12 col-md-12" id="adresSatir">
								 
								 <div class="row" id="adressecim">
								 <div class="col-xl-9 col-lg-9 col-md-9">'.$deger["adres"].'</div>
								 <div class="col-xl-3 col-lg-3 col-md-3 text-right ">';
								 
								 if ($deger["varsayilan"]==1) :
								 echo "Varsayılan";
								 
						Form::Olustur("2",array("type" => "radio","value" => $deger["id"], "name" => "adrestercih","checked"=>"checked","id"=>"radioBtn","class"=>"float-right","data-value"=>$deger['adres']));	

						
					
						else:
						Form::Olustur("2",array("type" => "radio","value" => $deger["id"], "name" => "adrestercih","id"=>"radioBtn","class"=>"float-right","data-value"=>$deger['adres']));			 
								 endif;	
							echo'</div> </div> </div>';
								 endforeach;


								 
								 ?>
                                
                            
                            </div>									
                        
                        </div>      
						
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
	Session::set("siparistenmikod",5050); 

?>

 <div class="content">
	<div class="container">
		<div class="login-page">
			    <div class="dreamcrub">
			   	 <ul class="breadcrumbs">
                    <li class="home">
                       <a href="<?php echo URL; ?>" title="Anasayfa">Anasayfa</a>&nbsp;
                       <span>&gt;</span>
                    </li>
                    <li class="women">
                       Üyeliksiz Alışveriş
                    </li>
                </ul>
                <ul class="previous">
                	<li><a href="<?php echo URL; ?>">Geri Dön</a></li>
                </ul>
                <div class="clearfix"></div>
			   </div>
			   <div class="account_grid">
			   <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
               
			  	 <h2>HEMEN ÜYE OL</h2>
				 <p>Yeni üye olarak, avantajları yakalayabilirisin.</p>
				 <a class="acount-btn" href="<?php echo URL; ?>/uye/hesapOlustur">ÜYE OL</a>
			   </div>
			   
			   <div class="col-md-6 login-left wow fadeInLeft" data-wow-delay="0.4s">
               
			  	 <h2>ÜYELİKSİZ ALIŞVERİŞ</h2>
				 <p>Üye olmadan alışveriş yapabilirsiniz</p>
				 <a class="acount-btn" href="<?php echo URL; ?>/sayfalar/siparistamamlauyeliksiz">ÜYELİKSİZ DEVAM ET</a>
			   </div>	
			   
			   <div class="clearfix"> </div>
			 </div>
		   </div>
</div>



<?php
	
	endif;
	
	
	
	else:
	// BU SEPETTE ÜRÜN VARMI ONA BAKIYOR
	header("Location:".URL);
	
	
	
	endif;
	
	
?>


<?php require 'views/footer.php'; ?> 		
        
        
        
       