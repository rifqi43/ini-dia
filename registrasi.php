<?php
include_once "config/koneksi.php";

if(isset($_POST["daftar"])){
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$nama_lengkap = $_POST['nama_lengkap'];
$alamat = $_POST['alamat'];

$result = mysqli_query($conn,"SELECT username FROM user WHERE username = '$username'");

if(mysqli_fetch_assoc($result)){
    echo "<script>alert('username sudah digunakan')</script>";
    return false;
}else{
    $password = password_hash($password, PASSWORD_DEFAULT);

    $results = mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password','$email','$nama_lengkap','$alamat')");
    if ($results>0) {
        header("Location: index.php");
    }else {
        echo "gagal daftar";
    }
    
}

}