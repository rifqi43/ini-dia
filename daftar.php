<?php
session_start();

if(isset($_SESSION["login"])){
    header("location:login.php");
    exit;
}

require 'config/koneksi.php';

if( isset($_POST['daftar'])){
    if(register($_POST) > 0){
        echo"<script>
        alert('anda berhasil mendaftar');
        document.location.href = 'login.php';
        </script>";
    }else{
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style1.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
</head>
<body>
    <h1>daftar</h1>
    <form action="registrasi.php" method="post">
        <p>
            <label for="username">username</label>
            <input type="text"name="username">
        </p>
        <p>
        <label for="password">password</label>
            <input type="text"name="password">
        </p>
        <p>
        <label for="email">email</label>
            <input type="email"name="email">
        </p>
        <p>
        <label for="nama_lengkap">nama lengkap</label>
            <input type="text"name="nama_lengkap">
        </p>
        <p>
        <label for="alamat">alamat</label>
            <input type="text"name="alamat">
        </p>
        <p>
            <button type="submit" name="daftar">Daftar</button>
        </p>
    </form>
</body>
</html>