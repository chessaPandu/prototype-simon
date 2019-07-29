<!DOCTYPE html>
<html>
<?php
include_once('includes/header.inc.php');
include_once('includes/perawat.inc.php');

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$Perawat = new Perawat($db);
$Perawat->id_perawat = $id;

  if($Perawat->delete()){
    echo "<script>location.href='perawat.php';</script>";
  } else{
    echo "<script>alert('Gagal Hapus Data');location.href='perawat.php';</script>";
  }
?>