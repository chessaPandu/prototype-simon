<?php
class Catatan {
	private $conn;
	private $table_name = '`catatan-perawat`';

	public $id_catatan;
    public $waktu;
    public $catatan_perawat;
    public $id_rekam_medis;
    public $id_perawat;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_name} VALUES(?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_catatan);
		$stmt->bindParam(2, $this->waktu);
		$stmt->bindParam(3, $this->catatan_perawat);
	    $stmt->bindParam(4, $this->id_rekam_medis);
	    $stmt->bindParam(5, $this->id_perawat);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function getNewID() {
		$query = "SELECT MAX(id_catatan) as code FROM {$this->table_name}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '15', 8);
		} else {
			return $this->genCode($nomor_terakhir, '15', 8);
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
		$query = "SELECT cp.id_catatan, cp.waktu, cp.catatan_perawat, pr.id_perawat, pr.nama FROM `catatan-perawat` cp INNER JOIN perawat pr ON cp.id_perawat=pr.id_perawat WHERE cp.id_rekam_medis = '$id' ORDER BY cp.id_catatan DESC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
}
?>