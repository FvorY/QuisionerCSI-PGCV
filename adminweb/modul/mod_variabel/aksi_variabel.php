<?php
session_start();
include "../../../koneksi.php";
$module = $_GET[module];
$act = $_GET[act];

// Hapus variabel
if ($module=='variabel' AND $act=='hapus'){
	mysqli_query($db, "DELETE FROM tvariabel WHERE variabelId='$_GET[id]'");
	header('location:../../master.php?module=variabel');
}

// Input variabel
elseif ($module=='variabel' AND $act=='input'){
	$variabelName 	= $_POST['variabel'];
	$createdDate = date('Y-m-d H:i:s');
	$masuk = mysqli_query($db, "INSERT INTO tvariabel(variabelName,CreatedDate,CreatedUser, ModifiedDate, ModifiedUser) VALUES('$variabelName','$createdDate','$_SESSION[userId]', '$createdDate','$_SESSION[userId]')");
	header('location:../../master.php?module=variabel');
}

// Update variabel
elseif ($module=='variabel' AND $act=='update'){
	$modifiedDate = date('Y-m-d H:i:s');
	$aksi=mysqli_query($db, "UPDATE tvariabel SET variabelName = '$_POST[variabel]', ModifiedDate = '$modifiedDate', ModifiedUser = '$_SESSION[userId]' WHERE variabelId = '$_POST[id]'");
	if($aksi)
  {
    header('location:../../master.php?module=variabel');
  }
  else
  {
    echo "gagal";
  }
}
?>
