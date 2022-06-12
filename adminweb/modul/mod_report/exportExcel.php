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
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN A</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN B</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN C</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN D</b></td>
			<td bgcolor=#c6e1f2 align=center><b>JAWABAN E</b></td>
			<td bgcolor=#c6e1f2 align=center><b>Jumlah Total</b></td>
		</tr>";
$no = 1;
while ($data = mysqli_fetch_array($hasil)){
	$descriptionId = $data[descriptionId];
	$sql = mysqli_query($db,"SELECT SUM(jawaban5) As TotalA,
						SUM(jawaban4) As TotalB,
						SUM(jawaban3) As TotalC,
						SUM(jawaban2) As TotalD,
						SUM(jawabanE) As TotalE,
						SUM(jawaban5+jawaban4+jawaban3+jawaban2+jawabanE) As jumlahtotal
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
$data_count = mysqli_fetch_array(mysqli_query($db,"SELECT SUM(jawaban5) As TotalA,
						SUM(jawaban4) As TotalB,
						SUM(jawaban3) As TotalC,
						SUM(jawaban2) As TotalD,
						SUM(jawabanE) As TotalE,
						SUM(jawaban5+jawaban4+jawaban3+jawaban2+jawabanE) As jumlahtotal
						FROM tanswer"));
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