<?php
include_once('includes/header.inc.php');
include_once('includes/perawat.inc.php');

$Perawat = new Perawat($db);
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
    			<strong style="font-size:18pt;"><span class="fa fa-book"></span> Data Perawat</strong>
    		</div>
    		<div class="col-md-6 text-right">
          <div class="btn-group">
      			<button type="button" onclick="location.href='perawat-input.php'" class="btn btn-primary"><span class="fa fa-clone"></span> Tambah Data</button>
          </div>
    		</div>
    	</div>
    	<br/>
    <div style="overflow-x:auto;">
     <table class="data-table" width="80%" align="center">
        <thead>
          <tr align="center">
            <th> ID Perawat </th>
            <th> Username </th>
            <th> Password </th>
            <th> Nama Perawat </th>
            <th> Tanggal Lahir </th>
            <th> Jenis Kelamin </th>
            <th> No HP </th>
            <th> Email </th>
            <th> Alamat </th>
            <th colspan="2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; $perawats = $Perawat->readAll(); while ($row = $perawats->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr align="center">
              <td><?=$row['id_perawat']?></td>
              <td><?=$row['username']?></td>
              <td><?=$row['password']?></td>
              <td><?=$row['nama']?></td>
              <td><?=$row['tgl_lahir']?></td>
              <td><?=$row['jk']?></td>
              <td><?=$row['no_hp']?></td>
              <td><?=$row['email']?></td>
              <td><?=$row['alamat']?></td>
              <td> <a href="perawat-update.php?id=<?php echo $row['id_perawat']; ?>"> Edit </a> </td>
              <td> <a href="perawat-delete.php?id=<?php echo $row['id_perawat']; ?>"> Hapus </a> </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      </div>
    </div>
    </form>
    <br/><br/><br/>
  </div>
</body>
</html>