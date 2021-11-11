<?php
include("connection.php");

# untuk insert karyawan
if (isset($_POST["simpan_karyawan"])) {
    // tampung data input karyawan dari user
    $nama_karyawan = $_POST["nama_karyawan"];
    $alamat_karyawan = $_POST["alamat_karyawan"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $password = sha1($_POST["password"]);

    # mmanage upload file
    $fileName = $_FILES["foto"]["name"]; // file name
    $extension = pathinfo($_FILES["foto"]["name"]);
    $ext = $extension["extension"]; //extensi file

    $foto = time()."-".$fileName;

    #proses upload
    $folderName = "foto/$foto";
    if (move_uploaded_file($_FILES["foto"]["tmp_name"],$folderName)) {
        // membuat perintah sql utk insert data ke tbl karyawan
        $sql = "insert into karyawan values ('', '$nama_karyawan', 
        '$alamat_karyawan', '$kontak', '$username', '$password', '$foto')";

        // eksekusi perintah sql
        mysqli_query($connect, $sql);

        // direct ke halaman list karyawan
        header("location: list-karyawan.php");
    } else{
        echo "Upload File Gagal";
    }
    
}

# untuk edit karyawan
else if (isset($_POST["edit_karyawan"])) {
    // tampung data edit karyawan dari user
    $id_karyawan = $_POST["id_karyawan"];
    $nama_karyawan = $_POST["nama_karyawan"];
    $alamat_karyawan = $_POST["alamat_karyawan"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];

    # jika update data dan gambar
    if (!empty($_FILES["foto"]["name"])) {
        # ambil data nama file yg akan dihapus
        $sql ="select * from karyawan where id_karyawan='$id_karyawan'";
        # eksekusi perintah sql
        $hasil = mysqli_query($connect, $sql);
        # konversi hasil query ke bentuk array
        $karyawan = mysqli_fetch_array($hasil);  
        
        $oldFileName = $karyawan["foto"];

        # membuat path file yg lama
        $path = "foto/$oldFileName";

        # cek eksistensi file lama
        if (file_exists($path)){
            # hapus file lama
            unlink($path);
        }

        # membuat file name baru 
        $foto = time()."-".$_FILES["foto"]["name"];
        $folder = "foto/$foto";

        # proses upload file baru
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $folder)) {
            if (empty($_POST["password"])) {
                $sql = "update karyawan set id_karyawan='$id_karyawan', nama_karyawan='$nama_karyawan', 
                alamat_karyawan='$alamat_karyawan', kontak='$kontak', username='$username', foto='$foto' 
                where id_karyawan='$id_karyawan'";
            } else {
                $password = sha1($_POST["password"]);
                $sql = "update karyawan set id_karyawan='$id_karyawan', nama_karyawan='$nama_karyawan', 
                alamat_karyawan='$alamat_karyawan', kontak='$kontak', username='$username', 
                password='$password', foto='$foto' where id_karyawan='$id_karyawan'";
            }

            if (mysqli_query($connect, $sql)) {
                header("location:list-karyawan.php");
            } else {
                echo "gagal boss";
            }
        }
    }
    # jika update data 
    else {
        if (empty($_POST["password"])) {
            $sql = "update karyawan set id_karyawan='$id_karyawan', nama_karyawan='$nama_karyawan', 
            alamat_karyawan='$alamat_karyawan', kontak='$kontak', username='$username' where id_karyawan='$id_karyawan'";
        } else {
            $password = sha1($_POST["password"]);
            $sql = "update karyawan set id_karyawan='$id_karyawan', nama_karyawan='$nama_karyawan', 
            alamat_karyawan='$alamat_karyawan', kontak='$kontak', username='$username', 
            password='$password' where id_karyawan='$id_karyawan'";
        }

            if (mysqli_query($connect, $sql)) {
                header("location:list-karyawan.php");
            } else {
                echo "gagal boss";
            }
    }
}

elseif (isset($_GET["id_karyawan"])) {
    $id_karyawan = $_GET['id_karyawan'];

     # ambil data nama file yg akan dihapus
     $sql ="select * from karyawan where id_karyawan='$id_karyawan'";
     # eksekusi perintah sql
     $hasil = mysqli_query($connect, $sql);
     # konversi hasil query ke bentuk array
     $karyawan = mysqli_fetch_array($hasil);  
     
     $oldFileName = $karyawan["foto"];

     # membuat path file yg lama
     $path = "foto/$oldFileName";

     # cek eksistensi file lama
     if (file_exists($path)){
         # hapus file lama
         unlink($path);
     }

     $sql ="delete from karyawan where id_karyawan = '".$id_karyawan."'" ;
     # eksekusi perintah sql
     $hasil = mysqli_query($connect, $sql);
     header("location:list-karyawan.php");
}

?>