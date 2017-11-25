<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>	
</head>
<body>

<div id="container">
	<h1>Merhaba Dünya!</h1>

<form role="form" action="<?php echo base_url("welcome/update_kullanici/$kullnaicilar->id") ?>" method="post">
	
  <input type="text" name="kullanici_adi" value="<?php echo $kullnaicilar->k_ad?>"> <br>

  <input type="text" name="kullanici_soyadi" value="<?php echo $kullnaicilar->k_soyad  ?>"> <br>
 <button type="submit" >Güncelle</button>

</form>
</div>
<br><br>


</body>
</html>