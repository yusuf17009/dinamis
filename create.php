<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian CRUD - Membuat Data</title>
    <link rel="stylesheet" href="style/custom.css">
    <!-- Framework Style Boostrap biar ga perlu styling manual -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <div class="container-fluid ">
            <a class="navbar-brand text-uppercase text-light fw-bold" href="index.php">Muhammad Naufal Mathara RAHMAN | 26 | XI TKJ 2</a>
        </div>
    </nav>
    <div class="container">
        <h4 class="mt-4 mx-2 fw-bold">MEMBUAT DATA SISWA | Create Content</h4>
        <a href="index.php" class="btn btn-danger my-3 mx-2">kembali</a>
        <div class="garis"></div>
        <?php

        // -------------------------------------------------------------
        // KODE PHP DIBAWAH MERUPAKAN FUNGSI UNTUK MELAKUKAN CREATE
        // -------------------------------------------------------------


        // Mengimport file connect.php untuk terhubung ke database
        include "connect.php";

        // Fungsi untuk untuk mencegah inputan karakter yg tidak sesuai
        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Cek apakah ada kiriman form dari method POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = input($_POST["nama"]);
            $absen = input($_POST["absen"]);
            $kelas = input($_POST["kelas"]);
            $foto = $_FILES["foto"]["name"];

            // SQL Query untuk menginput data kedalam tabel siswa
            $sql = "insert into siswa (foto,nama,absen,kelas) 
            values ('$foto','$nama','$absen','$kelas')";

            // Menjalankan SQL query diatas
            $hasil = mysqli_query($connect, $sql);

            // Mengecek kondisi diatas apakah berhasil atau tidak dalam mengeksekusi query
            if ($hasil) {
                // Mengupload foto di folder 'foto'
                move_uploaded_file($_FILES["foto"]["tmp_name"], "foto/" . $_FILES["foto"]["name"]);
                header("Location:index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
            }
        }
        ?>
        <div class="col col-lg-8 mx-auto">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group mt-3">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Masukan foto</label>
                        <input class="form-control" name="foto" type="file" id="formFile">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label>Nama:</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />
                </div>
                <div class="form-group mt-3">
                    <label>Absen :</label>
                    <input type="text" name="absen" class="form-control" placeholder="Masukan Absen" required />
                </div>
                <div class="form-group mt-3">
                    <label>Kelas:</label>
                    <input type="text" name="kelas" class="form-control" placeholder="Masukan Kelas" required />
                </div>
                <button type="submit" name="submit" class="btn btn-primary mt-3">Kirim</button>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>