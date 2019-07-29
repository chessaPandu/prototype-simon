<?php
include("config.php");
session_start();
if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
$config = new Config(); $db = $config->getConnection();
?>
<!DOCTYPE html>
<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link rel="shortcut icon" href="images/favicon.ico">
	<style>
	body {
	font-family: Arial, Helvetica, sans-serif;
	}

	.navbar-baru {
	overflow: hidden;
	background-color: #333;
	}

	.navbar-baru a {
	float: left;
	font-size: 16px;
	color: white;
	text-align: center;
	padding: 14px 16px;
	text-decoration: none;
	}

	.dropdown-baru {
	float: left;
	overflow: hidden;
	}

	.dropdown-baru .dropbtn-baru {
	font-size: 16px;  
	border: none;
	outline: none;
	color: white;
	padding: 14px 16px;
	background-color: inherit;
	font-family: inherit;
	margin: 0;
	}

	.navbar-baru a:hover, .dropdown-baru:hover .dropbtn-baru {
	background-color: red;
	}

	.dropdown-content-baru {
	display: none;
	position: absolute;
	background-color: #f9f9f9;
	min-width: 160px;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	z-index: 1;
	}

	.dropdown-content-baru a {
	float: none;
	color: black;
	padding: 12px 16px;
	text-decoration: none;
	display: block;
	text-align: left;
	}

	.dropdown-content-baru a:hover {
	background-color: #ddd;
	}

	.dropdown-baru:hover .dropdown-content-baru {
	display: block;
	}

	ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		overflow: hidden;
		background-color: #333;
		width: 100%;
		}

	li {
		float: left;
		}

	li a, .dropbtn-baru {
		display: inline-block;
		color: white;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
		}

	li a:hover, .dropdown-baru:hover .dropbtn-baru {
		background-color: red;
		}

	li.dropdown-baru {
		display: inline-block;
		}
	
	</style>
	</head>
		<body>
		<div class="navbar-baru">
			  <li><a href="index.php">Home</a></li>
			  	<?php if ($_SESSION["role"] == "admin"): ?>
				  <li><a href="dokter.php"> Dokter </a></li>
				  <li><a href="perawat.php"> Perawat </a></li>
				  <li><a href="pasien.php"> Pasien </a></li>
				  <li class="dropdown-baru" style="float:right">
				  	<button class="dropbtn-baru"><?php echo $_SESSION['nama']; ?>
						<i class="fa fa-caret-down-baru"></i>
					</button>
				  <div class="dropdown-content-baru">
      				<a href="logout.php">Logout</a>
				  </div>
              	  </li>
		</div>
			  	<?php elseif ($_SESSION["role"] == "dokter"): ?>
				  <li><a href="pasien.php"> Pasien </a></li>
				  <li class="dropdown-baru" style="float:right">
				  	<button class="dropbtn-baru"><?php echo $_SESSION['nama']; ?>
						<i class="fa fa-caret-down-baru"></i>
					</button>
				  <div class="dropdown-content-baru">
      				<a href="logout.php">Logout</a>
				  </div>
              	  </li>
		</div>
			  	<?php else : ?>
				  <li><a href="pasien.php"> Pasien </a></li>
				  <li class="dropdown-baru" style="float:right">
				  	<button class="dropbtn-baru"><?php echo $_SESSION['nama']; ?>
						<i class="fa fa-caret-down-baru"></i>
					</button>
				  <div class="dropdown-content-baru">
      				<a href="logout.php">Logout</a>
				  </div>
              	  </li>
		</div>
                <?php endif; ?>
		</body>
</html>