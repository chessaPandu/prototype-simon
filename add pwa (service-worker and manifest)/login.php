<?php
include("config.php");

$config = new Config(); $db = $config->getConnection();

if ($_POST) {
    include_once 'includes/login.inc.php';
    $login = new Login($db);
    $login->username = $_POST['username'];
    $login->password = $_POST['password'];
    if ($login->login()) {
        echo "<script>location.href='index.php'</script>";
    } else {
        echo "<script>alert('Username / Password tidak sesuai!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Sistem Informasi Monitoring Pasien</title>

	  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A simple storefront built on Material Design Lite.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="manifest" href="manifest.json">

    <!-- HS 3 & 4 untuk fitur add to home screen yang berhubungan dengan manifest.json -->
    <!-- TODO HS-3 - Add to home screen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Simon Pasien">
    <link rel="apple-touch-icon" href="images/touch/apple-touch-icon.png">
    <!-- TODO HS-4 - Tile icons for Windows -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#2F3BA2">

	<link rel="shortcut icon" href="images/favicon.ico">

<link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form action="" method="post" class="form-login">
        <h2 align="center">Login</h2>
    	<p>
        	<input type="text" name="username" placeholder="Username" class="normal-input" />
    	</p>
        <p>
        	<input type="password" name="password" placeholder="Password" class="normal-input" />
    	</p>
        <input type="submit" value="Login" class="tombol" name="login"  />
    </form>

	<script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', function() {
        navigator.serviceWorker.register('service-worker.js')
          .then(reg => {
            console.log('Service worker registered!', reg);
          })
          .catch(err => {
            console.log('Service worker registration failed: ', err);
          });
      });
    }
  </script>


</body>
</html>