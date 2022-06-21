<?php
error_reporting(0);
$namaFile = "all_responden_recap_report.xls";
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment; filename=$namaFile");
header("Content-Transfer-Encoding: binary ");

include "../../../koneksi.php";
include "../../../fungsi/fungsi_indotgl.php";

$hasil = mysqli_query($db,"SELECT * FROM questiondescription");
$date = date('Y-m-d');
$time = date('H:i:s');
$dateIndo = tgl_indo($date);

echo "<table border=1 cellpadding=0 cellspacing=0>
		<tr>
			<td colspan=8 bgcolor=yellow style='border: none'; align='center'>Laporan Rekap Kuisioner Responden</td>
		</tr>
		<tr>
			<td colspan=8>Dicetak : <b>$dateIndo $time</b></td>
		</tr>
		
		<tr>
			<td bgcolor=#c6e1f2 align=center><b>NO</b></td>
			<td bgcolor=#c6e1f2 align=center><b>GROUP ID</b></td>
			<td bgcolor=#c6e1f2 align=center><b>DESCRIPTION</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN 5</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN 4</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN 3</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN 2</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN 1</b></td>
			<td bgcolor=#c6e1f2 align=center><b>Jumlah Total</b></td>
		</tr>";
$no = 1;
while ($data = mysqli_fetch_array($hasil)){
	$descriptionId = $data[descriptionId];
	$sql = mysqli_query($db,"SELECT CEILING(SUM(jawaban5) / 5) As TotalA,
	CEILING(SUM(jawaban4) / 4) As TotalB,
	CEILING(SUM(jawaban3) / 3) As TotalC,
	CEILING(SUM(jawaban2) / 2) As TotalD,
	CEILING(SUM(jawabanE) / 1) As TotalE,
	SUM( jawaban5 div 5 + jawaban4 div 4 + jawaban3 div 3 + jawaban2 div 2 + jawabanE div 1) As jumlahtotal
	FROM tanswer WHERE descriptionId = '$descriptionId'");
	
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
$data_count = mysqli_fetch_array(mysqli_query($db,"SELECT CEILING(SUM(jawaban5) / 5) As TotalA,
CEILING(SUM(jawaban4) / 4) As TotalB,
CEILING(SUM(jawaban3) / 3) As TotalC,
CEILING(SUM(jawaban2) / 2) As TotalD,
CEILING(SUM(jawabanE) / 1) As TotalE,
SUM( jawaban5 div 5 + jawaban4 div 4 + jawaban3 div 3 + jawaban2 div 2 + jawabanE div 1) As jumlahtotal
FROM tanswer WHERE respondenId = '$_GET[id]'"));
echo "<tr align=center>
	
	<td bgcolor=#c6e1f2 colspan=3><b>Total</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalA]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalB]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalC]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalD]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[TotalE]</b></td>
	<td bgcolor=#c6e1f2><b>$data_count[jumlahtotal]</b></td>
	</tr></table>";
?>