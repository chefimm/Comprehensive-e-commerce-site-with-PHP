<?php

class Router extends Controller {
   public static $yetkikontrol, $view, $Form, $Bilgi,$Pagination;
   public static $model;


   public static function İnit() {
      /*parent::KutuphaneYukle(array("view","Form","Bilgi","Upload","Pagination","Dosyacikti","Dosyaİslemleri","Sms","Mailislem"));	*/

      self::$yetkikontrol = new PanelHarici();
      self::$view = new view();
			self::$Bilgi = new Bilgi();
			self::$Form = new Form();
			self::$Pagination = new Pagination();
			
			$yol='model/adminpanel_model.php';
			require $yol;
			$modelsinifName='adminpanel_model';
					
      self::$model = new $modelsinifName();
			
   }


   public static function SayfaYukleme(
      $bolum,
      $yetkituru = false,
      $gidilecekDosyaYolu,
      $ModelFonksiyonAdi = false,
      array $sorgu = null ) {


						switch ( $bolum ):

						case "ADMİN":
							 $gidilecekDosyaYolu = ADMİNDOSYAYOLU . $gidilecekDosyaYolu;
							 break;

						case "ARAYUZ":
							 $gidilecekDosyaYolu = ARAYUZDOSYAYOLU . $gidilecekDosyaYolu;
							 break;

						 endswitch;
			 
			 

         $kullanat = array();
				 
         for ( $i = 0; $i < count( $sorgu ); $i++ ):
				 
				 			if(count($sorgu[$i])<3)  :
							
							
							
										if ($ModelFonksiyonAdi && $ModelFonksiyonAdi=="SpesifikVerial"):
		 					
										$kullanat[$sorgu[$i][0]]=self::$model->$ModelFonksiyonAdi($sorgu[$i][1]);
		 						
										else:

										$kullanat[$sorgu[$i][0]]=$sorgu[$i][1];

										endif;
							
							
							else:
							
							$kullanat[$sorgu[$i][0]]=self::$model->$ModelFonksiyonAdi($sorgu[$i][1],($sorgu[$i][2] == "false" ) ? false : $sorgu[$i][2]);
							
							endif;
            
         endfor;


         self::$yetkikontrol->YetkisineBak( $yetkituru );

         self::$view->goster( $gidilecekDosyaYolu, $kullanat );

   }

   public static function SayfaYuklemePagi(
	    $islemTipi,
      $bolum,
      $yetkituru = false,
      $gidilecekDosyaYolu,      
      $islemTabloAdi,
			$mevcutSayfa=false,
			$AyarAdimiz,
			array $istenilensutunlar=null,
			array $tabloadlari=null,
			$kosul=null
			
			) {


						switch ( $bolum ):

						case "ADMİN":
							 $gidilecekDosyaYolu = ADMİNDOSYAYOLU . $gidilecekDosyaYolu;
							 break;

						case "ARAYUZ":
							 $gidilecekDosyaYolu = ARAYUZDOSYAYOLU . $gidilecekDosyaYolu;
							 break;

						 endswitch;
						 
						 
						 
	 self::$yetkikontrol->YetkisineBak( $yetkituru );		
	 
			switch($islemTipi) :

							case "Uyeler":
											self::$Pagination->paginationOlustur(self::$model->sayfalama($islemTabloAdi),$mevcutSayfa,
											self::$model->tekliveri($AyarAdimiz," from ayarlar"));		

											self::$view->goster( $gidilecekDosyaYolu, array(		
												"data" => self::$model->joinislemi($istenilensutunlar,$tabloadlari,
												$kosul.self::$Pagination->limit.",".self::$Pagination->gosterilecekadet	),		
												"toplamsayfa" =>self::$Pagination->toplamsayfa,
												"toplamveri" => self::$model->sayfalama($islemTabloAdi)		
												) );	

							break;
							case "Urunler":
							
		 									self::$Pagination->paginationOlustur(self::$model->sayfalama($islemTabloAdi),$mevcutSayfa,
											self::$model->tekliveri($AyarAdimiz," from ayarlar"));		
							
											self::$view->goster($gidilecekDosyaYolu,array(		
													"data" => self::$model->Verial($islemTabloAdi," LIMIT ".self::$Pagination->limit.",".self::$Pagination->gosterilecekadet),		
													"toplamsayfa" => self::$Pagination->toplamsayfa,
													"toplamveri" => self::$model->sayfalama($islemTabloAdi),
													"data2" => self::$model->Verial("ana_kategori",false)		
													));
							break;
							
								case "Bulten":
							
		 									self::$Pagination->paginationOlustur(self::$model->sayfalama($islemTabloAdi),$mevcutSayfa,
											self::$model->tekliveri($AyarAdimiz," from ayarlar"));							
											self::$view->goster($gidilecekDosyaYolu,array(		
													"data" => self::$model->Verial($islemTabloAdi," LIMIT ".self::$Pagination->limit.",".self::$Pagination->gosterilecekadet),		
													"toplamsayfa" => self::$Pagination->toplamsayfa,
													"toplamveri" => self::$model->sayfalama($islemTabloAdi)
													));
							break;
						

			endswitch;
	
 


   }


		public static function Sil(
		$bolum,
		$yetkituru,
		$gidilecekDosyaYolu,
		$gidilecekUrl,
		array $sorgu,
		array $OlumluBilgiVerileri,
		array $OlumsuzBilgiVerileri) {
		
		
			     switch ( $bolum ):

						case "ADMİN":
							 $gidilecekDosyaYolu = ADMİNDOSYAYOLU . $gidilecekDosyaYolu;
							 break;

						case "ARAYUZ":
							 $gidilecekDosyaYolu = ARAYUZDOSYAYOLU . $gidilecekDosyaYolu;
							 break;

						 endswitch;
						 
						 
						 
				 self::$yetkikontrol->YetkisineBak( $yetkituru );
				 
				 		
				 
		if (self::$model->Sil($sorgu[0],$sorgu[1])): 		
									
					 self::$view->goster($gidilecekDosyaYolu,
					 								["Bilgi" =>[
															"adres" => URL."/panel/".$gidilecekUrl,
															"baslik" => $OlumluBilgiVerileri[0],
															"metin" => $OlumluBilgiVerileri[1],
															"durum" => $OlumluBilgiVerileri[2]
															]	] );
				
		else:		
					
					 self::$view->goster($gidilecekDosyaYolu,
					 								["Bilgi" =>[
															"adres" => URL."/panel/".$gidilecekUrl,
															"baslik" => $OlumsuzBilgiVerileri[0],
															"metin" => $OlumsuzBilgiVerileri[1],
															"durum" => $OlumsuzBilgiVerileri[2]
															]	] );
		
		endif;

		
		
	

		}
		
		public static function Guncelle(
		array $TeknikVeriler=null,			
		array $SutunAdlari,		
		array $FormVerileri,
		$kriterVerisi,
		$Kosul,
		$gidilecekUrl,		
		$Tabload,	
		array $OlumluBilgiVerileri,
		array $OlumsuzBilgiVerileri,
		$bolum=false) {
		
		
		if (isset($TeknikVeriler[1])) :
		
			    switch ( $TeknikVeriler[1] ):

							case "ADMİN":
								 $gidilecekDosyaYolu = ADMİNDOSYAYOLU . $TeknikVeriler[3];
								 break;

							case "ARAYUZ":
								 $gidilecekDosyaYolu = ARAYUZDOSYAYOLU . $TeknikVeriler[3];
								 break;

						 endswitch;
			else:
			
			 switch ( $bolum ):

							case "ADMİN":
								 $gidilecekDosyaYolu = ADMİNDOSYAYOLU . $gidilecekUrl;
								 break;

							case "ARAYUZ":
								 $gidilecekDosyaYolu = ARAYUZDOSYAYOLU . $gidilecekUrl;
								 
								 
								 break;

						 endswitch;
		
		endif;
		
	
		
		
		
			if($TeknikVeriler[0]=="ilk"):
						self::SayfaYukleme($TeknikVeriler[1],$TeknikVeriler[2],$TeknikVeriler[3],$TeknikVeriler[4],							
						$TeknikVeriler[5]);	
				
			else:
			
			if ($_POST) :	
						$SutunVerileri=array();

						foreach ($FormVerileri as $anahtar => $deger):
									
									
									if(strstr($anahtar,"input")) :
											$SutunVerileri[]=self::$Form->get($deger)->bosmu();
									elseif (strstr($anahtar,"select")):
									    $SutunVerileri[]=self::$Form->Selectboxget($deger);	
									elseif (strstr($anahtar,"check")):
									    $SutunVerileri[]=self::$Form->Checkboxget($deger);	
									elseif (strstr($anahtar,"radio")):
							 	    	$SutunVerileri[]=self::$Form->radiobutonget($deger);	
									endif;

						endforeach;

				
					$kriterVerisi=self::$Form->get($kriterVerisi)->bosmu();		
					
					$TamKosul=$Kosul.$kriterVerisi;				
					
					if (!empty(self::$Form->error)) :
					
					
										self::$view->goster($gidilecekDosyaYolu,
									["Bilgi" =>[
											"adres" => URL."/panel/".$gidilecekUrl,
											"baslik" => "BAŞARISIZ",
											"metin" => "Tüm alanlar doldurulmalıdır.",
											"durum" => "warning"
											]	] );			
					
				else:		
				if (self::$model->Guncelle($Tabload,
								  $SutunAdlari,
				        	$SutunVerileri,$TamKosul)): 

																			 self::$view->goster($gidilecekDosyaYolu,
																												["Bilgi" =>[
																														"adres" => URL."/panel/".$gidilecekUrl,
																														"baslik" => $OlumluBilgiVerileri[0],
																														"metin" => $OlumluBilgiVerileri[1],
																														"durum" => $OlumluBilgiVerileri[2]
																														]	] );

																else:		
																				self::$view->goster($gidilecekDosyaYolu,
																														["Bilgi" =>[
																																"adres" => URL."/panel/".$gidilecekUrl,
																																"baslik" => $OlumsuzBilgiVerileri[0],
																																"metin" => $OlumsuzBilgiVerileri[1],
																																"durum" => $OlumsuzBilgiVerileri[2]
																																]	] );

																endif;
				endif;					

			else:			
			
			self::$Bilgi->direktYonlen(URL."/panel/".$gidilecekUrl);
	
			endif;				
				
				
endif;
		
		
		
		}
		
		
		public static function KategoriGuncelle(
		array $TeknikVeriler=null,				
		array $FormVerileri,
		$kriterVerisi,
		$Kosul,
		$gidilecekUrl,		
		array $OlumluBilgiVerileri,
		array $OlumsuzBilgiVerileri
		) {
		
		
		if (isset($TeknikVeriler[1])) :
		
			    switch ( $TeknikVeriler[1] ):

							case "ADMİN":
								 $gidilecekDosyaYolu = ADMİNDOSYAYOLU . $TeknikVeriler[3];
								 break;

							case "ARAYUZ":
								 $gidilecekDosyaYolu = ARAYUZDOSYAYOLU . $TeknikVeriler[3];
								 break;

						 endswitch;
			else:
			
			 switch ( $bolum ):

							case "ADMİN":
								 $gidilecekDosyaYolu = ADMİNDOSYAYOLU . $gidilecekUrl;
								 break;

							case "ARAYUZ":
								 $gidilecekDosyaYolu = ARAYUZDOSYAYOLU . $gidilecekUrl;
								 
								 
								 break;

						 endswitch;
		
		endif;
				
		
		
			if($TeknikVeriler[0]=="ilk"):
						self::SayfaYukleme($TeknikVeriler[1],$TeknikVeriler[2],$TeknikVeriler[3],$TeknikVeriler[4],							
						$TeknikVeriler[5]);	
				
			else:
			
			if ($_POST) :	
						$SutunVerileri=array();

						foreach ($FormVerileri as $anahtar => $deger):
									
									
									if(strstr($anahtar,"input")) :
											$SutunVerileri[]=self::$Form->get($deger)->bosmu();
									elseif (strstr($anahtar,"select")):
									    $SutunVerileri[]=self::$Form->Selectboxget($deger);	
									elseif (strstr($anahtar,"check")):
									    $SutunVerileri[]=self::$Form->Checkboxget($deger);	
									elseif (strstr($anahtar,"radio")):
							 	    	$SutunVerileri[]=self::$Form->radiobutonget($deger);	
									endif;

						endforeach;

				
					$kriterVerisi=self::$Form->get($kriterVerisi)->bosmu();		
					
					$TamKosul=$Kosul.$kriterVerisi;				
					
					if (!empty(self::$Form->error)) :
					
					
										self::$view->goster($gidilecekDosyaYolu,
									["Bilgi" =>[
											"adres" => URL."/panel/".$gidilecekUrl,
											"baslik" => "BAŞARISIZ",
											"metin" => "Tüm alanlar doldurulmalıdır.",
											"durum" => "warning"
											]	] );			
					
				else:		
				
				
					
		if ($SutunVerileri[0]=="ana") :
		
		$sonuc=self::$model->Guncelle("ana_kategori",
		array("ad"),
		array($SutunVerileri[1]),$TamKosul);
				
		elseif($SutunVerileri[0]=="cocuk") :
		
		
		$sonuc=self::$model->Guncelle("cocuk_kategori",
		array("ana_kat_id","ad"),
		array($SutunVerileri[2],$SutunVerileri[1]),$TamKosul);
		
	
			
		elseif($SutunVerileri[0]=="alt") :
		
		$sonuc=self::$model->Guncelle("alt_kategori",
		array("cocuk_kat_id","ana_kat_id","ad"),
		array($SutunVerileri[3],$SutunVerileri[2],$SutunVerileri[1]),$TamKosul);
		endif;
				
				
				
				
				if ($sonuc): 

																			 self::$view->goster($gidilecekDosyaYolu,
																												["Bilgi" =>[
																														"adres" => URL."/panel/".$gidilecekUrl,
																														"baslik" => $OlumluBilgiVerileri[0],
																														"metin" => $OlumluBilgiVerileri[1],
																														"durum" => $OlumluBilgiVerileri[2]
																														]	] );

																else:		
																				self::$view->goster($gidilecekDosyaYolu,
																														["Bilgi" =>[
																																"adres" => URL."/panel/".$gidilecekUrl,
																																"baslik" => $OlumsuzBilgiVerileri[0],
																																"metin" => $OlumsuzBilgiVerileri[1],
																																"durum" => $OlumsuzBilgiVerileri[2]
																																]	] );

																endif;
				endif;					

			else:			
			
			self::$Bilgi->direktYonlen(URL."/panel/".$gidilecekUrl);
	
			endif;				
				
				
endif;
		
		
		
		}
		
		
		public static function Ekle(
		array $TeknikVeriler=null,			
		array $SutunAdlari,		
		array $FormVerileri,		
		$gidilecekUrl,		
		$Tabload,	
		array $OlumluBilgiVerileri,
		array $OlumsuzBilgiVerileri,
		$bolum=false) {
		
		
		if (isset($TeknikVeriler[1])) :
		
			    switch ( $TeknikVeriler[1] ):

							case "ADMİN":
								 $gidilecekDosyaYolu = ADMİNDOSYAYOLU . $TeknikVeriler[3];
								 break;

							case "ARAYUZ":
								 $gidilecekDosyaYolu = ARAYUZDOSYAYOLU . $TeknikVeriler[3];
								 break;

						 endswitch;
			else:
			
			 switch ( $bolum ):

							case "ADMİN":
								 $gidilecekDosyaYolu = ADMİNDOSYAYOLU . $gidilecekUrl;
								 break;

							case "ARAYUZ":
								 $gidilecekDosyaYolu = ARAYUZDOSYAYOLU . $gidilecekUrl;
								 
								 
								 break;

						 endswitch;
		
		endif;
		
	
		
		
		
			if($TeknikVeriler[0]=="ilk"):
						self::SayfaYukleme($TeknikVeriler[1],$TeknikVeriler[2],$TeknikVeriler[3],$TeknikVeriler[4],							
						$TeknikVeriler[5]);	
				
			else:
			
			if ($_POST) :	
						$SutunVerileri=array();

						foreach ($FormVerileri as $anahtar => $deger):
									
									
									if(strstr($anahtar,"input")) :
											$SutunVerileri[]=self::$Form->get($deger)->bosmu();
									elseif (strstr($anahtar,"select")):
									    $SutunVerileri[]=self::$Form->Selectboxget($deger);	
									elseif (strstr($anahtar,"check")):
									    $SutunVerileri[]=self::$Form->Checkboxget($deger);	
									elseif (strstr($anahtar,"radio")):
							 	    	$SutunVerileri[]=self::$Form->radiobutonget($deger);	
									endif;

						endforeach;					
				
					
					if (!empty(self::$Form->error)) :
					
					
										self::$view->goster($gidilecekDosyaYolu,
									["Bilgi" =>[
											"adres" => URL."/panel/".$gidilecekUrl,
											"baslik" => "BAŞARISIZ",
											"metin" => "Tüm alanlar doldurulmalıdır.",
											"durum" => "warning"
											]	] );			
					
				else:	
				
						
				
				if (self::$model->Ekleme($Tabload,
													$SutunAdlari,
													$SutunVerileri)): 

																			 self::$view->goster($gidilecekDosyaYolu,
																												["Bilgi" =>[
																														"adres" => URL."/panel/".$gidilecekUrl,
																														"baslik" => $OlumluBilgiVerileri[0],
																														"metin" => $OlumluBilgiVerileri[1],
																														"durum" => $OlumluBilgiVerileri[2]
																														]	] );

																else:		
																				self::$view->goster($gidilecekDosyaYolu,
																														["Bilgi" =>[
																																"adres" => URL."/panel/".$gidilecekUrl,
																																"baslik" => $OlumsuzBilgiVerileri[0],
																																"metin" => $OlumsuzBilgiVerileri[1],
																																"durum" => $OlumsuzBilgiVerileri[2]
																																]	] );

																endif;
				endif;					

			else:			
			
			self::$Bilgi->direktYonlen(URL."/panel/".$gidilecekUrl);
	
			endif;				
				
				
endif;
		
		
		
		}

}


?>