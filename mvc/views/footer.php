  
<!-- The modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="modalLabel">Teslimat adresi ve kişisel bilgiler</h4>
</div>
<div class="modal-body">
Modal content...
</div>

</div>
</div>
</div>

</div>
  
        
        
        <div class="footer">
		<div class="container">
		 <div class="footer_top">
			<div class="span_of_4">
				<div class="col-md-3 span1_of_4">
                
           

                               
					<h4>En Çok Satanlar</h4>
					<ul class="f_nav">
                    
                         <?php
				
			
				foreach ($Harici->encoksatan as $deger):
		
	
				
echo '<li><a href="'.URL.'/urunler/detay/'.$deger["id"].'/'.$Harici->seo($deger["urunad"]).'">'.$deger["urunad"].'</a></li>';
				
				
				endforeach;
				
				
				?>
                    
                    
								
					</ul>	
				</div>
				<div class="col-md-3 span1_of_4">
					<h4>Yardım</h4>
					<ul class="f_nav">
<li><a href="<?php echo URL;?>/sayfalar/kargonezamangelir">Kargo ne zaman gelir</a></li>
<li><a href="<?php echo URL;?>/sayfalar/iadehakki">İade hakkı</a></li>
<li><a href="<?php echo URL;?>/sayfalar/musterihizmetleri">Müşteri hizmetleri</a></li>
<li><a href="<?php echo URL;?>/sayfalar/gizlilikpolitikasi">Gizlilik politikası</a></li>
<li><a href="<?php echo URL;?>/sayfalar/satissozlesmesi">Satış sözleşmesi</a></li>
<li><a href="<?php echo URL;?>/sayfalar/iletisim">Bize Ulaşın</a></li>
					</ul>	
				</div>
				<div class="col-md-3 span1_of_4">
					<h4>Stoğu Azalanlar</h4>
					<ul class="f_nav">
                    
                                         <?php
				
			
				foreach ($Harici->stoguazalan as $deger):
		
	
				
echo '<li><a href="'.URL.'/urunler/detay/'.$deger["id"].'/'.$Harici->seo($deger["urunad"]).'">'.$deger["urunad"].'</a></li>';
				
				
				endforeach;
				
				
				?>  
                    
                    
            
					</ul>					
				</div>
				<div class="col-md-3 span1_of_4">
					<h4>Rastgele Kategoriler</h4>
					<ul class="f_nav">
                    
                    
                      <?php				
			
				foreach ($Harici->populerkategori as $deger):		
				
echo '<li><a href="'.URL.'/urunler/kategori/'.$deger["id"].'/'.$Harici->seo($deger["ad"]).'">'.$deger["ad"].'</a></li>';
				
				
				endforeach;
				
				
				?>  
                    
				
					</ul>			
				</div>
				<div class="clearfix"></div>
				</div>
		  </div>
		  <div class="cards text-center">
				<img src="images/cards.jpg" alt="" />
		  </div>
		  <div class="copyright text-center">
				<p>© 2022 Eshop. All Rights Reserved | Design by   <a href="http://w3layouts.com">  W3layouts</a><br />Mehmet Mert Combaş</p>
		  </div>
		</div>
		</div>
</body>
</html>

<?php

$cache->cacheOlustur();




?>
