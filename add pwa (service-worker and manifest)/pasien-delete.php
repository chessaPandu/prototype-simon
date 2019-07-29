<!DOCTYPE html>
<html>
<?php
include_once('includes/header.inc.php');
include_once('includes/pasien.inc.php');

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$Pasien = new Pasien($db);
$Pasien->id_pasien = $id;

  if($Pasien->delete()){
    echo "<script>location.href='pasien.php';</script>";
  } else{
    echo "<script>alert('Gagal Hapus Data');location.href='pasien.php';</script>";
  }
?>