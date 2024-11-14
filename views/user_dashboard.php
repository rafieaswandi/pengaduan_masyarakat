<?php
session_start();
if ($_SESSION['role'] != 'public') {
  header("Location: login.php");
  exit();
}

include '../config/database.php';
$id_user = $_SESSION['id_user'];
$sql = "SELECT * FROM Pengaduan WHERE id_user = :id_user";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_user' => $id_user]);
$pengaduan = $stmt->fetchAll();
?>

<h1>Daftar Pengaduan Saya</h1>
<a href="form_pengaduan.php">Tambah Pengaduan</a>
<link rel="stylesheet" href="user_dashboard.css">
<table>
  <tr>
    <th>Judul</th>
    <th>Status</th>
    <th>Tanggal</th>
  </tr>
  <?php foreach ($pengaduan as $p) { ?>
  <tr>
    <td><?= $p['judul_pengaduan']; ?></td>
    <td><?= $p['status_pengaduan']; ?></td>
    <td><?= $p['tanggal_pengaduan']; ?></td>
  </tr>
  <?php } ?>
</table>
<a href="logout.php">Logout</a>