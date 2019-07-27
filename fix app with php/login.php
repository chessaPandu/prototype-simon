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
</body>
</html>