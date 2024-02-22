<?php 
session_start();

// Jika pengguna sudah login, redirect ke halaman index
if(isset($_SESSION["username"])){
    header("location: index.php");
    exit;
}

require "config/koneksi.php";

if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        
        // Verifikasi password
        if(password_verify($password, $row['password'])) {
            // Set session untuk menyimpan status login dan username
            $_SESSION['username'] = $username;

            // Redirect ke halaman setelah login
            header("location: app/index.php");
            exit;
        }
    }
    
    // Jika login gagal
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <div class="container">
        <form action="" method="post">
            <p>
                <label for="username">Username</label>
                <input type="text" name="username">
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name="password">
            </p>
            <p>
                <button type="submit" name="login">Login</button>
            </p>
        </form>
        <?php

            if(isset($error)){
                echo "<p>Password atau username salah</p>";
            }
        ?>
        <div class="button-container">
            <a href="daftar.php" class="register-button">Register</a>
        </div>
    </div>
</body>
</html>
