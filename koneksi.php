<?php
// koneksi
$host = mysqli_connect("localhost", "root", "", "smk");
if (!$host) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
