<?php
require 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "DELETE FROM siswa WHERE id = $id";
    $delete = mysqli_query($host, $query);
    
    if ($delete) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menghapus data.";
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}

mysqli_close($host);
?>
