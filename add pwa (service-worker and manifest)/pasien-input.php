<?php
include_once('includes/header.inc.php');
include_once('includes/pasien.inc.php');
$Pasien = new Pasien($db);

if($_POST){
    $Pasien->id_pasien = $_POST["id_pasien"];
    $Pasien->nama = $_POST["nama"];
    $Pasien->nik = $_POST["nik"];
    $Pasien->tgl_lahir = $_POST["tgl_lahir"];
    $Pasien->jk = $_POST["jk"];
    $Pasien->no_hp = $_POST["no_hp"];
    $Pasien->alamat = $_POST["alamat"];
    $Pasien->gol_darah = $_POST["gol_darah"];
    $Pasien->id_admin = $_SESSION["id_user"];

	if($Pasien->insert()){
    echo "berhasil simpan";
	} else { 
		echo "gagal simpan";
	}
}
?>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
  	<p style="margin-bottom:10px;">
  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Pasien </strong>
  	</p>
  	<div class="panel panel-default">
			<div class="panel-body">
      <form method="POST">
            <div class="form-group">
						    <label for="id_pasien">ID Pasien</label>
						    <input type="number" class="form-control" name="id_pasien" id="id_pasien" readonly="on" value="<?php echo $Pasien->getNewID(); ?>">
						  </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" name="nik" id="nik" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <select class="form-control" name="jk" id="jk" required="on">
                  <option type="radio" name="jk" id="jk" required="on" value="laki-laki">Laki-Laki
                  <option type="radio" name="jk" id="jk" required="on" value="perempuan">Perempuan
                </select>
            </div>
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="tel" name="no_hp" id="no_hp" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="gol_darah">Golongan Darah</label>
                <select class="form-control" name="gol_darah" id="gol_darah" required="on">
                  <option type="radio" name="gol_darah" id="gol_darah" required="on" value="A">A
                  <option type="radio" name="gol_darah" id="gol_darah" required="on" value="B">B
                  <option type="radio" name="gol_darah" id="gol_darah" required="on" value="AB">AB
                  <option type="radio" name="gol_darah" id="gol_darah" required="on" value="O">O
                </select>
            </div>
            <div class="btn-group">
                <button type="submit" class="btn btn-dark">Simpan</button>
                <button type="button" onclick="location.href='pasien.php'" class="btn btn-default">Kembali</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>