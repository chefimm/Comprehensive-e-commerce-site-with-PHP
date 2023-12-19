<?php

class GenelGorev extends Controller  {
	
	
	function __construct() {
	
	parent::KutuphaneYukle(array("view","Form","Bilgi","Mailislem"));	
		
	$this->Modelyukle('GenelGorev');
	
	Session::init();	
	}	
	
	function YorumFormKontrol() {		
		
		if ($_POST) :	
		
	$ad=$this->Form->get("ad")->bosmu();
	$yorum=$this->Form->get("yorum")->bosmu();
	$urunid=$this->Form->get("urunid")->bosmu();
	$uyeid=$this->Form->get("uyeid")->bosmu();
	$tarih=date("d-m-Y");	
	if (!empty($this->Form->error)) :
	
	echo $this->Bilgi->uyari("danger","LÜTFEN BOŞ ALAN BIRAKMAYINIZ");

	else:
		$sonuc=$this->model->Eklemeİslemi("yorumlar",
		array("uyeid","urunid","ad","icerik","tarih"),
		array($uyeid,$urunid,$ad,$yorum,$tarih));
	
		if ($sonuc==1):
		echo $this->Bilgi->uyari("success","Yorumunuz kayıt edildi. Onaylandıktan sonra yayınlanacaktır",'id="ok"');		
		else:
	
		echo $this->Bilgi->uyari("danger","HATA OLUŞTU. LÜTFEN DAHA SONRA TEKRAR DENEYİNİZ");
		
		endif;
	
	endif;
	
	
	else:	
	
		$this->Bilgi->direktYonlen("/");
	
	endif;
	} // YORUM  KONTROL	
	
	function BultenKayit() {
		if ($_POST) :	
	$mailadres=$this->Form->get("mailadres")->bosmu();	
	$this->Form->GercektenMailmi($mailadres);	
	$tarih=date("Y-m-d");		
	if (!empty($this->Form->error)) :	
	echo $this->Bilgi->uyari("danger","GİRİLEN MAİL ADRESİ GEÇERSİZ");
	else:
		$sonuc=$this->model->Eklemeİslemi("bulten",
		array("mailadres","tarih"),
		array($mailadres,$tarih));
	
		if ($sonuc==1):		
		echo $this->Bilgi->uyari("success","Bultene Başarılı bir şekilde kayıt oldunuz. Teşekkür ederiz",'id="bultenok"');
		
		else:
		
	
		echo $this->Bilgi->uyari("danger","HATA OLUŞTU. LÜTFEN DAHA SONRA TEKRAR DENEYİNİZ");
		
		endif;
	
	endif;
	
	else:	
	
		$this->Bilgi->direktYonlen("/");
	
	endif;
	
		
	} // BULTEN KAYIT  KONTROL
	
	function iletisim() {
		if ($_POST) :		
	$ad=$this->Form->get("ad")->bosmu();
	$mail=$this->Form->get("mail")->bosmu();
	$konu=$this->Form->get("konu")->bosmu();
	$mesaj=$this->Form->get("mesaj")->bosmu();
	
	@$this->Form->GercektenMailmi($mail);	
	$tarih=date("d-m-Y");
		
	if (!empty($this->Form->error)) :
	
	echo $this->Bilgi->uyari("danger","LÜTFEN TÜM BİLGİLERİ UYGUN GİRİNİZ");

	else:
		$sonuc=$this->model->Eklemeİslemi("iletisim",
		array("ad","mail","konu","mesaj","tarih"),
		array($ad,$mail,$konu,$mesaj,$tarih));
	
		if ($sonuc==1):

		
		echo $this->Bilgi->uyari("success","Mesajınız Alındı. En kısa sürede Dönüş yapılacaktır. Teşekkür ederiz",'id="Formok"');
		
		else:
	
		echo $this->Bilgi->uyari("danger","HATA OLUŞTU. LÜTFEN DAHA SONRA TEKRAR DENEYİNİZ");
		
		endif;
	
	endif;
	
	
	else:	
	
		$this->Bilgi->direktYonlen("/");
	
	endif;

		
	} // iletisim Formu
	
	
	function SepeteEkle() {
Cookie::SepeteEkle($this->Form->get("id")->bosmu(),$this->Form->get("adet")->bosmu());
		
	} // SEPETE EKLE
	
	function FavoriEkle() {
	$urunlink=$_POST["urunlink"];
	$uyeid=$this->Form->get("uyeid")->bosmu();
	$urunresim=$_POST["urunresim"];
	

		$this->model->Eklemeİslemi("favoriurunler",
		array("uyeid","urunlink","urunresim"),
		array($uyeid,$urunlink,$urunresim));
		
	} // SEPETE EKLE
	
	function UrunSil() {
		if ($_POST) :		
		Cookie::UrunUcur($_POST["urunid"]);
		
		else:		
		$this->Bilgi->direktYonlen("/");	
	    endif;	
	} // ÜRÜN SİL
	
	function UrunGuncelle () {
		if ($_POST) :		
		Cookie::Guncelle($_POST["urunid"],$_POST["adet"]);
		else:		
		$this->Bilgi->direktYonlen("/");	
	    endif;	
	} // ÜRÜN GÜNCELLE
	
	function SepetiBosalt () {
		
		$this->Bilgi->direktYonlen("/sayfalar/sepet");
		
		Cookie::SepetiBosalt();
		
	} // SEPETİ BOŞALT	
	
	function SepetKontrol() {
		
		echo '<a href="'.URL.'/sayfalar/sepet">
		<h3> <img src="'.URL.'/views/design/images/bag.png" alt=""> </h3>
		<p>';	
		
		if (isset($_COOKIE["urun"])) :
		
			echo count($_COOKIE["urun"]);			
			else:			
			echo "Sepetiniz Boş";
		endif;		
		echo'</p></a>';
		
	} // SEPET KONTROL
	
function teslimatgetir ()  {
		
		if ($_POST) :		
		
		$sipno=$this->Form->get("sipno")->bosmu();
		$adresid=$this->Form->get("adresid")->bosmu();
	
$teslimatBilgileriGetir=$this->model->Verial("teslimatbilgileri","where siparis_no=".$sipno);
$AdresGetir=$this->model->Verial("adresler","where id=".$adresid);	
				echo '<div class="row">
		
				<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-dark">
					<div class="row">
					
							<div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 text-left">
								<div class="row">
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-bottom border-secondary mb-2">
							<h5>KİŞİSEL BİLGİLER</h5>
							</div>
					
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
							<span class="font-weight-bold">Ad : </span>'.$teslimatBilgileriGetir[0]["ad"].'
							</div>
							
							
								<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
							<span class="font-weight-bold">Soyad : </span>'.$teslimatBilgileriGetir[0]["soyad"].'
							</div>
							
							
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
							<span class="font-weight-bold">Mail :  </span>'.$teslimatBilgileriGetir[0]["mail"].'
							</div>
							
							
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
							<span class="font-weight-bold">Telefon : </span>'.$teslimatBilgileriGetir[0]["telefon"].'
							</div>						
					
							</div>							
							
							</div>	
							
							<div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 text-left">
								<div class="row">
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-bottom border-secondary mb-2">
							<h5>ADRES BİLGİSİ</h5>
							</div>					
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
							<span class="font-weight-bold">Adres : </span>'.$AdresGetir[0]["adres"].'
							</div>
					
							</div>
							</div>
					
					</div>	
				</div>
		</div>';
	
	else:	
	
		$this->Bilgi->direktYonlen("/");
	
	endif;
		
	} // YÖNETİM PANELİ teslimat getir	
	
	function siparisgetir ()  {
		
		if ($_POST) :		
		
		$sipno=$this->Form->get("sipno")->bosmu();
		$adresid=$this->Form->get("adresid")->bosmu();
		
		
		$siparisGetir=$this->model->Verial("siparisler","where siparis_no=".$sipno);
			
			?>
<div class="row arkaplan p-1 mt-2 pb-0 text-center">  

<div class="col-lg-3 col-xl-3 col-md-3 geneltext2 "> <span>ÜRÜN AD</span> </div>
<div class="col-lg-3 col-xl-3 col-md-3 geneltext2 "> <span>ÜRÜN ADET</span> </div>
<div class="col-lg-3 col-xl-3 col-md-3 geneltext2 "> <span>ÜRÜN FİYAT</span> </div>
<div class="col-lg-3 col-xl-3 col-md-3 geneltext2 "> <span>TOPLAM FİYAT</span> </div> 
           </div> 
	<?php
	$toplam=array();
	foreach ($siparisGetir as $deger):
	
		echo '<div class="row border border-light text-center">     
<div class="col-lg-3 col-xl-3 col-md-3 text-dark kalinyap p-2">'.$deger["urunad"].'</div>
<div class="col-lg-3 col-xl-3 col-md-3 text-dark kalinyap p-2">'.$deger["urunadet"].'</div>
<div class="col-lg-3 col-xl-3 col-md-3 text-dark kalinyap p-2">
'.number_Format($deger["urunfiyat"],2,",",".").' TL</div>
<div class="col-lg-3 col-xl-3 col-md-3 text-dark kalinyap p-2">'.number_Format($deger["toplamfiyat"],2,",",".").' TL</div>             
           </div> ';
	$toplam[]=$deger["toplamfiyat"];	
	endforeach;
											
			  ?>
      
      
              <!-- TOPLAM FİYAT -->
                     
                   	<div class="row"> 
                      
                     
                    <div class="col-lg-12  geneltext2 text-right kalinyap p-2 border-bottom border-secondary"><span >SİPARİŞ TOPLAMI
					
					<?php
					print_r(number_Format(array_sum($toplam),2,",","."). " TL");
					
					 ?></span></div>        
                        
                    </div>   
                 <!-- TOPLAM FİYAT -->   
                 
               
			        
                   
                   
         <?php        
                 
                 
	
$teslimatBilgileriGetir=$this->model->Verial("teslimatbilgileri","where siparis_no=".$sipno);
$AdresGetir=$this->model->Verial("adresler","where id=".$adresid);	
				echo '<div class="row">		
				<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-dark">
					<div class="row">					
							<div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 text-left">
								<div class="row">
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-bottom border-secondary mb-2 geneltext2">
							<h5>KİŞİSEL BİLGİLER</h5>
							</div>					
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
							<span class="font-weight-bold">Ad : </span>'.$teslimatBilgileriGetir[0]["ad"].'
							</div>
							
							
								<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
							<span class="font-weight-bold">Soyad : </span>'.$teslimatBilgileriGetir[0]["soyad"].'
							</div>
							
							
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
							<span class="font-weight-bold">Mail :  </span>'.$teslimatBilgileriGetir[0]["mail"].'
							</div>
							
							
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
							<span class="font-weight-bold">Telefon : </span>'.$teslimatBilgileriGetir[0]["telefon"].'
							</div>					
					
							</div>							
							
							</div>	
							<hr>
							<div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 text-left">
								<div class="row">
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-bottom border-secondary mb-2 geneltext2">
							<h5>ADRES BİLGİSİ</h5>
							</div>					
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
							<span class="font-weight-bold">Adres : </span>'.$AdresGetir[0]["adres"].'
							</div>
					
							</div>
							</div>
					
					</div>	
				</div>
		</div>';
	
	else:	
	
		$this->Bilgi->direktYonlen("/");
	
	endif;
		
	} // YÖNETİM PANELİ siparis yazdır getir	
	
function iadeislemi ()  {
		
		if ($_POST) :		
		
		$sipno=$this->Form->get("sipno")->bosmu();	
		$iadeguncelleme=$this->model->Guncelle("siparisler",array("durum"),array(2),"siparis_no=".$sipno);
		if ($iadeguncelleme):

		echo '<div class="alert alert-warning text-center">İADE İŞLEMİ BAŞARILI</div>';

		else:
		echo "hata var";echo '<div class="alert alert-danger text-center">İŞLEM SIRASINDA HATA OLDU</div>';
		endif;

	
	else:	
	
		$this->Bilgi->direktYonlen("/");
	
	endif;
		
	} // ARAYÜZ PANELİ iade işlemi
	
function paneliadeislemi ()  {
		
		if ($_POST) :		
		
		$sipno=$this->Form->get("sipno")->bosmu();	
		$iadeguncelleme=$this->model->Guncelle("siparisler",array("durum"),array(3),"siparis_no=".$sipno);
		if ($iadeguncelleme):

		echo '<div class="alert alert-warning text-center">İADE İŞLEMİ BAŞARILI</div>';

		else:
		echo "hata var";echo '<div class="alert alert-danger text-center">İŞLEM SIRASINDA HATA OLDU</div>';
		endif;

	
	else:	
	
		$this->Bilgi->direktYonlen("/");
	
	endif;
		
	} // YÖNETİM PANELİ iade işlemi
	
	function VarsayilanAdresYap() {
			
		if ($_POST) :	
		
		$uyeid=$this->Form->get("uyeid")->bosmu();
		$adresid=$this->Form->get("adresid")->bosmu();
		
	$this->model->Guncelle("adresler",
	array("varsayilan"),
	array(0),"uyeid=".$uyeid);		
	else:
		$this->Bilgi->direktYonlen("/");
	
	endif;

	
} // VARSAYILAN TÜM ADRESLERİ SIFIRLIYOR	
	
	function VarsayilanAdresYap2() {
			
		if ($_POST) :		
		
		$uyeid=$this->Form->get("uyeid")->bosmu();
		$adresid=$this->Form->get("adresid")->bosmu();	
			
				$this->model->Guncelle("adresler",
				array("varsayilan"),
				array(1),"id=".$adresid." and uyeid=".$uyeid);
	
	else:	
		$this->Bilgi->direktYonlen("/");
	
	endif;

	
}	// SEÇİLEN ADRESİ VARSAYILAN YAPIYOR

	function uyeyorumkontrol() {
			
		if ($_POST) :		
		
		$yorumid=$this->Form->get("yorumid")->bosmu();
		$kriter=$this->Form->get("kriter")->bosmu();	
		
		if ($kriter==1) :		
				$this->model->Guncelle("yorumlar",
				array("durum"),
				array(1),"id=".$yorumid);				
		elseif ($kriter==2):		
			$this->model->Silmeİslemi("yorumlar","id=".$yorumid);	
		
		endif;
	
	else:	
		$this->Bilgi->direktYonlen("/");
	
	endif;
	
}	// ÜYE YORUMLARI ONAY İŞLEVİ

function selectkontrol () {
if ($_POST):
$anaid=$_POST["anaid"];
$cocukid=$_POST["cocukid"];

	if ($_POST["kriter"]=="cocukgetir"):
			$gelendeger=$this->model->Verial("cocuk_kategori","where ana_kat_id=".$anaid);
			foreach ($gelendeger as $deger):	
			Form::OlusturOption(array("value"=>$deger["id"]),false,$deger["ad"]);
			endforeach;	

	endif;


	if ($_POST["kriter"]=="altgetir"):
			$gelendeger=$this->model->Verial("alt_kategori","where cocuk_kat_id=".$cocukid);
			foreach ($gelendeger as $deger):	
			Form::OlusturOption(array("value"=>$deger["id"]),false,$deger["ad"]);
			endforeach;	

	endif;
	//-------------ANA EKRAN KONTROLLERİ BAŞLIYOR----------------
	
	if ($_POST["kriter"]=="anaekrancocukgetir"):
			$gelendeger=$this->model->Verial("cocuk_kategori","where ana_kat_id=".$anaid);
			foreach ($gelendeger as $deger):	
			Form::OlusturOption(array("value"=>$deger["id"]),false,$deger["ad"]);
			endforeach;	

	endif;
	
	if ($_POST["kriter"]=="anaekranaltgetir"):
			$gelendeger=$this->model->Verial("alt_kategori","where cocuk_kat_id=".$cocukid);
			foreach ($gelendeger as $deger):	
			Form::OlusturOption(array("value"=>$deger["id"]),false,$deger["ad"]);
			endforeach;	

	endif;


else:	
$this->Bilgi->direktYonlen("/");

endif;
} // KATEGORİLERİN SELECT HAREKETİNİ KONTROL EDİYOR.


function bultentoplusilme () {
		if ($_POST) :	
		
		$idler=rtrim($_POST["idler"],",");
	
		$this->model->Silmeİslemi("bulten","id IN(".$idler.")");		
		else:		
		$this->Bilgi->direktYonlen("/");	
	    endif;
}

function uruntoplusilme () {
		if ($_POST) :	
		
		$idler=rtrim($_POST["idler"],",");
	
		$this->model->Silmeİslemi("urunler","id IN(".$idler.")");		
		else:		
		$this->Bilgi->direktYonlen("/");	
	    endif;
}

// 	GRUPLARIN İŞLEMLERİ

function grupadguncelle () {

if ($_POST) :	
		$grupad=$_POST["grupad"];
		$grupid=$_POST["grupid"];	
		$tabload=$_POST["tabload"];
		
		$grupadguncelleme=$this->model->Guncelle($tabload,array("ad"),array($grupad),"id=".$grupid);
		
		if ($grupadguncelleme):

		echo '<div class="alert alert-success text-center">Grup Güncelleme Başarılı</div>';

		else:
		echo '<div class="alert alert-danger text-center">GÜNCELLEME SIRASINDA HATA OLDU</div>';
		endif;
	
		
		else:		
			echo '<div class="alert alert-danger text-center">İŞLEM SIRASINDA HATA OLUŞTU</div>';
	    endif;


}

function grupadsil () {

if ($_POST) :	
	
		$grupid=$_POST["grupid"];		
		$tabload=$_POST["tabload"];
		if ($this->model->Silmeİslemi($tabload,"id=".$grupid)):

		echo '<div class="alert alert-success text-center">Grup Silindi.</div>';

		else:
		echo '<div class="alert alert-danger text-center">SİLME SIRASINDA HATA OLDU</div>';
		endif;
	
		
		else:		
			echo '<div class="alert alert-danger text-center">İŞLEM SIRASINDA HATA OLUŞTU</div>';
	    endif;


}

function grupekleme () {


if ($_POST) :	
		$grupad=$_POST["grupad"];
		$tabload=$_POST["tabload"];
		$grupekleme=$this->model->Eklemeİslemi($tabload,
		array("ad"),
		array($grupad));
				
				
				if ($grupekleme):

				echo '<div class="alert alert-success text-center">Grup Eklendi</div>';

				else:
				echo '<div class="alert alert-danger text-center">EKLEME SIRASINDA HATA OLDU</div>';
				endif;
	
		
		else:		
		echo '<div class="alert alert-danger text-center">İŞLEM SIRASINDA HATA OLUŞTU</div>';
	    endif;


}
// 	GRUPLARIN İŞLEMLERİ
// ŞABLONLARIN İŞLEMLERİ
function sablonguncelle () {


if ($_POST) :	
		$sablonad=$_POST["sablonad"];
		$sablonicerik=$_POST["sablonicerik"];
		$sablonid=$_POST["sablonid"];
		$tabload=$_POST["tabload"];
		
		$sablonguncelleme=$this->model->Guncelle($tabload,array("ad","icerik"),array($sablonad,$sablonicerik),"id=".$sablonid);
		
		if ($sablonguncelleme):

		echo '<div class="alert alert-success text-center">Şablon Güncelleme Başarılı</div>';

		else:
		echo '<div class="alert alert-danger text-center">GÜNCELLEME SIRASINDA HATA OLDU</div>';
		endif;
	
		
		else:		
			echo '<div class="alert alert-danger text-center">İŞLEM SIRASINDA HATA OLUŞTU</div>';
	    endif;


}

function sablonsil () {

if ($_POST) :	
	
		$sablonid=$_POST["sablonid"];	
		$tabload=$_POST["tabload"];
		
		if ($this->model->Silmeİslemi($tabload,"id=".$sablonid)):

		echo '<div class="alert alert-success text-center">Şablon Silindi.</div>';

		else:
		echo '<div class="alert alert-danger text-center">SİLME SIRASINDA HATA OLDU</div>';
		endif;
	
		
		else:		
			echo '<div class="alert alert-danger text-center">İŞLEM SIRASINDA HATA OLUŞTU</div>';
	    endif;


}


function sablonekleme () {


if ($_POST) :	
		$sablonad=$_POST["sablonad"];
		$sablonicerik=$_POST["sablonicerik"];
		$tabload=$_POST["tabload"];
		
		$sablonekleme=$this->model->Eklemeİslemi($tabload,
		array("ad","icerik"),
		array($sablonad,$sablonicerik));
				
				
				if ($sablonekleme):

				echo '<div class="alert alert-success text-center">Şablon Eklendi</div>';

				else:
				echo '<div class="alert alert-danger text-center">EKLEME SIRASINDA HATA OLDU</div>';
				endif;
	
		
		else:		
		echo '<div class="alert alert-danger text-center">İŞLEM SIRASINDA HATA OLUŞTU</div>';
	    endif;


}

function grupcek () {

if ($_POST) :	
		$grupid=$_POST["grupid"];
		$sutunad=$_POST["sutunad"];
		$kriter=($sutunad=="grupid") ? "telefon" : "mail";
		
		$numara=$this->model->Verial("uye_panel","where $sutunad=".$grupid);
		
	
				foreach ($numara as $deger):
				
				echo $deger[$kriter]."\r";
				
				endforeach;
			
	
		
		else:		
		echo '<div class="alert alert-danger text-center">İŞLEM SIRASINDA HATA OLUŞTU</div>';
	    endif;


}

function bultenmailgetir () {

if ($_POST) :	
		$durum=$_POST["durum"]; // bunu daha sonra kullanabiliriz
				
		$mailler=$this->model->Verial("bulten",false);
		
	
				foreach ($mailler as $deger):
				
				echo $deger["mailadres"]."\r";
				
				endforeach;
			
	
		
		else:		
		echo '<div class="alert alert-danger text-center">İŞLEM SIRASINDA HATA OLUŞTU</div>';
	    endif;


}

	function toplunumaraekleme () {
	
		$dosya=fopen($_FILES["numaralar"]["tmp_name"],"r");
		// feof fgets
		
				while (!feof($dosya)) :
				
				echo fgets($dosya);
				
				endwhile;
				
				fclose($dosya);


	}
	
	function mailgonderme () {
	
	if ($_POST) :
	
				$mail=$_POST["mail"]; 
				$baslik=$_POST["baslik"]; 
				$metin=$_POST["metin"]; 
				
		echo $this->Mailislem->mailgonder(array($mail),$baslik,$metin);				
	
		
		else:		
		echo '<div class="alert alert-danger text-center">İŞLEM SIRASINDA HATA OLUŞTU</div>';
	    endif;
	
			


	}
	
		function FavoriSil() {
		if ($_POST) :		
		
			$this->model->Silmeİslemi("favoriurunler","id=".$_POST["id"]);	
		else:		
		$this->Bilgi->direktYonlen("/");	
	    endif;	
	} // ÜRÜN SİL
	


}




?>