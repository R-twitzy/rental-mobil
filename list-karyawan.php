<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Daftar Karyawan</title>
</head>
<body>
<div class="container">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="text-white">Data Karyawan</h4>
            </div>
            <div class="card-body">
                <!-- tombol daftar -->
                <a href="form-karyawan.php">
                    <button class="btn btn-outline-success btn-block">
                        Tambahkan Karyawan
                    </button>
                </a>
                <hr>
                <!-- kotak pencarian data karyawan -->
                <form action="list-karyawan.php" method="get">
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
                        $sql = "select * from karyawan
                        where id_karyawan like '%$search%'
                        or nama_karyawan like '%$search%'
                        or alamat_karyawan like '%$search%'
                        or kontak like '%$search%'
                        or username like '%$search%'";
                    } else {
                        $sql = "select * from karyawan";
                    }
                    //eksekusi perintah sql
                    $hasil = mysqli_query($connect, $sql);
                    while($karyawan = mysqli_fetch_array($hasil)){ ?>
                        <li class="list-group-item">
                        <div class="row">
                            <!-- bagian gambar karyawan-->
                            <div class="col-lg-3">
                                <img src="foto/<?=$karyawan["foto"]?>"
                                width="200">
                            </div>

                            <!-- bagian data karyawan-->
                            <div class="col-lg-7 col-md-7">
                                <h5>Nama karyawan : <?php echo $karyawan["nama_karyawan"];?></h5>
                                <h6>ID karyawan : <?php echo $karyawan["id_karyawan"];?></h6>
                                <h6>Alamat : <?php echo $karyawan["alamat_karyawan"]?></h6>
                                <h6>Username : <?php echo $karyawan["username"];?></h6>
                                <h6>Kontak : <?php echo $karyawan["kontak"];?></h6>
                            </div>

                            <!-- bagian tombol pilihan-->
                            <div class="col-lg-2 col-md-2">
                                <a href="form-karyawan.php?id_karyawan=<?=$karyawan["id_karyawan"]?>">
                                    <button class="btn btn-block btn-outline-primary mb-1">
                                        Edit
                                    </button>
                                </a>
                                <a href="process-karyawan.php?id_karyawan=<?=$karyawan["id_karyawan"]?>">
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