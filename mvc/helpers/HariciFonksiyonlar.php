<?php

/*

BURADA SİTENİN TÜM AYARLARINI VE DİĞER FONKSİYONLARIMI BARINDIRIYOR

*/

class  HariciFonksiyonlar  extends Model {
	
	public $sonuc,$title,$sayfaAciklama,$anahtarKelime,$sloganUst1,$sloganAlt1,$sloganUst2,$sloganAlt2,$sloganUst3,$sloganAlt3,$mailhost,$mailadres,$mailsifre,$mailport;
	
	public $linkler=array(),$encoksatan=array(),$stoguazalan=array(),$populerkategori=array(),
	$slider=array();
	
	public static $de;
	
	
	function __construct() {	
	
	parent::__construct();
	
	
	self::$de=$this->db;

	$this->sonuc=$this->db->listele("ayarlar");
	
	$this->title=$this->sonuc[0]["title"];
	$this->sayfaAciklama=$this->sonuc[0]["sayfaAciklama"];
	$this->anahtarKelime=$this->sonuc[0]["anahtarKelime"];
	$this->mailhost=$this->sonuc[0]["mail_host"];
	$this->mailadres=$this->sonuc[0]["mail_adres"];
	$this->mailsifre=$this->sonuc[0]["mail_sifre"];
	$this->mailport=$this->sonuc[0]["mail_port"];
	
	
$this->encoksatan=$this->db->listele("urunler","order by satisadet desc LIMIT 8");
$this->stoguazalan=$this->db->listele("urunler","where stok < 200 order by stok asc LIMIT 8");	
$this->populerkategori=$this->db->listele("alt_kategori","order by rand() LIMIT 8");	

$this->slider=$this->db->listele("slider");

	
	}
	
	
	function seo($s) {
 $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',');
 $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','');
 $s = str_replace($tr,$eng,$s);
 $s = strtolower($s);
 $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
 $s = preg_replace('/\s+/', '-', $s);
 $s = preg_replace('|-+|', '-', $s);
 $s = preg_replace('/#/', '', $s);
 $s = str_replace('.', '', $s);
 $s = trim($s, '-');
 return $s;
} // SEO fonksiyonu	
	
	function LinkleriGetir() {
		
		$son=$this->db->prepare("select * from ana_kategori");
		$son->execute();
		
		
		while ($aktar=$son->fetch(PDO::FETCH_ASSOC)) :
		
		
		echo ' <li class="dropdown">
		            <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$aktar["ad"].' <b class="caret"></b></a>
		            <ul class="dropdown-menu multi-column columns-3">
			            <div class="row">';
		
		
		
	$son2=$this->db->prepare("select * from cocuk_kategori where ana_kat_id=".$aktar["id"]);
	$son2->execute();		
	
					while ($aktar2=$son2->fetch(PDO::FETCH_ASSOC)) :
					
					
					   echo'<div class="col-sm-4">
					            <ul class="multi-column-dropdown">
									<h6>'.$aktar2["ad"].'</h6>';
											
					$son3=$this->db->prepare("select * from 
					alt_kategori where cocuk_kat_id=".$aktar2["id"]);
					$son3->execute();		
	
					while ($aktar3=$son3->fetch(PDO::FETCH_ASSOC)) :			
											
echo  '<li><a href="'.URL.'/urunler/kategori/'.$aktar3["id"].'/'.$this->seo($aktar3["ad"]).'">'.$aktar3["ad"].'</a></li>';			
									
							endwhile;
							
										
						  
					           echo'</ul> </div>';
					
					
					
		
		
		
					endwhile;
					
					
					
		echo'<div class="clearfix"></div>
			            </div>
		            </ul>
		        </li>';
		
		
		endwhile;
		
		
	/*	
	
	JOİN İŞLEMİNİ GÜNCELLEMELER İLE EKLEYECEĞİZ
	
	join left right MYSQL	
	dasdas dasdasd anakategori JOİN altkategori ON anaktegori.id=altkatgori.id	
	
	*/
	
	
		
	}  // LİNKLER

	function bulten() {
		
		
	?>
    
      <div class="row">
    
     <div class="col-md-12" id="Bulten">
        	<div class="join">
					<h6>BÜLTENE KAYIT</h6>
					<div class="sub-left-right">
    <?php Form::Olustur("1",array("id" => "bultenForm")); ?> 
							<input type="text" value="Mail Adresinizi Yazınız" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mail Adresinizi Yazınız';}"  name="mailadres"/>
                            
<?php Form::Olustur("2",array("type" => "button","value" => "KAYIT OL","id" => "bultenBtn")); ?>                     
						
	<?php Form::Olustur("kapat"); ?> 				
					</div>
					<div class="clearfix"> </div>
				</div>
                
                 </div>
                 
                  </div>
    
    <?php
	
		
	} // BULTEN
	
	function UrunCek($id) {
	
	return $this->db->listele("urunler","where id=".$id);
		
	} // ÜRÜN ÇEK	
	
	function UyesiparisGetir($dizimiz) {
	
	  
	  $siparisnum=array();
	  
	  foreach ($dizimiz as $value) :	  
	  $siparisnum[]=$value["siparis_no"];	  
	  endforeach;	 
	
	  $temizsiparisnumaralari=array_unique($siparisnum,SORT_STRING);
	  
	  
	  foreach ($temizsiparisnumaralari as $value) :
	  	$siparisler=$this->db->listele("siparisler","where siparis_no=".$value);
	?>
		
		
      	<!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        		 <div class="row arkaplan2  pb-0" >
                 	<div class="col-xl-2 col-lg-2 col-md-12 col-sm-12  Uye_panel_siparisler">
                    <span>Sipariş No :</span> <span class="spantext"><?php echo $value; ?></span>
                    </div>                   
                    
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 pt-3 Uye_panel_siparisler">
                    <span>Kargo Durumu :</span> <span class="spantext">
					
					<?php 
					switch ($siparisler[0]["kargodurum"]) :
					
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
                    
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 Uye_panel_siparisler">
                    <span>Ödeme Türü :</span> <span class="spantext"><?php echo $siparisler[0]["odemeturu"]; ?></span>
                    </div>
                    
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 Uye_panel_siparisler">
                    <span>Tarih :</span> <span class="spantext"><?php echo $siparisler[0]["tarih"]; ?></span>
                    </div>
                    
               <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 Uye_panel_siparisler" id="detaygoster">
               
  <a href="#" data-value="<?php echo $value; ?>" data-value2="<?php echo $siparisler[0]["adresid"]; ?>" data-toggle="modal" data-target="#exampleModalCenter" id="adres">Teslimat </a> | 
  
                 
  <a href="#" id="iade" data-value="<?php echo $value; ?>">İade</a> 
                    </div>                                                 
                 
                    
                    <!--  
					
					ÜRÜNLER-->
           
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-2 p-0">
                     
                     	<div class="row p-5">                      
                        
<div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2 ">ÜRÜN ADI</div>
<div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">ÜRÜN ADET</div>
<div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">ÜRÜN FİYAT</div>
<div class="col-lg-3 bg-gradient-gri text-dark kalinyap p-2">TOPLAM FİYAT</div>
						</div>
                        
                        <?php 
						$toplam=array();
					for ($i=0; $i<count($siparisler); $i++):
					
		echo '<div class="row border border-light">     
<div class="col-lg-3 urunler">'.$siparisler[$i]["urunad"].'</div>
<div class="col-lg-3 urunler">'.$siparisler[$i]["urunadet"].'</div>
<div class="col-lg-3 urunler">'.number_format($siparisler[$i]["urunfiyat"], 2, ',', '.').'</div>
<div class="col-lg-3 urunler">'.$siparisler[$i]["toplamfiyat"].'</div>             
                     </div> ';
					$toplam[]=$siparisler[$i]["toplamfiyat"];		
					endfor;
					
							  ?>
      
      
              <!-- TOPLAM FİYAT -->
                     
                   	<div class="row"> 
                      
                    <div class="col-lg-9 text-dark kalinyap p-2"></div>    
                    <div class="col-lg-2  siptoplam text-right p-2"><span>SİPARİŞ TOPLAMI :</span></div>  
                    <div class="col-lg-1  siptoplam text-left kalinyap p-2"><span >
					
					<?php
					
					echo number_format(array_sum($toplam), 2, ',', '.');
					
					 ?></span></div>        
                        
                    </div>    
                 <!-- TOPLAM FİYAT -->   
                 
               
      
      
     				
                        
                   
                     
                     </div>
                 
                   <!--  ÜRÜNLER-->
                  	<div class="row"> 
					
					 <div class="col-lg-12">
					 <div id="iadeiskelet"></div>
					 </div>
			
                 </div>   
                 
                 </div>
        
      	<!-- SİPARİŞİN İSKELETİ BİTİYOR -->  
		
		 <?php
	  	
	  
	  					endforeach;
			
		
		
	} // PANEL - ÜYENİN SİPARİŞLERİNİ GETİRİYOR
	
	function UyeyorumGetir($dizimiz,$toplamsayfa=false,$toplamveri=false) { 
		                
              echo'<div class="row"><div class="col-md-12 text-center">';
                 	 echo $toplamveri>0 ? '<div class="alert alert-info">'.$toplamveri. " adet yorumunuz var</div>" : '<div class="alert alert-info">Henüz hiçbir ürüne yorum yazmamışsınız.</div>';  
				   
				   if ($toplamveri!=0) : 
				   echo'<table class="table">
                    <tbody> 
					<tr id="baslik">
                    <td>YORUMUNUZ</td>
                    <td>ÜRÜN</td>
                    <td>TARİH</td>
                    <td>DURUM</td>
					<td>GÜNCELLE</td>
                    <td>SİL</td>                   
                    </tr>';
					
					foreach ($dizimiz as $deger) :	
					
					$GelenUrun=$this->UrunCek($deger["urunid"]);
					echo'<tr id="adresElemanlar">
                    <td><span class="sp'.$deger["id"].'">'.$deger["icerik"].'</span></td>
                    <td>'.$GelenUrun[0]["urunad"].'</td>
                    <td>'.$deger["tarih"].'</td>
					<td>'; echo ($deger["durum"]==0) ? "<span class='onaysiz'>Onaysız</span>" : "<span class='onayli'>Onaylı</span>"; echo'</td>					
					<td id="GuncelButonlarinanasi">					
					<input type="button" class="btn btn-sm btn-success" data-value="'.$deger["id"].'" value="Güncelle"></td> <td>';?>
                    
	   <a onclick='UrunSil("<?php echo $deger["id"] ?>","yorumsil")' class="btn btn-sm btn-danger">SİL</a> <?php echo'</td> </tr>';
	   
						endforeach;
					
                   echo '</tbody></table>';
                   endif; 
				   
				   
		 if (isset($toplamsayfa)) :	 		 
		 $link="/uye/yorumlarim/";		 
		 endif;	 
        
		Pagination::numaralar($toplamsayfa,$link);
				   
				   
                    
                   echo '</div></div>';
                
                
		
	} // PANEL - ÜYENİN YORUMLARINI GETİRİYOR
	
	function UyeadresGetir($dizimiz) {


				   echo' <div class="row">


				   <div class="col-md-12 text-center mt-5"> ';

						echo count($dizimiz)>0 ? '<div class="alert alert-info mt-5">'.count($dizimiz). ' adet adresiniz kayıtlıdır <a href="'.URL.'/uye/adresekle" class="btn  btn-sm btn-success mb-5 ">ADRES EKLE</a></div>' : '<div class="alert alert-info mt-5">Kayıtlı adresiniz bulunmamaktadır. <a href="'.URL.'/uye/adresekle" class="btn  btn-sm btn-success mb-5 ">ADRES EKLE</a></div>';  
					   echo'</div>'; 




						foreach ($dizimiz as $deger) :			

						echo'<div class="col-md-2 text-center" id="adresiskelet">

							<div class="row" id="adresElemanlar">
								<div class="col-md-12" id="adresİd">
					<span class="adresSp'.$deger["id"].'">'.$deger["adres"].'</span></div>
					 </div>


					 <div class="row">


					<div class="col-xl-12 col-lg-12 col-sm-12 col-md-12" id="AdresGuncelButonlarinanasi">

		<input type="button" class="btn btn-sm  btn-primary btn-block" data-value="'.$deger["id"].'" id="AdresGuncelBtn" value="GÜNCELLE">					

								</div>	



								<div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">';?>

		   <a onclick='UrunSil("<?php echo $deger["id"] ?>","adresSil")' class="btn btn-sm btn-primary btn-block" id="AdresSilBtn">SİL</a> <?php echo'</div>  



			  <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">';

		   echo  $deger["varsayilan"]==1 ? '<a class="btn btn-sm btn-danger btn-block" id="AdresSilBtn">VARSAYILAN ADRES</a>' : '<a onclick=\'VarsayilanYap("'.$deger["uyeid"].'","'.$deger["id"].'")\' class="btn btn-sm btn-primary btn-block" id="AdresSilBtn">VARSAYILAN YAP</a>';




		 echo'</div>  


						   </div>       
						   </div>';
							endforeach;		


				   echo '</div>'; 	




		} // PANEL - ÜYENİN ADRESLERİNİ GETİRİYOR
	
	function UyeadresEkle($dizimiz) {
		
				
	
	if ($dizimiz=="ekleme") :	
	
	?>
                <div class="row text-center">
                  	<div class="col-md-4"></div> 
                   <div class="col-md-4 text-center" id="ortala">
                   
                   <!--  SATIRLAR BAŞLIYOR-->
                   
                   			 <div class="row text-center" id="satirlar">
                             	<div class="col-md-12" id="satirlarbaslik">ADRES EKLE</div>
                             
                             
             <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12" > 
                      <?php 	 Form::Olustur("1",array(
					 "action" => URL."/uye/adresEkleSon",
					 "method" => "POST"				
					 ));   ?>
                     <h4>Adresiniz yazınız</h4></div>
                     
 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
 <?php
 Form::Olustur("3",array("rows"=>5,"name"=>"yeniadres","class"=>"form-control")); ?> 
 
</div>
 


        
<div class="col-md-12">     
         <?php
 Form::Olustur("2",array("type"=>"hidden","name"=>"uyeid","value"=>Session::get("uye")));
 Form::Olustur("2",array("type"=>"submit","class"=>"btn","value"=>"ADRES EKLE"));
 Form::Olustur("kapat"); 
  ?>
 </div>


<?php 

	endif;
?>
      
                             
                             
                             </div>	
                             
                    <!--  SATIRLAR BİTİYOR-->         
                   
                   
                   </div> 
                 <div class="col-md-4"></div> 
               </div>
                
				
                
                
                
                
				<?php	
				
	
	
	}  // PANEL - ÜYENİN ADRES EKLİYOR
	
	function UyeayarlarGetir($dizimiz) {		
	
	if ($dizimiz!="ok") :	
	
	?>
                <div class="row text-center">
                  	<div class="col-md-4"></div> 
                   <div class="col-md-4 text-center" id="ortala">
                   
                   <!--  SATIRLAR BAŞLIYOR-->
                   
                   			 <div class="row text-center" id="satirlar">
                             	<div class="col-md-12" id="satirlarbaslik">HESAP AYARLARI</div>
                             
                             
                             		<div class="col-md-5" > 
                      <?php 	 Form::Olustur("1",array(
					 "action" => URL."/uye/ayarGuncelle",
					 "method" => "POST"				
					 ));   ?>
                     <label>Ad</label></div>
 <div class="col-md-7"><?php
 Form::Olustur("2",array("type"=>"text","name"=>"ad","value"=>$dizimiz[0]["ad"],"class"=>"form-control")); ?> 
</div>
 
 							<!--  --------->         
<div class="col-md-5"><label>Soyad</label></div>
 <div class="col-md-7" > <?php
 Form::Olustur("2",array("type"=>"text","name"=>"soyad","value"=>$dizimiz[0]["soyad"],"class"=>"form-control")); ?> 
</div>
 
  							<!--  --------->         
<div class="col-md-5"><label>Mail adresiniz</label></div>
<div class="col-md-7" > <?php
 Form::Olustur("2",array("type"=>"text","name"=>"mail","value"=>$dizimiz[0]["mail"],"class"=>"form-control")); ?>
</div>
 
   							<!--  --------->         
<div class="col-md-5"><label>Telefon</label></div>
<div class="col-md-7" ><?php
 Form::Olustur("2",array("type"=>"text","name"=>"telefon","value"=>$dizimiz[0]["telefon"],"class"=>"form-control")); ?>
</div>
 
    							<!--  --------->         
<div class="col-md-12">     
         <?php
 Form::Olustur("2",array("type"=>"hidden","name"=>"uyeid","value"=>$dizimiz[0]["id"]));
 Form::Olustur("2",array("type"=>"submit","class"=>"btn","value"=>"GÜNCELLE"));
 Form::Olustur("kapat"); 
  ?>
 </div>


<?php 

	endif;
?>
      
                             
                             
                             </div>	
                             
                    <!--  SATIRLAR BİTİYOR-->         
                   
                   
                   </div> 
                 <div class="col-md-4"></div> 
               </div>
                
				
                
                
                
                
				<?php	
				
	
	
	}  // PANEL - ÜYENİN AYARLARINI GETİRİYOR
	
	function Uyesifredegistir($dizimiz) {
		
		if ($dizimiz!="ok") :
	
	
	?>
		
		
		
			
                <div class="row text-center">
                  	<div class="col-md-4"></div> 
                   <div class="col-md-4 text-center" id="ortala">
                   
                   <!--  SATIRLAR BAŞLIYOR-->
                   
                   			 <div class="row text-center" id="satirlar">
                	<div class="col-md-12" id="satirlarbaslik">ŞİFRE DEĞİŞTİR</div>
                             
                             
                             		<div class="col-md-5" >
                                  <?php
					  Form::Olustur("1",array(
					 "action" => URL."/uye/sifreguncelle",
					 "method" => "POST"				
					 )); 
								  
								  
								  ?>  
      
                                    <label>Mevcut Şifreniz</label></div>
 <div class="col-md-7">
  <?php
 Form::Olustur("2",array("type"=>"password","name"=>"msifre","class"=>"form-control")); ?>
 </div> 
 							<!--  --------->         
 <div class="col-md-5"><label>Yeni Şifreniz</label></div>
 <div class="col-md-7">
 <?php
 Form::Olustur("2",array("type"=>"password","name"=>"yen1","class"=>"form-control")); ?> 
</div>
 
  							<!--  --------->         
<div class="col-md-5"><label>Şifre (Tekrar)</label></div>
<div class="col-md-7" >
<?php
 Form::Olustur("2",array("type"=>"password","name"=>"yen2","class"=>"form-control")); ?>
</div>
 
  
    							<!--  --------->         
<div class="col-md-12">        
    <?php
 Form::Olustur("2",array("type"=>"hidden","name"=>"uyeid","value"=>$dizimiz)); ?>
        
    <?php
 Form::Olustur("2",array("type"=>"submit","class"=>"btn","value"=>"DEĞİŞTİR" )); ?>
    </div>

   <?php endif; ?>   
                       
                             
 </div>	
                             
                    <!--  SATIRLAR BİTİYOR-->         
                   
                   
                   </div> 
                 <div class="col-md-4"></div> 
               </div>
                
				
                
                
                
                
				<?php		
	
	} // PANEL - ÜYENİN ŞİFRE DEĞİŞTİRME
	
	//*****************************************************
	
	function UyeBilgileriniGetir() {
		
 	return $this->db->listele("uye_panel","where id=".Session::get("uye"));	
	
		
	}// SİPARİŞ TAMAMLA - ÜYE BİLGİLERİNİ GETİRİYOR
	
	function UyeAdresleriniGetir() {
		
  	return $this->db->listele("adresler","where uyeid=".Session::get("uye"));	
	
		
	}// SİPARİŞ TAMAMLA - ÜYE ADRESLERİ GETİRİYOR
	
	
	function UrunkategoriGetir($id) {
	
	return $this->db->listele("alt_kategori","where id=".$id);
		
	} // ÜRÜN ÇEK	
	
	
	function UyeFavoriGetir($dizimiz) {	
	  

	  foreach ($dizimiz as $value) :	  	
		?>
		
				 
                	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
					
					<a href="<?php echo $value["urunlink"]; ?>" >
		<img src="<?php echo $value["urunresim"]; ?>" class="img-responsive" width="200" heigth="200" />
					</a>
					
				 <a onclick='UrunSil("<?php echo $value["id"] ?>","FavoriSil")' class="btn btn-sm btn-primary btn-block" id="FavoriSilBtn">SİL</a>  

					
                   
                    </div>                    
           
     
		
		 <?php
	  	
	  
	  					endforeach;
			
	
		
	} // PANEL - ÜYENİN SİPARİŞLERİNİ GETİRİYOR
	
 
}




?>