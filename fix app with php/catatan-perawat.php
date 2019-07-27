<!DOCTYPE html>
<html>
<?php
include_once('includes/header.inc.php');
include_once('includes/status-pasien.inc.php');
include_once('includes/catatan-perawat.inc.php');

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$Catatan = new Catatan($db);
$Catatan->id_rekam_medis = $id;

?>
<!DOCTYPE html>
<html>
<head>
  <title>Sistem Informasi Monitoring Pasien</title>
  <link rel="stylesheet" href="css/style_tabel.css">
</head>
<body>
    <div class="container">
    <form method="post">
    <div class="row">
    		<div class="col-md-6 text-left">
    			<strong style="font-size:18pt;"><span class="fa fa-book"></span> Catatan Perawat</strong>
    		</div>
    		<div class="col-md-6 text-right">
          <div class="btn-group">
          <?php
                if ($_SESSION['role'] == 'perawat') {
          ?>
      			<button type="button" onclick="location.href='catatan-input.php?id_rekam_medis=<?php echo $Catatan->id_rekam_medis; ?>'" class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data</button>
    	      <br/>
          <?php
              }else{
          ?>
            <br/>
          <?php
              }
          ?>
        </div>
    		</div>
    </div>
    <br/>
    <div style="overflow-x:auto;">
     <table class="data-table" width="80%" align="center">
        <thead>
          <tr align="center">
            <th> ID Catatan </th>
            <th> Waktu </th>
            <th> Catatan Perawat </th>
            <th> Nama Perawat </th>
            <th colspan="1">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $catatans = $Catatan->readAll($_GET['id']); while ($row = $catatans->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr align="center">
              <td><?=$row['id_catatan']?></td>
              <td><?=$row['waktu']?></td>
              <td><?=$row['catatan_perawat']?></td>
              <td><?=$row['nama']?></td>
              <td><a href="intruksi-dokter.php?id=<?php echo $row['id_catatan']; ?>"> Intruksi Dokter </a> </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      </div>
    </form>
    <br/><br/><br/>
    </div>
</body>
</html>
