<?php  session_start(); ob_start();
	  require_once('../../config/posconfig.php');

	$request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
				$request->setLocale(\Iyzipay\Model\Locale::TR);
				$request->setConversationId("123456789");
				$request->setToken($_POST['token']);
				$checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, Config::options());

if (isset($_SESSION["kulad"]) && isset($_SESSION["uye"]) ) :
 
			

				if ($checkoutForm->getStatus()=="success" && $checkoutForm->getPaymentStatus()=="SUCCESS"):

							echo "<h3>ÖDEME KONTROL EDİLİYOR</h3>";						
							header("Location:http://phpogren.xyz/mvc/uye/siparistamamlandi/true");
				else:

							print_r($checkoutForm->getErrorMessage());
							header("Location:http://phpogren.xyz/mvc/uye/siparistamamlandi/false");

				endif;
					  
					  



elseif (!isset($_SESSION["adrestercih"])) :

if ($checkoutForm->getStatus()=="success" && $checkoutForm->getPaymentStatus()=="SUCCESS"):

							echo "<h3>ÖDEME KONTROL EDİLİYOR</h3>";						
							header("Location:http://phpogren.xyz/mvc/uye/uyeliksizSiparisTamamlandi/true");
				else:

							print_r($checkoutForm->getErrorMessage());
							header("Location:http://phpogren.xyz/mvc/uye/uyeliksizSiparisTamamlandi/false");

				endif;


else:
// OTURUM KONTROLÜ YAPIYOR
	header("Location:http://phpogren.xyz/mvc");
	
	endif;
	
	?>
	



