<?php
session_start();
error_reporting(1);
include "../../../koneksi.php";
$module = $_GET[module];
$act = $_GET[act];

// Hapus Deskripsi
if ($module=='question' AND $act=='hapus'){
	mysqli_query($db, "DELETE FROM tquestion WHERE questionId='$_GET[id]'");
	header('location:../../master.php?module=question');
}

// Input Deskripsi
elseif ($module=='question' AND $act=='input'){
	$categoryId = $_POST['categoryId'];
	$variabelId 	= $_POST['variabelId'];
	$pertanyaan	= $_POST['pertanyaan'];
	$createdDate= date('Y-m-d H:i:s');
	if ($categoryId == '0'){
		echo "<script lang=javascript>
		 		window.alert('Pilih kategori pertanyaan');
		 		history.back();
		 		</script>";
  			exit;
	}
	if ($variabelId == '0'){
		echo "<script lang=javascript>
		 		window.alert('Pilih variabel pertanyaan');
		 		history.back();
		 		</script>";
  			exit;
	}
	elseif (empty($pertanyaan)){
		echo "<script lang=javascript>
		 		window.alert('Pertanyaan belum diisi');
		 		history.back();
		 		</script>";
  			exit;
	}
	else{
		$masuk = mysqli_query($db, "INSERT INTO tquestion(variabelId, categoryId, question, CreatedDate, CreatedUser, ModifiedDate, ModifiedUser) VALUES('$variabelId', '$categoryId','$pertanyaan','$createdDate','$_SESSION[userId]','$createdDate','$_SESSION[userId]')");
		if($masuk){
			header('location:../../master.php?module=question');
		}
		else{
			echo"gagal...!";
		}
	}
}

// Update Group
elseif ($module=='question' AND $act=='update'){
	include "../../../koneksi.php";
	$modifiedDate = date('Y-m-d H:i:s');
	$question=$_POST['question'];
	$variabelId=$_POST['variabelId'];
	$ModifiedUser=$_SESSION['userId'];
	$questionId=$_POST['id'];

	$aksi=mysqli_query($db, "UPDATE tquestion SET question='$question', variabelId='$variabelId',ModifiedDate = '$modifiedDate',
	ModifiedUser = '$ModifiedUser' WHERE questionId = '$questionId'") or die("gagal melaksanakan kueri");
	if($aksi)
	{

		header('location:../../master.php?module=question');
	}
	else
	{
		echo "gagal";
	}
}
?>
