<?php
include_once('includes/header.inc.php');
include_once('includes/perawat.inc.php');
$Perawat = new Perawat($db);

if($_POST){
    $Perawat->id_perawat = $_POST["id_perawat"];
    $Perawat->username = $_POST["username"];
    $Perawat->password = $_POST["password"];
    $Perawat->nama = $_POST["nama"];
    $Perawat->tgl_lahir = $_POST["tgl_lahir"];
    $Perawat->jk = $_POST["jk"];
    $Perawat->no_hp = $_POST["no_hp"];
    $Perawat->email = $_POST["email"];
    $Perawat->alamat = $_POST["alamat"];
    $Perawat->role = $_POST["role"];
    $Perawat->id_admin = $_SESSION["id_user"];

	if($Perawat->insert()){
    echo "berhasil simpan";
	} else { 
		echo "gagal simpan";
	}
}
?>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
  	<p style="margin-bottom:10px;">
  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Perawat </strong>
  	</p>
  	<div class="panel panel-default">
			<div class="panel-body">
      <form method="POST">
            <div class="form-group">
				<label for="id_perawat">ID Perawat</label>
				<input type="number" class="form-control" name="id_perawat" id="id_perawat" readonly="on" value="<?php echo $Perawat->getNewID(); ?>">
			</div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" id="password" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required="on">
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
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" name="role" id="role" class="form-control" required="on" value="perawat" readonly="on">
            </div>
            <div class="btn-group">
                <button type="submit" class="btn btn-dark">Simpan</button>
                <button type="button" onclick="location.href='perawat.php'" class="btn btn-default">Kembali</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>