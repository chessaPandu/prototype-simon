<?php
include_once('includes/header.inc.php');
include_once('includes/status-pasien.inc.php');
$Rekam = new Rekam($db);

if($_POST){
    $Rekam->id_rekam_medis = $_POST["id_rekam_medis"];
    $Rekam->suhu = $_POST["suhu"];
    $Rekam->tensi = $_POST["tensi"];
    $Rekam->diagnosis_penyakit = $_POST["diagnosis_penyakit"];
    $Rekam->waktu = $_POST["waktu"];
    $Rekam->id_pasien = $_POST["id_pasien"];
    $Rekam->id_perawat = $_SESSION["id_user"];
    
	if($Rekam->insert()){
    echo "berhasil simpan";
	} else { 
		echo "gagal simpan";
	}
}
?>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
  	<p style="margin-bottom:10px;">
  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Rekam Medis </strong>
  	</p>
  	<div class="panel panel-default">
			<div class="panel-body">
      <form method="POST">
            <div class="form-group">
				<label for="id_rekam_medis">ID Rekam Medis</label>
				<input type="number" class="form-control" name="id_rekam_medis" id="id_rekam_medis" readonly="on" value="<?php echo $Rekam->getNewID(); ?>">
			</div>
            <div class="form-group">
                <label for="suhu">Suhu</label>
                <input type="text" name="suhu" id="suhu" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="tensi">Tensi</label>
                <input type="text" name="tensi" id="tensi" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="diagnosis_penyakit">Diagnosis Penyakit</label>
                <input type="text" name="diagnosis_penyakit" id="diagnosis_penyakit" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="datetime-local" name="waktu" id="waktu" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="id_pasien">ID Pasien</label>
                <input type="text" name="id_pasien" id="id_pasien" class="form-control" required="on" value="<?php echo $_GET['id_pasien']; ?>" readonly="on">
            </div>
            <div class="btn-group">
                <button type="submit" class="btn btn-dark">Simpan</button>
                <button type="button" onclick="location.href='status-pasien.php?id_pasien=<?php echo $row['id_pasien']; ?>'" class="btn btn-default">Kembali</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>