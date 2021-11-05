<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pelanggan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="text-white">Form Anggota</h4>
            </div>

            <div class="card-body">
                <?php
                if (isset($_GET["id_pelanggan"])) {
                    // memeriksa ketika load file ini
                    // apakah membawa data GET dg nama "id_pelanggan"
                    // jika true, maka form pelanggan digunakan utk edit

                    # mengakses data pelanggan dari id_pelanggan yg dikirim
                    include "connection.php";
                    $id_pelanggan = $_GET["id_pelanggan"];
                    $sql = "select * from pelanggan where id_pelanggan='$id_pelanggan'";
                    # eksekusi perintah sql
                    $hasil = mysqli_query($connect, $sql);
                    # konversi hasil query ke bentuk array
                    $pelanggan = mysqli_fetch_array($hasil);
                    ?>

                <form action="process-pelanggan.php" method="post">
                    ID Pelanggan
                    <input type="text" name="id_pelanggan"
                    class="form-control mb-2" required
                    value="<?=$pelanggan["id_pelanggan"] ?>" readonly>

                    Nama Pelanggan
                    <input type="text" name="nama_pelanggan"
                    class="form-control mb-2" required
                    value="<?=$pelanggan["nama_pelanggan"] ?>">

                    Alamat Pelanggan
                    <input type="text" name="alamat_pelanggan"
                    class="form-control mb-2" required
                    value="<?=$pelanggan["alamat_pelanggan"] ?>">

                    Kontak
                    <input type="text" name="kontak"
                    class="form-control mb-2" required
                    value="<?=$pelanggan["kontak"] ?>">

                    <button type="submit" class="btn btn-primary btn-block"
                    name="edit_pelanggan" onclick="return confirm('Apakah anda yakin?')">
                        Save
                    </button>
                </form>

                    <?php
                }else {
                    // jika false, maka form pelanggan digunakan utk insert
                    ?>

                <form action="process-pelanggan.php" method="post">
                    Nama Pelanggan
                    <input type="text" name="nama_pelanggan"
                    class="form-control mb-2" required>

                    Alamat Pelanggan
                    <input type="text" name="alamat_pelanggan"
                    class="form-control mb-2" required>

                    Kontak
                    <input type="text" name="kontak"
                    class="form-control mb-2" required>

                    <button type="submit" class="btn btn-primary btn-block"
                    name="simpan_pelanggan" onclick="return confirm('Apakah anda yakin?')">
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