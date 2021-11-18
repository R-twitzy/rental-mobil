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
    <title>Data Peminjaman</title>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header bg-dark mt-2">
                <h5 class="text-white">
                    Daftar Sewa
                </h5>
            </div>
            <div class="card-body">
                <!-- tombol tambah -->
                <a href="form-sewa.php">
                    <button class="btn btn-outline-success btn-block">
                        sewa mobil
                    </button>
                </a>
                <hr>
                <ul class="list-group">
                    <?php
                    include "connection.php";
                    
                    $sql = "select sewa.*,pelanggan.*,karyawan.*,mobil.*,kembali.id_kembali,
                    kembali.tgl_kembali,kembali.total_bayar from sewa 
                    inner join pelanggan on sewa.id_pelanggan=pelanggan.id_pelanggan
                    inner join karyawan on sewa.id_karyawan=karyawan.id_karyawan
                    inner join mobil on sewa.id_mobil=mobil.id_mobil
                    left outer join kembali on sewa.id_sewa=kembali.id_sewa
                    order by id_sewa";

                    $hasil = mysqli_query($connect, $sql);
                    while($sewa = mysqli_fetch_array($hasil)){
                        ?>
                        <li class="list-group-item">
                            <!-- Status Pengembalian-->
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <h5>
                                        <?php 
                                        if ($sewa["id_kembali"]== null) { ?>
                                            <div class="badge badge-warning">
                                                Masih disewa
                                            </div> 
                                            <a href="process-kembali.php?id_sewa=<?=($sewa["id_sewa"])?>"
                                            onclick="return confirm('Apakah anda yakin?')">
                                            <button class="badge btn btn-outline-info mx-1">Kembalikan</button>
                                            </a>
                                            <?php } 
                                        else { ?>
                                            <div class="badge badge-secondary">
                                                Telah Dikembalikan Pada <?=($sewa["tgl_kembali"])?>
                                            </div> 
                                            <h6>
                                                Bayar: Rp <?=(number_format($sewa["total_bayar"],2))?>
                                            </h6><?php } ?> 
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Kode Sewa</small>
                                    <h5><?=($sewa["id_sewa"])?></h5>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Pelanggan</small>
                                    <h5><?=($sewa["nama_pelanggan"])?></h5>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Karyawan</small>
                                    <h5><?=($sewa["nama_karyawan"])?></h5>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <small class="text-info">Tgl. Sewa</small>
                                    <h5><?=($sewa["tgl_sewa"])?></h5>
                                </div>
                            </div>
                            <small class="text-success">Mobil yang disewa</small><br>
                            
                                <?php
                                    $id_sewa= $sewa["id_sewa"];
                                    $sql = "select * from sewa
                                    inner join mobil on sewa.id_mobil = mobil.id_mobil
                                    where id_sewa = '$id_sewa'";

                                    $hasil_mobil = mysqli_query($connect, $sql);
                                    while($mobil = mysqli_fetch_array($hasil_mobil)){
                                    ?>
                                        <small>
                                            <b><?=($mobil["merk"])?></b>
                                            <i class="ml-1 text-primary">Biaya: Rp <?=($mobil["biaya_sewa_per_hari"])?>/hari</i>
                                        </small> <?php
                                    }
                                ?>
                            
                            
                        </li>
                        <?php
                    } 
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>