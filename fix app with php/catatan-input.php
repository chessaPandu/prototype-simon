<?php
include_once('includes/header.inc.php');
include_once('includes/catatan-perawat.inc.php');
$Catatan = new Catatan($db);

if($_POST){
    $Catatan->id_catatan = $_POST["id_catatan"];
    $Catatan->waktu = $_POST["waktu"];
    $Catatan->catatan_perawat = $_POST["catatan_perawat"];
    $Catatan->id_rekam_medis = $_POST["id_rekam_medis"];
    $Catatan->id_perawat = $_SESSION["id_user"];
    
	if($Catatan->insert()){
    echo "berhasil simpan";
	} else { 
		echo "gagal simpan";
	}
}
?>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
  	<p style="margin-bottom:10px;">
  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Catatan Perawat </strong>
  	</p>
  	<div class="panel panel-default">
			<div class="panel-body">
      <form method="POST">
            <div class="form-group">
				<label for="id_catatan">ID Catatan Perawat</label>
				<input type="number" class="form-control" name="id_catatan" id="id_catatan" readonly="on" value="<?php echo $Catatan->getNewID(); ?>">
			</div>
            <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="datetime-local" name="waktu" id="waktu" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="catatan_perawat">Catatan Perawat</label>
                <input type="text" name="catatan_perawat" id="catatan_perawat" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="id_rekam_medis">ID Rekam Medis</label>
                <input type="text" name="id_rekam_medis" id="id_rekam_medis" class="form-control" required="on" value="<?php echo $_GET['id_rekam_medis']; ?>" readonly="on">
            </div>
            <div class="btn-group">
                <button type="submit" class="btn btn-dark">Simpan</button>
                <button type="button" onclick="location.href='status-pasien.php'" class="btn btn-default">Kembali</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>