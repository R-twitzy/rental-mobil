<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg karyawan
if (!isset($_SESSION["karyawan"])) {
    header("location:login.php");
}
include "navbar.php";
?>