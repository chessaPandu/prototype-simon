<?php
include_once('includes/header.inc.php');
include_once('includes/pasien.inc.php');

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$Pasien = new Pasien($db);
$Pasien->id_pasien = $id;
$Pasien->readOne();

if ($_POST) {
    $Pasien->id_pasien = $_POST["id_pasien"];
    $Pasien->nama = $_POST["nama"];
    $Pasien->nik = $_POST["nik"];
    $Pasien->tgl_lahir = $_POST["tgl_lahir"];
    $Pasien->jk = $_POST["jk"];
    $Pasien->no_hp = $_POST["no_hp"];
    $Pasien->alamat = $_POST["alamat"];
    $Pasien->gol_darah = $_POST["gol_darah"];
    if ($Pasien->update()) {
        echo "<script>location.href='pasien.php'</script>";
    } else { ?>
      <script type="text/javascript">
        window.onload = function () {
          showStickyErrorToast();
        };
      </script> <?php
    }
}
?>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
  	<p style="margin-bottom:10px;">
  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Update Pasien</strong>
  	</p>
  	<div class="panel panel-default">
			<div class="panel-body">
          <form method="POST">
            <div class="form-group">
                <label for="id_pasien">ID Pasien</label>
                <input type="text" name="id_pasien" id="id_pasien" class="form-control" autofocus="on" readonly="on" value="<?php echo $Pasien->id_pasien; ?>">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required="on"value="<?php echo $Pasien->nama; ?>">
            </div>
            <div class="form-group">
                <label for="nik">NIK</label>
                <input type="text" name="nik" id="nik" class="form-control" required="on"value="<?php echo $Pasien->nik; ?>">
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required="on" value="<?php echo $Pasien->tgl_lahir; ?>">
            </div>
            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <select class="form-control" name="jk" id="jk" required="on">
                    <option value="">---</option>
                    <option value="laki-laki"<?=($Pasien->jk == "laki-laki")? "selected=\"on\"" : "" ?>>Laki-laki</option>
                    <option value="perempuan"<?=($Pasien->jk == "perempuan")? "selected=\"on\"" : "" ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="tel" name="no_hp" id="no_hp" class="form-control" required="on" value="<?php echo $Pasien->no_hp; ?>">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" required="on" value="<?php echo $Pasien->alamat; ?>">
            </div>
            <div class="form-group">
                <label for="gol_darah">Golongan Darah</label>
                <select class="form-control" name="gol_darah" id="gol_darah" required="on">
                    <option value="">---</option>
                    <option value="A"<?=($Pasien->gol_darah == "A")? "selected=\"on\"" : "" ?>>A</option>
                    <option value="B"<?=($Pasien->gol_darah == "B")? "selected=\"on\"" : "" ?>>B</option>
                    <option value="AB"<?=($Pasien->gol_darah == "AB")? "selected=\"on\"" : "" ?>>AB</option>
                    <option value="O"<?=($Pasien->gol_darah == "O")? "selected=\"on\"" : "" ?>>O</option>
                </select>
            </div>
            <div class="btn-group">
              <button type="submit" class="btn btn-dark">Update</button>
              <button type="button" onclick="location.href = 'pasien.php'" class="btn btn-default">Kembali</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

