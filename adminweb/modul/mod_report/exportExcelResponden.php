<?php
error_reporting(0);
$namaFile = "responden_report.xls";
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Transfer-Encoding: binary ");

include "../../../koneksi.php";
include "../../../fungsi/fungsi_indotgl.php";

$hasil = mysqli_query($db,"SELECT * FROM tquestion");
$date = date('Y-m-d');
$time = date('H:i:s');
$dateIndo = tgl_indo($date);
$dateIndo2 = tgl_indo($responden['dateSurvey']);

$responden = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM tanswer, tresponden WHERE tanswer.respondenId = '$_GET[id]' AND tresponden.respondenId = tanswer.respondenId"));
$dateIndo2 = tgl_indo($responden['dateSurvey']);
$namaFile = "responden_report_$responden[companyName].xls";
header("Content-Disposition: attachment; filename=$namaFile");
echo "<table border=1 cellpadding=0 cellspacing=0>
		<tr align='center'>
			<td colspan=8 bgcolor=yellow style='border: none';>Laporan Kuisioner Responden</td>
		</tr>
		<tr>
			<td colspan=8>Dicetak : <b>$dateIndo $time</b></td>
		</tr>
		<tr>
			<td colspan=8>Nama : <b>$responden[companyName]</b></td>
		</tr>
		<tr>
			<td colspan=8>Alamat : <b>$responden[companyAddress]</b></td>
		</tr>
		<tr>
			<td colspan=8>Telp / Ph : <b>$responden[companyPhoneHP]</b></td>
		</tr>
		<tr>
			<td colspan=8>Tanggal Isi Survey : <b>$dateIndo2 </b></td>
		</tr>
		<tr>
			<td colspan=8>Kritik dan Saran : <b>$responden[suggestion]</b></td>
		</tr>
		
		<tr>
			<td bgcolor=#c6e1f2 align=center><b>NO</b></td>
			<td bgcolor=#c6e1f2 align=center><b>Group ID</b></td>
			<td bgcolor=#c6e1f2 align=center><b>DESCRIPTION</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN A</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN B</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN C</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN D</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN E</b></td>
			<td bgcolor=#c6e1f2 align=center><b>Jumlah Total</b></td>
		</tr>";
$no = 1;
while ($data = mysqli_fetch_array($hasil)){
	$descriptionId = $data[questionId];
	$sql = mysqli_query($db,"SELECT SUM(jawaban5) As TotalA,
						SUM(jawaban4) As TotalB,
						SUM(jawaban3) As TotalC,
						SUM(jawaban2) As TotalD,
						SUM(jawabanE) As TotalE,
						SUM(jawaban5+jawaban4+jawaban3+jawaban2+jawabanE) As jumlahtotal
						FROM tanswer WHERE questionId = '$questionId' AND respondenId = '$_GET[id]'");
	
	while($oke = mysqli_fetch_array($sql)){
		echo "<tr valign=top>
			<td>$no</td>
			<td>$data[groupId]</td>
			<td>$data[description]</td>
			<td>$oke[TotalA]</td>
			<td>$oke[TotalB]</td>
			<td>$oke[TotalC]</td>
			<td>$oke[TotalD]</td>
			<td>$oke[TotalE]</td>
			<td>$oke[jumlahtotal]</td>
		  </tr>";	 
		 
		$no++;
	}
}
$data_count = mysqli_fetch_array(mysqli_query($db,"SELECT SUM(jawaban5) As TotalA,
						SUM(jawaban4) As TotalB,
						SUM(jawaban3) As TotalC,
						SUM(jawaban2) As TotalD,
						SUM(jawabanE) As TotalE,
						SUM(jawaban5+jawaban4+jawaban3+jawaban2+jawabanE) As jumlahtotal
						FROM tanswer WHERE respondenId = '$_GET[id]'"));
echo "<tr>
	<td bgcolor=#c6e1f2></td>
	<td bgcolor=#c6e1f2 align='right'><b>Total</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalA]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalB]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalC]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalD]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalE]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[jumlahtotal]</b></td>
	</tr></table>";
?>