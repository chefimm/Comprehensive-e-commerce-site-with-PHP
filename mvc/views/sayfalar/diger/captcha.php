<?php

session_start(); 



if ($_GET["tur"]=="auto") :

$rand=array("topla","cikar","varsayilan");
$gelen=array_rand($rand,1);
$deger=$rand[$gelen];

else:

$deger=$_GET["tur"];

endif;


switch ($deger) :

case "topla":

$sayi1=mt_rand(1,40);  // 14
$sayi2=mt_rand(1,30);   // 6
$_SESSION["kod"]=$sayi1+$sayi2;
$kod=$sayi1."+" .$sayi2 . "= ?";
break;

case "cikar":

$sayi1=mt_rand(1,99);  
$sayi2=mt_rand(1,$sayi1);  
$_SESSION["kod"]=$sayi1-$sayi2;
$kod=$sayi1."-" .$sayi2 . "= ?";
break;


case "varsayilan":

$kod=substr(md5(mt_rand(0,99999999)),0,6); // bu değeri session olarak atayacağım

$_SESSION["kod"]=$kod;

break;

endswitch;





header('Content-type: image/png');

$resim = imagecreate(100,50);

$arka_renk=imagecolorallocate($resim,245,197,32); // sarı yaptık

$yazi_renk=imagecolorallocate($resim,30,28,28); // siyah yaptık

$cizgi_renk=imagecolorallocate($resim,rand(0,225),rand(0,225),rand(0,225)); 

for ($i=0; $i<8; $i++) :

imageline($resim,0,rand()%95,200,rand()%95,$cizgi_renk);

endfor;

$nokta_renk=imagecolorallocate($resim,0,0,255); 

for ($i=0; $i<300; $i++) :

imagesetpixel($resim,rand()%100,rand()%50,$nokta_renk);

endfor;


imagestring($resim,35,20,20,$kod,$yazi_renk);
imagepng($resim);
imagedestroy($resim);



?>