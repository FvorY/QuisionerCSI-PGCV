<?php
include "../koneksi.php";
include "../fungsi/fungsi_indotgl.php";
include "../fungsi/class_paging.php";

$module = $_GET['module'];

if ($module == 'variabel'){
	include "modul/mod_variabel/variabel.php";
}
elseif ($module == 'question'){
	include "modul/mod_question/pertanyaan.php";
}
elseif ($module == 'hasil'){
	include "modul/mod_report/hasil.php";
}
elseif ($module == 'grafik'){
	include "modul/mod_report/grafik.php";
}
elseif ($module == 'user'){
	include "modul/mod_user/user.php";
}
else{
	include "modul/mod_home/home.php";
}
?>
