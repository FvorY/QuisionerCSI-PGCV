<link href="css/bootstrap.min.css" rel="stylesheet">
<?php
error_reporting(0);
include "koneksi.php";
include "fungsi/fungsi_indotgl.php";
$companyName	= $_POST[name];
$pekerjaan = $_POST[fakultas];
$gender = $_POST[gender];
$prodi = $_POST[prodi];
$nim = $_POST[nim];
$date	= date('Y-m-d');
$no=1;
$companyId =date('Ymd his');

$no_hitung = 1;
$sql_hitung = mysqli_query($db,"SELECT * FROM tvariabel");
while($data_hitung = mysqli_fetch_array($sql_hitung)){
	$id_hitung = $data_hitung[variabelId];
	$hasil_hitung = mysqli_query($db,"SELECT * FROM tquestion, tvariabel WHERE tquestion.variabelId = '$id_hitung' AND tquestion.variabelId = tvariabel.variabelId ORDER BY tvariabel.variabelId");
	$i_hitung = 1;
	while ($r_hitung = mysqli_fetch_array($hasil_hitung)){
		$id_hitung = $data_hitung[variabelId];
		$asfa_hitung = $_POST['asfa'.$i_hitung.$id_hitung];
		if (empty($asfa_hitung)){
			echo "<script lang=javascript>
		 		window.alert('Anda belum mengisi kuisioner atau ada kuisioner yang belum terisi..!');
		 		history.back();
		 		</script>";
  			exit;
		}

		$i_hitung++;
	}
	$no_hitung++;
}

if (empty($companyName)){
	echo "<script lang=javascript>
		 		window.alert('Isi Nama Anda');
		 		history.back();
		 		</script>";
  			exit;
}

elseif (empty($pekerjaan)){
	echo "<script lang=javascript>
		 		window.alert('Isi Fakultas Anda');
		 		history.back();
		 		</script>";
  			exit;
}

elseif (empty($prodi)){
	echo "<script lang=javascript>
		 		window.alert('Prodi');
		 		history.back();
		 		</script>";
  			exit;
}
elseif (empty($nim)){
	echo "<script lang=javascript>
		 		window.alert('NIM');
		 		history.back();
		 		</script>";
  			exit;
}
elseif (empty($gender)){
	echo "<script lang=javascript>
		 		window.alert('Jenis Kelamin');
		 		history.back();
		 		</script>";
  			exit;
}
else{
	$pekerjaan = str_replace('+', ' ', $pekerjaan);
	$no = 1;
	$sql = mysqli_query($db,"SELECT * FROM tvariabel");
	mysqli_query($db,"INSERT INTO tresponden(respondenId,name,gender,prodi,dateSurvey,fakultas,nim)
	VALUES('$companyId','$companyName', '$gender','$prodi','$date','$pekerjaan','$nim')");
	while($data = mysqli_fetch_array($sql)){
		$id = $data[variabelId];
		$hasil = mysqli_query($db,"SELECT * FROM tquestion, tvariabel WHERE tquestion.variabelId = '$id' AND tquestion.variabelId = tvariabel.variabelId ORDER BY tvariabel.variabelId");
		$i = 1;
		while ($r = mysqli_fetch_array($hasil)){
			$id = $data[variabelId];
			$asfa = $_POST['asfa'.$i.$id];
			// echo "$i $asfa<br>";
			if ($asfa == '5'){
				mysqli_query($db,"INSERT INTO tanswer (descriptionId,categoryId,variabelId,respondenId,jawaban,jawaban5,jawaban4,jawaban3,jawaban2,jawabanE)
				VALUES('$r[questionId]','$r[categoryId]','$r[variabelId]','$companyId','$asfa','5','0','0','0','0')");
			}
			elseif($asfa == '4'){
				mysqli_query($db,"INSERT INTO tanswer (descriptionId,categoryId,variabelId,respondenId,jawaban,jawaban5,jawaban4,jawaban3,jawaban2,jawabanE)
				VALUES('$r[questionId]','$r[categoryId]','$r[variabelId]','$companyId','$asfa','0','4','0','0','0')");
			}
			elseif($asfa == '3'){
				mysqli_query($db,"INSERT INTO tanswer (descriptionId,categoryId,variabelId,respondenId,jawaban,jawaban5,jawaban4,jawaban3,jawaban2,jawabanE)
				VALUES('$r[questionId]','$r[categoryId]','$r[variabelId]','$companyId','$asfa','0','0','3','0','0')");
				// VALUES($r[questionId]','$r[categoryId]','$r[variabelId]','$companyId','$asfa','0','0','3','0','0')");
			}
			elseif($asfa == '2'){
				mysqli_query($db,"INSERT INTO tanswer (descriptionId,categoryId,variabelId,respondenId,jawaban,jawaban5,jawaban4,jawaban3,jawaban2,jawabanE)
				VALUES('$r[questionId]','$r[categoryId]','$r[variabelId]','$companyId','$asfa','0','0','0','2','0')");
			}
			else{
				mysqli_query($db,"INSERT INTO tanswer (descriptionId,categoryId,variabelId,respondenId,jawaban,jawaban5,jawaban4,jawaban3,jawaban2,jawabanE)
				VALUES('$r[questionId]','$r[categoryId]','$r[variabelId]','$companyId','$asfa','0','0','0','0','1')");
			}
			$i++;
		}
		echo "<br>";
		$no++;
	}


	echo "<center><font face='Tahoma' size='2'>
			Responden yang terhormat,<br><br>
			Terima kasih atas waktu yang telah diluangkan untuk melengkapi survey yang kami sediakan. <br>
			Pendapat Anda sangat berarti bagi kami untuk meningkatkan kualitas SIAKAD. <br><br>
			Hormat kami, <br><br>
			RISMAWATI HUSNA<br>
			<a href='./index.php'>
			</br>
			</br>
			<button  class='btn btn-lg btn-info'><span class='glyphicon glyphicon-arrow-left'></span> Kembali</button>
			</a>
			</center>";

}
?>
