<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tampil.css">
    <title>tampil gambar</title>
</head>
<body>
    <table>
        <?php
        
        require "../config/koneksi.php";

        $dir = "uploads/";
        $files = scandir($dir);
        
        foreach($files as $file) {
            if ($file != "." && $file != "..") {
                echo "<tr>";
                echo "<td><img src='" . $dir . $file . "' width='100'></td>";
                echo "<td>" . $file . "</td>";

                echo "<td>";
                echo "<form action='index.php' method='post'>";

                $file = basename($file);
                $query = "SELECT foto_id FROM foto WHERE lokasi_file = '$dir$file'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $foto_id = $row['foto_id'];

                echo "<input type='hidden' name='foto_id' value='$foto_id'>";
                echo "<button type='submit' name='like'>Like</button>";
                echo "</form>";
                echo "</td>";

                echo "</tr>";
            }
        }

        if(isset($_POST['like'])) {
            
            $foto_id = $_POST['foto_id'];

            $user_id = 1; 

            $tanggal_like = date("Y-m-d");

            $sql = "INSERT INTO like_foto (foto_id, user_id, tanggal_like) VALUES ('$foto_id', '$user_id', '$tanggal_like')";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Like berhasil ditambahkan.</p>";
            } else {
                echo "<p>Maaf, terjadi kesalahan saat menambahkan like.</p>";
            }
        }
        ?>
    </table>
    <a href="formupload.php">upload</a>
</body>
</html>
