<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli("localhost", "root", "", "galeri");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $nama_album = $_POST['judul_album'];
    $deskripsi = $_POST['deskripsi'];
    $user_id = $_POST['user_id'];
    $tanggal_dibuat = date("Y-m-d");

    $sql = "INSERT INTO album (nama_album, deskripsi, tanggal_dibuat, user_id) 
            VALUES ('$nama_album', '$deskripsi', '$tanggal_dibuat', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Album berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
