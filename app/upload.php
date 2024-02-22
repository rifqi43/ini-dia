<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["gambar"]["name"]);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowedTypes = array("jpg", "jpeg", "png", "gif");

    if (in_array($fileType, $allowedTypes)) {
        $judul_foto = $_POST['judul_foto'];
        $fileExt = '.' . $fileType;
        $newFileName = $judul_foto . $fileExt;
        $targetFilePath = $targetDir . $newFileName;

        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFilePath)) {

            $conn = new mysqli("localhost", "root", "", "galeri");


            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            $deskripsi_foto = $_POST['deskripsi_foto'];
            $tanggal_unggah = date("Y-m-d");
            $lokasi_file = $targetFilePath;
            $album_id = $_POST['album_id'];
            $user_id = $_POST['user_id'];


            $sql = "INSERT INTO foto (judul_foto, deskripsi_foto, tanggal_unggah, lokasi_file, album_id, user_id) 
                    VALUES ('$judul_foto', '$deskripsi_foto', '$tanggal_unggah', '$lokasi_file', '$album_id', '$user_id')";

            if ($conn->query($sql) === TRUE) {
                echo "File berhasil diunggah dan data foto telah disimpan ke database.";
                header('location: index.php');
            } else {
                echo "Maaf, terjadi kesalahan saat menyimpan data ke database: " . $conn->error;
            }


            $conn->close();
        } else {

            echo "Maaf, terjadi kesalahan saat mengunggah file atau memindahkan file ke folder upload.";
        }
    } else {
        echo "Maaf, hanya JPG, JPEG, PNG & GIF yang diizinkan.";
    }
}
?>
