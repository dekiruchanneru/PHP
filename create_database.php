<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "smk";

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Membuat tabel siswa
$sql = "CREATE TABLE siswa (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat VARCHAR(100) NOT NULL,
    hobi VARCHAR(200) NOT NULL,
    jenis_kelamin VARCHAR(20) NOT NULL,
    alat_koding VARCHAR(50) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Tabel 'siswa' berhasil dibuat";
} else {
    echo "Error saat membuat tabel: " . mysqli_error($conn);
}

// Menutup koneksi
mysqli_close($conn);
?>
