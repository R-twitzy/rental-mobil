<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary">
                <h4 class="text-white">
                    Form Mobil
                </h4>
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
                        ISBN
                        <input type="number" name="isbn"
                        class="form-control mb-2" required
                        value="<?=$mobil["isbn"] ?>" readonly>

                        Judul mobil
                        <input type="text" name="judul_buku"
                        class="form-control mb-2" required
                        value="<?=$mobil["judul_buku"] ?>">

                        Penulis
                        <input type="text" name="penulis"
                        class="form-control mb-2" required
                        value="<?=$mobil["penulis"] ?>">

                        Penerbit
                        <input type="text" name="penerbit"
                        class="form-control mb-2" required
                        value="<?=$mobil["penerbit"] ?>">

                        Jumlah Halaman
                        <input type="number" name="jumlah_halaman"
                        class="form-control mb-2" required
                        value="<?=$mobil["jumlah_halaman"] ?>">

                        Genre
                        <select name="genre" class="form-control mb-2" required">
                            <option value="<?=$buku["genre"] ?>">
                                <?=$mobil["genre"] ?>
                            </option>
                            <option value="Novel">Novel</option>
                            <option value="Sains">Sains</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Religi">Religi</option>
                            <option value="Romansa">Romansa</option>
                            <option value="Dokumenter">Dokumenter</option>
                        </select>

                        Cover <br>
                        <img src="cover/<?=$buku["cover"] ?>" width="150">
                        <input type="file" name="cover"
                        class="form-control mb-2">

                        <button type="submit" class="btn btn-primary btn-block" name="edit_buku"
                        onclick="return confirm('Apakah anda yakin?')">
                            Save
                        </button>
                    </form>
                <?php
                } else {
                    #form utk insert ?>
                    <form action="process-buku.php" method="post"
                    enctype="multipart/form-data">
                        ISBN
                        <input type="number" name="isbn"
                        class="form-control mb-2" required>

                        Judul Buku
                        <input type="text" name="judul_buku"
                        class="form-control mb-2" required>

                        Penulis
                        <input type="text" name="penulis"
                        class="form-control mb-2" required>

                        Penerbit
                        <input type="text" name="penerbit"
                        class="form-control mb-2" required>

                        Jumlah Halaman
                        <input type="number" name="jumlah_halaman"
                        class="form-control mb-2" required>

                        Genre
                        <select name="genre" class="form-control mb-2" required>
                            <option value="Novel">Novel</option>
                            <option value="Sains">Sains</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Religi">Religi</option>
                            <option value="Romansa">Romansa</option>
                            <option value="Dokumenter">Dokumenter</option>
                        </select>

                        Cover
                        <input type="file" name="cover"
                        class="form-control mb-2" required>

                        <button type="submit" class="btn btn-primary btn-block" name="simpan_buku">
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