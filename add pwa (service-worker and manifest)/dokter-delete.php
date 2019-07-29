<!DOCTYPE html>
<html>
<?php
include_once('includes/header.inc.php');
include_once('includes/dokter.inc.php');

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$Dokter = new Dokter($db);
$Dokter->id_dokter = $id;

  if($Dokter->delete()){
    echo "<script>location.href='dokter.php';</script>";
  } else{
    echo "<script>alert('Gagal Hapus Data');location.href='dokter.php';</script>";
  }
?>