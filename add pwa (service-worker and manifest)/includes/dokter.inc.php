<?php
class Dokter {
	private $conn;
	private $table_name = 'dokter';

    public $id_dokter;
    public $username;
    public $password;
	public $nama;
    public $tgl_lahir;
    public $jk;
    public $no_hp;
    public $email;
    public $alamat;
    public $role;
    public $id_admin;

	public function __construct($db) {
		$this->conn = $db;
	}

	function insert() {
		$query = "INSERT INTO {$this->table_name} VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_dokter);
        $stmt->bindParam(2, $this->username);
        $stmt->bindParam(3, $this->password);
		$stmt->bindParam(4, $this->nama);
	    $stmt->bindParam(5, $this->tgl_lahir);
	    $stmt->bindParam(6, $this->jk);
        $stmt->bindParam(7, $this->no_hp);
        $stmt->bindParam(8, $this->email);
	    $stmt->bindParam(9, $this->alamat);
		$stmt->bindParam(10, $this->role);
		$stmt->bindParam(11, $this->id_admin);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function getNewID() {
		$query = "SELECT MAX(id_dokter) AS code FROM {$this->table_name}";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return $this->genCode($row["code"], '12', 8);
		} else {
			return $this->genCode($nomor_terakhir, '12', 8);
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
		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_dokter ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();

		return $stmt;
	}

	function readOne() {
		$query = "SELECT * FROM ".$this->table_name." WHERE id_dokter=:id_dokter LIMIT 0,1";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id_dokter', $this->id_dokter);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id_dokter = $row['id_dokter'];
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->nama = $row['nama'];
	    $this->tgl_lahir = $row['tgl_lahir'];
	    $this->jk = $row['jk'];
        $this->no_hp = $row['no_hp'];
        $this->email = $row['email'];
	    $this->alamat = $row['alamat'];
	}

	function update() {
		$query = "UPDATE {$this->table_name}
				SET
                    username = :username,
                    password = :password,
					nama = :nama,
				    tgl_lahir = :tgl_lahir,
				    jk = :jk,
				    no_hp = :no_hp,
                    email = :email,
				    alamat = :alamat
				WHERE
					id_dokter = :id";
        $stmt = $this->conn->prepare($query);
	 
		$stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
	    $stmt->bindParam(':nama', $this->nama);
		$stmt->bindParam(':tgl_lahir', $this->tgl_lahir);
	    $stmt->bindParam(':jk', $this->jk);
        $stmt->bindParam(':no_hp', $this->no_hp);
        $stmt->bindParam(':email', $this->email);
	    $stmt->bindParam(':alamat', $this->alamat);
	    $stmt->bindParam(':id', $this->id_dokter);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		$query = "DELETE FROM ".$this->table_name." WHERE id_dokter = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id_dokter);
		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
