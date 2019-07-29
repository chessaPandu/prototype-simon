<?php
include_once('includes/header.inc.php');
include_once('includes/pasien.inc.php');

$Pasien = new Pasien($db);
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
    <br/>
    <div class="row">
    		<div class="col-md-6 text-left">
    			<strong style="font-size:18pt;"><span class="fa fa-book"></span> Data Dokter</strong>
    		</div>
    		<div class="col-md-6 text-right">
          <div class="btn-group">
          <?php
                if ($_SESSION['role'] == 'admin') {
          ?>
      			<button type="button" onclick="location.href='dokter-input.php'" class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data</button>
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
     <table class="data-table" width="100%" align="center">
        <thead>
          <tr align="center">
            <th> ID Pasien </th>
            <th> Nama Pasien </th>
            <th> NIK </th>
            <th> Tanggal Lahir </th>
            <th> Jenis Kelamin </th>
            <th> No HP </th>
            <th> Alamat </th>
            <th> Golongan Darah </th>
            <th colspan="3">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; $pasiens = $Pasien->readAll(); while ($row = $pasiens->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr align="center">
              <td><?=$row['id_pasien']?></td>
              <td><?=$row['nama']?></td>
              <td><?=$row['nik']?></td>
              <td><?=$row['tgl_lahir']?></td>
              <td><?=$row['jk']?></td>
              <td><?=$row['no_hp']?></td>
              <td><?=$row['alamat']?></td>
              <td><?=$row['gol_darah']?></td>
              <?php
                if ($_SESSION['role'] == 'admin') {
              ?>
              <td> <a href="status-pasien.php?id=<?php echo $row['id_pasien']; ?>"> Status Pasien </a> </td>
              <td> <a href="pasien-update.php?id=<?php echo $row['id_pasien']; ?>"> Edit </a> </td>
              <td> <a href="pasien-delete.php?id=<?php echo $row['id_pasien']; ?>"> Hapus </a> </td>
              <?php
                }else{
              ?>
              <td> <a href="status-pasien.php?id=<?php echo $row['id_pasien']; ?>"> Status Pasien </a> </td>
              <?php
                }
              ?>
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