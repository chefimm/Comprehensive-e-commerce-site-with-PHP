<?php $Harici= new HariciFonksiyonlar();  $PanelHarici = new PanelHarici();   ob_start();  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

 <title>MVC | E-Commerce | KONTROL PANELİ</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo URL; ?>/views/YonPanel/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<script src="<?php echo URL; ?>/views/design/js/jquery.min.js"></script>
<script src="<?php echo URL; ?>/views/design/js/bizim.js"></script>
  <!-- Custom styles for this template-->
  <link href="<?php echo URL; ?>/views/YonPanel/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo URL; ?>/views/YonPanel/css/bizim.css" rel="stylesheet">
  
   <script src="<?php echo URL; ?>/views/YonPanel/js/sweetalert.js"></script>
     <script src="<?php echo URL; ?>/views/YonPanel/js/jscolor.js"></script>
<script>

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
</script>
 
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">	 
	 
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-mvc sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo URL."/panel/siparisler"; ?>">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-store"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MVC Ticaret</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      
     <?php $PanelHarici->MenuKontrol(); ?> 

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
	
	  
	  


      

       