<?php
include_once('includes/header.inc.php');
include_once('includes/dokter.inc.php');

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$Dokter = new Dokter($db);
$Dokter->id_dokter = $id;
$Dokter->readOne();

if ($_POST) {
    $Dokter->id_dokter = $_POST["id_dokter"];
    $Dokter->username = $_POST["username"];
    $Dokter->password = $_POST["password"];
    $Dokter->nama = $_POST["nama"];
    $Dokter->tgl_lahir = $_POST["tgl_lahir"];
    $Dokter->jk = $_POST["jk"];
    $Dokter->no_hp = $_POST["no_hp"];
    $Dokter->email = $_POST["email"];
    $Dokter->alamat = $_POST["alamat"];
    if ($Dokter->update()) {
        echo "<script>location.href='dokter.php'</script>";
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
  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Update Dokter</strong>
  	</p>
  	<div class="panel panel-default">
			<div class="panel-body">
          <form method="POST">
            <div class="form-group">
                <label for="id_dokter">ID Dokter</label>
                <input type="text" name="id_dokter" id="id_dokter" class="form-control" autofocus="on" readonly="on" value="<?php echo $Dokter->id_dokter; ?>">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required="on"value="<?php echo $Dokter->username; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" id="password" class="form-control" required="on"value="<?php echo $Dokter->password; ?>">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required="on"value="<?php echo $Dokter->nama; ?>">
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required="on" value="<?php echo $Dokter->tgl_lahir; ?>">
            </div>
            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <select class="form-control" name="jk" id="jk" required="on">
                    <option value="">---</option>
                    <option value="laki-laki"<?=($Dokter->jk == "laki-laki")? "selected=\"on\"" : "" ?>>Laki-laki</option>
                    <option value="perempuan"<?=($Dokter->jk == "perempuan")? "selected=\"on\"" : "" ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="tel" name="no_hp" id="no_hp" class="form-control" required="on" value="<?php echo $Dokter->no_hp; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required="on" value="<?php echo $Dokter->email; ?>">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" required="on" value="<?php echo $Dokter->alamat; ?>">
            </div>
            <div class="btn-group">
              <button type="submit" class="btn btn-dark">Update</button>
              <button type="button" onclick="location.href = 'dokter.php'" class="btn btn-default">Kembali</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

