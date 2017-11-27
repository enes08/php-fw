<!DOCTYPE html>
<html lang="en">
<head>


  <meta charset="utf-8">
  <title>Welcome to CodeIgniter</title> 

   <script src="<?php echo base_url("assets/jquery.min.js")?>"></script>
<script src="<?php echo base_url("assets/jquery.fancybox-1.3.4.js")?>"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/jquery.fancybox-1.3.4.css")?>" media="screen">
<script type="text/javascript">
  $(document).ready(function() {  
        //https://github.com/fancyapps/fancyBox
         $(".fancybox").fancybox({


        });
  
  });
  </script>


	
</head>
<body>

<div id="container">
	<h1>Merhaba Dünya!</h1>

<form role="form" action="<?php echo base_url("welcome/add_Kullanici") ?>" method="post">
	
  <input type="text" name="kullanici_adi"> <br>

  <input type="text" name="kullanici_soyadi"> <br>
 <button type="submit" >Gönder</button>

</form>
</div>
<br><br>
<div>
	

	<?php foreach ($kullnaicilar as $kbilgi) {	
		 ?>
		 <li> 

 <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url("resim") . "/" .$kbilgi->resim_url ?>">
		 	<img 
               width="80"
         src="<?php echo base_url("resim") . "/" .$kbilgi->resim_url ?>"> 

         </a>     
<div><?php echo $kbilgi->k_ad." ".$kbilgi->k_soyad  ?> <a href="<?php echo base_url("welcome/delete_kullanici/$kbilgi->id") ?>">Sil</a>| <a href="<?php echo base_url("welcome/update_kullaniciPage/$kbilgi->id") ?>">Güncelle</a>|
          <a href="<?php echo base_url("welcome/newresim/$kbilgi->id") ?>">Resim Ekle</a>
</div>
	  	
	  </li>
     
<?php } ?>
</div>


 
</body>
</html>