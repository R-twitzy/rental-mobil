<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mobil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="text-white">Daftar Mobil</h4>
            </div>
            <div class="card-body">
                <!-- tombol tambah -->
                <a href="form-mobil.php">
                    <button class="btn btn-outline-success btn-block">
                        Tambahkan Mobil
                    </button>
                </a>
                <hr>
                <!-- search-->
                <form action="list-mobil.php" method="get">
                    <input type="text" name="search"
                    class="form-control mb-3"
                    placeholder="Masukkan Keyword Pencarian">
                </form>
                <ul class="list-group">
                    <?php
                    include ("connection.php");
                    if (isset($_GET["search"])) {
                        # jika pd saat load halaman ini
                        # akan mengecek apakah ada data dgn method
                        # GET yg bernama search
                        $search = $_GET["search"];
                        $sql = "select * from mobil
                        where id_mobil like '%$search%'
                        or nomor_mobil like '%$search%'
                        or merk like '%$search%'
                        or jenis like '%$search%'
                        or warna like '%$search%'
                        or tahun_pembuatan like '%$search%'
                        or biaya_sewa_per_hari like '%$search%'";
                    } else {
                        $sql = "select * from mobil";
                    }

                    //eksekusi perintah sql
                    $query = mysqli_query($connect, $sql);
                    while($mobil = mysqli_fetch_array($query)){ ?>
                        <li class="list-group-item">
                            <div class="row">

                                <!-- bagian gambar mobil-->
                                <div class="col-lg-4">
                                    <img src="image/<?=$mobil["image"]?>"
                                    width="200">
                                </div>

                                <!-- bagian data mobil-->
                                <div class="col-lg-6">
                                    <h5><?=$mobil["merk"]?></h5>
                                    <h6>ID : <?=$mobil["id_mobil"]?></h6>
                                    <h6>Nopol : <?=$mobil["nomor_mobil"]?></h6>
                                    <h6>Jenis : <?=$mobil["jenis"]?></h6>
                                    <h6>Warna : <?=$mobil["warna"]?></h6>
                                    <h6>Tahun Pembuatan : <?=$mobil["tahun_pembuatan"]?></h6>
                                    <h6>Harga Sewa : Rp <?=$mobil["biaya_sewa_per_hari"]?>/hari</h6>
                                </div>

                                <!-- tombol-->
                                <div class="col-lg-2">
                                <a href="form-mobil.php?id_mobil=<?=$mobil["id_mobil"]?>">
                                    <button class="btn btn-block btn-outline-primary mb-1">
                                        Edit
                                    </button>
                                </a>
                                <a href="process-mobil.php?id_mobil=<?=$mobil["id_mobil"]?>">
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