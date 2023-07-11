<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Siswa</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url('https://w7.pngwing.com/pngs/1012/665/png-transparent-sky-cloud-blue-blue-background-s-text-computer-wallpaper-color.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Edit Data Siswa</h2>

        <?php
        $host = mysqli_connect("localhost", "root", "", "smk");
        if (!$host) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $query = "SELECT * FROM siswa WHERE id = $id";
            $result = mysqli_query($host, $query);

            if (mysqli_num_rows($result) > 0) {
                $data = mysqli_fetch_assoc($result);
                $nama = $data['nama'];
                $alamat = $data['alamat'];
                $jenis_kelamin = $data['jenis_kelamin'];
                $hobi = explode(", ", $data['hobi']);
                $alat = $data['alat_koding'];
            } else {
                echo "Data tidak ditemukan.";
                exit;
            }
        } else {
            echo "ID tidak ditemukan.";
            exit;
        }

        if (isset($_POST['simpan'])) {
            $nama_baru = $_POST['nama'];
            $alamat_baru = $_POST['alamat'];
            $jenis_kelamin_baru = $_POST['jenis_kelamin'];
            $hobi_baru = implode(", ", $_POST['hobi']);
            $alat_baru = $_POST['alat'];

            $query = "UPDATE siswa SET nama = '$nama_baru', alamat = '$alamat_baru', hobi = '$hobi_baru', jenis_kelamin = '$jenis_kelamin_baru', alat_koding = '$alat_baru' WHERE id = $id";
            $update = mysqli_query($host, $query);

            if ($update) {
                header("Location: index.php");
                exit;
            } else {
                echo "Gagal mengupdate data.";
                exit;
            }
        }

        mysqli_close($host);
        ?>

        <form method="POST">
            <table>
                <tr>
                    <td>Nama:</td>
                    <td><input type="text" name="nama" value="<?php echo $nama; ?>" /></td>
                </tr>
                <tr>
                    <td>Alamat:</td>
                    <td><input type="text" name="alamat" value="<?php echo $alamat; ?>" /></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin:</td>
                    <td>
                        <input type="radio" name="jenis_kelamin" value="Laki-laki" <?php echo ($jenis_kelamin == 'Laki-laki') ? 'checked' : ''; ?>>Laki-laki
                        <input type="radio" name="jenis_kelamin" value="Perempuan" <?php echo ($jenis_kelamin == 'Perempuan') ? 'checked' : ''; ?>>Perempuan
                    </td>
                </tr>
                <tr>
                    <td>Alat Koding:</td>
                    <td>
                        <select name="alat">
                            <option value="Pilih" <?php echo ($alat == 'Pilih') ? 'selected' : ''; ?>>Pilih</option>
                            <option value="PC" <?php echo ($alat == 'PC') ? 'selected' : ''; ?>>PC</option>
                            <option value="Laptop" <?php echo ($alat == 'Laptop') ? 'selected' : ''; ?>>Laptop</option>
                            <option value="HP" <?php echo ($alat == 'HP') ? 'selected' : ''; ?>>HP</option>
                            <option value="Tulis Tangan" <?php echo ($alat == 'Tulis Tangan') ? 'selected' : ''; ?>>Tulis Tangan</option</select>
                    </td>
                </tr>
                <tr>
                    <td>Hobi:</td>
                    <td>
                        <label><input type="checkbox" name="hobi[]" value="Nonton" <?= (in_array('Nonton', $hobi)) ? 'checked' : ''; ?>>Nonton</label>
                        <label><input type="checkbox" name="hobi[]" value="Menulis" <?= (in_array('Menulis', $hobi)) ? 'checked' : ''; ?>>Menulis</label>
                        <label><input type="checkbox" name="hobi[]" value="Traveling" <?= (in_array('Traveling', $hobi)) ? 'checked' : ''; ?>>Traveling</label>
                        <label><input type="checkbox" name="hobi[]" value="Otomotif" <?= (in_array('Otomotif', $hobi)) ? 'checked' : ''; ?>>Otomotif</label>
                        <label><input type="checkbox" name="hobi[]" value="Fotografi" <?= (in_array('Fotografi', $hobi)) ? 'checked' : ''; ?>>Fotografi</label>
                        <label><input type="checkbox" name="hobi[]" value="Programming" <?= (in_array('Programming', $hobi)) ? 'checked' : ''; ?>>Programming</label>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="simpan" value="Simpan Perubahan">
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
