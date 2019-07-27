<?php
include_once('includes/header.inc.php');
include_once('includes/hasil-intruksi.inc.php');
$Hasil = new Hasil($db);

if($_POST){
    $Hasil->id_hasil_intruksi = $_POST["id_hasil_intruksi"];
    $Hasil->waktu = $_POST["waktu"];
    $Hasil->hasil_intruksi = $_POST["hasil_intruksi"];
    $Hasil->id_intruksi = $_POST["id_intruksi"];
    $Hasil->id_perawat = $_SESSION["id_user"];
    
	if($Hasil->insert()){
    echo "berhasil simpan";
	} else { 
		echo "gagal simpan";
	}
}
?>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
  	<p style="margin-bottom:10px;">
  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Hasil Intruksi Dokter </strong>
  	</p>
  	<div class="panel panel-default">
			<div class="panel-body">
      <form method="POST">
            <div class="form-group">
				<label for="id_hasil_intruksi">ID Hasil Intruksi Dokter</label>
				<input type="number" class="form-control" name="id_hasil_intruksi" id="id_hasil_intruksi" readonly="on" value="<?php echo $Hasil->getNewID(); ?>">
			</div>
            <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="datetime-local" name="waktu" id="waktu" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="hasil_intruksi">Hasil Intruksi Dokter</label>
                <input type="text" name="hasil_intruksi" id="hasil_intruksi" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="id_intruksi">ID Intruksi</label>
                <input type="text" name="id_intruksi" id="id_intruksi" class="form-control" required="on" value="<?php echo $_GET['id_intruksi']; ?>" readonly="on">
            </div>
            <div class="btn-group">
                <button type="submit" class="btn btn-dark">Simpan</button>
                <button type="button" onclick="location.href='intruksi-dokter.php'" class="btn btn-default">Kembali</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>