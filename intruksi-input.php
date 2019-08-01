<?php
include_once('includes/header.inc.php');
include_once('includes/intruksi-dokter.inc.php');
$Intruksi = new Intruksi($db);

if($_POST){
    $Intruksi->id_intruksi = $_POST["id_intruksi"];
    $Intruksi->waktu = $_POST["waktu"];
    $Intruksi->intruksi_dokter = $_POST["intruksi_dokter"];
    $Intruksi->id_catatan = $_POST["id_catatan"];
    $Intruksi->id_dokter = $_SESSION["id_user"];
    
	if($Intruksi->insert()){
    echo "berhasil simpan";
	} else { 
		echo "gagal simpan";
	}
}
?>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
  	<p style="margin-bottom:10px;">
  		<strong style="font-size:18pt;"><span class="fa fa-clone"></span> Tambah Intruksi Dokter </strong>
  	</p>
  	<div class="panel panel-default">
			<div class="panel-body">
      <form id='intruksi-simpan' method="POST">
            <div class="form-group">
				<label for="id_intruksi">ID Intruksi Dokter</label>
				<input type="number" class="form-control" name="id_intruksi" id="id_intruksi" readonly="on" value="<?php echo $Intruksi->getNewID(); ?>">
			</div>
            <div class="form-group">
                <label for="waktu">Waktu</label>
                <input type="datetime-local" name="waktu" id="waktu" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="intruksi_dokter">Intruksi Dokter</label>
                <input type="text" name="intruksi_dokter" id="intruksi_dokter" class="form-control" required="on">
            </div>
            <div class="form-group">
                <label for="id_catatan">ID Catatan Perawat</label>
                <input type="text" name="id_catatan" id="id_catatan" class="form-control" required="on" value="<?php echo $_GET['id_catatan']; ?>" readonly="on">
            </div>
            <div class="btn-group">
                <button type="submit" class="btn btn-dark" id="simpanintruksi">Simpan</button>
                <button type="button" id="kembali" onclick="location.href='catatan-perawat.php'" class="btn btn-default">Kembali</button>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>
<script>
    
    function updateIndicator() {
    	// if(navigator.onLine) {
    	//     $('form#intruksi-simpan').attr('method', 'post')
        //     $('form#intruksi-simpan').attr('action', '')
        // }
        // if(!navigator.onLine) {
    	    document.querySelector("#simpanintruksi").addEventListener('click',function(e){
    	        console.log('service worker')
                e.preventDefault();
                waktu = document.querySelector("#waktu").value;
                var intruksi = {
                    'waktu':waktu,
                    'id_intruksi':document.querySelector("#id_intruksi").value,
                    'intruksi_dokter':document.querySelector("#intruksi_dokter").value,
                    'id_catatan':document.querySelector("#id_catatan").value
                
                };
                
        
                if ('serviceWorker' in navigator && 'SyncManager' in window)
                {
                    navigator.serviceWorker.ready
                    .then(function(sw)
                    {
                        idb_intruksi.set(waktu,intruksi)
                        .then(function(){
                            sw.sync.register('sync-new-trx');
                        });
                    });
                }
                else
                {
                    alert('Data telah disimpan')
                    window.location = 'catatan-perawat.php';
                    idb_intruksi.set(waktu,intruksi);
                }
            });
            document.querySelector("#kembali").addEventListener('click',function(e){
                console.log('deleting intruksi indexed' + intruksi.waktu);
                 idb_intruksi.delete(intruksi.waktu);
        });
    }
    
    // Update the online status icon based on connectivity
    window.addEventListener('online',  updateIndicator);
    window.addEventListener('offline', updateIndicator);
    updateIndicator();

</script>
<script src="idb.js"></script>
<script src="intruksiDB.js"></script>