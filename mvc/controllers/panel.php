<?php

class panel extends Controller  {
	
	public $yetkikontrol,$aramadegeri,$sorguhatasi;
	
function __construct() {
		Session::init();
	
		parent::KutuphaneYukle(array("view","Form","Bilgi","Upload","Pagination","Dosyacikti","Dosyaİslemleri","Sms","Mailislem"));	
		
		Router::İnit();
	//	Router::$modelyukle('adminpanel');	

		if (!Session::get("AdminAd") && !Session::get("Adminid")) : 
		$this->giris();		
		exit();
		
		else:
		$this->yetkikontrol= new PanelHarici();	
		endif;
		
	
	}	// construct	
	
function giris() {
		
		if (Session::get("AdminAd") && Session::get("Adminid")) : 
		$this->Bilgi->direktYonlen("/panel/siparisler");
		else:		
		$this->view->goster("YonPanel/sayfalar/index");	
//		Router::SayfaYukleme("ADMİN",false,"index",false,	null);			
		endif;		
		
	} // LOGİN GİRİŞ SAYFASI		
	
function Index() {
		
		if ($this->yetkikontrol->yoneticiYetki==2) :
		$this->urunler();
		elseif ($this->yetkikontrol->yoneticiYetki==3) :
		$this->uyeler();
		else:		
		$this->siparisler();
		endif;	
		
	}  // VARSAYILAN OLARAK ÇALIŞIYOR
	
//----------------------------------------------
	
function siparisler() {

	Router::SayfaYukleme("ADMİN","siparisYonetim","siparis","SpesifikVerial",	[	
	["data","siparis_no from siparisler"]	]);	

	} // SİPARİŞLERİN ANA EKRANI	
	
function kargoguncelle($islem,$sipno=false) {		
		
	Router::Guncelle(
	[$islem,"ADMİN","siparisYonetim","siparis","Verial",
	[["KargoGuncelle","siparisler","where siparis_no=".$sipno]]],
	["kargodurum"],
	["select" =>"durum"],
	"sipno",
	"siparis_no=",
	"siparisler",	
	"siparisler",	
	["BAŞARILI","KARGO GÜNCELLEME BAŞARILI","success"],
	["BAŞARISIZ","KARGO GÜNCELLEME SIRASINDA HATA OLUŞTU.","warning"]	
	);	
	
	}  // KARGO DURUM GÜNCELLEME	
	
function siparisarama() {	
	$this->yetkikontrol->YetkisineBak("siparisYonetim");		
		if ($_POST) :
		$aramatercih=$this->Form->get("aramatercih")->bosmu();		
		$aramaverisi=$this->Form->get("aramaverisi")->bosmu();	
		
				if (!empty($this->Form->error)) :
				
			$this->view->goster("YonPanel/sayfalar/siparis",
			array(		
			"Bilgi" => $this->Bilgi->hata("BİLGİ GİRİLMELİDİR.","/panel/siparisler",1)
			 ));
				else:				
				
		if ($aramatercih=="sipno") :				
				
			$this->view->goster("YonPanel/sayfalar/siparis",array(	
			"data" => Router::$model->arama("siparisler","siparis_no LIKE '".$aramaverisi."'")));
			
			elseif($aramatercih=="uyebilgi"):			
			
			$Bilgicek=Router::$model->arama("uye_panel",
			"id LIKE '%".$aramaverisi."%' or 
			ad LIKE '%".$aramaverisi."%'  or 
			soyad LIKE '%".$aramaverisi."%' or 
			telefon LIKE '%".$aramaverisi."%'");
		
				if (count($Bilgicek)>0):			
				$this->view->goster("YonPanel/sayfalar/siparis",array(				
				"data" => Router::$model->arama("siparisler","uyeid LIKE '".$Bilgicek[0]["id"]."'")));					
				else:				
				$this->view->goster("YonPanel/sayfalar/siparis",
				array(		
				"Bilgi" => $this->Bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/siparisler",2)
				 ));			
				endif;
				
		endif;
				endif;
		else:
			$this->Bilgi->direktYonlen("/panel/siparisler");
		
		endif;
	} // SİPARİŞ ARAMA
	
function siparisdetayliarama() {	
	$this->yetkikontrol->YetkisineBak("siparisYonetim");			

		if ($_POST) :
		$siparis_no=$this->Form->get("siparis_no",true);		
		$uyeBilgi=$this->Form->get("uyebilgi",true);		
		$kargodurum=$this->Form->get("kargodurum",true);	
		$odemeturu=$this->Form->get("odemeturu",true);	
		$durum=$this->Form->get("durum",true);			
		$tarih1=$this->Form->get("tarih1",true);		
		$tarih2=$this->Form->get("tarih2",true);	
		
	
		
		if (!empty($siparis_no)) : $this->aramadegeri.="<strong>Sipariş Numarası :</strong> ".$siparis_no;	endif;
		if (!empty($kargodurum)) : 		
				switch ($kargodurum):				
				case "0";
				$this->aramadegeri.="<strong>Kargo Durumu :</strong> Tedarik Sürecinde ";
				break;
				case "1";
				$this->aramadegeri.="<strong>Kargo Durumu :</strong> Paketleniyor ";
				break;
				case "2";
				$this->aramadegeri.="<strong>Kargo Durumu :</strong> Kargolandı ";
				break;				
				endswitch;
		
			endif;
		if (!empty($odemeturu)) : $this->aramadegeri.="<strong>Ödeme Türü :</strong> ".$odemeturu." ";	endif;
			if (!empty($durum)) : 		
				switch ($durum):				
				case "0";
				$this->aramadegeri.="<strong>Sipariş Durumu :</strong> İşlemde ";
				break;
				case "1";
				$this->aramadegeri.="<strong>Sipariş Durumu :</strong> Tamamlanmış ";
				break;
				case "2";
				$this->aramadegeri.="<strong>Sipariş Durumu :</strong> İade ";
				break;
								
				endswitch;
		
			endif; // arama kriteri şekilleniyor
	
		
			
			if (!empty($tarih1) && !empty($tarih2)) :	
			$tarihBilgisi="and	DATE(tarih) BETWEEN  '".$tarih1."' and '".$tarih2."'";			
			$this->aramadegeri.="<strong>Başlangıç tarihi :</strong> ".$tarih1 ." <strong>Bitiş tarihi :</strong> ".$tarih2;
			endif;
		
			if (!empty($uyeBilgi)) :				
			$Bilgicek=Router::$model->arama("uye_panel",
			"id LIKE '%".$uyeBilgi."%' or 
			ad LIKE '%".$uyeBilgi."%'  or 
			soyad LIKE '%".$uyeBilgi."%' or 
			telefon LIKE '%".$uyeBilgi."%'");			
			
			
					if ($Bilgicek):		
				
					$this->view->goster("YonPanel/sayfalar/siparisdetayarama",array(			
					"data" => Router::$model->arama("siparisler",
					"uyeid='".$Bilgicek[0]["id"]."' and
					siparis_no LIKE '%".$siparis_no."%' and
					kargodurum LIKE '%".$kargodurum."%' and
					odemeturu LIKE '%".$odemeturu."%' and
					durum LIKE '%".$durum."%' ".@$tarihBilgisi."
					"),
					"aramakriter" => $this->aramadegeri
					));						
					endif;
			
			
			elseif (!empty($siparis_no)) :				
			$this->view->goster("YonPanel/sayfalar/siparisdetayarama",array(				
				"data" => Router::$model->arama("siparisler","siparis_no LIKE ".$siparis_no),
				"aramakriter" => $this->aramadegeri
					));
			else:
			
				$this->view->goster("YonPanel/sayfalar/siparisdetayarama",array(			
					"data" => Router::$model->arama("siparisler",
					"kargodurum LIKE '%".$kargodurum."%' or
					odemeturu LIKE '%".$odemeturu."%' or
					durum LIKE '%".$durum."%' ".@$tarihBilgisi."
					"),
					"aramakriter" => $this->aramadegeri
					));	
			endif;
			
		else:
			$this->view->goster("YonPanel/sayfalar/siparisdetayarama",array(	
			"varsayilan" => true
			));			
		endif;
	} // SİPARİŞ  DETAYLI ARAMA		
	
function siparisExcelAl () {
	
	$this->yetkikontrol->YetkisineBak("siparisYonetim");
	$gelennumaralar=Session::get("numaralar");
	Router::$model->ExcelAyarCek2("siparis_no,urunad,urunadet,urunfiyat,toplamfiyat,kargodurum,odemeturu,durum,tarih from siparisler where siparis_no IN(".$gelennumaralar.")");
	
	$this->Dosyacikti->Excelaktar("SİPARİŞLER",NULL,
	array(
	"Sipariş numarası",
	"Ürün ad",
	"Ürün adet",
	"Ürün fiyat",
	"Toplam Fiyat",
	"Kargo durum",
	"Ödeme Türü",
	"Durum",
	"Tarih"	
	),Router::$model->icerikler[0]);
	
	} // SİPARİŞ EXCEL ÇIKTI
	
function siparisiade() {	
	Router::SayfaYukleme("ADMİN","siparisYonetim","siparisiade","SpesifikVerial",	[	
	["data","siparis_no from siparisler where durum=2"]	]);	
	} // SİPARİŞLERİN ANA EKRANI	
	
//----------------------------------------------
	
function kategoriler() {		
	
	Router::SayfaYukleme("ADMİN","kategoriYonetim","kategoriler","Verial",[	
	["anakategori","ana_kategori","false"],
	["cocukkategori","cocuk_kategori","false"],
	["altkategori","alt_kategori","false"]	
	]);	
		
	} // KATEGORİLER GELİYOR	
	
function kategoriGuncelle($islem,$kriter=false,$id=false) {


	Router::KategoriGuncelle(
	[$islem,"ADMİN","kategoriYonetim","kategoriguncelleme","Verial",
	[
	["data",$kriter."_kategori","where id=".$id],
	["kriter",$kriter],
	["AnaktegorilerTumu","ana_kategori","false"],	
	["CocukkategorilerTumu","cocuk_kategori","false"]	
	]],	
	["input1"=>"kriter","input3"=>"katad","select1"=>"anakatid","select2"=>"cocukkatid"],
	"kayitid",
	"id=",
	"kategoriler",	
	["BAŞARILI","KATEGORİ GÜNCELLEME BAŞARILI","success"],
	["BAŞARISIZ","KATEGORİ GÜNCELLEME SIRASINDA HATA OLUŞTU.","warning"]	
	);	

		
	} // KATEGORİLER GÜNCELLE	
	
function kategoriSil($kriter,$id) {

		Router::Sil("ADMİN","kategoriYonetim","kategoriler","kategoriler",
		[$kriter."_kategori","id=".$id], 
		["BAŞARILI","KATEGORİ SİLME BAŞARILI","success"],
		["BAŞARISIZ","KATEGORİ SİLME SIRASINDA HATA OLUŞTU.","warning"]);	
		
	} // KATEGORİ SİL
	
function kategoriEkle($islem,$kriter=false) {
      $this->yetkikontrol->YetkisineBak("kategoriYonetim");
		 
			if ($islem=="ilk"):
						  	Router::SayfaYukleme("ADMİN","kategoriYonetim","kategoriekle","Verial",[	
								["kriter",$kriter],
								["AnaktegorilerTumu","ana_kategori","false"],
								["CocukkategorilerTumu","cocuk_kategori","false"]	
								]);	
								
			else :			
				
		
			if ($_POST) :	
				$kriter=$this->Form->get("kriter")->bosmu();		
				$katad=$this->Form->get("katad")->bosmu();
				
				@$anakatid=$_POST["anakatid"];
				@$cocukkatid=$_POST["cocukkatid"];			
				
				if (!empty($this->Form->error)) :
				
			$this->view->goster("YonPanel/sayfalar/kategoriekle",
			array(
				"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/kategoriler","BAŞARISIZ","Kategori adı girilmelidir","warning")		
					
		 ));		
				
			else:	
		
		if ($kriter=="ana") :
		
		$sonuc=Router::$model->Ekleme("ana_kategori",
		array("ad"),
		array($katad));
				
		elseif($kriter=="cocuk") :
		
		$sonuc=Router::$model->Ekleme("cocuk_kategori",
		array("ana_kat_id","ad"),
		array($anakatid,$katad));
			
		elseif($kriter=="alt") :
		
		$sonuc=Router::$model->Ekleme("alt_kategori",
		array("cocuk_kat_id","ana_kat_id","ad"),
		array($cocukkatid,$anakatid,$katad));
		endif;
	
		if ($sonuc): 
	
			$this->view->goster("YonPanel/sayfalar/kategoriekle",
			array(
	"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/kategoriler","BAŞARILI","EKLEME BAŞARILI","success")	
			
			 ));
				
		else:
		
			$this->view->goster("YonPanel/sayfalar/kategoriekle",
			array(
		"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/kategoriler","BAŞARISIZ","EKLEME SIRASINDA HATA OLUŞTU","warning")			
			
		 ));	
		
		endif;
		
		endif;
		
				
			else:
			$this->Bilgi->direktYonlen("/panel/kategoriler");
				
	
				endif;		
								
			endif;
		
		
		
	} // KATEGORİ EKLE
	
function kategoriarama() {	
	$this->yetkikontrol->YetkisineBak("kategoriYonetim");		
		if ($_POST) :
		 $aramatercih=$this->Form->get("aramatercih")->bosmu();		
		 $aramaverisi=$this->Form->get("aramaverisi")->bosmu();		
		
			if (!empty($this->Form->error)) :
				
			$this->view->goster("YonPanel/sayfalar/kategoriler",
			array(		
			"Bilgi" => $this->Bilgi->hata("Boş alan bırakılmamalıdır.","/panel/kategoriler",1)
			 ));				
				
				else:				
							
			if ($aramatercih=="ana") :				
			$Bilgicek=Router::$model->arama("ana_kategori",
			"ad LIKE '%".$aramaverisi."%'");			
			elseif($aramatercih=="cocuk"):		
			
			$Bilgicek=Router::$model->joinislemi(
			array(
			"ana_kategori.ad As anakatad",
			"cocuk_kategori.ad  As cocukad",			
			"cocuk_kategori.id As cocukid"
			),
			array(
			"ana_kategori",
			"cocuk_kategori"				
			),
			"ana_kategori.id=cocuk_kategori.ana_kat_id	AND
			cocuk_kategori.ad LIKE '%".$aramaverisi."%'"
			);
		
			
			elseif($aramatercih=="alt"):
			
			$Bilgicek=Router::$model->joinislemi(
			array(
			"ana_kategori.ad As anakatad",
			"cocuk_kategori.ad  As cocukkatad",
			"alt_kategori.ad  As altad",
			"alt_kategori.id As altid"
			),
			array(
			"ana_kategori",
			"cocuk_kategori",
			"alt_kategori"		
			),
			"(ana_kategori.id=cocuk_kategori.ana_kat_id) AND 	(cocuk_kategori.id=alt_kategori.cocuk_kat_id)
		AND
		alt_kategori.ad LIKE '%".$aramaverisi."%'"
			);
			
			endif;
			
				if ($Bilgicek):
			
				$this->view->goster("YonPanel/sayfalar/kategoriler",array(				
				"kategoriaramasonuc" => $Bilgicek,
				"kelime" => $aramaverisi,
				"kategorimiz" => $aramatercih				
				));		
				
				else:
				
				$this->view->goster("YonPanel/sayfalar/kategoriler",
				array(		
				"Bilgi" => $this->Bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/kategoriler",2)
				 ));			
				endif;
				
			
			
		endif;
		
		
		
		else:
			$this->Bilgi->direktYonlen("/panel/kategoriler");		
		
		
		endif;
		
	} // KATEGORİ ARAMA	
	
//----------------------------------------------
	
function uyeler ($mevcutsayfa=false) {		

		Router::SayfaYuklemePagi("Uyeler","ADMİN","uyeYonetim","uyeler","uye_panel",$mevcutsayfa,"uyelerGoruntuAdet",
		["pazarlama_gruplar.ad As grupad","uye_panel.*"],
		["pazarlama_gruplar","uye_panel"],
		"uye_panel.grupid=pazarlama_gruplar.id  LIMIT ");	
		
} // ÜYELER GELİYOR			
	
function uyeGuncelle($islem,$id=false) {

	Router::Guncelle(
	[$islem,"ADMİN","uyeYonetim","uyeler","Verial",
	[["Uyeguncelle","uye_panel","where id=".$id],
	 ["smsgruplar","pazarlama_gruplar","false"]]
	],
	["ad","soyad","mail","telefon","durum","grupid"],
	["input1" =>"ad","input2" =>"soyad","input3" =>"mail","input4" =>"telefon","select1" =>"durum","select2" =>"grup"],
	"uyeid",
	"id=",
	"uyeler",	
	"uye_panel",	
	["BAŞARILI","ÜYE GÜNCELLEME BAŞARILI","success"],
	["BAŞARISIZ","ÜYE GÜNCELLEME SIRASINDA HATA OLUŞTU.","warning"]	
	);	

		
	} // ÜYELER GÜNCELLE	
		
function uyeSil($id) {
  	Router::Sil("ADMİN","uyeYonetim","uyeler","uyeler",
		["uye_panel","id=".$id], 
		["BAŞARILI","ÜYE SİLME BAŞARILI","success"],
		["BAŞARISIZ","ÜYE SİLME SIRASINDA HATA OLUŞTU.","warning"]);			
	}  // ÜYE SİL	
		
function uyearama($kelime=false,$mevcutsayfa=false) {	
		$this->yetkikontrol->YetkisineBak("uyeYonetim");		
		if ($_POST || isset($kelime)) :
		
		if ($_POST): 
		$aramaverisi=$this->Form->get("aramaverisi")->bosmu();	
		$sorgum=!empty($this->Form->error);
		else:
		$aramaverisi=$kelime;	
		$sorgum=empty($kelime);
		endif;
				
		
		
				if ($sorgum) :
				
				$this->view->goster("YonPanel/sayfalar/uyeler",
				array(		
				"Bilgi" => $this->Bilgi->hata("KRİTER GİRİLMELİDİR.","/panel/uyeler",2)
				 ));			
				
				else:
			
			$Bilgicek=Router::$model->arama("uye_panel",
			"id LIKE '%".$aramaverisi."%' or 
			ad LIKE '%".$aramaverisi."%'  or 
			soyad LIKE '%".$aramaverisi."%' or 
			telefon LIKE '%".$aramaverisi."%'");
			
		$this->Pagination->paginationOlustur(count($Bilgicek),$mevcutsayfa,Router::$model->tekliveri("uyelerAramaAdet"," from ayarlar"));
	
				if (count($Bilgicek)>0):
			
				$this->view->goster("YonPanel/sayfalar/uyeler",array(				
			"data" => Router::$model->arama("uye_panel",
			"id LIKE '%".$aramaverisi."%' or 
			ad LIKE '%".$aramaverisi."%'  or 
			soyad LIKE '%".$aramaverisi."%' or 
			telefon LIKE '%".$aramaverisi."%' 
			LIMIT ".$this->Pagination->limit.",".$this->Pagination->gosterilecekadet),
			"toplamsayfa" => $this->Pagination->toplamsayfa,
			"toplamveri" => count($Bilgicek),
			"arama" => $aramaverisi					
				));		
				
				else:
				
				$this->view->goster("YonPanel/sayfalar/uyeler",
				array(		
				"Bilgi" => $this->Bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/uyeler",2)
				 ));			
				endif;
	
				
				endif;
				
		
		
		else:
			$this->Bilgi->direktYonlen("/panel/uyeler");		
		
		
		endif;
		
	} // ÜYE ARAMA
	
function uyeadresbak($id) {		
	
	Router::SayfaYukleme("ADMİN","uyeYonetim","uyeler","Verial",[	
	["UyeadresBak","adresler","where uyeid=".$id]	]);		
	} // ÜYE ADRESLERİ 
	
function musteriyorumlar ($mevcutsayfa=false) {	
	
		$this->yetkikontrol->YetkisineBak("uyeYonetim");	
	
	$this->Pagination->paginationOlustur(Router::$model->sayfalama("yorumlar"),$mevcutsayfa,
	Router::$model->tekliveri("uyelerYorumAdet"," from ayarlar"));	
		
		$this->view->goster("YonPanel/sayfalar/musteriyorumlar",array(
		
		"data" => Router::$model->joinislemi(
		array(
		"urunler.urunad As urunad",
		"yorumlar.*"	
		),
		array(
		"urunler",
		"yorumlar"		
		),
		"yorumlar.urunid=urunler.id order by durum asc LIMIT ".$this->Pagination->limit.",".$this->Pagination->gosterilecekadet
		),
		
		"toplamsayfa" => $this->Pagination->toplamsayfa,
		"toplamveri" => Router::$model->sayfalama("yorumlar")
		
		
		));  
	
	
		
	} // ÜYELERİN YORUMLARI
	
//----------------------------------------------
	
function urunler ($mevcutsayfa=false) {
	Router::SayfaYuklemePagi("Urunler","ADMİN","urunYonetim","urunler","urunler",$mevcutsayfa,"urunlerGoruntuAdet");		
	
	}  // ÜRÜNLER GELİYOR
	
function urunGuncelle($islem,$id=false) {
$this->yetkikontrol->YetkisineBak("urunYonetim");		
			if($islem=="ilk"):
									Router::SayfaYukleme("ADMİN","urunYonetim","urunler","Verial",[	
									["Urunguncelle","urunler","where id=".$id],
									["data2","alt_kategori","false"],
									["AnakategorilerTumu","ana_kategori","false"],	
									["CocukkategorilerTumu","cocuk_kategori","false"]	
									]);	
			else:			
			
			if ($_POST) :	
			
				$ana_kat_id=$this->Form->get("ana_kat_id")->bosmu();
				$cocuk_kat_id=$this->Form->get("cocuk_kat_id")->bosmu();			
				$urunad=$this->Form->get("urunad")->bosmu();
				$katid=$this->Form->get("katid")->bosmu();							
				$fiyat=$this->Form->get("fiyat")->bosmu();
				$stok=$this->Form->get("stok")->bosmu();
				$durum=$this->Form->Selectboxget("durum");
				$urunaciklama=$this->Form->get("urunaciklama")->bosmu();
				$urunozellikaciklama=$this->Form->get("ozellikaciklama")->bosmu();
				$urunozellikleri=$this->Form->get("urunozellikleri")->bosmu();	
				$urunekstra=$this->Form->get("urunekstra")->bosmu();
				$kayitid=$this->Form->get("kayitid")->bosmu();		
				
if ($this->Upload->uploadPostAl("res1")) : $this->Upload->UploadDosyaKontrol("res1");	endif;	

if ($this->Upload->uploadPostAl("res2")) : $this->Upload->UploadDosyaKontrol("res2");	endif;	
				
if ($this->Upload->uploadPostAl("res3")) : $this->Upload->UploadDosyaKontrol("res3");	endif;	
				
			if (!empty($this->Form->error)) :
				
			$this->view->goster("YonPanel/sayfalar/urunler",
			array(
			"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARISIZ","Tüm alanlar doldurulmalıdır.","warning")		
			 ));
			 
			elseif (!empty($this->Upload->error)) :				
			$this->view->goster("YonPanel/sayfalar/urunler",
			array(		
			"Bilgi" => $this->Upload->error,
			"yonlen" =>$this->Bilgi->sureliYonlen(3,"/panel/urunler") 
			 ));
				
			else:			$sutunlar=array("ana_kat_id","cocuk_kat_id","katid","urunad","durum","aciklama","ozellikler","fiyat","stok","ozellikaciklama","ekstraBilgi");		
			$veriler=array($ana_kat_id,$cocuk_kat_id,$katid,$urunad,$durum,$urunaciklama,$urunozellikleri,$fiyat,$stok,$urunozellikaciklama,$urunekstra);
			
 if ($this->Upload->uploadPostAl("res1")) :
 	$sutunlar[]="res1"; 
	$veriler[]=$this->Upload->Yukle("res1",true); 
 endif;	

 if ($this->Upload->uploadPostAl("res2")) :
 	$sutunlar[]="res2"; 
	$veriler[]=$this->Upload->Yukle("res2",true); 
 endif;	
  if ($this->Upload->uploadPostAl("res3")) :
 	$sutunlar[]="res3"; 
	$veriler[]=$this->Upload->Yukle("res3",true); 
 endif;		
		$sonuc=Router::$model->Guncelle("urunler",
		$sutunlar,
		$veriler,"id=".$kayitid);	
		if ($sonuc): 	
			$this->view->goster("YonPanel/sayfalar/urunler",
			array(
			"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARILI","ÜRÜN BAŞARIYLA GÜNCELLENDİ","success")	
			 ));				
		else:		
			$this->view->goster("YonPanel/sayfalar/urunler",
			array(
			"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARISIZ","GÜNCELLEME SIRASINDA HATA OLUŞTU","warning")			
			 ));			
		endif;	
		
		endif;		
				
			else:
			$this->Bilgi->direktYonlen("/panel/urunler");			
	
	endif;	

			endif;
		
	
		
	} // ÜRÜNLER GÜNCELLE		

function urunekle($islem) {	
$this->yetkikontrol->YetkisineBak("urunYonetim");	
if ($islem=="ilk"):
  Router::SayfaYukleme("ADMİN","urunYonetim","urunler","Verial",[	
	["Urunekleme","true"],
	["data2","alt_kategori","false"]
	]);	
else:		
		
			if ($_POST) :				
				$urunad=$this->Form->get("urunad")->bosmu();
				$katid=$this->Form->get("katid")->bosmu();			
				$fiyat=$this->Form->get("fiyat")->bosmu();
				$stok=$this->Form->get("stok")->bosmu();
				$durum=$this->Form->get("durum")->bosmu();
				$urunaciklama=$this->Form->get("urunaciklama")->bosmu();
				$urunozellikaciklama=$this->Form->get("ozellikaciklama")->bosmu();
				$urunozellikleri=$this->Form->get("urunozellikleri")->bosmu();	
				
				$urunekstra=$this->Form->get("urunekstra")->bosmu();			
				$this->Upload->UploadResimYeniEkleme("res",3);
				
				if (!empty($this->Form->error)) :
				
			$this->view->goster("YonPanel/sayfalar/urunler",
			array(	
			"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARISIZ","Tüm alanlar doldurulmalıdır","warning")		
			 ));	
			 
			 	elseif (!empty($this->Upload->error)) :
				
			$this->view->goster("YonPanel/sayfalar/urunler",
			array(		
			"Bilgi" => $this->Upload->error
			 ));	
				
			else:	
				
		
				$dosyayukleme=$this->Upload->Yukle();	
				$sonuc=Router::$model->Ekleme("urunler",		array("katid","urunad","res1","res2","res3","durum","aciklama","ozellikler","fiyat","stok","ozellikaciklama","ekstraBilgi"),
		array($katid,$urunad,$dosyayukleme[0],$dosyayukleme[1],$dosyayukleme[2],$durum,$urunaciklama,$urunozellikleri,$fiyat,$stok,$urunozellikaciklama,$urunekstra));			
	
		
	
		if ($sonuc): 
	
			$this->view->goster("YonPanel/sayfalar/urunler",
			array(
				"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARILI","ÜRÜN BAŞARIYLA EKLENDİ","success")			
			 ));
				
		else:
		
			$this->view->goster("YonPanel/sayfalar/urunler",
			array(
				"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARISIZ","EKLEME SIRASINDA HATA OLUŞTU","warning")			
			 ));	
		
		endif;	
		
		endif;
						
			else:
			$this->Bilgi->direktYonlen("/panel/urunler");				
	
	endif;	
	
	
	
	
	endif;
		
	} // ÜRÜN EKLEME SON	
		
function urunSil($id) {

    Router::Sil("ADMİN","urunYonetim","urunler","urunler",
		["urunler","id=".$id], 
		["BAŞARILI","ÜRÜN SİLME BAŞARILI","success"],
		["BAŞARISIZ","ÜRÜN SİLME SIRASINDA HATA OLUŞTU.","warning"]);		 
		
	}  // ÜRÜNLER SİL	
	
function katgoregetir($katid=false,$mevcutsayfa=false) {	
	$this->yetkikontrol->YetkisineBak("urunYonetim");	
		if ($_POST) :
				
		$katid=$this->Form->get("katid")->bosmu();
		
		
		$Bilgicek=Router::$model->Verial("urunler","where katid=".$katid);
		
				
$this->Pagination->paginationOlustur(count($Bilgicek),$mevcutsayfa,Router::$model->tekliveri("urunlerKategoriAdet"," from ayarlar"));	
		
		
				if ($Bilgicek):
			
				$this->view->goster("YonPanel/sayfalar/urunler",array(
				
				"data" => Router::$model->Verial("urunler","where katid=".$katid." LIMIT ".$this->Pagination->limit.",".$this->Pagination->gosterilecekadet),
				"toplamsayfa" => $this->Pagination->toplamsayfa,
				"toplamveri" => count($Bilgicek),
				"katid" => $katid,
				"data2" => Router::$model->Verial("ana_kategori",false)			
				));	
				else:
				
				$this->view->goster("YonPanel/sayfalar/urunler",
				array(		
				"Bilgi" => $this->Bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/urunler",2)
				 ));			
				endif;
	
		
		
			elseif (isset($katid)):
		
		$Bilgicek=Router::$model->Verial("urunler","where katid=".$katid);
		
				
$this->Pagination->paginationOlustur(count($Bilgicek),$mevcutsayfa,Router::$model->tekliveri("urunlerKategoriAdet"," from ayarlar"));


		
			$this->view->goster("YonPanel/sayfalar/urunler",array(
				
				"data" => Router::$model->Verial("urunler","where katid=".$katid." LIMIT ".$this->Pagination->limit.",".$this->Pagination->gosterilecekadet),
				"toplamsayfa" => $this->Pagination->toplamsayfa,
				"toplamveri" => count($Bilgicek),
				"katid" => $katid,
				"data2" => Router::$model->Verial("alt_kategori",false)			
				));	
		
		else:
			$this->Bilgi->direktYonlen("/panel/urunler");		
		
		
		endif;
	} // ÜRÜNLERi KATEGORİYE GÖRE GETİR	
	
function urunarama($kelime=false,$mevcutsayfa=false) {	
		$this->yetkikontrol->YetkisineBak("urunYonetim");	
		if ($_POST) :
				
		$aramaverisi=$this->Form->get("arama")->bosmu();
		
				if (!empty($this->Form->error)) :				
				$this->view->goster("YonPanel/sayfalar/urunler",
				array(		
				"Bilgi" => $this->Bilgi->hata("KRİTER GİRİLMELİDİR.","/panel/urunler",2)
				 ));
				else:
			$Bilgicek=Router::$model->arama("urunler",
			"urunad LIKE '%".$aramaverisi."%' or 			
			stok LIKE '%".$aramaverisi."%'");
			
$this->Pagination->paginationOlustur(count($Bilgicek),$mevcutsayfa,Router::$model->tekliveri("urunlerAramaAdet"," from ayarlar"));	
			
			
				if (count($Bilgicek)>0):
			$this->view->goster("YonPanel/sayfalar/urunler",array(				
			"data" => Router::$model->arama("urunler",
			"urunad LIKE '%".$aramaverisi."%' or 		
			stok LIKE '%".$aramaverisi."%' 
			LIMIT ".$this->Pagination->limit.",".$this->Pagination->gosterilecekadet),	
				
			"toplamsayfa" => $this->Pagination->toplamsayfa,
			"toplamveri" => count($Bilgicek),
			"arama" => $aramaverisi,
			"data2" => Router::$model->Verial("ana_kategori",false)						
				));	
				
				else:
				
				$this->view->goster("YonPanel/sayfalar/urunler",
				array(		
				"Bilgi" => $this->Bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/urunler",2)
				 ));			
				endif;	
				
				endif;	
	
		elseif (isset($kelime)):
		
			$Bilgicek=Router::$model->arama("urunler",
			"urunad LIKE '%".$kelime."%' or 			
			stok LIKE '%".$kelime."%'");
			
$this->Pagination->paginationOlustur(count($Bilgicek),$mevcutsayfa,Router::$model->tekliveri("urunlerAramaAdet"," from ayarlar"));	
		
			$this->view->goster("YonPanel/sayfalar/urunler",array(				
			"data" => Router::$model->arama("urunler",
			"urunad LIKE '%".$kelime."%' or 			
			stok LIKE '%".$kelime."%' 
			LIMIT ".$this->Pagination->limit.",".$this->Pagination->gosterilecekadet),	
				
			"toplamsayfa" => $this->Pagination->toplamsayfa,
			"toplamveri" => count($Bilgicek),
			"arama" => $kelime,
			"data2" => Router::$model->Verial("ana_kategori",false)						
				));	
		
		else:
			$this->Bilgi->direktYonlen("/panel/urunler");		
		
		
		endif;	
		
	} // ÜRÜNLER ARAMA
	
function topluurunekle($son=false) {	
	$this->yetkikontrol->YetkisineBak("urunYonetim");		
	
	if ($son):
	
	$tercih=$this->Form->radiobutonget("dosyatercih");
	
	if ($tercih=="xml"):
	$this->Dosyaİslemleri->VerileriAyikla("dosya","/urunler/urun",	array("ana_kat_id","cocuk_kat_id","katid","*urunad","*res1","*res2","*res3","durum","*aciklama","*kumas","*urtYeri","*renk","fiyat","stok","*ozellik","*ekstraBilgi"));
	
	else:	
	
	$this->Dosyaİslemleri->JsonVerileriAyikla("dosya");
	
	endif;
	
	
			if (!empty($this->Dosyaİslemleri->error)) :
				
			$this->view->goster("YonPanel/sayfalar/topluurunislem",
			array(	
			"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARISIZ","Yüklenen XML Dosya Açılamadı","warning")		
			 ));
			 
			 else:
			 $zipsonuc=$this->Upload->xmlzipresimyukleme("zipdosya");
				
					if (!empty($this->Upload->error)) :

					$this->view->goster("YonPanel/sayfalar/topluurunislem",
					array(	
					"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARISIZ","Yüklenen Zip Dosyası Hatalı","warning")		
					 ));
			 
					else:
					
					$sonuc=Router::$model->TopluEkleme("urunler",		array("ana_kat_id","cocuk_kat_id","katid","urunad","res1","res2","res3","durum","aciklama","kumas","urtYeri","renk","fiyat","stok","ozellik","ekstraBilgi"),$this->Dosyaİslemleri->verileritut);				
					
										
						if ($sonuc): 
						$this->Upload->ZipResimYuklemeSon("zipdosya",$zipsonuc);
						$this->view->goster("YonPanel/sayfalar/topluurunislem",
						array(
						"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARILI","İÇERİ AKTARIM BAŞARI","success")			
						));

						else:

						$this->view->goster("YonPanel/sayfalar/topluurunislem",
						array(
						"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARISIZ","EKLEME SIRASINDA HATA OLUŞTU","warning")			
						));	

						endif;	
					
									
					
					endif;
			 
			 endif;
	
	else:
	$this->view->goster("YonPanel/sayfalar/topluurunislem",array(	
	"topluekleme" => true		
	));	
	
	endif;
		
	
		
	} // XML-JSON ÜRÜN EKLEME - TOPLU ÜRÜN EKLEME
	
function topluurunguncelleme($son=false) {	
	$this->yetkikontrol->YetkisineBak("urunYonetim");		
	
	if ($son):
	
	$tercih=$this->Form->radiobutonget("dosyatercih");
	
	
	if ($tercih=="xml"):
	
	$this->Dosyaİslemleri->TopluGuncellemeXml("dosya","/urunler/urun");
	
	else:	
	
	$this->Dosyaİslemleri->TopluGuncellemeJson("dosya");
	
	endif;
	
	
			if (!empty($this->Dosyaİslemleri->error)) :
				
			$this->view->goster("YonPanel/sayfalar/topluurunislem",
			array(	
			"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARISIZ","Yüklenen  Dosya Açılamadı","warning")		
			 ));
			 
			 else:
			 		if ($this->Dosyaİslemleri->resimvarmi):
					 $zipsonuc=$this->Upload->xmlzipresimyukleme("zipdosya");
					 
							if (!empty($this->Upload->error)) :

							$this->view->goster("YonPanel/sayfalar/topluurunislem",
							array(	
							"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARISIZ","Yüklenen Zip Dosyası Hatalı","warning")		
							 ));
								exit();
							 endif;
						
					endif;	 
								 
					
					
							Router::$model->TopluislemBaslat();	

							for ($a=0; $a<count($this->Dosyaİslemleri->verilerdizi); $a++):

							$sonuc=Router::$model->Guncelle("urunler",
							$this->Dosyaİslemleri->sutunlardizi[$a],
							$this->Dosyaİslemleri->verilerdizi[$a],
							"id=".$this->Dosyaİslemleri->verilerdizi[$a][0]);

									if (!$sonuc):

									$this->sorguhatasi=true;
									
									else:
									$this->sorguhatasi=false;

									endif;


							endfor;

							if ($this->sorguhatasi):	

							Router::$model->İslemlerigerial();

							else:

							Router::$model->TopluislemTamamla();
							endif;
				
					
										
						if (!$this->sorguhatasi): 
						
							if ($this->Dosyaİslemleri->resimvarmi):
							$this->Upload->ZipResimYuklemeSon("zipdosya",$zipsonuc);
							endif;
						$this->view->goster("YonPanel/sayfalar/topluurunislem",
						array(
						"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARILI","İÇERİ AKTARIM BAŞARI","success")			
						));

						else:

						$this->view->goster("YonPanel/sayfalar/topluurunislem",
						array(
						"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARISIZ","EKLEME SIRASINDA HATA OLUŞTU","warning")			
						));	

						endif;	
					
									
					
					
			 
			 endif;
	
	else:
	$this->view->goster("YonPanel/sayfalar/topluurunislem",array(	
	"topluguncelle" => true		
	));	
	
	endif;
		
	
		
	} // TOPLU ÜRÜN GÜNCELLEME

function topluurunsilme($son=false) {	
	$this->yetkikontrol->YetkisineBak("urunYonetim");		
	
	if ($son):
	
	$tercih=$this->Form->radiobutonget("dosyatercih");
	
	
	
	if ($tercih=="xml"):
	
	$sonhal=$this->Dosyaİslemleri->TopluSilmeXml("dosya","/urunler/urun");
	
	else:	
	
	$sonhal=$this->Dosyaİslemleri->TopluSilmeJson("dosya");
	
	endif;
	
	
			if (!empty($this->Dosyaİslemleri->error)) :
				
			$this->view->goster("YonPanel/sayfalar/topluurunislem",
			array(	
			"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARISIZ","Yüklenen  Dosya Açılamadı","warning")		
			 ));
			 
			 else:		 							 
					
					
						$sonuc=Router::$model->Sil("urunler","id IN($sonhal)");		
										
						if ($sonuc): 
						
						$this->view->goster("YonPanel/sayfalar/topluurunislem",
						array(
						"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARILI","ÜRÜNLER SİLİNDİ","success")			
						));

						else:

						$this->view->goster("YonPanel/sayfalar/topluurunislem",
						array(
						"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/urunler","BAŞARISIZ","EKLEME SIRASINDA HATA OLUŞTU","warning")			
						));	

						endif;	
					
									
					
					
			 
			 endif;
	
	else:
	$this->view->goster("YonPanel/sayfalar/topluurunislem",array(	
	"toplusilme" => true		
	));	
	
	endif;
		
	
		
	} // TOPLU ÜRÜN GÜNCELLEME
	
//----------------------------------------------	

function bulten ($mevcutsayfa=false) {
	Router::SayfaYuklemePagi("Bulten","ADMİN","bultenYonetim","bulten","bulten",$mevcutsayfa,"bultenGoruntuAdet");			
	} // BÜLTEN GELİYOR
	
function bultenExcelAl () {
	$this->yetkikontrol->YetkisineBak("bultenYonetim");
	Router::$model->ExcelAyarCek("bulten",false,"bulten");	
	$this->Dosyacikti->Excelaktar("Bültendeki Mailler",NULL,array("Mail Adresi"),Router::$model->icerikler);
		
	} // BULTEN EXCEL ÇIKTI
	
function bultenTxtAl () {	
	$this->yetkikontrol->YetkisineBak("bultenYonetim");
	$this->Dosyacikti->txtolustur(Router::$model->Verial("bulten",false));
		
	}  // BULTEN TXT ÇIKTI
	
function mailSil($id) {

    Router::Sil("ADMİN","bultenYonetim","bulten","bulten",
		["bulten","id=".$id], 
		["BAŞARILI","MAİL SİLME BAŞARILI","success"],
		["BAŞARISIZ","MAİL SİLME SIRASINDA HATA OLUŞTU.","warning"]);	
		
	}  // BÜLTEN MAİL SİL	

function mailarama($kelime=false,$mevcutsayfa=false) {	
		$this->yetkikontrol->YetkisineBak("bultenYonetim");
		
		if ($_POST || isset($kelime)) :
		
		if ($_POST): 
		$aramaverisi=$this->Form->get("arama")->bosmu();	
		$sorgum=!empty($this->Form->error);
		else:
		$aramaverisi=$kelime;	
		$sorgum=empty($kelime);
		endif;
	
				if ($sorgum) :
				
				$this->view->goster("YonPanel/sayfalar/bulten",
				array(		
				"Bilgi" => $this->Bilgi->hata("MAİL YAZILMALIDIR.","/panel/bulten",2)
				 ));
				else:
				
				
			$Bilgicek=Router::$model->arama("bulten",
			"mailadres LIKE '%".$aramaverisi."%'");
			
		$this->Pagination->paginationOlustur(count($Bilgicek),$mevcutsayfa,Router::$model->tekliveri("bultenGoruntuAdet"," from ayarlar"));
			
			
			
				if (count($Bilgicek)>0):
			
				$this->view->goster("YonPanel/sayfalar/bulten",array(				
			"data" => Router::$model->arama("bulten",
			"mailadres LIKE '%".$aramaverisi."%'
			LIMIT ".$this->Pagination->limit.",".$this->Pagination->gosterilecekadet),
			"toplamsayfa" => $this->Pagination->toplamsayfa,
			"toplamveri" => count($Bilgicek),
			"arama" => $aramaverisi					
				));	
			
			
				
				else:
				
				$this->view->goster("YonPanel/sayfalar/bulten",
				array(		
				"Bilgi" => $this->Bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/bulten",2)
				 ));			
				endif;
	
				
				endif;
		
		
		else:
			$this->Bilgi->direktYonlen("/panel/bulten");		
		
		
		endif;
	
		
	}  // BÜLTEN MAİL ARAMA
	
function tarihegoregetir($tarih1=false,$tarih2=false,$mevcutsayfa=false) {	
		$this->yetkikontrol->YetkisineBak("bultenYonetim");
		if ($_POST || (isset($tarih1) and isset($tarih2))) :
		
		
		if ($_POST): 
		$tar1=$this->Form->get("tar1")->bosmu();
		$tar2=$this->Form->get("tar2")->bosmu();
		$sorgum=!empty($this->Form->error);
		else:
		$tar1=$tarih1;
		$tar2=$tarih2;
		$sorgum=empty($tarih1) && empty($tarih2);
		endif;
				
		
				if ($sorgum) :
				
				$this->view->goster("YonPanel/sayfalar/bulten",
				array(		
				"Bilgi" => $this->Bilgi->hata("TARİHLER BELİRTİLMELİDİR.","/panel/bulten",2)
				 ));				
				
				else:
				
			$Bilgicek=Router::$model->Verial("bulten",
			"where DATE(tarih) BETWEEN '".$tar1."' and '".$tar2."'");
			
		$this->Pagination->paginationOlustur(count($Bilgicek),$mevcutsayfa,Router::$model->tekliveri("bultenGoruntuAdet"," from ayarlar"));
			
			
				if (count($Bilgicek)>0):
			
				$this->view->goster("YonPanel/sayfalar/bulten",array(				
			"data" => Router::$model->Verial("bulten",
			"where DATE(tarih) BETWEEN '".$tar1."' and '".$tar2."' 
			LIMIT ".$this->Pagination->limit.",".$this->Pagination->gosterilecekadet),
			"toplamsayfa" => $this->Pagination->toplamsayfa,
			"toplamveri" => count($Bilgicek),
			"tariharama" => true,
			"tarih1" => $tar1,
			"tarih2" => $tar2,
				));		
					
				
				else:
				
				$this->view->goster("YonPanel/sayfalar/bulten",
				array(		
				"Bilgi" => $this->Bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/bulten",2)
				 ));			
				endif;
	
				
				endif;	
		
		else:
			$this->Bilgi->direktYonlen("/panel/bulten");
		endif;
		
	}  // BÜLTEN TARİHE GÖRE ARAMA
	
//----------------------------------------------
	
function sistemayar () {
		
	Router::SayfaYukleme("ADMİN","sistemayarYonetim","sistemayar","Verial",[		
	["sistemayar","ayarlar","false"]
	]);	
		
	}  // SİSTEM AYARLARI GELİYOR
	
function ayarguncelle() {	

	Router::Guncelle(null,	["title","sayfaAciklama","anahtarKelime","uyelerGoruntuAdet","uyelerAramaAdet","urunlerGoruntuAdet","urunlerAramaAdet","urunlerKategoriAdet","ArayuzUrunlerGoruntuAdet","uyeYorumAdet","bultenGoruntuAdet","apikey","guvkey","smsbaslik","mail_host","mail_adres","mail_sifre","mail_port"],
	[	
	"input7" =>"sayfatitle",
	"input8" =>"sayfaaciklama",
	"input9" =>"anahtarkelime",	
	"input10" =>"uyeSayfaGorAdet",	
	"input11" =>"uyeAramaAdet",
	"input12" =>"urunlerSayfaGorAdet",	
	"input13" =>"urunlerAramaAdet",
	"input14" =>"urunlerKategoriAdet",
	"input15" =>"SiteUrunlerAdet",
	"input16" =>"uyeYorumAdet",
	"input17" =>"bultenadet",
	"input18" =>"apikey",
	"input19" =>"guvkey",
	"input20" =>"smsbaslik",
	"input21" =>"mailhost",
	"input22" =>"mailadres",
	"input23" =>"mailsifre",
	"input24" =>"mailport"],	
	"kayitid",
	"id=",
	"sistemayar",	
	"ayarlar",	
	["BAŞARILI","AYARLAR GÜNCELLENDİ","success"],
	["BAŞARISIZ","AYAR GÜNCELLEME SIRASINDA HATA OLUŞTU.","warning"],"ADMİN");			
	
		
	}  // SİSTEM AYARLARI GÜNCELLEME SON	
	
//----------------------------------------------
	
function sistembakim () {
		
	Router::SayfaYukleme("ADMİN","sistembakimYonetim","bakim",false,
	[["sistembakim","true"]]);	
		
	} // SİSTEM BAKIM
	
function bakimyap () {	
		
			$this->yetkikontrol->YetkisineBak("sistembakimYonetim");		
			if ($_POST["sistembtn"]) :	
			$bakim=Router::$model->bakim(DB_NAME);	
	
			if ($bakim): 
	
			$this->view->goster("YonPanel/sayfalar/bakim",
			array(
				"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/sistembakim","BAŞARILI","SİSTEM BAKIMI BAŞARIYLA YAPILDI","success")
			 ));
				
			else:
		
			$this->view->goster("YonPanel/sayfalar/bakim",
			array(
				"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/sistembakim","BAŞARISIZ","BAKIM SIRASINDA HATA OLUŞTU","warning")
			
			 ));	
		
			endif;
				
		else:
	    $this->Bilgi->direktYonlen("/panel/sistembakim");	
		endif;	
		
	}  // SİSTEM BAKIM SONUÇ
	
function veritabaniyedek () {
				
	Router::SayfaYukleme("ADMİN","sistembakimYonetim","yedek",false,
	[["veritabaniyedek","true"]]);
		
	} // VERİTABANI YEDEK
	
function dbyedekal($deger) {
	
	$this->Dosyacikti->veritabaniyedekindir($deger);
	
	}
	
function yedekal () {	
		 
			$this->yetkikontrol->YetkisineBak("sistembakimYonetim");		
	
			if ($_POST["sistembtn"]) :			
			$yedek=Router::$model->yedek(DB_NAME);	
			
			$yedektercih=$this->Form->radiobutonget("yedektercih");
			
			if ($yedek[0]): 
			
			
					if ($yedektercih=="local"):				
			

					$olustur=fopen(YEDEKYOL.date("d.m.Y").".sql","w+");
					fwrite($olustur,$yedek[1]);
					fclose($olustur);

					$this->view->goster("YonPanel/sayfalar/yedek",
					array(
						"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/veritabaniyedek","BAŞARILI","VERİTABANI YEDEĞİ BAŞARIYLA ALINDI","success")
					 ));
				
					else:

					$this->dbyedekal($yedek[1]);

					endif;			
			
			
			
			
			
			else:

				$this->view->goster("YonPanel/sayfalar/yedek",
				array(
					"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/veritabaniyedek","BAŞARISIZ","YEDEK SIRASINDA HATA OLUŞTU","warning")

				 ));
			
			
			
			endif;	
			
			
				
		else:
	    $this->Bilgi->direktYonlen("/panel/veritabaniyedek");	
		endif;	
		
	}  // VERİTABANI YEDEK SONUÇ
	
//----------------------------------------------
	
function cikis() {
			
			Session::destroy();			
			$this->Bilgi->direktYonlen("/panel/giris");
		
	} // ÇIKIŞ	
	
function sifredegistir() {	
		
	Router::SayfaYukleme("ADMİN","yoneticiYonetim","sifreislemleri",false,
	[["sifredegistir",Session::get("Adminid")]]);
		
	} // ŞİFRE DEĞİŞTİRME FormU
	
 function sifreguncelleson() {		

	if ($_POST) :		
		
	 $mevcutsifre=$this->Form->get("mevcutsifre")->bosmu();
	 $yen1=$this->Form->get("yen1")->bosmu();
	 $yen2=$this->Form->get("yen2")->bosmu();	 
	 $yonid=$this->Form->get("yonid")->bosmu();	 
	 $sifre=$this->Form->SifreTekrar($yen1,$yen2); 	
	$mevcutsifre=$this->Form->sifrele($mevcutsifre);
	
	if (!empty($this->Form->error)) :
	$this->view->goster("YonPanel/sayfalar/sifreislemleri",
	array(
	"sifredegistir" => Session::get("Adminid"),
	"Bilgi" => $this->Bilgi->uyari("danger","Girilen Bilgiler hatalıdır.")
	 ));
	
	else:	
	
		
	$sonuc2=Router::$model->GirisKontrol("yonetim","ad='".Session::get("AdminAd")."' and sifre='$mevcutsifre'");
	
		if ($sonuc2): 
		
				$sonuc=Router::$model->Guncelle("yonetim",
				array("sifre"),
				array($sifre),"id=".$yonid);
			
				if ($sonuc): 			
			
				$this->view->goster("YonPanel/sayfalar/sifreislemleri",
				array(
				
		"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/siparisler","BAŞARILI","ŞİFRE DEĞİŞTİRME BAŞARILI","success")			

			 	));					
						
				else:
				
				$this->view->goster("YonPanel/sayfalar/sifreislemleri",
				array(
				"sifredegistir" => Session::get("Adminid"),
				"Bilgi" => $this->Bilgi->uyari("danger","Şifre değiştirme sırasında hata oluştu.")
				));	
				
				endif;
			
		else:			
			$this->view->goster("YonPanel/sayfalar/sifreislemleri",
	array(
	"sifredegistir" => Session::get("Adminid"),
	"Bilgi" => $this->Bilgi->uyari("danger","Mevcut şifre hatalıdır.")
	 ));
					
		
		endif;
	
	endif;
	
	
	else:	
	
	$this->Bilgi->direktYonlen("/");
	endif;
	
		
	}  // YÖNETİCİ ŞİFRESİNİ GÜNCELLİYOR.
	
//----------------------------------------------
	
function yonetici () {			
	Router::SayfaYukleme("ADMİN","yoneticiYonetim","yonetici","Verial",[		
	["data","yonetim","false"]
	]);	
		
	} // YÖNETİCİLER GELİYOR

function yonSil($id) {

    Router::Sil("ADMİN","yoneticiYonetim","yonetici","yonetici",
		["yonetim","id=".$id], 
		["BAŞARILI","YÖNETİCİ SİLME BAŞARILI","success"],
		["BAŞARISIZ","YÖNETİCİ SİLME SIRASINDA HATA OLUŞTU.","warning"]);		
		
	}  // YÖNETİCİ SİL	
	
function yonekle($islem) {	
			$this->yetkikontrol->YetkisineBak("yoneticiYonetim");			
		if ($islem=="ilk") :				
			$this->view->goster("YonPanel/sayfalar/yonetici",array(	
			"yoneticiekle" => true		
			));				
		elseif ($islem=="son") :		
		if ($_POST) :		
	 $yonadi=$this->Form->get("yonadi")->bosmu();	 
	 $sif1=$this->Form->get("sif1")->bosmu();
	 $sif2=$this->Form->get("sif2")->bosmu();	
	 $sifre=$this->Form->SifreTekrar($sif1,$sif2); 	 
	$siparisYonetim=$this->Form->Checkboxget("siparisYonetim");
	$kategoriYonetim=$this->Form->Checkboxget("kategoriYonetim");	
	$uyeYonetim=$this->Form->Checkboxget("uyeYonetim");	
	$urunYonetim=$this->Form->Checkboxget("urunYonetim");	
	$muhasebeYonetim=$this->Form->Checkboxget("muhasebeYonetim");	
	$yoneticiYonetim=$this->Form->Checkboxget("yoneticiYonetim");	
	$bultenYonetim=$this->Form->Checkboxget("bultenYonetim");	
	$sistemayarYonetim=$this->Form->Checkboxget("sistemayarYonetim");	
	$sistembakimYonetim=$this->Form->Checkboxget("sistembakimYonetim");	
	$yetki=$this->Form->Selectboxget("yetki");	
	if (!empty($this->Form->error)) :
	$this->view->goster("YonPanel/sayfalar/yonetici",
	array(	
		"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/yonetici","BAŞARISIZ","Girilen Bilgiler hatalıdır","warning")	
	 ));	
	else:
		
				$sonuc=Router::$model->Ekleme("yonetim",
				array("ad","sifre","yetki","siparisYonetim","kategoriYonetim","uyeYonetim","urunYonetim","muhasebeYonetim","yoneticiYonetim","bultenYonetim","sistemayarYonetim","sistembakimYonetim"),
				array($yonadi,$sifre,$yetki,$siparisYonetim,$kategoriYonetim,$uyeYonetim,$urunYonetim,$muhasebeYonetim,$yoneticiYonetim,$bultenYonetim,$sistemayarYonetim,$sistembakimYonetim));
			
				if ($sonuc): 			
			
				$this->view->goster("YonPanel/sayfalar/yonetici",
				array(				
		"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/yonetici","BAŞARILI","Yeni yönetici eklendi","success")				
				));					
						
				else:
				
				$this->view->goster("YonPanel/sayfalar/yonetici",
				array(	
					"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/yonetici","BAŞARISIZ","Ekleme sırasında hata oluştu","warning")		
			
				));	
				
				endif;
	
	endif;	
	
	else:		
	$this->Bilgi->direktYonlen("/");
	endif;	
		
		endif;	
		
	} // YÖNETİCİ EKLEME
	
function yonguncelle($islem,$yonid=false) {	

	Router::Guncelle(
	[$islem,"ADMİN","yoneticiYonetim","yonetici","Verial",
	[["YoneticiGuncelle","yonetim","where id=".$yonid]]
	],	["ad","yetki","siparisYonetim","kategoriYonetim","uyeYonetim","urunYonetim","muhasebeYonetim","yoneticiYonetim","bultenYonetim","sistemayarYonetim","sistembakimYonetim"],
	[
	"input1" =>"yonadi",
	"select1" => "yetki",
	"check1" =>"siparisYonetim",
	"check2" =>"kategoriYonetim",
	"check3" =>"uyeYonetim",
	"check4" =>"urunYonetim",
	"check5" =>"muhasebeYonetim",
	"check6" =>"yoneticiYonetim",
	"check7" =>"bultenYonetim",
	"check8" =>"sistemayarYonetim",
	"check9" =>"sistembakimYonetim"],
	"yonid",
	"id=",
	"yonetici",	
	"yonetim",	
	["BAŞARILI","YÖNETİCİ GÜNCELLEME BAŞARILI","success"],
	["BAŞARISIZ","YÖNETİCİ GÜNCELLEME SIRASINDA HATA OLUŞTU.","warning"]	
	);	

	} // YÖNETİCİ GÜNCELLE
	
//----------------------------------------------
	
function bankabilgileri () {	
		
	Router::SayfaYukleme("ADMİN","muhasebeYonetim","bankabilgileri","Verial",[		
	["data","bankabilgileri","false"]
	]);	
	} // BANKA BİLGİLERİ GELİYOR		
	
function bankaGuncelle($islem,$id=false) {	

	Router::Guncelle(
	[$islem,"ADMİN","muhasebeYonetim","bankabilgileri","Verial",
	[["BankaGuncelle","bankabilgileri","where id=".$id]]],
	["banka_ad","hesap_ad","hesap_no","iban_no"],
	["input1" =>"banka_ad",
	"input2" => "hesap_ad",
	"input3" =>"hesap_no",
	"input4" =>"iban_no"],
	"bankaid",
	"id=",
	"bankabilgileri",	
	"bankabilgileri",	
	["BAŞARILI","BANKA BİLGİLERİNİ GÜNCELLEME BAŞARILI","success"],
	["BAŞARISIZ","BANKA BİLGİLERİNİ GÜNCELLEME SIRASINDA HATA OLUŞTU.","warning"]	
	);	

		
	} // BANKA BİLGİLERİ GÜNCELLE	
		
function bankaSil($id) {

		Router::Sil("ADMİN","muhasebeYonetim","bankabilgileri","bankabilgileri",
		["bankabilgileri","id=".$id], 
		["BAŞARILI","BANKA SİLME BAŞARILI","success"],
		["BAŞARISIZ","BANKA SİLME SIRASINDA HATA OLUŞTU.","warning"]);			
		
	}  // BANKA BİLGİLERİ SİL	
	
function bankaEkle($islem) {	

  Router::Ekle(
	[$islem,"ADMİN","muhasebeYonetim","bankabilgileri",false,
	[["BankaEkle","true"]]],
	["banka_ad","hesap_ad","hesap_no","iban_no"],
	["input1" =>"banka_ad",
	"input2" => "hesap_ad",
	"input3" =>"hesap_no",
	"input4" =>"iban_no"],	
	"bankabilgileri",	
	"bankabilgileri",	
	["BAŞARILI","YENİ BANKA BİLGİSİ EKLENDİ","success"],
	["BAŞARISIZ","BANKA EKLEME SIRASINDA HATA OLUŞTU.","warning"]	
	);	
		
	}  // BANKA BİLGİSİ EKLE
//----------------------------------------------
	
function smsislemleri () {		
	
	Router::SayfaYukleme("ADMİN","sistemayarYonetim","smsislemleri","Verial",[		
	["gruplar","pazarlama_gruplar","false"],
	["sablonlar","pazarlama_sms_sablonlar","false"]
	]);	
	}
	
function smsgonderme () {
	
		if ($_POST) :
		
		$numaralar=$this->Form->get("numaralar")->bosmu();
		$metin=$this->Form->get("metin")->bosmu();
		
		$dizi=explode("\r",$numaralar);
		/*
		Önce gelen numaraları bölüyorum.
		Tanımsız olan boşluk içeren dizi değerini kaybediyorum
		Kullanılabilir değer haline getiriyorum	
		*/
		if (count($dizi)>1) :
		
				if (in_array(null,$dizi) || in_array('',array_map('trim',$dizi))):
				array_pop($dizi);
				endif;
				
		endif;
		
		foreach ($dizi as $telno):
		
		$this->Sms->smsgonder($metin,$telno);		
	
		
		endforeach;
		
		$this->yetkikontrol->YetkisineBak("sistemayarYonetim");	
		$this->view->goster("YonPanel/sayfalar/smsislemleri",array(				
		"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/smsislemleri","BAŞARILI","Smsler Başarıyla gönderildi","success")				
				));		
	
		else:		
			$this->Bilgi->direktYonlen("/panel/smsislemleri");
		endif;
	
	
	}	
	
function mailislemleri () {				
	Router::SayfaYukleme("ADMİN","sistemayarYonetim","mailislemleri","Verial",[		
	["gruplar","pazarlama_mail_gruplar","false"],
	["sablonlar","pazarlama_mail_sablonlar","false"]
	]);	
	}
	
function mailgonderme () {
	
		if ($_POST) :
		
		$numaralar=$this->Form->get("numaralar")->bosmu();
		$metin=$this->Form->get("metin")->bosmu();
		$baslik=$this->Form->get("baslik")->bosmu();
		
		$dizi=explode("\r",$numaralar);
		/*
		Önce gelen numaraları bölüyorum.
		Tanımsız olan boşluk içeren dizi değerini kaybediyorum
		Kullanılabilir değer haline getiriyorum	
		*/
		if (count($dizi)>1) :
		
				if (in_array(null,$dizi) || in_array('',array_map('trim',$dizi))):
				array_pop($dizi);
				endif;
				
		endif;
		
		
		
		$this->Mailislem->mailgonder($dizi,$baslik,$metin);		
				
		$this->yetkikontrol->YetkisineBak("sistemayarYonetim");	
		
		$this->view->goster("YonPanel/sayfalar/mailislemleri",array(				
		"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/mailislemleri","BAŞARILI","Mailler Başarıyla gönderildi","success")				
				));		
	
		else:		
			$this->Bilgi->direktYonlen("/panel/mailislemleri");
		endif;
	
	
	}	
//----------------------------------------------
function slideryonetimi() {		
	Router::SayfaYukleme("ADMİN","yoneticiYonetim","slider","Verial",[		
	["sliderVerileri","slider","false"]
	]);	
	} // SLİDER YONETİMİ	
	
function SliderBabaFonksiyon($islem,$id=false) {
$this->yetkikontrol->YetkisineBak("yoneticiYonetim");	

			switch ($islem) :

			case "silme":
			
					if (isset($id)) :
						$sonuc=Router::$model->Sil("slider","id=".$id);	
							if ($sonuc): 	
						$this->view->goster("YonPanel/sayfalar/slider",
						array(
						"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/slideryonetimi","BAŞARILI","SİLME BAŞARILI","success")
						 ));				
					else:		
						$this->view->goster("YonPanel/sayfalar/slider",
						array(
						"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/slideryonetimi","BAŞARISIZ","SİLME SIRASINDA HATA OLUŞTU","warning")
						 ));		
					endif;

						else:
						
						$this->view->goster("YonPanel/sayfalar/slideryonetimi",
						array(
						"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/slideryonetimi","İD YOK","İD BİLGİSİ VERİLMELİDİR","warning")
						 ));

					endif;
						
			break;
			
			case "guncellemeilk":
			
						if (isset($id)) :
						
					$this->view->goster("YonPanel/sayfalar/slider",array(	
					"sliderGuncelle" => Router::$model->Verial("slider","where id=".$id)	
					));	
					else:
					
						$this->view->goster("YonPanel/sayfalar/slideryonetimi",
						array(
						"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/slideryonetimi","İD YOK","İD BİLGİSİ VERİLMELİDİR","warning")
						 ));
					
						endif;
				
			break;			
			
			case "guncellemeson":
			
			if ($_POST) :	
			
				$sloganAlt=$this->Form->get("sloganAlt")->bosmu();
				$sloganUst=$this->Form->get("sloganUst")->bosmu();			
				$sliderid=$this->Form->get("sliderid")->bosmu();		
				
if ($this->Upload->uploadPostAl("resim")) : $this->Upload->UploadDosyaKontrol("resim");	endif;	


				
			if (!empty($this->Form->error)) :
				
			$this->view->goster("YonPanel/sayfalar/slider",
			array(
			"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/slideryonetimi","BAŞARISIZ","Tüm alanlar doldurulmalıdır.","warning")		
			 ));
			 
			elseif (!empty($this->Upload->error)) :				
			$this->view->goster("YonPanel/sayfalar/slider",
			array(		
			"Bilgi" => $this->Upload->error,
			"yonlen" =>$this->Bilgi->sureliYonlen(3,"/panel/slideryonetimi") 
			 ));
				
			else:
			$sutunlar=array("sloganAlt","sloganUst");		
			$veriler=array($sloganAlt,$sloganUst);
			
					 if ($this->Upload->uploadPostAl("resim")) :
						$sutunlar[]="resim"; 
						$veriler[]=$this->Upload->Yukle("resim",true,"slider"); 
					 endif;	

	
				$sonuc=Router::$model->Guncelle("slider",$sutunlar,$veriler,"id=".$sliderid);	
				if ($sonuc): 	
					$this->view->goster("YonPanel/sayfalar/slider",
					array(
					"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/slideryonetimi","BAŞARILI","SLİDER BAŞARIYLA GÜNCELLENDİ","success")	
					 ));				
				else:		
					$this->view->goster("YonPanel/sayfalar/slider",
					array(
					"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/slideryonetimi","BAŞARISIZ","GÜNCELLEME SIRASINDA HATA OLUŞTU","warning")			
					 ));			
				endif;	
		
			endif;		
				
			else:
			$this->Bilgi->direktYonlen("/panel/slideryonetimi");	
			
			endif;	
				
			break;
			
			case "eklemeilk":
									
					$this->view->goster("YonPanel/sayfalar/slider",
					array("sliderEkleme" => true));	
					
			break;
			
			case "eklemeSon":
			
			if ($_POST) :				
			
				$sloganAlt=$this->Form->get("sloganAlt")->bosmu();
				$sloganUst=$this->Form->get("sloganUst")->bosmu();		
				
if ($this->Upload->uploadPostAl("resim")) : $this->Upload->UploadDosyaKontrol("resim");	endif;	
				
				if (!empty($this->Form->error)) :
				
					$this->view->goster("YonPanel/sayfalar/slider",
					array(	
					"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/slideryonetimi","BAŞARISIZ","Tüm alanlar doldurulmalıdır","warning")		
					 ));	
			 
			 elseif (!empty($this->Upload->error)) :
				
					$this->view->goster("YonPanel/sayfalar/slider",
					array(		
					"Bilgi" => $this->Upload->error
					 ));	
				
			else:	
				
				$sutunlar=array("sloganAlt","sloganUst");		
				$veriler=array($sloganAlt,$sloganUst);
				
				 if ($this->Upload->uploadPostAl("resim")) :
				 		$sutunlar[]="resim"; 
						$veriler[]=$this->Upload->Yukle("resim",true,"slider"); 
					 endif;	
		
			
		$sonuc=Router::$model->Ekleme("slider",$sutunlar,$veriler);
				
		
	
		if ($sonuc): 
	
			$this->view->goster("YonPanel/sayfalar/slider",
			array(
				"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/slideryonetimi","BAŞARILI","SLİDER BAŞARIYLA EKLENDİ","success")			
			 ));
				
		else:
		
			$this->view->goster("YonPanel/sayfalar/slider",
			array(
				"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/slideryonetimi","BAŞARISIZ","EKLEME SIRASINDA HATA OLUŞTU","warning")			
			 ));	
		
		endif;	
		
		endif;
						
			else:
			$this->Bilgi->direktYonlen("/panel/slideryonetimi");				
	
	endif;	
			
			break;

			endswitch;

}	

function renkyonetimi() {	
	Router::SayfaYukleme("ADMİN","yoneticiYonetim","renkyonetimi","Verial",[		
	["renkdegistir","renkyonetimi","false"]	]);	
	} // RENK YÖNETİMİ
	
function renkyonetimison() {		

	$this->yetkikontrol->YetkisineBak("yoneticiYonetim");		
		
		
	Router::Guncelle(null,	
	["header","sepetiniz","kategoriic","sepeteeklebuton"],
	[	
	"input1" =>"header",
	"input2" =>"sepetiniz",
	"input3" =>"kategoriic",	
	"input4" =>"sepeteeklebuton"	
	],	
	"kayitid",
	"id=",
	"renkyonetimi",	
	"renkyonetimi",	
	["BAŞARILI","RENKLER GÜNCELLENDİ","success"],
	["BAŞARISIZ","RENKLERİ GÜNCELLEME SIRASINDA HATA OLUŞTU.","warning"],"ADMİN");	
		
		
	}  // RENK YÖNETİMİ GÜNCELLİYOR.

function muhaseberapor() {	
	$this->yetkikontrol->YetkisineBak("siparisYonetim");			

		if ($_POST) :	
	
	
		$odemeturu=$this->Form->get("odemeturu",true);	
		$durum=$this->Form->get("durum",true);			
		$tarih1=$this->Form->get("tarih1",true);		
		$tarih2=$this->Form->get("tarih2",true);	
		
		
			
			if (!empty($this->Form->error)) :
			$this->view->goster("YonPanel/sayfalar/muhaseberapor",
				array(	
				"Bilgi" => $this->Bilgi->SweetAlert(URL."/panel/muhaseberapor","BAŞARISIZ","Boş alan olmamalıdır","warning")					
				 ));					
				else:	
			$this->aramadegeri.="<strong>Ödeme Türü :</strong> ".$odemeturu;
				switch ($durum):				
				case "0";
				$this->aramadegeri.="<strong> Sipariş Durumu :</strong> İşlemde";
				break;
				case "1";
				$this->aramadegeri.="<strong> Sipariş Durumu :</strong> Tamamlanmış";
				break;
				case "2";
				$this->aramadegeri.="<strong> Sipariş Durumu :</strong> İade";
				break;
				case "3";
				$this->aramadegeri.="<strong> Sipariş Durumu :</strong> İade Onaylanmış";
				break;
				endswitch;			
			$this->aramadegeri.="<strong> Başlangıç Tarihi :</strong> ".$tarih1;
			$this->aramadegeri.="<strong> Bitiş Tarihi :</strong> ".$tarih2;




			$sorgumuz=Router::$model->arama("siparisler",					
			"odemeturu LIKE '%".$odemeturu."%' and
			durum LIKE '%".$durum."%'  and	DATE(tarih) BETWEEN  '".$tarih1."' and '".$tarih2."'");

				if ($sorgumuz) :
							$this->view->goster("YonPanel/sayfalar/muhaseberapor",array(			
							"data" => $sorgumuz,
							"aramakriter" => $this->aramadegeri
							));	
							
				else:
				
						$this->view->goster("YonPanel/sayfalar/muhaseberapor",array(	
						"Hata" => true
						));	
				
				endif;
		


			endif;
		
	
			
		else:
			$this->view->goster("YonPanel/sayfalar/muhaseberapor",array(	
			"varsayilan" => true
			));			
		endif;
	} // MUHASEBE RAPOR ARAMA		
	
function muhasebeExcelAl () {
	
	$this->yetkikontrol->YetkisineBak("siparisYonetim");
	
	$idler=Session::get("idler");
	Router::$model->ExcelAyarCek2("urunad,urunadet,urunfiyat,toplamfiyat,odemeturu from siparisler where id IN(".$idler.")");
	
	$this->Dosyacikti->Excelaktar("MUHASEBE RAPORLAR",NULL,
	array(	
	"Ürün ad",
	"Ürün adet",
	"Ürün fiyat",
	"Toplam Fiyat",	
	"Ödeme Türü"	
	),Router::$model->icerikler[0]);
	
	} // SİPARİŞ EXCEL ÇIKTI	
}




?>