<?php
include_once('includes/header.inc.php');
include_once('includes/perawat.inc.php');

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$Perawat = new Perawat($db);
$Perawat->id_perawat = $id;
$Perawat->readOne();

if ($_POST) {
    $Perawat->id_perawat = $_POST["id_perawat"];
    $Perawat->username = $_POST["username"];
    $Perawat->password = $_POST["password"];
    $Perawat->nama = $_POST["nama"];
    $Perawat->tgl_lahir = $_POST["tgl_lahir"];
    $Perawat->jk = $_POST["jk"];
    $Perawat->no_hp = $_POST["no_hp"];
    $Perawat->email = $_POST["email"];
    $Perawat->alamat = $_POST["alamat"];
    if ($Perawat->update()) {
        echo "<script>location.href='perawat.php'</script>";
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
  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Update Perawat</strong>
  	</p>
  	<div class="panel panel-default">
			<div class="panel-body">
          <form method="POST">
            <div class="form-group">
                <label for="id_perawat">ID Perawat</label>
                <input type="text" name="id_perawat" id="id_perawat" class="form-control" autofocus="on" readonly="on" value="<?php echo $Perawat->id_perawat; ?>">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required="on"value="<?php echo $Perawat->username; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" id="password" class="form-control" required="on"value="<?php echo $Perawat->password; ?>">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required="on"value="<?php echo $Perawat->nama; ?>">
            </div>
            <div class="form-group">
                <label for="tgl_lahir">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required="on" value="<?php echo $Perawat->tgl_lahir; ?>">
            </div>
            <div class="form-group">
                <label for="jk">Jenis Kelamin</label>
                <select class="form-control" name="jk" id="jk" required="on">
                    <option value="">---</option>
                    <option value="laki-laki"<?=($Perawat->jk == "laki-laki")? "selected=\"on\"" : "" ?>>Laki-laki</option>
                    <option value="perempuan"<?=($Perawat->jk == "perempuan")? "selected=\"on\"" : "" ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="tel" name="no_hp" id="no_hp" class="form-control" required="on" value="<?php echo $Perawat->no_hp; ?>">
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="text" name="email" id="email" class="form-control" required="on" value="<?php echo $Perawat->email; ?>">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" required="on" value="<?php echo $Perawat->alamat; ?>">
            </div>
            <div class="btn-group">
              <button type="submit" class="btn btn-dark">Update</button>
              <button type="button" onclick="location.href = 'perawat.php'" class="btn btn-default">Kembali</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

