<!DOCTYPE html>
<html>
<head>
    <title>Mari Belajar Coding</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            background-image: url('https://w7.pngwing.com/pngs/1012/665/png-transparent-sky-cloud-blue-blue-background-s-text-computer-wallpaper-color.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.7); /* Putih transparan */
            border-radius: 10px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Form Input Data</h2>

        <?php
        $host = mysqli_connect("localhost", "root", "", "smk");
        if (!$host) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        if (isset($_POST['simpan'])) {
            $nama = $_POST["nama"];
            $alamat = $_POST["alamat"];
            $jenis_kelamin = $_POST["jenis_kelamin"];
            $hobi = implode(", ", $_POST['hobi']);
            $alat = $_POST["alat"];

            $query = "INSERT INTO siswa (nama, alamat, hobi, jenis_kelamin, alat_koding) VALUES ('$nama', '$alamat', '$hobi', '$jenis_kelamin', '$alat')";
            $simpan = mysqli_query($host, $query);

            if ($simpan) {
                echo "<div class='alert alert-success' role='alert'>Data telah tersimpan ke database.</div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>Error saat menyimpan data: " . mysqli_error($host) . "</div>";
            }
        }
        ?>

        <form method="POST">
            <table>
                <tr>
                    <td>Nama:</td>
                    <td><input type="text" name="nama" /></td>
                </tr>
                <tr>
                    <td>Alamat:</td>
                    <td><input type="text" name="alamat" /></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin:</td>
                    <td>
                        <input type="radio" name="jenis_kelamin" value="Laki-laki">Laki-laki
                        <input type="radio" name="jenis_kelamin" value="Perempuan">Perempuan
                    </td>
                </tr>
                <tr>
                    <td>Alat Koding:</td>
                    <td>
                        <select name="alat">
                            <option value="Pilih">Pilih</option>
                            <option value="PC">PC</option>
                            <option value="Laptop">Laptop</option>
                            <option value="HP">HP</option>
                            <option value="Tulis Tangan">Tulis Tangan</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Hobi:</td>
                    <td>
                        <label><input type="checkbox" name="hobi[]" value="Nonton">Nonton</label>
                        <label><input type="checkbox" name="hobi[]" value="Menulis">Menulis</label>
                        <label><input type="checkbox" name="hobi[]" value="Traveling">Traveling</label>
                        <label><input type="checkbox" name="hobi[]" value="Otomotif">Otomotif</label>
                        <label><input type="checkbox" name="hobi[]" value="Fotografi">Fotografi</label>
                        <label><input type="checkbox" name="hobi[]" value="Programming">Programming</label>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="simpan" value="Simpan">
                    </td>
                </tr>
            </table>
        </form>

    <div class="container mt-5">
        <h2 class="text-center">Data Siswa</h2>
        <table class="table table-striped table-bordered mt-3">
            <thead class="thead-dark">
    <tr>
        <th width="10%">No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Hobi</th>
        <th>Jenis Kelamin</th>
        <th>Alat Koding</th>
        <th>Aksi</th>  <!-- Kolom baru -->
    </tr>

    <?php
    $i = 1;
    $query = "SELECT * FROM siswa";
    $sql = mysqli_query($host, $query);
    while ($data = mysqli_fetch_array($sql)) {
        echo "<tr>";
        echo "<td>" . $i++ . "</td>";
        echo "<td>" . $data['nama'] . "</td>";
        echo "<td>" . $data['alamat'] . "</td>";
        echo "<td>" . $data['hobi'] . "</td>";
        echo "<td>" . $data['jenis_kelamin'] . "</td>";
        echo "<td>" . $data['alat_koding'] . "</td>";
        // Tambahkan kolom "Aksi" di sini
        echo "<td>";
        echo "<a href='edit.php?id=" . $data['id'] . "'>Edit</a> | "; // Ganti 'id' dengan nama kolom id dari tabel Anda
        echo "<a href='delete.php?id=" . $data['id'] . "'>Hapus</a>"; // Ganti 'id' dengan nama kolom id dari tabel Anda
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- snip -->

    </div>
</body>
</html>
