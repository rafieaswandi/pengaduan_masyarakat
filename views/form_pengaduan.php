<?php
session_start();
if ($_SESSION['role'] != 'public') {
  header("Location: login.php"); 
  exit();
}

include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_user = $_SESSION['id_user']; 
  $judul_pengaduan = $_POST['judul_pengaduan'];
  $deskripsi = $_POST['deskripsi'];

  $sql = "INSERT INTO Pengaduan (id_user, judul_pengaduan, deskripsi) VALUES (:id_user, :judul_pengaduan, :deskripsi)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    'id_user' => $id_user,
    'judul_pengaduan' => $judul_pengaduan,
    'deskripsi' => $deskripsi
  ]);

  header("Location: user_dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pengaduan</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Form Pengaduan Baru</h1>
  <form method="POST">
    <label for="judul_pengaduan">Judul Pengaduan</label>
    <!-- <input type="text" name="judul_pengaduan" id="judul_pengaduan" required> -->
    <input type="text" autocomplete="off" name="judul_pengaduan" id="judul_pengaduan" class="input" placeholder="Masukan Judul"><br>


    <label for="deskripsi">Deskripsi Pengaduan</label>
    <!-- <textarea name="deskripsi" id="deskripsi" required></textarea>

    <button type="submit">Kirim Pengaduan</button> -->
    <textarea id="deskripsi" name="deskripsi" required class="input" placeholder="Deskripsikan Pengaduanmu"></textarea><br>
    <button type="submit">
        <span class="circle1"></span>
        <span class="circle2"></span>
        <span class="circle3"></span>
        <span class="circle4"></span>
        <span class="circle5"></span>
        <span class="text">Kirim Pengaduan</span>
    </button>
  </form>
</body>
</html>
