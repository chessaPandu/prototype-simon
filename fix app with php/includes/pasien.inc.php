<?php
class Pasien {
	private $conn;
	private $table_name = 'pasien';

	public $id_pasien;
	public $nama;
	public $nik;
    public $tgl_lahir;
    public $jk;
    public $no_hp;
    public $alamat;
	public $gol_darah;
    public $id_admin;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_name} VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_pasien);
		$stmt->bindParam(2, $this->nama);
		$stmt->bindParam(3, $this->nik);
	    $stmt->bindParam(4, $this->tgl_lahir);
	    $stmt->bindParam(5, $this->jk);
	    $stmt->bindParam(6, $this->no_hp);
	    $stmt->bindParam(7, $this->alamat);
		$stmt->bindParam(8, $this->gol_darah);
		$stmt->bindParam(9, $this->id_admin);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_pasien) AS code FROM {$this->table_name}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '11', 8);
		} else {
			return $this->genCode($nomor_terakhir, '11', 8);
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

	function readAll() {
		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_pasien ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM ".$this->table_name." WHERE id_pasien=:id_pasien LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_pasien', $this->id_pasien);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_pasien = $row['id_pasien'];
		$this->nama = $row['nama'];
		$this->nik = $row['nik'];
	    $this->tgl_lahir = $row['tgl_lahir'];
	    $this->jk = $row['jk'];
	    $this->no_hp = $row['no_hp'];
	    $this->alamat = $row['alamat'];
	    $this->gol_darah = $row['gol_darah'];
	}

	function update() {
		$query = "UPDATE {$this->table_name}
				SET
					nama = :nama,
					nik = :nik,
				    tgl_lahir = :tgl_lahir,
				    jk = :jk,
				    no_hp = :no_hp,
				    alamat = :alamat,
				    gol_darah = :gol_darah
				WHERE
					id_pasien = :id";
		$stmt = $this->conn->prepare($query);
		
	    $stmt->bindParam(':nama', $this->nama);
		$stmt->bindParam(':nik', $this->nik);
		$stmt->bindParam(':tgl_lahir', $this->tgl_lahir);
	    $stmt->bindParam(':jk', $this->jk);
	    $stmt->bindParam(':no_hp', $this->no_hp);
	    $stmt->bindParam(':alamat', $this->alamat);
	    $stmt->bindParam(':gol_darah', $this->gol_darah);
	    $stmt->bindParam(':id', $this->id_pasien);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function delete() {
		$query = "DELETE FROM ".$this->table_name." WHERE id_pasien = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_pasien);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
