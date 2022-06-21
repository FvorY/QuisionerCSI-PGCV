<?php

$server = "localhost:8889";
$user = "root";
$password = "root";
$nama_database = "survey2";

$db = mysqli_connect($server, $user, $password, $nama_database);

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

?>
