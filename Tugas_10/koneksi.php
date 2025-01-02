<?php
$konek = mysqli_connect("localhost", "root","", "sekolah");
if (mysqli_connect_errno()){
    echo"koneksi database gagal : ". mysqli_connect_error();
}
?>