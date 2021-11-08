<?php
include("connection.php");

# untuk insert buku
if (isset($_POST["simpan_mobil"])) {
    // tampung data input mobil dari user
    $id_mobil = $_POST["id_mobil"];
    $nomor_mobil = $_POST["nomor_mobil"];
    $merk = $_POST["merk"];
    $jenis = $_POST["jenis"];
    $warna = $_POST["warna"];
    $tahun_pembuatan = $_POST["tahun_pembuatan"];
    $biaya_sewa_per_hari = $_POST["biaya_sewa_per_hari"];

    # mmanage upload file
    $fileName = $_FILES["image"]["name"]; // file name
    $extension = pathinfo($_FILES["image"]["name"]);
    $ext = $extension["extension"]; //extensi file

    $image = time()."-".$fileName;

    #proses upload
    $folderName = "image/$image";
    if (move_uploaded_file($_FILES["image"]["tmp_name"],$folderName)) {
        // membuat perintah sql utk insert data ke tbl mobil
        $sql = "insert into mobil values ('', '$nomor_mobil', 
        '$merk', '$jenis', '$warna', '$tahun_pembuatan', '$biaya_sewa_per_hari', '$image')";

        // eksekusi perintah sql
        mysqli_query($connect, $sql);

        // direct ke halaman list mobil
        header("location: list-mobil.php");
    } else{
        echo "Upload File Gagal";
    }
    
}

# untuk edit mobil
elseif (isset($_POST["edit_mobil"])) {
    // tampung data edit mobil dari user
    $id_mobil = $_POST["id_mobil"];
    $nomor_mobil = $_POST["nomor_mobil"];
    $merk = $_POST["merk"];
    $jenis = $_POST["jenis"];
    $warna = $_POST["warna"];
    $tahun_pembuatan = $_POST["tahun_pembuatan"];
    $biaya_sewa_per_hari = $_POST["biaya_sewa_per_hari"];


    # jika update data dan gambar
    if (!empty($_FILES["image"]["name"])) {
        # ambil data nama file yg akan dihapus
        $sql ="select * from mobil where id_mobil='$id_mobil'";
        # eksekusi perintah sql
        $hasil = mysqli_query($connect, $sql);
        # konversi hasil query ke bentuk array
        $mobil = mysqli_fetch_array($hasil);  
        
        $oldFileName = $mobil["image"];

        # membuat path file yg lama
        $path = "image/$oldFileName";

        # cek eksistensi file lama
        if (file_exists($path)){
            # hapus file lama
            unlink($path);
        }

        # membuat file name baru 
        $image = time()."-".$_FILES["image"]["name"];
        $folder = "image/$image";

        # proses upload file baru
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $folder)) {
            $sql = "update mobil set nomor_mobil='$nomor_mobil', merk='$merk',
            jenis='$jenis', warna='$warna', tahun_pembuatan='$tahun_pembuatan', 
            biaya_sewa_per_hari='$biaya_sewa_per_hari', image='$image' where id_mobil='$id_mobil'";

            if (mysqli_query($connect, $sql)) {
                header("location:list-mobil.php");
            } else {
                echo "gagal boss";
            }
        }
    }
    # jika update data 
    else {
        $sql = "update mobil set nomor_mobil='$nomor_mobil', merk='$merk',
        jenis='$jenis', warna='$warna', tahun_pembuatan='$tahun_pembuatan', 
        biaya_sewa_per_hari='$biaya_sewa_per_hari'where id_mobil='$id_mobil'";

            if (mysqli_query($connect, $sql)) {
                header("location:list-mobil.php");
            } else {
                echo "gagal boss";
            }
    }
}

elseif (isset($_GET["id_mobil"])) {
    $id_mobil = $_GET['id_mobil'];

     # ambil data nama file yg akan dihapus
     $sql ="select * from mobil where id_mobil='$id_mobil'";
     # eksekusi perintah sql
     $hasil = mysqli_query($connect, $sql);
     # konversi hasil query ke bentuk array
     $mobil = mysqli_fetch_array($hasil);  
     
     $oldFileName = $mobil["image"];

     # membuat path file yg lama
     $path = "image/$oldFileName";

     # cek eksistensi file lama
     if (file_exists($path)){
         # hapus file lama
         unlink($path);
     }

     $sql ="delete from mobil where id_mobil = '".$id_mobil."'" ;
     # eksekusi perintah sql
     $hasil = mysqli_query($connect, $sql);
     header("location:list-mobil.php");
}

?>