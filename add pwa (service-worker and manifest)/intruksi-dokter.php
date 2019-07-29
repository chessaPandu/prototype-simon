<!DOCTYPE html>
<html>
<?php
include_once('includes/header.inc.php');
include_once('includes/catatan-perawat.inc.php');
include_once('includes/intruksi-dokter.inc.php');

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$Intruksi = new Intruksi($db);
$Intruksi->id_catatan = $id;

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
    			<strong style="font-size:18pt;"><span class="fa fa-book"></span> Intruksi Dokter</strong>
    		</div>
    		<div class="col-md-6 text-right">
          <div class="btn-group">
          <?php
                if ($_SESSION['role'] == 'dokter') {
          ?>
      			<button type="button" onclick="location.href='intruksi-input.php?id_catatan=<?php echo $Intruksi->id_catatan; ?>'" class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data</button>
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
            <th> ID Intruksi </th>
            <th> Waktu </th>
            <th> Intruksi Dokter </th>
            <th> Nama Dokter </th>
            <th colspan="1">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $intruksis = $Intruksi->readAll($_GET['id']); while ($row = $intruksis->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr align="center">
              <td><?=$row['id_intruksi']?></td>
              <td><?=$row['waktu']?></td>
              <td><?=$row['intruksi_dokter']?></td>
              <td><?=$row['nama']?></td>
              <td><a href="hasil-intruksi.php?id=<?php echo $row['id_intruksi']; ?>"> Hasil Intruksi </a> </td>
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
