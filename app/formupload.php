<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formupload.css">
    <title>Form Upload Gambar</title>
</head>
<body>
    <form action="logout.php" method="POST" class="login-email">
        <button type="submit" class="btn">Logout</button>
    </form>
    <h2>Form Upload Gambar</h2>
    <a href="index.php">Tampil</a>
    <a href="album.php">Album</a>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="judul_foto">Judul Foto:</label><br>
        <input type="text" id="judul_foto" name="judul_foto"><br>
        <label for="deskripsi_foto">Deskripsi Foto:</label><br>
        <textarea id="deskripsi_foto" name="deskripsi_foto"></textarea><br>
        <label for="album_id">Pilih Album:</label><br>
        <select id="album_id" name="album_id">
            <?php
            $conn = new mysqli("localhost", "root", "", "galeri");

            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            $sql = "SELECT album_id, nama_album FROM album";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {

                while($row = $result->fetch_assoc()) {

                    echo '<option value="'.$row["album_id"].'">'.$row["nama_album"].'</option>';
                }
            } else {
                echo '<option value="">Tidak ada album tersedia</option>';
            }

            $conn->close();
            ?>
        </select><br>
        <?php
            session_start();
            if(isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                echo '<input type="hidden" name="user_id" value="'.$user_id.'">';
            }
        ?>
        Pilih gambar untuk diupload:
        <input type="file" name="gambar" id="gambar"><br>
        <input type="submit" value="Upload Gambar" name="submit">
    </form>
</body>
</html>
