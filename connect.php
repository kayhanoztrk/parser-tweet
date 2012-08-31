<?php

/**
 * @file
 * Check if consumer token is set and if so send user to get a request token.
 */

/**
 * Exit with an error message if the CONSUMER_KEY or CONSUMER_SECRET is not defined.
 */
require_once('config.php');
if (CONSUMER_KEY === '' || CONSUMER_SECRET === '') {
  echo 'You need a consumer key and secret to test the sample code. Get one from <a href="https://twitter.com/apps">https://twitter.com/apps</a>';
  exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	
	<title>TweetParser</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<link rel="stylesheet" href="css/login.css"/>
</head>
<body>
	<!-- Header -->
	<div id="header"><div class="header">
		<div class="yazi">TweetParser</div>
	</div></div>
	<!--#Header -->
	<!-- Genel -->
	<div id="genel">
		
		<!-- Sol -->
		<div id="sol">
			<img src="images/login_sol_resim.png" alt="" class="resim"/>
		</div>
		<!--#Sol -->
		<!-- Sağ -->
		<div id="sag">
		<div class="icerik">
			<span style="font-size: 15px; position: relative; left: 120px">Twitter Api Adına hoşgeldin..</span>
			<p>Merhaba, Twitter Api Adı sizin istediğiniz tarihteki twitlerinizi görmenize olanak sağlar. Twitter hesabınızın dökümanını çıkarır.(Kayıt Tarihi, twit sayısı vs.)Bu sayede istediğiniz tarihte attığınız twittleri rahatça görebilirsiniz.</p>
			<p>Uygulamayı Görebilmek için Twitter’a giriş yapıp Uygulamaya izin ver butonuna tıklamanız gerek. Bunun için aşağıdaki “Uygulamaya İzin Ver” butonuna tıklamanız yeterli olacaktır.</p>
			<a href="./redirect.php" class="buton_link">Uygulamaya İzin Ver</a>
		</div>
		</div>
		<!--#Sağ -->
	</div>
	<!--#Genel -->
	<!-- Footer -->
	<?php require_once 'footer.php'; ?>