<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>

<div id="container">

 <div >
 	<form role="form" enctype="multipart/form-data" method="post" action="<?php echo base_url("welcome/add/$id");?>">
                    <label class="" for="first-name">Resim Seç<span class="required">*</span>
                    </label>
                    <input type="file"  required="required" name="resim" >
         <button type="submit" >Ekle</button>

                </form>
                </div>
</div>

</body>
</html>