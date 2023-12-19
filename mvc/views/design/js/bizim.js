
$(document).ready(function() {

// SİPARİŞ TAMAMLAMA EKRANI İÇİN YAZILAN KODLAR

	//*********
	// ilk etapta sayfa açılır açılmaz varsayılan adresin değerini diğer adreslere inputuna yazıyorum
	$('body input[type="text"][id="sipadres"]').val($('#adressecim input[type="radio"]:checked').attr("data-value"));	
	$('body input[type="text"][name="fatadres"]').val($('#adressecim input[type="radio"]:checked').attr("data-value"));
	$('body input[type="text"][name="tesadres"]').val($('#adressecim input[type="radio"]:checked').attr("data-value"));
	// diğer varsayılan değerleri aktarıyorum.
	$('input[name="fatad"]').val($('input[id=sipAd]').val());
	$('input[name="fatsoyad"]').val($('input[id=sipSoyad]').val());
	$('input[name="tesad"]').val($('input[id=sipAd]').val());
	$('input[name="tessoyad"]').val($('input[id=sipSoyad]').val());

	//-- Adres seçimi değişitirilirse üyenin bilgilerindeki adres inputuna veriyi yazıyoruz
	$('#adressecim input[type="radio"]').on('change',function() { 	
	$('body input[type="text"][id="sipadres"]').val($(this).attr("data-value"));						
	});
	//*********
	
	
	$('.faturatercih input[name="faturaTercih"]').on('change',function() {		
		var gelenTercih=$(this).val(); // 0-1
		
		if (gelenTercih==1) 		
		{				
			
			 $('input[name="fatad"]').val("");
			 $('input[name="fatsoyad"]').val("");
			 $('input[name="fatadres"]').val("");	
		}		
		else {		
		// tercih 1 ise demek ki farklı bir adres girmek istiyor demektir.
		$('body input[type="text"][name="fatadres"]').val($('#adressecim input[type="radio"]:checked').attr("data-value"));			
			  $('input[name="fatad"]').val($('input[id=sipAd]').val());
			  $('input[name="fatsoyad"]').val($('input[id=sipSoyad]').val());						
		}	
		
	});
	//*********
	
	
	$('.testercih input[name="teslimatTercih"]').on('change',function() {		
		var gelenTercih=$(this).val(); // 0-1
		
		if (gelenTercih==1) 		
		{				
			
			 $('input[name="tesad"]').val("");
			 $('input[name="tessoyad"]').val("");
			 $('input[name="tesadres"]').val("");	
		}		
		else {		
		// tercih 1 ise demek ki farklı bir adres girmek istiyor demektir.
		$('body input[type="text"][name="tesadres"]').val($('#adressecim input[type="radio"]:checked').attr("data-value"));			
			  $('input[name="tesad"]').val($('input[id=sipAd]').val());
			  $('input[name="tessoyad"]').val($('input[id=sipSoyad]').val());						
		}	
		
	});
	
	

// SİPARİŞ TAMAMLAMA EKRANI İÇİN YAZILAN KODLAR

// SANAL POS İÇİN
$('body #havale').hide();

	$('#uyelik input[type="radio"]').on('change',function() { 
				if ($(this).val()==1) {
				$('body #kredi').hide();
				$('body #havale').show();

				}
				else {
				$('body #havale').hide();
				$('body #kredi').show();
				}			
		});	
		
// SANAL POS İÇİN

/* kullanıcı arayüz sipariş iade */ 
		$('body #iade').click(function() {
			
			
			var eleman=$(this);
			var sipno=$(this).attr('data-value');
			var iadeiskelet=eleman.parents(".arkaplan2").find("#iadeiskelet");
		 iadeiskelet.html('<div class="alert alert-info text-center"><input type="button" id="iadebutonu" class="btn btn-primary" data-value="'+sipno+'" value="İADE ET"><input type="button" id="vazgec" class="btn btn-danger" value="VAZGEÇ"></div>');
		 
		 
		 
		iadeiskelet.find('#iadebutonu').click(function() {
		
		var sipno=$(this).attr('data-value');		
	
		$.post("http://localhost/mvc/GenelGorev/iadeislemi",{"sipno":sipno},function(cevap) {
				
		iadeiskelet.html(cevap);
	
		});	



		});
		

				iadeiskelet.find('#vazgec').click(function() {


					iadeiskelet.html("").hide();

				});


		});	
		
		
		
			
		
	
// toplu bülten kayıt silme

	$('#toplusilbtn').click(function() {
	
	var elemanlar=$(":checkbox:checked");
	var idler="";
	//var idlerimiz=[];
	
		elemanlar.each(function() {
		
		

			idler +=$(this).val()+",";

//idlerimiz.push($(this).val());
		
		
		});	
		
		
		 /* array elemanlarını tek tek yakalama ve yok etme */
	/*	$.each(idlerimiz,function(index, value){
		
		var anaiskelet=$(":checkbox:checked").prop("value",value).parents('.mailcerceve');
		anaiskelet.css("background","black");
		anaiskelet.fadeOut();
		});*/	
		
		
			$.post("http://localhost/mvc/GenelGorev/bultentoplusilme",{"idler":idler},function() {		

				var anaiskelet=$(":checkbox:checked").parents('.mailcerceve');
				anaiskelet.css("background","black");
				anaiskelet.fadeOut();


			});	

			
		});	
		
		
		
		$('#tumunusecbtn').click(function() {
			
		$('body input[type="checkbox"]').attr("checked",true);


		});	
		
		$('#tumunukaldirbtn').click(function() {
			$('body input[type="checkbox"]').attr("checked",false);	
		});	
// toplu bülten kayıt silme	


// toplü ürün silme

$('#topluurunsilbtn').click(function() {

	
	var elemanlar=$(":checkbox:checked");
	var idler="";
	//var idlerimiz=[];
	
		elemanlar.each(function() {
		
		

			idler +=$(this).val()+",";
		
		
		});	
		

		
			$.post("http://localhost/mvc/GenelGorev/uruntoplusilme",{"idler":idler},function() {		

				var anaiskelet=$(":checkbox:checked").parents('#uruncerceve');
				anaiskelet.css("background","black");
				anaiskelet.fadeOut("slow",function() {
				
				window.location.href="http://localhost/mvc/panel/urunler/";
				
				
				});


			});	

			
		});	
		
		
		$('input[type="checkbox"][name="anacheck"]').click(function() {
		
			if (this.checked) {
				$('body input[type="checkbox"]').attr("checked",true);
			
			}
			else {
				$('body input[type="checkbox"]').attr("checked",false);	
			
			}	


		});			
	
		
	
/* kullanıcı arayüz sipariş iade */ 		
		
		$('#iadeonay a').click(function() {
			
			
			var eleman=$(this);
			var sipno=$(this).attr('data-value');
			var iadeiskelet=eleman.parents(".arkaplan");
			
			$.post("http://localhost/mvc/GenelGorev/paneliadeislemi",{"sipno":sipno},function() {		
			iadeiskelet.fadeOut();
	
			});		 

			
		});	
	

$('#anaekranselect').attr("disabled",false);
$('#cocukekranselect').attr("disabled",true);
$('#katidekranselect').attr("disabled",true);


$('#anaekranselect').on('change',function() { 

		var secilendeger= $(this).val();		
		
$.post("http://localhost/mvc/GenelGorev/selectkontrol",{"kriter":"anaekrancocukgetir","anaid":secilendeger},function(cevap) {
		$('#cocukekranselect').attr("disabled",false);	
		$('#cocukekranselect').html(cevap);
		
	});
$('#katidekranselect').attr("disabled",true).html('<option value="0">Seçiniz</option>');

});


$('#cocukekranselect').on('change',function() { 
$('#katidekranselect').attr("disabled",false);
		var secilendeger= $(this).val();		
		
$.post("http://localhost/mvc/GenelGorev/selectkontrol",{"kriter":"anaekranaltgetir","cocukid":secilendeger},function(cevap) {
			
		$('#katidekranselect').html(cevap);
		
	});


});







/* ÜRÜN GÜNCELLEME */ 
$('#sifirla').on('click',function() { 
$('#anaselect').attr("disabled",false);
$('#cocukselect').attr("disabled",false).html('<option value="0">Seçiniz</option>');
$('#altselect').attr("disabled",false).html('<option value="0">Seçiniz</option>');
});


$('#anaselect').on('change',function() { 

		var secilendeger= $(this).val();		
		
$.post("http://localhost/mvc/GenelGorev/selectkontrol",{"kriter":"cocukgetir","anaid":secilendeger},function(cevap) {
			
		$('#cocukselect').html(cevap);
		
	});
$('#altselect').attr("disabled",true).html('<option value="0">Seçiniz</option>');

});


$('#cocukselect').on('change',function() { 
$('#altselect').attr("disabled",false);
		var secilendeger= $(this).val();		
		
$.post("http://localhost/mvc/GenelGorev/selectkontrol",{"kriter":"altgetir","cocukid":secilendeger},function(cevap) {
			
		$('#altselect').html(cevap);
		
	});


});

/* ÜRÜN GÜNCELLEME */ 




	
		$('#sec').click(function() {
			
		$('#EklemeformuAna input[type="checkbox"]').attr("checked",true);


		});	
		
		$('#kaldir').click(function() {
			$('#EklemeformuAna input[type="checkbox"]').attr("checked",false);	
		});
		
		$('#sec').click(function() {
			
		$('#GuncelleformuAna input[type="checkbox"]').attr("checked",true);


		});	
		
			$('#kaldir').click(function() {
			$('#GuncelleformuAna input[type="checkbox"]').attr("checked",false);	
		});
		
		
		

	
		$('#detaygoster #adres').click(function() {
		
		var sipno=$(this).attr('data-value');
		var adresid=$(this).attr('data-value2');
	
		
		
		$.post("http://localhost/mvc/GenelGorev/teslimatgetir",{"sipno":sipno,"adresid":adresid},function(cevap) {
			
		$(".modal-body").html(cevap);
		$("#exampleModalLongTitle").html("Teslimat adresi ve kişisel bilgiler");
	});	
		
		
		
	});
	
		$('#detaygoster #siparis').click(function() {
		
		var sipno=$(this).attr('data-value');
		var adresid=$(this).attr('data-value2');
	
		
		
		$.post("http://localhost/mvc/GenelGorev/siparisgetir",{"sipno":sipno,"adresid":adresid},function(cevap) {
			
		$(".modal-body").html(cevap);
		$("#exampleModalLongTitle").html("SİPARİŞ ÖZETİ");
				
		
	});	
		
		
		
	});
	
	
	jQuery.fn.extend({
	printElem: function() {
		var cloned = this.clone();
    var printSection = $('#printSection');
    if (printSection.length == 0) {
    	printSection = $('<div id="printSection"></div>')
    	$('body').append(printSection);
    }
    printSection.append(cloned);
    var toggleBody = $('body *:visible');
    toggleBody.hide();
    $('#printSection, #printSection *').show();
    window.print();
    printSection.remove();
    toggleBody.show();
	}
});

$(document).ready(function(){
	$(document).on('click', '#btnPrint', function(){
  	$('#exampleModalCenter').printElem();
  });
});

	
	
	
	
	$("#aramakutusu").attr("placeholder","Sipariş numarası");	
	
	$("#aramaselect").on('change', function(e) {
		
		var secilenial = $(this);
		var valueninDegeri=secilenial.val();		
		if (valueninDegeri=="sipno") {
		$("#aramakutusu").val("");	
		$("#aramakutusu").attr("placeholder","Sipariş numarası yazın");	
		}
		if (valueninDegeri=="uyebilgi") {
		$("#aramakutusu").val("");	
		$("#aramakutusu").attr("placeholder","Üye Bilgilerin herhangi biri");		
		}
		
		
	});

	
	$("#SepetDurum").load("http://localhost/mvc/GenelGorev/SepetKontrol");
	
	$("#Sonuc").hide();
	
	$("#FormAnasi").hide();
	
	
    $("#yorumEkle").click(function(e) {
		 $("#FormAnasi").slideToggle();	
        
    });
	
	
	$("#yorumGonder").click(function() {
		
		$.ajax({
			type:"POST",
			url:'http://localhost/mvc/GenelGorev/YorumFormKontrol',
			data:$('#yorumForm').serialize(),
			success: function(donen_veri){
				$('#yorumForm').trigger("reset");
				$('#FormSonuc').html(donen_veri);
				
				if ($('#ok').html()=="Yorumunuz kayıt edildi. Onaylandıktan sonra yayınlanacaktır") {
					$("#FormAnasi").fadeOut();
					
					
				}
				
			
				
			},
		});
			
		
        
    });
	
	
	$("[type='number']").keypress(function (evt) {
		evt.preventDefault();
		
		
	});
	
	
	
	
	
	$("#bultenBtn").click(function() {
		
		
	$.ajax({
			type:"POST",
			url:'http://localhost/mvc/GenelGorev/BultenKayit',
			data:$('#bultenForm').serialize(),
			success: function(donen_veri){
				$('#bultenForm').trigger("reset");
				$('#Bulten').html(donen_veri);
				
				if ($('#bultenok').html()=="Bultene Başarılı bir şekilde kayıt oldunuz. Teşekkür ederiz") {
				
					
					
				}
				
			
				
			},
		});
			
		
        
    });
	
	
	
	
	
	$("#İletisimbtn").click(function() {
		//$('#iletisimForm').fadeOut();
		
		
//$('#FormSonuc').html("Merhaba");
		
		
	$.ajax({
			type:"POST",
			url:'http://localhost/mvc/GenelGorev/iletisim',
			data:$('#iletisimForm').serialize(),
			success: function(donen_veri){
				$('#iletisimForm').trigger("reset");
			$('#FormSonuc').html(donen_veri);
				
					if ($('#formok').html()=="Mesajınız Alındı. En kısa sürede Dönüş yapılacaktır. Teşekkür ederiz") {
						
				$('#iletisimForm').fadeOut();
				$('#FormSonuc').html(donen_veri);
					
					
				}
				
				
							
			
				
			},
		});
			
		
        
    });
	
	
	
		$("#SepetBtn").click(function() {

		
	$.ajax({
			type:"POST",
			url:'http://localhost/mvc/GenelGorev/SepeteEkle',
			data:$('#SepeteForm').serialize(),
			success: function(donen_veri){
				$('#SepeteForm').trigger("reset");
				
				
				$("html,body").animate({scrollTop : 0} , "slow");
				
		$("#SepetDurum").load("http://localhost/mvc/GenelGorev/SepetKontrol");					
		$('#Mevcut').html('<div class="alert alert-success text-center">SEPETE EKLENDİ</div>');
				
					
							
			
				
			}
		});
			
		
        
    });
	
	
		
		$("#FavoriBtn").click(function() {

		
	$.ajax({
			type:"POST",
			url:'http://localhost/mvc/GenelGorev/FavoriEkle',
			data:$('#FavoriForm').serialize(),
			success: function(donen_veri){
			$('#FavoriForm').trigger("reset");				
					
		$('#FavoriMevcut').html('<div class="alert alert-success text-center">FAVORİYE EKLENDİ</div>');	
				
			}
		});
			
		
        
    });
	
	
	
	
	$('#GuncelForm input[type="button"]').click(function() {
		
		var id=$(this).attr('data-value');
		
		
		var adet=$('#GuncelForm input[name="adet'+id+'"]').val();
		
		
		$.post("http://localhost/mvc/GenelGorev/UrunGuncelle",{"urunid":id,"adet":adet},function() {
			
		window.location.reload();
		
	});	
		
		
		
	});
	
	
	//--------------------------------------------------------------------------
	
	
		$('#GuncelButonlarinanasi input[type="button"]').click(function() {
		
		var id=$(this).attr('data-value');
		
		
		var textArea=$("<textarea id='"+id+"' name='yorum' style='width:100% height:200px' />");
		
		
		textArea.val($(".sp"+id).html());
		$(".sp"+id).parent().append(textArea);
		$(".sp"+id).remove();
		input.focus();
		
		
	
		
		
	});
	
	
	$(document).on('blur' ,'textarea[name=yorum]',function() {
		
		$(this).parent().append($('<span/>').html($(this).val()));
		var id=$(this).attr("id");
		$(this).remove();
		
		
		
		
		$.post("http://localhost/mvc/uye/YorumGuncelle",{"yorumid":id,"yorum":$(this).val()},function(donen) {
			
			//alert(donen);
			
		window.location.reload();
		
	});		
	
		
		
	});
	
	
//---------------------------------------------------------------------------

$('#AdresGuncelButonlarinanasi input[type="button"]').click(function() {
		
		var id=$(this).attr('data-value');
		
		
		var textArea=$("<textarea id='"+id+"' name='adres' style='width:100%; height:100%;' />");
		
		
		textArea.val($(".adresSp"+id).html());
		$(".adresSp"+id).parent().append(textArea);
		$(".adresSp"+id).remove();
		input.focus();
		
	
		
		
	});
	
	
	$(document).on('blur' ,'textarea[name=adres]',function() {
		
		$(this).parent().append($('<span/>').html($(this).val()));
		var id=$(this).attr("id");
		$(this).remove();
		
		
		
		
		$.post("http://localhost/mvc/uye/AdresGuncelle",{"adresid":id,"adres":$(this).val()},function(donen) {
			
			//alert(donen);
			
		window.location.reload();
		
	});		
	
		

		
		
	});	
	
	
	
	var ad,soyad,mail,telefon;
	
	
	$('.Bilgitercih input[name="bilgiTercih"]').on('change',function() {
		
	
		
		var gelenTercih=$(this).val(); // 0-1
		
		if (gelenTercih==1) 		
		{
			ad=$('input[id=sipAd]').val();
			soyad=$('input[id=sipSoyad]').val();
			mail=$('input[id=sipMail]').val();
			telefon=$('input[id=sipTlf]').val();
			
			
			 $('input[id=sipAd]').val("");
			 $('input[id=sipSoyad]').val("");
			 $('input[id=sipMail]').val("");
			 $('input[id=sipTlf]').val("");
			
		}
		
		else {
			
			 $('input[id=sipAd]').val(ad);
			 $('input[id=sipSoyad]').val(soyad);
			 $('input[id=sipMail]').val(mail);
			 $('input[id=sipTlf]').val(telefon);	
			
		}
	
		
	});
	
	
	/* SMS İŞLEMLERİ İÇİN GRUPLAR VE ŞABLONLAR */ 
	
		// GRUPLAR İLE İLGİLİ KODLAR
	
	$('#gruplar select').on('change',function() { 

		var secilendeger= $(this).val();
		var grupad = $(this).children('option:selected').attr("data-value");
		var tabload = $(this).attr("data-value");
		
		
		if (grupad!=null) {
		
		$('#grupislem').html('<div class="row"><div class="col-lg-8 col-xl-8 col-md-8 col-sm-8"><form id="grupguncelle"><input name="grupad" class="form-control" value="'+grupad+'"><input name="grupid" type="hidden" value="'+secilendeger+'"><input name="tabload" type="hidden" value="'+tabload+'"></div><div class="col-lg-2 col-xl-2 col-md-2 col-sm-2"><input type="button" id="grupguncelbtn" class="btn btn-success btn-sm mt-1" value="Güncelle"></form></div><div class="col-lg-2 col-xl-2 col-md-2 col-sm-2"><input type="button" class="btn btn-danger btn-sm mt-1" id="grupsilbtn" value="Sil" data-value="'+secilendeger+'" data-value2="'+tabload+'"></div></div>');	
			
		
		}
		else {
		$('#grupislem').html('İŞLEM SEÇİNİZ');
		
		}
		
		
		});
		
		
		

		
	$(document).on("click","#grupguncelbtn",function() {
		
	$.ajax({
			type:"POST",
			url:'http://localhost/mvc/GenelGorev/grupadguncelle',
			data:$('#grupguncelle').serialize(),
			success: function(donen_veri){
			$('#grupguncelle').trigger("reset");		
				
			$('#grupislem').html(donen_veri);		
			
		
			}
		});
			
		
        
    });
	
	$(document).on("click","#grupsilbtn",function() {
	
		var id=$(this).attr('data-value');
		var tabload=$(this).attr('data-value2');
		
$.post("http://localhost/mvc/GenelGorev/grupadsil",{"grupid":id,"tabload":tabload},function(donen) {
			
		$('#grupislem').html(donen);	
		
	});	
			
		
        
    });
	
	
		$("#grupekle").on("click",function() {
		var tabload = $(this).attr("data-value");
		
			$('#grupislem').html('<div class="row"><div class="col-lg-8 col-xl-8 col-md-8 col-sm-8"><form id="grupekleform" name="ekleme"><input name="grupad" type="text" class="form-control"><input name="tabload" type="hidden" value="'+tabload+'"></div><div class="col-lg-4 col-xl-4 col-md-4 col-sm-4"><input type="button" id="grupeklebtn" class="btn btn-success btn-sm mt-1 btn-block" value="Ekle"></form></div></div>');			
		
        
       });
	  
	    
	   $(document).on("click","#grupeklebtn",function() {
	 		
		$.ajax({
			type:"POST",
			url:'http://localhost/mvc/GenelGorev/grupekleme',
			data:$('#grupekleform').serialize(),
			success: function(donen_veri){
			$('#grupekleform').trigger("reset");		
				
			$('#grupislem').html(donen_veri);		
			
			}
		});
			
		
        
    });
	
	
	
		// GRUPLAR İLE İLGİLİ KODLAR
		
		
		// ŞANLONLAR İLE İLGİLİ KODLAR
	
	$('#sablonlar select').on('change',function() { 

		var secilendeger= $(this).val();
		var sablonad = $(this).children('option:selected').attr("data-value");
		var sablonicerik = $(this).children('option:selected').attr("data-value2");
		var tabload = $(this).attr("data-value");
		if (sablonad!=null) {
		
		$('#sablonislem').html('<div class="row"><div class="col-lg-8 col-xl-8 col-md-8 col-sm-8"><form id="sablonguncelleform"><input name="sablonad" class="form-control" value="'+sablonad+'"><input name="sablonid" type="hidden" value="'+secilendeger+'"><input name="tabload" type="hidden" value="'+tabload+'"><textarea class="form-control mt-2" rows="8" name="sablonicerik">'+sablonicerik+'</textarea></div><div class="col-lg-2 col-xl-2 col-md-2 col-sm-2"><input type="button" id="sablonguncelbtn" class="btn btn-success btn-sm mt-1" value="Güncelle"></form></div><div class="col-lg-2 col-xl-2 col-md-2 col-sm-2"><input type="button" class="btn btn-danger btn-sm mt-1" id="sablonsilbtn" value="Sil" data-value="'+secilendeger+'" data-value2="'+tabload+'"></div></div>');	
			
		
		}
		else {
		$('#sablonislem').html('İŞLEM SEÇİNİZ');
		
		}
		
		
		});
		
		
		

		
	$(document).on("click","#sablonguncelbtn",function() {
		
	$.ajax({
			type:"POST",
			url:'http://localhost/mvc/GenelGorev/sablonguncelle',
			data:$('#sablonguncelleform').serialize(),
			success: function(donen_veri){
			$('#sablonguncelleform').trigger("reset");		
				
			$('#sablonislem').html(donen_veri);		
			
		
			}
		});
			
		
        
    });
	
	$(document).on("click","#sablonsilbtn",function() {
	
		var id=$(this).attr('data-value');
		var tabload=$(this).attr('data-value2');
$.post("http://localhost/mvc/GenelGorev/sablonsil",{"sablonid":id,"tabload":tabload},function(donen) {
			
		$('#sablonislem').html(donen);	
		
	});	
	
	

			
		
        
    });
	
	
		$("#sablonekle").on("click",function() {
			var tabload = $(this).attr("data-value");
			
			$('#sablonislem').html('<div class="row"><div class="col-lg-8 col-xl-8 col-md-8 col-sm-8"><form id="sablonekleform"><input name="sablonad" class="form-control" ><input name="tabload" type="hidden" value="'+tabload+'"><textarea class="form-control mt-2" rows="8" name="sablonicerik"></textarea></div><div class="col-lg-2 col-xl-2 col-md-2 col-sm-2"><input type="button" id="sabloneklebtn" class="btn btn-success btn-sm mt-1" value="EKLE"></form></div></div>');		
		
        
       });
	  
	    
	   $(document).on("click","#sabloneklebtn",function() {
	 		
		$.ajax({
			type:"POST",
			url:'http://localhost/mvc/GenelGorev/sablonekleme',
			data:$('#sablonekleform').serialize(),
			success: function(donen_veri){
			$('#sablonekleform').trigger("reset");		
				
			$('#sablonislem').html(donen_veri);		
			
			}
		});
			
		
        
    });	
	
	
		// ŞABLONLAR İLE İLGİLİ KODLAR	
		
		// ŞABLON SEÇME KODLARI
		
		$('select[name="sablonsec"]').on('change',function() {
		$('textarea[name="metin"]').val("");
		$('textarea[name="metin"]').val($('select[name="sablonsec"] option:selected').attr("data-value"));

		
		});
		
		// ŞABLON SEÇME KODLARI
		// GRUP  SEÇME KODLARI
		
		$('select[name="grupsec"]').on('change',function() {
		var gelenid= $(this).val();
		var sutunad = $(this).attr("data-value");
		
		$.post("http://localhost/mvc/GenelGorev/grupcek",{"grupid":gelenid,"sutunad":sutunad},function(donen) {
		
		
		$('textarea[name="numaralar"]').append(donen);		
		
		
		});	
	
		
		});
		
		// GRUP  SEÇME KODLARI	
		
		
		$(document).on("click","#bultenmailgetir",function() {
	 		
		$.post("http://localhost/mvc/GenelGorev/bultenmailgetir",{"durum":"ok"},function(donen) {
		
		
		$('textarea[name="numaralar"]').append(donen);
			
		
		
			});	
			
		
        
		});	
		
		// TOPLU NUMARA EKLEME KODLARI
		$('.numaraeklemebilgi').hide();
		$('.maileklemebilgi').hide();
		
	$("#numaraeklebtn").click(function(e) {
	
		e.preventDefault();
		
		var formData= new FormData($("#toplunumaraform")[0]);	
	
	
			$.ajax({
			beforeSend: function() {
			$('.numaraeklemebilgi').append("Yükleme Başlıyor<br>").show();		
			
			},			
			type:"POST",
			url:'http://localhost/mvc/GenelGorev/toplunumaraekleme',			
			enctype: 'multipart/form-data',	
			processData:false,
			contentType:false,
			data:formData,
			}).done (function(donen_veri) {
			$('#toplunumaraform').trigger("reset");	
			$('.numaraeklemebilgi').append("Yüklendi<br>");	
			$('textarea[name="numaralar"]').append(donen_veri);
			$('.numaraeklemebilgi').html("").hide();		
			});
			
		});	
		
		
		// TOPLU NUMARA EKLEME KODLARI
		
	/* SMS İŞLEMLERİ İÇİN GRUPLAR VE ŞABLONLAR */ 
	
		$(document).on("click","#zamanligonder",function() {	
		
		$('body textarea').prop("disabled",true);
		$('body select').prop("disabled",true);
		$('body input').prop("disabled",true);
		$('body button').prop("disabled",true);
		
		
		var mailler2=$('textarea[name="numaralar"]').val().split('\n');
		var metin=$('textarea[name="metin"]').val();
		var baslik=$('input[name="baslik"]').val();
		var zaman = $("select[name='zamansec']").children('option:selected').val();
		
		$('#stop').html('<input type="button" class="btn btn-danger btn-sm" value="DURDUR" id="otomatikdurdur">');	
		
		$('#otomatikmailsonuc').html('<span class="text-dark"><img src="http://localhost/mvc/views/design/images//load.gif" width="40" height="40"  class="m-1"> İŞLEM SÜRÜYOR</span>');	
					
		
		
		
		var mailler=$.map(mailler2,function(veri){
		
			return veri !=='' ? veri : null;
		});
		
		
		var deger=0;
		var logkaydi="";
		var olumlu=0;
		var olumsuz=0;
		var donen;
		
		
		var otomatikmail = setInterval(function(){	
		
		donen="";
				
	$.post("http://localhost/mvc/GenelGorev/mailgonderme",{"mail":mailler[deger],"baslik":baslik,"metin":metin},function(donen) {
		
		logkaydi+=mailler[deger]+"-"+donen;
		
		if (donen=="ok") {
		
		olumlu++;
		}
		else {
		
		olumsuz++;
		}

		
	});
				
					
		deger++;
		
							
					if (deger > mailler.length) {
					clearInterval(otomatikmail);
					
					$('#otomatikmailsonuc').html('<div class="alert alert-danger">Mail Sonuç: Olumlu :'+olumlu+' Olumsuz :'+olumsuz+'</div>');	
					
					}
					
		},zaman);
		
		
		$(document).on("click","#otomatikdurdur",function() {
			
				clearInterval(otomatikmail);
				$('#otomatikmailsonuc').html('<div class="alert alert-danger">Mail gönderimi durduruldu: Olumlu :'+olumlu+' Olumsuz :'+olumsuz+'</div>');	
				
				$('body textarea').prop("disabled",false);
				$('body select').prop("disabled",false);
				$('body input').prop("disabled",false);
				$('body button').prop("disabled",false);
			
			});	
		
			
		
        
		});		
		
			





		
});

function VarsayilanYap(deger,deger2) {	
		
		$.post("http://localhost/mvc/GenelGorev/VarsayilanAdresYap",{"uyeid":deger,"adresid":deger2},function() {
			
	$.post("http://localhost/mvc/GenelGorev/VarsayilanAdresYap2",{"uyeid":deger,"adresid":deger2},function() {
			
			window.location.reload();
	
		
		});	
	
		
		});	
		

		
	}	
	
function uyeyorumkontrol(yorumid,kriter) {	


		
	$.post("http://localhost/mvc/GenelGorev/uyeyorumkontrol",{"yorumid":yorumid,"kriter":kriter},function() {
			
			window.location.reload();
	
		
		});			

		
	}	

function UrunSil(deger,kriter) {
	
	switch  (kriter) {
		
		
		case "sepetsil":
		$.post("http://localhost/mvc/GenelGorev/UrunSil",{"urunid":deger},function() {
		
		window.location.reload();
		
		});	
		
		
		break;
		
		
		
		
		
		case "yorumsil":
		
		
		
		$.post("http://localhost/mvc/uye/Yorumsil",{"yorumid":deger},function(donen) {
			
			
			
			if (donen)  {				
				$("#Sonuc").html("Yorum başarıyla silindi.");				
			}
			else
			{
				$("#Sonuc").html("Silme işleminde hata oluştu.");
					
			}
		
				$("#Sonuc").fadeIn(1000,function() {
						
						$("#Sonuc").fadeOut(1000,function() {
							$("#Sonuc").html("");
							window.location.reload();				
					
						});
				
				
					
				});
		
		
		
		});	
		
		
		break;
		
		case "adresSil":
		$.post("http://localhost/mvc/uye/adresSil",{"adresid":deger},function(donen) {
		
		
			if (donen)  {				
				$("#Sonuc").html("Adres başarıyla silindi.");				
			}
			else
			{
				$("#Sonuc").html("Silme işleminde hata oluştu.");
					
			}
		
				$("#Sonuc").fadeIn(1000,function() {
						
						$("#Sonuc").fadeOut(1000,function() {
							$("#Sonuc").html("");
							window.location.reload();				
					
						});
				
				
					
				});
		
		
		
		
		
		});	
		
		
		break;
		
		
		case "FavoriSil":
		$.post("http://localhost/mvc/GenelGorev/FavoriSil",{"id":deger},function() {
		
		window.location.reload();
		
		});	
		
		
		break;
		
		
	
	
		
	}
	
	
	
	
	
}




function silmedenSor (gidilecekLink) {
	
  swal({
  title: "Silmek istediğine emin misin?",
  text: "Silinen kayıt geri alınamaz.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
     window.location.href =  gidilecekLink; 
  } else {
    swal({title:"Silme işleminden vazgeçtiniz", icon: "warning",});
  }
});
	
}

$(document).ready(function() {
 function BilgiPenceresi(linkAdres,sonucbaslik,sonucmetin,sonuctur) {
	
	 swal(sonucbaslik, sonucmetin, sonuctur, {
  buttons: {
    
    catch: {
      text: "KAPAT",
      value: "tamam",
    }
  },
})
.then((value) => {
if (value=="tamam") {
   window.location.href =  linkAdres;
  }		
  
});
	
}
});




