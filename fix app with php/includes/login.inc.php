<?php
class Login {
    private $conn;
    private $table_name1 = "admin";
    private $table_name2 = "dokter";
    private $table_name3 = "perawat";

    public $user;
    public $username;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        $user = $this->checkCredentialsAdmin();
        if ($user) {
            $this->user = $user;
            session_start();
            $_SESSION['id_user'] = $user['id_admin'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];
            return $user['nama'];
        }else {
            $user = $this->checkCredentialsDokter();
            if ($user) {
                $this->user = $user;
                session_start();
                $_SESSION['id_user'] = $user['id_dokter'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['password'] = $user['password'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['role'] = $user['role'];
                return $user['nama'];
            }else {
                $user = $this->checkCredentialsPerawat();
                if ($user) {
                    $this->user = $user;
                    session_start();
                    $_SESSION['id_user'] = $user['id_perawat'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['password'] = $user['password'];
                    $_SESSION['nama'] = $user['nama'];
                    $_SESSION['role'] = $user['role'];
                    return $user['nama'];
                }else {
                    return false;
                }
            }
        }
        return false;
    }

    protected function checkCredentialsAdmin() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_name1.' WHERE username=? AND password=? LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }

    protected function checkCredentialsDokter() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_name2.' WHERE username=? AND password=? LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }
    
    protected function checkCredentialsPerawat() {
        $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_name3.' WHERE username=? AND password=? LIMIT 1');
        $stmt->bindParam(1, $this->username);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->password;
            if ($submitted_pass == $data['password']) return $data;
        }
        return false;
    }

    public function getUser() {
        return $this->user;
    }
}
