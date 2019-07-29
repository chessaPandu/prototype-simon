<?php
include("includes/header.inc.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistem Informasi Monitoring Pasien</title>
</head>
<body>
	<?php if (isset($_SESSION['id_user'])): ?>
		<?php if ($_SESSION['role'] == 'admin'): ?>
			<h2>Halo Admin <?php echo $_SESSION['nama']; ?></h2>
		<?php elseif ($_SESSION['role'] == 'dokter'): ?>
			<h2>Halo Dokter <?php echo $_SESSION['nama']; ?></h2>
		<?php else: ?>
			<h2>Halo Perawat <?php echo $_SESSION['nama']; ?></h2>
		<?php endif; ?>
	<?php endif; ?>

</body>
</html>
