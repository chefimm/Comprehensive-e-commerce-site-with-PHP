<?php

class uye extends Controller  {
	
	
	function __construct() {	
		
parent::KutuphaneYukle(array("view","Form","Bilgi","Pagination","Captcha","Mailislem","Token"));
		
		$this->Modelyukle('uye');
		Session::init();
	
	}	
	

	
	function giris() {	
	


	$this->view->goster("sayfalar/giris",
	array("captcha" => $this->Captcha->kodolustur("auto"),
		  "token" => $this->Token->kodolustur()));
	
	
		
	} // GİRİŞ SAYFASI
	
	function hesapOlustur() {	
		
	$this->view->goster("sayfalar/uyeol",
	array("captcha" => $this->Captcha->kodolustur("auto"),
		  "token" => $this->Token->kodolustur()));
		
	} // HESAP OLUŞTUR SAYFASI	
	
	function kayitkontrol() {
	
	if ($_POST) :		
	$ad=$this->Form->get("ad")->bosmu();
	$soyad=$this->Form->get("soyad")->bosmu();
	$mail=$this->Form->get("mail")->bosmu();
	$sifre=$this->Form->get("sifre")->bosmu();
	$sifretekrar=$this->Form->get("sifretekrar")->bosmu();
	$telefon=$this->Form->get("telefon")->bosmu();	
	$guvenlik=$this->Form->get("guvenlik")->bosmu();	
	$token=$this->Form->get("token")->bosmu();
	$this->Form->GercektenMailmi($mail);	
	$sifre=$this->Form->SifreTekrar($sifre,$sifretekrar);	
	
	if (!empty($this->Form->error)) :	

	$this->view->goster("sayfalar/uyeol",
	array("hata" => $this->Form->error));	
	
	elseif ($guvenlik!=Session::get("kod")) :	

	$this->view->goster("sayfalar/uyeol",
	array(
	"Bilgi" =>$this->Bilgi->hata("Güvenlik kod hatalıdır.","/uye/hesapOlustur",3)));
	
	elseif ($token!=Session::get("token")) :	

	$this->view->goster("sayfalar/uyeol",
	array(
	"Bilgi" =>$this->Bilgi->hata("Sistem Hatası var.","/uye/uyeol",3)));
	
	else:	
	$sonuc=$this->model->Ekleİslemi("uye_panel",
	array("ad","soyad","mail","sifre","telefon"),
	array($ad,$soyad,$mail,$sifre,$telefon));
	
		if ($sonuc):	
		$this->view->goster("sayfalar/uyeol",
		array("Bilgi" =>$this->Bilgi->basarili("KAYIT BAŞARILI","/uye/giris",2)));			
		else:		
		$this->view->goster("sayfalar/uyeol",
		array("Bilgi" => 
		$this->Bilgi->uyari("danger","Kayıt esnasında hata oluştu")));		
		endif;	
	endif;
		
		else:		
	$this->Bilgi->direktYonlen("/");
	endif;		
	}  // KAYIT KONTROL		
	
	function cikis() {			
			Session::destroy();			
			$this->Bilgi->direktYonlen("/magaza");		
	} // ÇIKIŞ	
	
	function giriskontrol() {
		
	if ($_POST) :	
	
		if ($_POST["giristipi"]=="uye") :	
		
	$ad=$this->Form->get("ad")->bosmu();
	$sifre=$this->Form->get("sifre")->bosmu();
	$token=$this->Form->get("token")->bosmu();
	$guvenlik=$this->Form->get("guvenlik")->bosmu();	
	
	if (!empty($this->Form->error)) :
	$this->view->goster("sayfalar/giris",
	array("Bilgi" => $this->Bilgi->uyari("danger","Ad ve şifre boş olamaz")));	
	
	elseif ($guvenlik!=Session::get("kod")) :	

	$this->view->goster("sayfalar/giris",
	array(
	"Bilgi" =>$this->Bilgi->hata("Güvenlik kod hatalıdır.","/uye/giris",3)));
	
	/*elseif ($token!=Session::get("token")) :	

	$this->view->goster("sayfalar/giris",
	array(
	"Bilgi" =>$this->Bilgi->hata("Sistem Hatası var.","/uye/giris",3)));*/
	
	else:	
	$sifre=$this->Form->sifrele($sifre);
	$sonuc=$this->model->GirisKontrol("uye_panel","ad='$ad' and sifre='$sifre' and durum=1");
	
		if ($sonuc): 		
	
			$this->Bilgi->direktYonlen("/uye/panel");			
			Session::init();
			Session::set("kulad",$sonuc[0]["ad"]);	
			Session::set("uye",$sonuc[0]["id"]); 			
		else:		
			$this->view->goster("sayfalar/giris",
			array("Bilgi" => 
			$this->Bilgi->uyari("danger","Kullanıcı adı veya şifresi hatalıdır")));				
		endif;	
	endif; // hatanın	
	
		elseif ($_POST["giristipi"]=="yon") :	
	$AdminAd=$this->Form->get("AdminAd")->bosmu();
	$Adminsifre=$this->Form->get("Adminsifre")->bosmu();	
	if (!empty($this->Form->error)) :
	$this->view->goster("YonPanel/sayfalar/index",
	array("Bilgi" => $this->Bilgi->uyari("danger","Ad ve şifre boş olamaz")));
	else:	
	$Adminsifre=$this->Form->sifrele($Adminsifre);
	$sonuc=$this->model->GirisKontrol("yonetim","ad='$AdminAd' and sifre='$Adminsifre'");
	
		if ($sonuc): 		
	
			$this->Bilgi->direktYonlen("/panel/siparisler");			
			Session::init();
			Session::set("AdminAd",$sonuc[0]["ad"]);	
			Session::set("Adminid",$sonuc[0]["id"]); 			
		else:		
			$this->view->goster("YonPanel/sayfalar/index",
			array("Bilgi" => 
			$this->Bilgi->uyari("danger","Kullanıcı adı veya şifresi hatalıdır")));				
		endif;
	
	endif; // hatanın	
	
	endif;
	
	
		else:		
	$this->Bilgi->direktYonlen("/");
	endif;		
	}  // GİRİŞ KONTROL	
	
	// ÜYENİN PANELİNİ SAĞLAYAN FONKSİYONLAR
	
	function sifresifirlama($kriter=false,$kodumuz=false) {
	
	if ($kriter=="son"):
	
		if ($_POST) :	
		
			$mailadres=$this->Form->get("mailadres")->bosmu();

			if (!empty($this->Form->error)) :
			$this->view->goster("sayfalar/sifremiunuttum",
			array("Bilgi" => $this->Bilgi->hata("Mail Adresi boş olmamalıdır.","/uye/sifresifirlama")));

			else:	

				$sonuc=$this->model->VerileriAl("uye_panel","where mail='$mailadres'");	


					if (count($sonuc)>0): 	
					// kod üretebilirim
					$kodumuz=substr(sha1(mt_rand(1,99999)),4,9);
					Session::set("kod",$kodumuz);
					Session::set("uyemailadres",$mailadres);
					
		$linkicerik='<html>
				<head><title>Üyelik Aktivasyon</title></head>
					<body>
				Linke tıklayarak şifrenizi sıfırlayabiliriz.<br><b>Doğrulama Link :</b><hr>
				
<a href="http://phpogren.xyz/mvc/uye/sifresifirlama/dogrulama/'.$kodumuz.'">ŞİFREYİ SIFIRLA</a>
				</body>							
		</html>';
					
					
					

					$this->Mailislem->mailgonder(array($mailadres),"Üyelik Aktivasyon",$linkicerik,true);

						$this->view->goster("sayfalar/sifremiunuttum",
						array("kodgirme"=>true,					
						"Bilgi" => $this->Bilgi->uyari("success","Mail adresinize kod gönderildi")));			
					else:		
						$this->view->goster("sayfalar/sifremiunuttum",
						array("Bilgi" => $this->Bilgi->hata("Böyle bir kayıt yok","/uye/sifresifirlama")));		
					endif;

				endif;	
		
		else:
		
			$this->Bilgi->direktYonlen("/");
	
		endif;
		
	elseif ($kriter=="dogrulama"):	
	
			if (Session::get("denemehakki")):

					if (Session::get("denemehakki")==3):
						Session::destroy();
						$this->Bilgi->direktYonlen("/");
					else:
					Session::set("denemehakki",Session::get("denemehakki")+1);
						$this->view->goster("sayfalar/sifremiunuttum",
						array("koddurum"=>true));	
					endif;	
					
			
			
			
			else:	
			
					if ($kodumuz):

					// BURADA LİNK İLE GELEN KOD KARŞILAŞTIRILIYOR
					
									if (Session::get("kod")==$kodumuz): 	
											$this->view->goster("sayfalar/sifremiunuttum",
											array("koddurum"=>true));			
										else:	
											$this->view->goster("sayfalar/sifremiunuttum",
											array("Bilgi" => $this->Bilgi->hata("Kod Hatalı","/uye/sifresifirlama/son")));		
										endif;

					else:


					if ($_POST) :	

					$kod=$this->Form->get("kod")->bosmu();	

							if (!empty($this->Form->error)) :
							$this->view->goster("sayfalar/sifremiunuttum",
							array("Bilgi" => $this->Bilgi->hata("Kod boş olmamalıdır.","/uye/sifresifirlama/son")));

							else:	

										if (Session::get("kod")==$kod): 	
											$this->view->goster("sayfalar/sifremiunuttum",
											array("koddurum"=>true));			
										else:	
											$this->view->goster("sayfalar/sifremiunuttum",
											array("Bilgi" => $this->Bilgi->hata("Kod Hatalı","/uye/sifresifirlama/son")));		
										endif;

							endif;	

						else:

							$this->Bilgi->direktYonlen("/");

						endif;
						
						
					endif;		

			endif; // şifre uyumsuzluk halinde tekrar gelinince hata olmaması için

	elseif ($kriter=="sifredegistir"):	
	
			if ($_POST) :	

				$sifre1=$this->Form->get("sifre1")->bosmu();
				$sifre2=$this->Form->get("sifre2")->bosmu();
				$sonsifre=$this->Form->SifreTekrar($sifre1,$sifre2);	

					if (!empty($this->Form->error)) :
					$this->view->goster("sayfalar/sifremiunuttum",
					array("koddurum"=>true,
					"Bilgi" => $this->Bilgi->hata("Şifreler Uyumsuz.","/uye/sifresifirlama/dogrulama")));

					else:

					$sifirlamamailadres=Session::get("uyemailadres");

					$sonuc=$this->model->Guncelleİslemi("uye_panel",
					array("sifre"),
					array($sonsifre),"mail='$sifirlamamailadres'");	

						if ($sonuc): 	
						Session::destroy();

							$this->view->goster("sayfalar/sifremiunuttum",
							array("koddurum"=>true,
							"Bilgi" => $this->Bilgi->basarili("ŞİFRE SIFIRLAMA BAŞARILI","/uye/giris")));
						else:		
							$this->view->goster("sayfalar/sifremiunuttum",
							array("Bilgi" => $this->Bilgi->hata("Güncelleme sırasında hata oluştu.","/uye/sifremiunuttum")));		
						endif;



					endif;	

		else:
		
			$this->Bilgi->direktYonlen("/");
	
		endif;
	
	else:
	
	
	$this->view->goster("sayfalar/sifremiunuttum");
	
	endif;
		
	
		
	} // ŞİFREMİ UNUTTUM
	
	//*********** ÜYENİN PANELİNİ SAĞLAYAN FONKSİYONLAR
	
	function Yorumsil () {
		
		if ($_POST) :		
		echo $this->model->Silmeİslemi("yorumlar", "id=".$_POST["yorumid"]);		
		else:	
		$this->Bilgi->direktYonlen("/");
		endif;		
	} // YORUM SİL
	
	function adresSil () {		
		if ($_POST) :			
		echo $this->model->Silmeİslemi("adresler", "id=".$_POST["adresid"]);		
		endif;		
	} // ADRES SİL
	
	function YorumGuncelle()  {
		
		if ($_POST) :
			
		echo $this->model->Guncelleİslemi("yorumlar",
		array("icerik","durum"),
		array($_POST["yorum"],"0"),"id=".$_POST["yorumid"]);		
		else:		
		$this->Bilgi->direktYonlen("/");
		endif;		
	} // YORUM GÜNCELLE
	
	function AdresGuncelle()  {
		
		if ($_POST) :		
		echo $this->model->Guncelleİslemi("adresler",
		array("adres"),
		array($_POST["adres"]),"id=".$_POST["adresid"]);
		else:	
		$this->Bilgi->direktYonlen("/");
		endif;		
	} // ADRES GÜNCELLE		
	
	function Panel() {	
	
	$this->view->goster("sayfalar/panel",array(
	"siparisler" => $this->model->VerileriAl("siparisler","where uyeid=".Session::get("uye"))));
	} // ANA PANEL
	
	function yorumlarim($mevcutsayfa=false) {	
	
	$veriler=$this->model->VerileriAl("yorumlar","where uyeid=".Session::get("uye"));	
	$this->Pagination->paginationOlustur(count($veriler),$mevcutsayfa,
	$this->model->tekliveri("uyeYorumAdet"," from ayarlar"));	
	$this->view->goster("sayfalar/panel",array(
	"yorumlar" => $this->model->VerileriAl("yorumlar","where uyeid=".Session::get("uye")." LIMIT ".$this->Pagination->limit.",".$this->Pagination->gosterilecekadet),
	"toplamsayfa" => $this->Pagination->toplamsayfa,
	"toplamveri" => count($veriler)		
	));			
	} // YORUMLAR
	
	function adreslerim() {		
	
	$this->view->goster("sayfalar/panel",array(
	"adres" => $this->model->VerileriAl("adresler","where uyeid=".Session::get("uye"))
	));	
	} // ADRESLER
	
	function adresekle() {	
	
	$this->view->goster("sayfalar/panel",array(
	"adresekle" => "ekleme"));
	} // ADRES EKLE
	
	function adresEkleSon() {		
		if ($_POST) :			
	$yeniadres=$this->Form->get("yeniadres")->bosmu();
	$uyeid=$this->Form->get("uyeid")->bosmu();
	if (!empty($this->Form->error)) :
	$this->view->goster("sayfalar/panel",
	array("adresekle" => "ekleme",
	"Bilgi" => $this->Bilgi->hata("Adres boş olmamalıdır.","/uye/adresekle")
	 ));
	 	
	else:		
	
		$sonuc=$this->model->Ekleİslemi("adresler",
		array("uyeid","adres"),
		array($uyeid,$yeniadres));
	
		if ($sonuc): 	
			$this->view->goster("sayfalar/panel",
			array(
			"adresekle" => "tamam",
			"Bilgi" => $this->Bilgi->basarili("EKLEME BAŞARILI","/uye/adreslerim")
			 ));			
		else:		
			$this->view->goster("sayfalar/panel",
			array(
			"adresekle" => "ekleme",
			"Bilgi" => $this->Bilgi->hata("Kayıt Esnasında hata oluştu.","/uye/adresekle")
			 ));		
		endif;
	
	endif;	
	
		else:	
	
	$this->Bilgi->direktYonlen("/");
	endif;			
	} // ADRES EKLİYOR.
	
	function hesapayarlarim() {		
	
	$this->view->goster("sayfalar/panel",array(
	"ayarlar" => $this->model->VerileriAl("uye_panel","where id=".Session::get("uye"))));	
	} // HESAP AYARLARI
	
	function sifredegistir() {			
	$this->view->goster("sayfalar/panel",array(
	"sifredegistir" => Session::get("uye")));			
	} // ŞİFRE DEĞİŞTİR
	
	function siparislerim() {		
	$this->view->goster("sayfalar/panel",array(
	"siparisler" => $this->model->VerileriAl("siparisler","where uyeid=".Session::get("uye"))));
	} // SİPARİŞLER
	
	function ayarGuncelle() {		
		if ($_POST) :
		
			$ad=$this->Form->get("ad")->bosmu();
			$soyad=$this->Form->get("soyad")->bosmu();
			$mail=$this->Form->get("mail")->bosmu();
			$telefon=$this->Form->get("telefon")->bosmu();
			$uyeid=$this->Form->get("uyeid")->bosmu();	
	if (!empty($this->Form->error)) :
	$this->view->goster("sayfalar/panel",
	array(
	"ayarlar" => $this->model->VerileriAl("uye_panel","where id=".Session::get("uye")),
	"Bilgi" => $this->Bilgi->uyari("danger","Girilen Bilgiler hatalıdır.")
	 )); 	
	else:	
		$sonuc=$this->model->Guncelleİslemi("uye_panel",
		array("ad","soyad","mail","telefon"),
		array($ad,$soyad,$mail,$telefon),"id=".$uyeid);	
		if ($sonuc): 	
			$this->view->goster("sayfalar/panel",
			array("ayarlar" => "ok",
			"Bilgi" => $this->Bilgi->basarili("GÜNCELLEME BAŞARILI","/uye/panel")
			 ));
		else:		
			$this->view->goster("sayfalar/panel",
			array(
			"ayarlar" => $this->model->VerileriAl("uye_panel","where id=".Session::get("uye")),
			"Bilgi" => $this->Bilgi->uyari("danger","Güncelleme sırasında hata oluştu.")
			 ));		
		endif;
	
	endif;
		
		else:	
	$this->Bilgi->direktYonlen("/");
	endif;		
	} // ÜYE KENDİ AYARLARINI GÜNCELLİYOR.
	
	function sifreguncelle() {		

	if ($_POST) :		
		
	 $msifre=$this->Form->get("msifre")->bosmu();
	 $yen1=$this->Form->get("yen1")->bosmu();
	 $yen2=$this->Form->get("yen2")->bosmu();
	 $uyeid=$this->Form->get("uyeid")->bosmu();
	 $sifre=$this->Form->SifreTekrar($yen1,$yen2);	
	 $msifre=$this->Form->sifrele($msifre);
	
	if (!empty($this->Form->error)) :
	$this->view->goster("sayfalar/panel",
	array(
	"sifredegistir" => Session::get("uye"),
	"Bilgi" => $this->Bilgi->uyari("danger","Girilen Bilgiler hatalıdır.")
	 ));
	
	else:
	$sonuc2=$this->model->GirisKontrol("uye_panel","ad='".Session::get("kulad")."' and sifre='$msifre'");
	
		if ($sonuc2): 		
				$sonuc=$this->model->Guncelleİslemi("uye_panel",
				array("sifre"),
				array($sifre),"id=".$uyeid);			
				if ($sonuc): 
				$this->view->goster("sayfalar/panel",
				array(
				"sifredegistir" => "ok",
				"Bilgi" => $this->Bilgi->basarili("ŞİFRE DEĞİŞTİRME BAŞARILI","/uye/panel")
			 	));	
				else:
				$this->view->goster("sayfalar/panel",
				array(
				"sifredegistir" => Session::get("uye"),
				"Bilgi" => $this->Bilgi->uyari("danger","Şifre değiştirme sırasında hata oluştu.")
				));			
				endif;		
		else:		
			$this->view->goster("sayfalar/panel",
	array(
	"sifredegistir" => Session::get("uye"),
	"Bilgi" => $this->Bilgi->uyari("danger","Mevcut şifre hatalıdır.")
	 ));		
		endif;	
	endif;	
	else:	
	$this->Bilgi->direktYonlen("/");
	endif;		
	} // ÜYE ŞİFRESİNİ GÜNCELLİYOR.	
	
	function favoriler() {		
	$this->view->goster("sayfalar/panel",array(
	"favoriler" => $this->model->VerileriAl("favoriurunler","where uyeid=".Session::get("uye"))));
	} // SİPARİŞLER
	
//***********  ÜYENİN PANELİNİ SAĞLAYAN FONKSİYONLAR
		
	
	function odemeyap($deger=false) {
		
		if ($_POST) :			
		
			if (!isset($deger)) :
			
	Session::set("adrestercih",$this->Form->get("adrestercih")->bosmu());
			endif;
		
	$ad=$this->Form->get("ad")->bosmu();
	$soyad=$this->Form->get("soyad")->bosmu();
	$mail=$this->Form->get("mail")->bosmu();
	$telefon=$this->Form->get("telefon")->bosmu();		
	$adres=$this->Form->get("adres")->bosmu();	
	$fatad=$this->Form->get("fatad")->bosmu();
	$fatsoyad=$this->Form->get("fatsoyad")->bosmu();
	$fatulke=$this->Form->get("fatulke")->bosmu();
	$fatsehir=$this->Form->get("fatsehir")->bosmu();
	$fatadres=$this->Form->get("fatadres")->bosmu();		
	$tesad=$this->Form->get("tesad")->bosmu();
	$tessoyad=$this->Form->get("tessoyad")->bosmu();
	$tesulke=$this->Form->get("tesulke")->bosmu();
	$tessehir=$this->Form->get("tessehir")->bosmu();
	$tesadres=$this->Form->get("tesadres")->bosmu();	


	
				if (!empty($this->Form->error)) :
				$this->view->goster("sayfalar/siparisitamamla",
				array("Bilgi" => $this->Bilgi->uyari("danger","Bilgiler eksiksiz doldurulmalıdır")));

				else:
				// EĞER GELEN VERİLERDE HATA YOK İSE BU VERİLERİ SANAL POS'UMUZU GÖSTERECEĞİMİZ SAYFAMIZA ARRAY OLARAK GÖNDERİYORUZ.
				
					$this->view->goster("sayfalar/odeme",
					array("veriler" => array(
					"ad"=>$ad,
					"soyad"=>$soyad,
					"mail"=>$mail,
					"telefon"=>$telefon,					
					"adres"=>$adres,					
					"fatad"=>$fatad,
					"fatsoyad"=>$fatsoyad,
					"fatulke"=>$fatulke,
					"fatsehir"=>$fatsehir,
					"fatadres"=>$fatadres,
					"tesad"=>$tesad,
					"tessoyad"=>$tessoyad,
					"tesulke"=>$tesulke,
					"tessehir"=>$tessehir,
					"tesadres"=>$tesadres				
					)));



				endif;
	
	else:	
	
	$this->Bilgi->direktYonlen("/");
	endif;
	

	} // ÖDEME YAP 
	
	function siparistamamlandi($deger=false) {		
				
		if ($deger):
		
					$odemeturu=$_POST["odemeturu"];
					
					if (!isset($odemeturu)) :

					$odemeturu="Sanal Pos";

					endif;
				
					$tarih=date("d.m.Y");
					$siparisNo=mt_rand(0,99999999);					
					$uyeid=Session::get("uye");
					$tesad=Session::get("tesad");
					$tessoyad=Session::get("tessoyad");
					$mail=Session::get("mail");
					$telefon=Session::get("telefon");
					$adrestercih=Session::get("adrestercih");					
					$this->model->TopluislemBaslat();
					
				
		if (isset($_COOKIE["urun"])) :
				$toplam=0;
						foreach ($_COOKIE["urun"] as $id => $adet) :

						$GelenUrun=$this->model->VerileriAl("urunler","where id=".$id);

							$birimfiyat=$GelenUrun[0]["fiyat"]*$adet;
							$this->model->SiparisTamamlama(
							array(
							$siparisNo,
							$adrestercih,
							$uyeid,
							$GelenUrun[0]["urunad"],
							$adet,
							$GelenUrun[0]["fiyat"],
							$birimfiyat,
							$odemeturu,
							$tarih	
							));		
							
						$toplam+=$birimfiyat;
						
						$this->model->Guncelleİslemi("urunler",
						array("stok"),
						array($GelenUrun[0]["stok"]-$adet),"id=".$GelenUrun[0]["id"]);	


					endforeach;	
	
		else:	
			$this->Bilgi->direktYonlen("/");	
		endif;
	
	
				$this->model->TopluislemTamamla();	

				Cookie::SepetiBosalt(); // sepeti boşalttık		
		
						$TeslimatBilgileri=$this->model->Ekleİslemi("teslimatbilgileri",
						array("siparis_no","ad","soyad","mail","telefon"),
						array(
						$siparisNo,
						$tesad,
						$tessoyad,
						$mail,
						$telefon	
						));	

						if ($TeslimatBilgileri): 	
						
						$this->view->goster("sayfalar/siparistamamlandi",
						array(
						"siparisno" => $siparisNo,
						"toplamtutar" => $toplam,
						"odemeturu" =>$odemeturu
						));	
						Session::topludestroy(array("ad","soyad","mail","telefon","adres","tesad","tessoyad"));
									
						else:

						$this->view->goster("sayfalar/siparisitamamla",
						array("Bilgi" => $this->Bilgi->uyari("danger","Sipariş oluşturulurken hata oluştu")));

						endif;
						
						
	else:
				$this->view->goster("sayfalar/siparistamamlandi",
				array("bilgi" => $this->Bilgi->uyari("danger","İŞLEM SIRASINDA HATA OLUŞTU")));
	
	endif;
				
						
	

	} // ÖDEME KONTROLÜ SONRASINDA YÖNLENEN YER
	
	function uyeliksizSiparisTamamlandi($deger=false) {		
				
		if ($deger):
		
					$odemeturu=$_POST["odemeturu"];
					
					if (!isset($odemeturu)) :

					$odemeturu="Sanal Pos";

					endif;
				
					$ad=Session::get("ad");
					$soyad=Session::get("soyad");
					$mail=Session::get("mail");
					$telefon=Session::get("telefon");
					$adres=Session::get("adres");
					$tarih=date("d.m.Y");				
					$siparisNo=mt_rand(0,99999999);
					$tesad=Session::get("tesad");
					$tessoyad=Session::get("tessoyad");	
					
						$idler=$this->model->UyeliksizekleİslemiToptan("uye_panel",
						array("ad","soyad","mail","telefon","tur"),
						array($ad,$soyad,$mail,$telefon,2),$adres,"teslimatbilgileri",
						array("siparis_no","ad","soyad","mail","telefon"),
						array($siparisNo,$tesad,$tessoyad,$mail,$telefon));	
					
				$this->model->TopluislemBaslat();
					
				
		if (isset($_COOKIE["urun"])) :
				$toplam=0;
						foreach ($_COOKIE["urun"] as $id => $adet) :

						$GelenUrun=$this->model->VerileriAl("urunler","where id=".$id);

							$birimfiyat=$GelenUrun[0]["fiyat"]*$adet;
							$this->model->SiparisTamamlama(
							array(
							$siparisNo,
							$idler["adresid"],
							$idler["uyeid"],
							$GelenUrun[0]["urunad"],
							$adet,
							$GelenUrun[0]["fiyat"],
							$birimfiyat,
							$odemeturu,
							$tarih	
							));		
							
						$toplam+=$birimfiyat;
						
						$this->model->Guncelleİslemi("urunler",
						array("stok"),
						array($GelenUrun[0]["stok"]-$adet),"id=".$GelenUrun[0]["id"]);	


					endforeach;	
	
		else:	
			$this->Bilgi->direktYonlen("/");	
		endif;
	
	
				$this->model->TopluislemTamamla();	

				Cookie::SepetiBosalt(); // sepeti boşalttık		
		
						

						if ($idler["teslimat"]): 	
						
						$this->view->goster("sayfalar/siparistamamlandi",
						array(
						"siparisno" => $siparisNo,
						"toplamtutar" => $toplam,
						"odemeturu" =>$odemeturu
						));	
						Session::topludestroy(array("ad","soyad","mail","telefon","adres","tesad","tessoyad"));
									
						else:

						$this->view->goster("sayfalar/siparisitamamla",
						array("Bilgi" => $this->Bilgi->uyari("danger","Sipariş oluşturulurken hata oluştu")));

						endif;
						
						
	else:
				$this->view->goster("sayfalar/siparistamamlandi",
				array("bilgi" => $this->Bilgi->uyari("danger","İŞLEM SIRASINDA HATA OLUŞTU")));
	
	endif;
				
						
	

	} // ÖDEME KONTROLÜ SONRASINDA YÖNLENEN YER
	
	
	

	
}




?>