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
					
					/*	foreach ($veri["Bilgi"] as $anahtar => $deger) :
						
						
			echo'<div class="alert alert-danger mt-5">'.$anahtar.'-'.$deger.'</div>';
						
					echo $veri["yonlen"];
						
						endforeach;
						
						echo $veri["Bilgi"]["adres"];*/
						
						else:
						
						echo $veri["Bilgi"];
						endif;
				
				
				
				endif;
	  
	 
	 
	 
	  if (isset($veri["data"])) :  
	  
	   ?>
      <!-- BAŞLIK -->
	      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-lg-2 col-xl-2 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> BÜLTEN  </h1></div>
              
		            
        
     <div class="col-lg-8 col-xl-8 col-md-12 mb-12 text-right">
     	<div class="row">
        
    <div class="col-xl-3 ">
    <?php 
    	  Form::Olustur("1",array(
					 "action" => URL."/panel/tarihegoregetir",
					 "method" => "POST"								
					 ));  
						 
 Form::Olustur("2",array("type"=>"date","name"=>"tar1","class"=>"form-control"));	
			 ?>
    </div>
    
        <div class="col-xl-3 ">
		<?php     	
						 
 Form::Olustur("2",array("type"=>"date","name"=>"tar2","class"=>"form-control"));
			 ?>
    
    </div>  
    
    
    <div class="col-xl-2 ">
    
    <?php 
	
			 Form::Olustur("2",array("type"=>"submit","value"=>"GETİR","class"=>"btn btn-sm btn-mvc btn-block mt-1"));		 
			 Form::Olustur("kapat");
			 ?>
     </div>
        
        	<div class="col-xl-3">
         	  <?php
	
			  Form::Olustur("1",array(
					 "action" => URL."/panel/mailarama",
					 "method" => "POST"				
					 ));  
						 
					 
 Form::Olustur("2",array("type"=>"text","name"=>"arama","class"=>"form-control","placeholder"=>"Mail Adresi Yazın"));		 
					 
	  ?>		
		
  

            </div>
        	<div class="col-xl-1">
                   
         <?php    
             
	 Form::Olustur("2",array("type"=>"submit","value"=>"ARA","class"=>"btn btn-sm btn-mvc btn-block mt-1"));		
			 

					 
			Form::Olustur("kapat");	 ?>
             
             
            </div>
        
        </div>
     
     
    
     </div>   
	 
	 
	       <div class="col-lg-2 col-xl-2 col-md-12 mb-12  text-right">
				  
      
	  
	  <div class="dropdown show">
  <a class="btn btn-sm btn-mvc dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dosya
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="<?php echo URL; ?>/panel/bultenExcelAl"><i class="fas fa-file-export text-dark "></i> Excel</a>
	
	   <a class="dropdown-item" href="<?php echo URL; ?>/panel/bultenTxtAl"><i class="fas fa-file-alt text-dark "></i> Txt</a>
	   	  
   
  </div>
</div>
	  
	  </div>
	 
	 
       
          </div>
          <!-- BAŞLIK --> 	
          
          
              
                
      	<!-- SİPARİŞİN İSKELETİ BAŞLIYOR -->
        		 <div class="row arkaplan p-1 mt-2 pb-0">
                 	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 border-right p-2 pt-3 geneltext bg-gradient-mvc">
					 <div class="row" >
					<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 text-warning text-left pt-2">
					<?php 	 if (isset($veri["tariharama"])) :  
					
					echo "Tarih Sorgulama : ". $veri["tarih1"]."-".$veri["tarih2"]." tarih arasındaki mailler";
					 elseif (isset($veri["arama"])) :  	
					 
					 echo "Aranan kelime : ". $veri["arama"];
					
					endif;?>
							
							</div>
							
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 pt-2">
							    <span>MAİLLER -</span>    Toplam mail sayısı : <?php 
								echo $veri["toplamveri"]; ?>
							
							</div>
							
							<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 text-right">
							
							<input type="button" id="tumunusecbtn" class="btn btn-dark btn-sm" value="SEÇ">
								
							<input type="button" id="tumunukaldirbtn" class="btn btn-dark btn-sm" value="KALDIR">
							<input type="button" id="toplusilbtn" class="btn btn-danger btn-sm" value="TOPLU SİL">
							
							</div>
					 
					 
					 
					 </div>
					
					
					
					
                
                    </div>
                             
                    <!--  ÜRÜNLER-->                  
                                  
                    
                       <?php   foreach ($veri["data"] as $value) : 
           
					
							echo '<div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 mt-2  ">
                                <div class="row m-1 mailcerceve">
								
										<div class="col-xl-2 col-lg-2 col-md-2 col-sm-4 p-1 pt-2">';
										
    Form::Olustur("2",array("type"=>"checkbox","value"=>$value["id"],"name"=>"silme"));	                      
                                        echo'</div>  
										 
                                		 <div class="col-xl-8 col-lg-8 col-md-8 col-sm-4 p-1 pt-1">
                                        '.$value["mailadres"].'
                                         </div>                                     
               
										 
										 
									      <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                              
										 
                                         <a href="'.URL.'/panel/mailSil/'.$value["id"].'" class="fas fa-trash-alt mt-1   silbuton"></a>
                                         </div>
										 
                                
                                </div>
                        
                        </div>';

	
					
					
	  					endforeach;
						
						
						 ?>
                 
                   <!-- -->     
                 
                 
                 </div>
        
      	<!-- SİPARİŞİN İSKELETİ BİTİYOR -->
		
		 <?php
		 if (isset($veri["arama"])) :
		 $link="/panel/mailarama/".$veri["arama"]."/";
		
		 elseif (isset($veri["tariharama"])) :
		 $link="/panel/tarihegoregetir/".$veri["tarih1"]."/".$veri["tarih2"]."/";
		 else:
		 $link="/panel/bulten/";		 
		 endif;
		 
        
		Pagination::numaralar($veri["toplamsayfa"],$link);
        
        endif; ?>  
          
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>