<?php require 'views/header.php';  ?>


<?php

// BURADA SANAL POSUMUZ İÇİN GEREKLİ OLAN VERİLERİ BİR ÖNCEKİ SAYFAMIZDA GÖNDERDİĞİMİ İNDİSLER İLE ALABİLİYORUZ VE İSTEDİĞİMİ GİBİ SET EDECEĞİZ.				
			/*		echo $veri["veriler"]["ad"];
					echo $veri["veriler"]["soyad"];
					echo $veri["veriler"]["mail"];
					echo $veri["veriler"]["telefon"];					
					echo $veri["veriler"]["adres"];
					echo $veri["veriler"]["adrestercih"];
					echo $veri["veriler"]["fatad"];
					echo $veri["veriler"]["fatsoyad"];
					echo $veri["veriler"]["fatulke"];
					echo $veri["veriler"]["fatsehir"];
					echo $veri["veriler"]["fatadres"];
					echo $veri["veriler"]["tesad"];
					echo $veri["veriler"]["tessoyad"];
					echo $veri["veriler"]["tesulke"];
					echo $veri["veriler"]["tessehir"];
					echo $veri["veriler"]["tesadres"];	*/
					
					Session::set("ad",$veri["veriler"]["ad"]);
					Session::set("soyad",$veri["veriler"]["soyad"]);
					Session::set("mail",$veri["veriler"]["mail"]);
					Session::set("telefon",$veri["veriler"]["telefon"]);
					Session::set("adres",$veri["veriler"]["adres"]);					
					Session::set("tesad",$veri["veriler"]["tesad"]);
					Session::set("tessoyad",$veri["veriler"]["tessoyad"]);
					
					
					
 if (isset($veri["veriler"])) :
 
 
 

# create request class
$request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
$request->setLocale(\Iyzipay\Model\Locale::TR);
$request->setConversationId("123456789");
$request->setCurrency(\Iyzipay\Model\Currency::TL);
$request->setBasketId("B67832");
$request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
$request->setCallbackUrl("http://phpogren.xyz/mvc/helpers/sanalpos/odemekontrol.php");
$request->setEnabledInstallments(array(2, 3, 6, 9));

//---------SANAL POST İŞLEMİMİZ

$buyer = new \Iyzipay\Model\Buyer();
$buyer->setId(5);
$buyer->setName($veri["veriler"]["ad"]);
$buyer->setSurname($veri["veriler"]["soyad"]);
$buyer->setGsmNumber("+9".$veri["veriler"]["telefon"]);
$buyer->setEmail($veri["veriler"]["mail"]);
$buyer->setIdentityNumber("74300864791");
$buyer->setIp($_SERVER["REMOTE_ADDR"]);
$buyer->setCity($veri["veriler"]["tessehir"]);
$buyer->setCountry($veri["veriler"]["fatulke"]);
$buyer->setRegistrationAddress($veri["veriler"]["adres"]);
$request->setBuyer($buyer);	 // BURADA ARTIK ALICININ BİLGİLERİNİ PASLIYORUM

$shippingAddress = new \Iyzipay\Model\Address();
$shippingAddress->setContactName($veri["veriler"]["tesad"].$veri["veriler"]["tessoyad"]);
$shippingAddress->setCity($veri["veriler"]["tessehir"]);
$shippingAddress->setCountry($veri["veriler"]["tesulke"]);
$shippingAddress->setAddress($veri["veriler"]["tesadres"]);						
$request->setShippingAddress($shippingAddress); // TESLIMAT ADRESİNİ PASLIYORUM

$billingAddress = new \Iyzipay\Model\Address();
$billingAddress->setContactName($veri["veriler"]["fatad"].$veri["veriler"]["fatsoyad"]);
$billingAddress->setCity($veri["veriler"]["fatsehir"]);
$billingAddress->setCountry($veri["veriler"]["fatulke"]);	
$billingAddress->setAddress($veri["veriler"]["fatadres"]);
$request->setBillingAddress($billingAddress); // FATURA ADRESİ  PASLIYORUM		


  ?>

	<div class="container" id="sipTamamlaİskelet" >
    
    	<div class="row" id="tamamlandi">
		<div class="col-xl-12 col-lg-12 col-md-12 siparisbaslik "><h4>GÜVENLİ ÖDEME YAP</h4></div>
		
        
				<div class="col-xl-12 col-lg-12 col-md-12">
				<?php
					   $basketItems = array();
				
				       $toplamAdet=0;
					   $toplamfiyat=0;					   
					   
                       	foreach ($_COOKIE["urun"] as $id => $adet) :				
				
				 $GelenUrun=$Harici->UrunCek($id);
				 $GelenKategori=$Harici->UrunkategoriGetir($GelenUrun[0]["katid"]);
				
	 		// BURADA SEPETTE NE KADAR ÜRÜN VAR İSE ALIYOR VE SANAL POS İÇİN HAZIR HALE GETİRİYORUM

			$firstBasketItem = new \Iyzipay\Model\BasketItem();
			$firstBasketItem->setId($id);
			$firstBasketItem->setName($GelenUrun[0]["urunad"]);
			$firstBasketItem->setCategory1($GelenKategori[0]["ad"]);
			$firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
			$firstBasketItem->setPrice($GelenUrun[0]["fiyat"]*$adet);
			$basketItems[] = $firstBasketItem;	
				 
			 $toplamAdet  += $adet;
			 $toplamfiyat += $GelenUrun[0]["fiyat"]*$adet;			 
				
				endforeach; 
			$request->setPrice($toplamfiyat);
			$request->setPaidPrice($toplamfiyat);				
			$request->setBasketItems($basketItems);	?>
			
					 <div class="row" id="uyelik">
                            	<div class="col-md-12"><h4>ÖDEME YÖNTEMİ</h4></div>
								
								
				          <div class="col-md-6" id="adresSatir">
                                
                                                   <label>
  <?php Form::Olustur("2",array("type" => "radio","value" => "2", "name" => "odeme","checked"=>"checked")); ?> KREDİ KARTI 
                               </label>
                               
                                
                                </div>
                                
                           <div class="col-md-6" id="adresSatir">
                                
                               <label>
  <?php Form::Olustur("2",array("type" => "radio","value" => "1", "name" => "odeme")); ?> HAVALE / EFT
                               </label>
                            
                            </div>
							
							
                            

								
								
							<div class="col-md-12" id="havale">
							
							
							
				<div class="alert alert-info">IBAN bilgilerini bir sonraki sayfada göreceksiniz.</div>
			<?php Form::Olustur("1",array("method"=>"POST","action"=>URL."/uye/siparistamamlandi/true")); ?>
		<?php Form::Olustur("2",array("type" => "hidden","value" => "Nakit","name" => "odemeturu")); ?>
							
			<?php Form::Olustur("2",array("type" => "submit","value" => "SİPARİŞİ TAMAMLA","class" => "btn btn-5"));
			
			  Form::Olustur("kapat");	?>
			
							
							</div>
							
								<div class="col-md-12" id="kredi">
								<?php
								


# make request
$checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request, Config::options());

if ($checkoutFormInitialize->getStatus()=="success"):
print_r($checkoutFormInitialize->getCheckoutFormContent());
?>
<div id="iyzipay-checkout-form" class="responsive"></div>
<?php
else:
$checkoutFormInitialize->getErrorMessage();
endif;

																
								?>								
								
								
								</div>
                            
                            </div>
			
	

				</div>
        
        
        
                  
        
        </div>
    
    
	
</div>

<?php

	
	
	
				
 else:
	// VERİLER GELİYOR MU BAKIYOR/ GELMİYOR İSE DEMEK Kİ HARİCİ BİR ERİŞİM VAR YÖNLENDİRİYOR
	header("Location:".URL);
 
 endif;
	
?>


<?php require 'views/footer.php'; ?> 		
        
        
        
       