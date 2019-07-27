<!DOCTYPE html>
<html>
<?php
include_once('includes/header.inc.php');
include_once('includes/pasien.inc.php');
include_once('includes/status-pasien.inc.php');

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$Pasien = new Pasien($db);
$Pasien->id_pasien = $id;
$Pasien->readOne();

$Rekam = new Rekam($db);

?>
<!DOCTYPE html>
<html>
<head>
  <title>Sistem Informasi Monitoring Pasien</title>
  <link rel="stylesheet" href="css/style_tabel.css">
</head>
<body>
<div class="row">
        <div class="col-md-6 text-left">
    			<strong style="font-size:18pt;"><span class="fa fa-book"></span> Status Pasien</strong>
        <div class="panel panel-default">
        <div class="panel-body">
          <form method="POST">
            <div class="form-group">
                <label for="id_pasien">ID Pasien</label>
                <input type="text" name="id_pasien" id="id_pasien" readonly="on" class="form-control" value="<?php echo $Pasien->id_pasien; ?>">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" readonly="on" class="form-control" value="<?php echo $Pasien->nama; ?>">
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="text" name="tgl_lahir" id="tgl_lahir" readonly="on" class="form-control" value="<?php echo $Pasien->tgl_lahir; ?>">
            </div>
            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <input type="text" name="jk" id="jk" readonly="on" class="form-control" value="<?php echo $Pasien->jk; ?>">
            </div>
            <div class="form-group">
                <label for="gol_darah">Golongan Darah</label>
                <input type="text" name="gol_darah" id="gol_darah" readonly="on" class="form-control" value="<?php echo $Pasien->gol_darah; ?>">
            </div>
          </form>
        </div>
      </div>
  </div>
</div>
<div class="container">
    <form method="post">
    <div class="row">
    		<div class="col-md-6 text-left">
    			<strong style="font-size:18pt;"><span class="fa fa-book"></span> Rekam Medis</strong>
    		</div>
    		<div class="col-md-6 text-right">
          <div class="btn-group">
          <?php
                if ($_SESSION['role'] == 'perawat') {
          ?>
      			<button type="button" onclick="location.href='rekam-input.php?id_pasien=<?php echo $Pasien->id_pasien; ?>'" class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data</button>
            <button type="button" onclick="location.href='pasien.php'" class="btn btn-primary"><span class="fa fa-clone"></span> Kembali</button>
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
            <th> ID Rekam Medis </th>
            <th> Suhu Badan </th>
            <th> Tensi </th>
            <th> Diagnosis Penyakit </th>
            <th> Waktu </th>
            <th> Nama Perawat </th>
            <th colspan="1">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $rekams = $Rekam->readAll($_GET['id']); while ($row = $rekams->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr align="center">
              <td><?=$row['id_rekam_medis']?></td>
              <td><?=$row['suhu']?></td>
              <td><?=$row['tensi']?></td>
              <td><?=$row['diagnosis_penyakit']?></td>
              <td><?=$row['waktu']?></td>
              <td><?=$row['nama']?></td>
              <td><a href="catatan-perawat.php?id=<?php echo $row['id_rekam_medis']; ?>"> Catatan Perawat </a> </td>
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
