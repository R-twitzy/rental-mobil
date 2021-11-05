<?php
include("connection.php");

# untuk insert pelanggan
if (isset($_POST["simpan_pelanggan"])) {
    // tampubg data input pelanggan dari user
    $id_pelanggan = $_POST["id_pelanggan"];
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $alamat_pelanggan = $_POST["alamat_pelanggan"];
    $kontak = $_POST["kontak"];

    // membuat perintah sql utk insert data ke tbl pelanggan
    $sql = "insert into pelanggan values ('$id_pelanggan', 
    '$nama_pelanggan','$alamat_pelanggan', '$kontak')";

    // eksekusi perintah sql
    mysqli_query($connect, $sql);

    // direct ke halaman list pelanggan
    header("location: list-pelanggan.php");
}

# untuk edit pelanggan
else if (isset($_POST["edit_pelanggan"])) {
    // tampung data yg akan diupdate
    $id_pelanggan = $_POST["id_pelanggan"];
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $alamat_pelanggan = $_POST["alamat_pelanggan"];
    $kontak = $_POST["kontak"];

    // membuat perintah sql untuk update data
    $sql = "update pelanggan set nama_pelanggan='$nama_pelanggan',
    alamat_pelanggan='$alamat_pelanggan',
    kontak='$kontak' where id_pelanggan='$id_pelanggan'";

    // eksekusi perintah sql
    mysqli_query($connect, $sql);

    // direct ke halaman list pelanggan
    header("location: list-pelanggan.php");
}

# untuk hapus pelanggan
else if (isset($_GET["id_pelanggan"])) {
    $id_pelanggan = $_GET['id_pelanggan'];
    $sql ="delete from pelanggan where id_pelanggan = '".$id_pelanggan."'" ;

    $result = mysqli_query($connect,$sql);

    if ($result) {
        header('Location:list-pelanggan.php');
    } else {
        printf('Gagal ya'.mysqli_error($connect));
        exit();
    }
}

?>