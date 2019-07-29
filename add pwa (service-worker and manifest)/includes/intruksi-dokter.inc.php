<?php
class Intruksi {
	private $conn;
	private $table_name = '`intruksi-dokter`';

	public $id_intruksi;
    public $waktu;
    public $intruksi_dokter;
    public $id_catatan;
    public $id_dokter;

	public function __construct($db) {
		$this->conn = $db;
	}

	
	function insert() {
		$query = "INSERT INTO {$this->table_name} VALUES(?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_intruksi);
		$stmt->bindParam(2, $this->waktu);
		$stmt->bindParam(3, $this->intruksi_dokter);
	    $stmt->bindParam(4, $this->id_catatan);
	    $stmt->bindParam(5, $this->id_dokter);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function getNewID() {
		$query = "SELECT MAX(id_intruksi) as code FROM {$this->table_name}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '16', 8);
		} else {
			return $this->genCode($nomor_terakhir, '16', 8);
		}
	}

	function genCode($latest, $key, $chars = 0) {
		$new = intval(substr($latest, strlen($key))) + 1;
		$numb = str_pad($new, $chars, "0", STR_PAD_LEFT);
		return $key . $numb;
		}
	
		function genNextCode($start, $key, $chars = 0) {
		$new = str_pad($start, $chars, "0", STR_PAD_LEFT);
		return $key . $new;
		}

	function readAll($id) {
        $query = "SELECT intr.id_intruksi, intr.waktu, intr.intruksi_dokter, doc.nama, doc.id_dokter FROM `intruksi-dokter` intr JOIN `catatan-perawat` ct ON intr.id_catatan = ct.id_catatan JOIN `dokter` doc ON intr.id_dokter = doc.id_dokter WHERE intr.id_catatan = '$id' ORDER BY id_intruksi DESC";  
        $stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
}
?>