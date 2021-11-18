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
    <title>Daftar Pelanggan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header bg-dark mt-2">
                <h5 class="text-white">Data Pelanggan</h5>
            </div>
            <div class="card-body">
                <!-- tombol daftar -->
                <a href="form-pelanggan.php">
                    <button class="btn btn-outline-success btn-block">
                        Daftar Menjadi Pelanggan
                    </button>
                </a>
                <hr>
                <!-- kotak pencarian data pelanggan -->
                <form action="list-pelanggan.php" method="get">
                    <input type="text" name="search"
                    class="form-control mb-3"
                    placeholder="Masukan Keyword Pencarian"
                    required>
                </form>
                <ul class="list-group">
                    <?php
                    include("connection.php");
                    if (isset($_GET["search"])) {
                        # jika pd saat load halaman ini
                        # akan mengecek apakah ada data dgn method
                        # GET yg bernama search
                        $search = $_GET["search"];
                        $sql = "select * from pelanggan
                        where id_pelanggan like '%$search%'
                        or nama_pelanggan like '%$search%'
                        or alamat_pelanggan like '%$search%'
                        or kontak like '%$search%'";
                    } else {
                        $sql = "select * from pelanggan";
                    }
                    //eksekusi perintah sql
                    $query = mysqli_query($connect, $sql);
                    while($pelanggan = mysqli_fetch_array($query)){ ?>
                        <li class="list-group-item">
                        <div class="row">
                            <!-- bagian data pelanggan-->
                            <div class="col-lg-10 col-md-10">
                                <h5>Nama Pelanggan : <?php echo $pelanggan["nama_pelanggan"];?></h5>
                                <h6>ID Pelanggan : <?php echo $pelanggan["id_pelanggan"];?></h6>
                                <h6>Alamat Pelanggan : <?php echo $pelanggan["alamat_pelanggan"];?></h6>
                                <h6>Kontak : <?php echo $pelanggan["kontak"];?></h6>
                            </div>

                            <!-- bagian tombol pilihan-->
                            <div class="col-lg-2 col-md-2">
                                <a href="form-pelanggan.php?id_pelanggan=<?=$pelanggan["id_pelanggan"]?>">
                                    <button class="btn btn-block btn-outline-primary mb-1">
                                        Edit
                                    </button>
                                </a>
                                <a href="process-pelanggan.php?id_pelanggan=<?=$pelanggan["id_pelanggan"]?>">
                                    <button class="btn btn-block btn-danger"
                                    onclick="return confirm('Apakah anda yakin?')">
                                        Remove
                                    </button>
                                </a>
                            </div>
                        </div>
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