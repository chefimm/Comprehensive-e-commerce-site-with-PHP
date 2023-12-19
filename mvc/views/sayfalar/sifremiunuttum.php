<?php require 'views/header.php'; ?>


<?php if (!Session::get("kulad") && !Session::get("uye")) : ?>

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
                      Şifremi unuttum
                    </li>
                </ul>
                <ul class="previous">
                	<li><a href="<?php echo URL; ?>">Geri Dön</a></li>
                </ul>
                <div class="clearfix"></div>
			   </div>
			              <?php
								
								
								
								if (isset($veri["Bilgi"])) :
								
								echo $veri["Bilgi"];
								
								endif;
				
			   
			   ?>
			   
			   <div class="account_grid text-center">
			     <div class="col-md-3 login-right wow fadeInRight" data-wow-delay="0.4s">
			   </div>
			   <?php 
			   
			   if (isset($veri["kodgirme"])):
			  ?>
			   
			   	   <div class="col-md-6 login-right wow fadeInRight sifrecerceve" data-wow-delay="0.4s">
			  	<h3>KODU DOĞRULAMA</h3>
				
                <?php
		
				 Form::Olustur("1",array(
					 "action" => URL."/uye/sifresifirlama/dogrulama",
					 "method" => "POST"				
					 )); 
				?>
				
				  <div>
					<span>KODU GİRİNİZ</span>
<?php Form::Olustur("2",array("type"=>"text","name"=>"kod","required"=>"required")); ?>       
                    
			
				  </div>

                  				 
                  
<?php
 Form::Olustur("2",array("type"=>"submit","value"=>"DOĞRULA"));
 
 Form::Olustur("kapat"); 
?>     
                  
            
			   </div>	
			   
			   <?php
			   
			     elseif (isset($veri["koddurum"])):
			  ?>
			   
			   	   <div class="col-md-6 login-right wow fadeInRight sifrecerceve" data-wow-delay="0.4s">
			  	<h3>SIFIRLAMA EKRANI</h3>
				
                <?php
				
				if (!Session::get("denemehakki")) :
					Session::set("denemehakki",1);				
				endif;
			
				 Form::Olustur("1",array(
					 "action" => URL."/uye/sifresifirlama/sifredegistir",
					 "method" => "POST"				
					 )); 
				?>
				
				  <div>
					<span>Şifreleri belirleyin</span>
<?php Form::Olustur("2",array("type"=>"password","name"=>"sifre1","required"=>"required","placeholder"=>"Yeni Şifre")); 
Form::Olustur("2",array("type"=>"password","name"=>"sifre2","required"=>"required","placeholder"=>"Yeni Şifre Tekrar")); ?>       
                    
			
				  </div>

                			 
                  
<?php
 Form::Olustur("2",array("type"=>"submit","value"=>"ŞİFRE DEĞİŞTİR"));
 
 Form::Olustur("kapat"); 
?>     
                  
            
			   </div>	
			   
			   <?php
			   
			   else:
			   ?>
			   
			   	   <div class="col-md-6 login-right wow fadeInRight sifrecerceve" data-wow-delay="0.4s">
			  	<h3>ŞİFREMİ UNUTTTUM</h3>
				<div class="alert alert-info">Mail adresinizi yazarak şifrenizi sıfırlayabilirsiniz.<br> Şifrenize doğrulama kodu gönderilecektir.</div>
                <?php
				
				 Form::Olustur("1",array(
					 "action" => URL."/uye/sifresifirlama/son",
					 "method" => "POST"				
					 )); 
				?>
				
				  <div>
					<span>Mail Adresiniz</span>
<?php Form::Olustur("2",array("type"=>"text","name"=>"mailadres","required"=>"required","placeholder"=>"Mail adresinizi yazınız")); ?>       
                    
			
				  </div>

				 
                  
<?php
 Form::Olustur("2",array("type"=>"submit","value"=>"ŞİFREMİ SIFIRLA"));
 
 Form::Olustur("kapat"); 
?>     
                  
            
			   </div>	
			   
			   <?php
			   endif;
			   ?>
			   
		
			   
			    <div class="col-md-3 login-right wow fadeInRight" data-wow-delay="0.4s">
			   </div>
			   <div class="clearfix"> </div>
			 </div>
		   </div>
</div>


<?php
else:
	
	header("Location:".URL);
	
	endif;
?>


<?php require 'views/footer.php'; ?> 		
        
        
        
       