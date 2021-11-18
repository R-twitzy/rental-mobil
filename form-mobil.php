<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg petugas
if (!isset($_SESSION["karyawan"])) {
    header("location:login.php");
}
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form mobil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header bg-dark mt-2">
                <h5 class="text-white">
                    Form Mobil
                </h5>
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET["id_mobil"])) {
                    #form utk edit
                    # mengakses data anggota dari id_mobil yg dikirim
                    include "connection.php";
                    $id_mobil = $_GET["id_mobil"];
                    $sql = "select * from Mobil 
                    where id_mobil='$id_mobil'";
                    # eksekusi perintah sql
                    $hasil = mysqli_query($connect, $sql);
                    # konversi hasil query ke bentuk array
                    $mobil = mysqli_fetch_array($hasil);
                    ?>
                    <form action="process-mobil.php" method="post"
                    enctype="multipart/form-data">
                        ID Mobil
                        <input type="number" name="id_mobil"
                        class="form-control mb-2" required
                        value="<?=$mobil["id_mobil"] ?>" readonly>

                        Nopol
                        <input type="text" name="nomor_mobil"
                        class="form-control mb-2" required
                        value="<?=$mobil["nomor_mobil"] ?>">

                        Merk
                        <input type="text" name="merk"
                        class="form-control mb-2" required
                        value="<?=$mobil["merk"] ?>">

                        Jenis
                        <select name="jenis" class="form-control mb-2" required">
                            <option value="<?=$mobil["jenis"] ?>">
                                <?=$mobil["jenis"] ?>
                            </option>
                            <option value="Family">Family</option>
                            <option value="Sport">Sport</option>
                        </select>

                        Warna
                        <input type="text" name="warna"
                        class="form-control mb-2" required
                        value="<?=$mobil["warna"] ?>">

                        Tahun Pembuatan
                        <input type="number" name="tahun_pembuatan"
                        class="form-control mb-2" required
                        value="<?=$mobil["tahun_pembuatan"] ?>">

                        Biaya Sewa
                        <input type="number" name="biaya_sewa_per_hari"
                        class="form-control mb-2" required
                        value="<?=$mobil["biaya_sewa_per_hari"] ?>">

                        Image <br>
                        <img src="image/<?=$image["image"] ?>" width="150">
                        <input type="file" name="image"
                        class="form-control mb-2">

                        <button type="submit" class="btn btn-primary btn-block" name="edit_mobil"
                        onclick="return confirm('Apakah anda yakin?')">
                            Save
                        </button>
                    </form>
                <?php
                } else {
                    #form utk insert ?>
                    <form action="process-mobil.php" method="post"
                    enctype="multipart/form-data">

                        Nopol
                        <input type="text" name="nomor_mobil"
                        class="form-control mb-2" required>

                        Merk
                        <input type="text" name="merk"
                        class="form-control mb-2" required>

                        Jenis
                        <select name="jenis" class="form-control mb-2" required">
                            <option value="Family">Family</option>
                            <option value="Sport">Sport</option>
                        </select>

                        Warna
                        <input type="text" name="warna"
                        class="form-control mb-2" required>

                        Tahun Pembuatan
                        <input type="number" name="tahun_pembuatan"
                        class="form-control mb-2" required>

                        Biaya Sewa
                        <input type="number" name="biaya_sewa_per_hari"
                        class="form-control mb-2" required>

                        Image <br>
                        <img src="image/<?=$image["image"] ?>" width="150">
                        <input type="file" name="image"
                        class="form-control mb-2">

                        <button type="submit" class="btn btn-primary btn-block" name="simpan_mobil">
                            Save
                        </button>
                    </form>
                <?php    
                }
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>