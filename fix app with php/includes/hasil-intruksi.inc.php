<?php
class Hasil {
	private $conn;
	private $table_name = '`hasil-intruksi`';

	public $id_hasil_intruksi;
    public $waktu;
    public $hasil_intruksi;
    public $id_intruksi;
    public $id_perawat;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_name} VALUES(?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_hasil_intruksi);
		$stmt->bindParam(2, $this->waktu);
		$stmt->bindParam(3, $this->hasil_intruksi);
	    $stmt->bindParam(4, $this->id_intruksi);
	    $stmt->bindParam(5, $this->id_perawat);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function getNewID() {
		$query = "SELECT MAX(id_hasil_intruksi) as code FROM {$this->table_name}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '17', 8);
		} else {
			return $this->genCode($nomor_terakhir, '17', 8);
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
        $query = "SELECT has.id_hasil_intruksi, has.waktu, has.hasil_intruksi, pr.nama, pr.id_perawat FROM `hasil-intruksi` has JOIN `intruksi-dokter` intr ON has.id_intruksi = intr.id_intruksi JOIN `perawat` pr ON has.id_perawat = pr.id_perawat WHERE has.id_intruksi = '$id' ORDER BY id_hasil_intruksi DESC
		";  
        $stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
}
?>