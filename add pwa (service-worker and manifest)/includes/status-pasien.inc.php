<?php
class Rekam {
	private $conn;
	private $table_name = '`rekam-medis`';

	public $id_rekam_medis;
	public $suhu;
	public $tensi;
    public $diagnosis_penyakit;
    public $waktu;
    public $id_pasien;
    public $id_perawat;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_name} VALUES(?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_rekam_medis);
		$stmt->bindParam(2, $this->suhu);
		$stmt->bindParam(3, $this->tensi);
	    $stmt->bindParam(4, $this->diagnosis_penyakit);
	    $stmt->bindParam(5, $this->waktu);
	    $stmt->bindParam(6, $this->id_pasien);
	    $stmt->bindParam(7, $this->id_perawat);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function getNewID() {
		$query = "SELECT MAX(id_rekam_medis) as code FROM {$this->table_name}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '14', 8);
		} else {
			return $this->genCode($nomor_terakhir, '14', 8);
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
        $query = "SELECT rm.id_rekam_medis, rm.suhu, rm.tensi, rm.diagnosis_penyakit, rm.waktu, rm.id_pasien, pr.nama, pr.id_perawat FROM `rekam-medis` rm JOIN `perawat` pr ON rm.id_perawat = pr.id_perawat WHERE id_pasien = '$id' ORDER BY id_rekam_medis DESC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}
}
?>