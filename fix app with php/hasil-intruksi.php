<!DOCTYPE html>
<html>
<?php
include_once('includes/header.inc.php');
include_once('includes/intruksi-dokter.inc.php');
include_once('includes/hasil-intruksi.inc.php');

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$Hasil = new Hasil($db);
$Hasil->id_intruksi= $id;

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style_tabel.css">
</head>
<body>
    <div class="container">
    <form method="post">
    <div class="row">
    		<div class="col-md-6 text-left">
    			<strong style="font-size:18pt;"><span class="fa fa-book"></span> Hasil Intruksi Dokter</strong>
    		</div>
    		<div class="col-md-6 text-right">
          <div class="btn-group">
          <?php
                if ($_SESSION['role'] == 'perawat') {
          ?>
      			<button type="button" onclick="location.href='hasil-input.php?id_intruksi=<?php echo $Hasil->id_intruksi; ?>'" class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data</button>
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
            <th> ID Hasil Intruksi </th>
            <th> Waktu </th>
            <th> Hasil Intruksi Dokter </th>
            <th> Nama Perawat </th>
          </tr>
        </thead>
        <tbody>
          <?php $hasils = $Hasil->readAll($_GET['id']); while ($row = $hasils->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr align="center">
              <td><?=$row['id_hasil_intruksi']?></td>
              <td><?=$row['waktu']?></td>
              <td><?=$row['hasil_intruksi']?></td>
              <td><?=$row['nama']?></td>
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
