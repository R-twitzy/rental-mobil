<?php
include "connection.php";
// tampung inputan
$tgl_sewa = $_POST["tgl_sewa"];
$id_pelanggan = $_POST["id_pelanggan"];
$id_karyawan = $_POST["id_karyawan"];
$id_mobil = $_POST["id_mobil"];

// perintah sql utk insert ke tabel pinjam
$sql="insert into sewa values
('','$id_mobil', '$id_karyawan', '$id_pelanggan', '$tgl_sewa')";
if (mysqli_query($connect, $sql)) {
    # jika insert berhasil
    # insert ke tabel detail_pinjam
    $sql="select * from sewa order by id_sewa desc";
    $sewa = mysqli_query($connect, $sql);
    $array = mysqli_fetch_array($sewa);
    $id_sewa= $array["id_sewa"];
    header("location:list-sewa.php");
}
 else {
    # jika gagal
    echo mysqli_error($connect);
}

?>