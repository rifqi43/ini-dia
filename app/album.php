<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="album.css">
    <title>Tambah Album</title>
</head>
<body>
    <h2>Tambah Album</h2>
    <form action="tambah_album.php" method="post">
        <label for="judul_album">Judul Album:</label><br>
        <input type="text" id="judul_album" name="judul_album" required><br>
        <label for="deskripsi">Deskripsi:</label><br>
        <textarea id="deskripsi" name="deskripsi" required></textarea><br>
        <?php
            session_start();
            if(isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                echo '<input type="hidden" name="user_id" value="'.$user_id.'">';
            } else {
                echo '<input type="hidden" name="user_id" value="1">';
            }
        ?>
        <input type="submit" value="Tambah Album">
    </form>
</body>
</html>
