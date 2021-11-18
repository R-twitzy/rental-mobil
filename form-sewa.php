<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg karyawan
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Form Penyewaan Mobil pinjam</title>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header bg-dark mt-2">
                <h5 class="text-white">Form Penyewaan Mobil</h5>
            </div>
            <div class="card-body">
                <form action="process-sewa.php" method="post">
                    <!-- input kode sewa (alhamdulillah kode sewa saya auto increment)-->

                    <!-- input tgl_sewa otomatis -->
                    <?php
                    date_default_timezone_set('Asia/Jakarta');
                    ?>
                    Tanggal sewa
                    <input type="text" name="tgl_sewa" class="form-control mb-2"
                    value="<?=(date("Y-m-d H:i:s"))?>"readonly>

                    <!-- pilih anggota melalui nama -->
                    Pilih Data Pelanggan
                    <select name="id_pelanggan" class="form-control mb-2" required>
                        <?php
                        include "connection.php";
                        $sql="select * from pelanggan";
                        $hasil= mysqli_query($connect, $sql);
                        while ($pelanggan= mysqli_fetch_array($hasil)) {
                            ?>
                            <option value="<?=($pelanggan["id_pelanggan"])?>">
                                <?=($pelanggan["nama_pelanggan"])?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                
                    <!-- petugas ambil dari data login-->
                    <input type="hidden" name="id_karyawan"
                    value="<?=($_SESSION["karyawan"]["id_karyawan"])?>">
                    karyawan
                    <input type="text" name="nama_karyawan" class="form-control mb-2"
                    value="<?=($_SESSION["karyawan"]["nama_karyawan"])?>" readonly>

                    <!-- tampilkan pilihan buku yg akan disewa-->
                    Pilih Mobil
                    <select name="id_mobil" class="form-control mb-2" required>
                        <?php
                        include "connection.php";
                        $sql="select * from mobil";
                        $hasil= mysqli_query($connect, $sql);
                        while ($mobil= mysqli_fetch_array($hasil)) {
                            ?>
                            <option value="<?=($mobil["id_mobil"])?>">
                                <?=($mobil["merk"])?> Rp<?=($mobil["biaya_sewa_per_hari"])?>/hari
                            </option>
                            <?php
                        }
                        ?>
                    </select>

                    <button class="btn btn-block btn-primary" type="submit">
                        Sewa
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>