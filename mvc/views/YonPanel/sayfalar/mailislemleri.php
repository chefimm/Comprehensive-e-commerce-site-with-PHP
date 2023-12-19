<?php require 'views/YonPanel/header.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid mt-3">

          <!-- Page Heading -->
          

          <div class="row">
      <div class="col-xl-12 col-md-12 mb-12 text-center"> 
      
     
       
    
      
      <?php 

	  
	  
	  	if (isset($veri["Bilgi"])) :
				
				
						if (is_array($veri["Bilgi"])) :
						
						?>
						 <script>
						 
		 BilgiPenceresi("<?php echo $veri["Bilgi"]["adres"]; ?>"," <?php echo $veri["Bilgi"]["baslik"]; ?>", "<?php echo $veri["Bilgi"]["metin"]; ?>","<?php echo $veri["Bilgi"]["durum"]; ?>");
		  </script>
					<?php	
					
						
						else:
						
						echo $veri["Bilgi"];
						endif;
				
				
				
				endif;
	  
	  if (isset($veri["gruplar"])) :

	
	  ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> MAİL YÖNETİMİ  </h1></div>
              
 
          </div>
          <!-- BAŞLIK --> 	
      
         
     <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-lg-10 col-xl-10 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>Mail İşlemleri Yönetimi</h3></div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12">
                    		<div class="row">
                           			 <!-- SOL -->
                            		<div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 bloklararasi">
                                    		<div class="row">
 					<div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2"> <i class="fas fa-plus" id="grupekle" data-value="pazarlama_mail_gruplar"></i> Gruplar</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger" id="gruplar">
                        	 <?php 	
					 
								
 	 Form::OlusturSelect("1",array("class"=>"form-control","name"=>"gruplar","data-value"=>"pazarlama_mail_gruplar"));
	
	  Form::OlusturOption(array("value"=>"0"),false,"Seçiniz");
	  
	 foreach ($veri["gruplar"] as $deger):
	 
	  Form::OlusturOption(array("value"=>$deger["id"],"data-value"=>$deger["ad"]),false,$deger["ad"]);
	 
	 endforeach;
	 
	 
	 Form::OlusturSelect("2",null);	  
					 
					 
					  ?>
                    
                    </div>
                    
                   	<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlar mt-2 text-danger" id="grupislem">İŞLEM SEÇİNİZ
					
					
					</div>
					
           
                    
					
					<div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 uruneklemeElemanlar mt-2"> <i class="fas fa-plus" id="sablonekle" data-value="pazarlama_mail_sablonlar"></i> Şablonlar</div>
                    <div class="col-lg-5 col-xl-5 col-md-5 col-sm-12 uruneklemeElemanlarDiger" id="sablonlar">
                        	 <?php 	
					 
								
 	  Form::OlusturSelect("1",array("class"=>"form-control","name"=>"sablonlar","data-value"=>"pazarlama_mail_sablonlar"));
	
	  Form::OlusturOption(array("value"=>"0"),false,"Seçiniz");
	 foreach ($veri["sablonlar"] as $deger):
	 
	  Form::OlusturOption(array("value"=>$deger["id"],"data-value"=>$deger["ad"],"data-value2"=>$deger["icerik"]),false,$deger["ad"]);
	 
	 endforeach;
	 
	 
	 Form::OlusturSelect("2",null);	     	 
					 
					 
					  ?>
                    
                    </div>
                    
                      	<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlar mt-2 text-danger" id="sablonislem">İŞLEM SEÇİNİZ</div>
						
						
						<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlar mt-2 " >TOPLU MAİL EKLE</div>
						
						<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlar mt-2" id="mailislem">
	  <?php 
  
   Form::Olustur("1",array("id" => "toplunumaraform"));
   Form::Olustur("2",array("type"=>"file","name"=>"numaralar"));
   Form::Olustur("2",array("type"=>"button","value"=>"YÜKLE","class"=>"btn btn-success","id"=>"numaraeklebtn")); 
   Form::Olustur("kapat");
  
  
  ?> 					
						
						
					<div class="maileklemebilgi alert alert-info"></div>	
						</div>
					
                
			     
                    
            								</div>
                                 
                                    
                                    
                                    </div>
                            		 <!-- SOL -->
                                     
                                      <!-- SAĞ -->
                           			 <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 ">
                                     	<div class="row">
                                        
                                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
										<div class="row">
								 <div class="col-lg-7 col-xl-7 col-md-7 col-sm-7  pt-2"><span class="btn btn-primary btn-sm float-left" id="bultenmailgetir">Bülteni getir</span> Mailler </div>
								 <div class="col-lg-5 col-xl-5 col-md-5 col-sm-5 ">					               	 <?php 	
					 
								
 	 Form::OlusturSelect("1",array("class"=>"form-control","name"=>"grupsec","data-value"=>"mailgrup"));
	
	  Form::OlusturOption(array("value"=>"0"),false,"Grup Seçiniz");
	 foreach ($veri["gruplar"] as $deger):
	 
	  Form::OlusturOption(array("value"=>$deger["id"]),false,$deger["ad"]);
	 
	 endforeach;
	 
	 
	 Form::OlusturSelect("2",null);	  
					 
					 
					  ?></div>
										
										</div>
										
										
										
					
										
										</div>
         <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
  <?php 
  
   Form::Olustur("1",array(
					 "action" => URL."/panel/mailgonderme",
					 "method" => "POST"				
					 ));  
  
  
  Form::Olustur("3",array("class"=>"form-control","name"=>"numaralar","rows"=>6),"");  ?> 
  
  
  
  
  </div>   
         
         
                                                 <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
												
											<div class="row ">
								 <div class="col-lg-7 col-xl-7 col-md-7 col-sm-7 pt-2"> Mail Oluştur</div>
								 <div class="col-lg-5 col-xl-5 col-md-5 col-sm-5 ">				 <?php 	
					 
								
 	  Form::OlusturSelect("1",array("class"=>"form-control","name"=>"sablonsec"));
	
	  Form::OlusturOption(array("value"=>"0"),false,"Şablon Seçiniz");
	 foreach ($veri["sablonlar"] as $deger):
	 
	  Form::OlusturOption(array("value"=>$deger["id"],"data-value"=>$deger["icerik"]),false,$deger["ad"]);
	 
	 endforeach;
	 
	 
	 Form::OlusturSelect("2",null);	     	 
					 
					 
					  ?>	</div>
										
										</div> 
												 
												 </div>
		  <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger">
		  
		  <div class="row">	
		  
		  		<div class="col-lg-3 col-xl-3 col-md-3 col-sm-3 pt-2">
				Mail Başlığı
				
				</div>
				
				<div class="col-lg-9 col-xl-9 col-md-9 col-sm-9">
				<?php 
					  Form::Olustur("2",array("class"=>"form-control","name"=>"baslik","type"=>"text"));

					 ?>
				
				</div>
		  
		  </div>
		  
		   </div> 										 
												 
         <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeElemanlarDiger"> <?php 
		  
		 
		 Form::Olustur("3",array("class"=>"form-control","name"=>"metin","rows"=>6),""); 
		 
		 
		 ?> </div> 
         
                                                 
                                        
                                     
                                     </div>
                                     </div>
                            			 <!-- SAĞ -->
                            
                            </div> <!-- İÇ ROW --></div> <!-- İÇ ANASI -->
                    
                    
         
                    
                      
              
          <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 uruneklemeBtn">
		  
		  	<div class="row">
					<div class="col-lg-5 col-xl-5 col-md-5 col-sm-5" id="otomatikmailsonuc">
					
							
			
					 
					</div>
					
					<div class="col-lg-3 col-xl-3 col-md-3 col-sm-3">
					<?php 
 Form::Olustur("2",array("type"=>"submit","value"=>"MAİL GÖNDER","class"=>"btn btn-success"));		
			 
Form::Olustur("kapat");
					?>
					</div>
					
					<div class="col-lg-4 col-xl-4 col-md-4 col-sm-4">
						<div class="row">
						
								<div class="col-lg-3 col-xl-3 col-md-3 col-sm-3" id="stop"> 
								
								</div>
						
							<div class="col-lg-3 col-xl-3 col-md-3 col-sm-3">
							<?php 
					   
	  Form::OlusturSelect("1",array("class"=>"form-control","name"=>"zamansec"));
	
 		Form::OlusturOption(array("value"=>"10000"),false,"10");	
		Form::OlusturOption(array("value"=>"15000"),false,"15");
	 	Form::OlusturOption(array("value"=>"20000"),"selected","20");	
		Form::OlusturOption(array("value"=>"25000"),false,"25");
		Form::OlusturOption(array("value"=>"30000"),false,"30");
		Form::OlusturOption(array("value"=>"60000"),false,"60");
		Form::OlusturOption(array("value"=>"180000"),false,"180");
    Form::OlusturSelect("2",null);	   
					 
				 ?>
							
							</div>
							<div class="col-lg-6 col-xl-6 col-md-6 col-sm-6">		   <?php 
		
	 
	 Form::OlusturSelect("2",null);	  
 Form::Olustur("2",array("type"=>"button","value"=>"ZAMANLI GÖNDER","class"=>"btn btn-dark","id"=>"zamanligonder"));	
					 
				 ?></div>
						</div>
			
					</div>
			
			</div>
		  
        
       
          
          </div>      
                     
             			</div> <!-- ROWWW -->
                        
                        
  
                        
             
             
             </div>
              
 
      			 </div>
         </div>
      
      
      <?php 
	  
	
	  	  
	  endif; 
	  
	?>
	 
	 
	
          
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>