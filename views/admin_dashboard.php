<?php
session_start();
if ($_SESSION['role'] != 'admin') {
  header("Location: login.php");
  exit();
}

include '../config/database.php';
$sql = "SELECT p.*, u.nama AS nama_user FROM Pengaduan p JOIN User u ON p.id_user = u.id_user";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$pengaduan = $stmt->fetchAll();
?>

<!-- <h1>Daftar Semua Pengaduan</h1>
<table>
  <tr>
    <th>Nama User</th>
    <th>Judul</th>
    <th>Status</th>
    <th>Tanggal</th>
    <th>Aksi</th>
  </tr>
  <?php foreach ($pengaduan as $p) { ?>
  <tr>
    <td><?= $p['nama_user']; ?></td>
    <td><?= $p['judul_pengaduan']; ?></td>
    <td><?= $p['status_pengaduan']; ?></td>
    <td><?= $p['tanggal_pengaduan']; ?></td>
    <td>
      <a href="edit_pengaduan.php?id=<?= $p['id_pengaduan']; ?>">Edit</a>
    </td>
  </tr>
  <?php } ?>
</table>
<a href="logout.php">Logout</a> -->

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="styles.css"> <!-- Link ke CSS -->
</head>
<body>
  <div class="container">
    <h1>Dashboard Admin</h1>
    <p>Halooo, Atminnnn. Berikut adalah daftar pengaduan yang masuk:</p>
    
    <!-- Tabel Pengaduan -->
    <table>
      <thead>
        <tr>
          <th>Judul Pengaduan</th>
          <th>Nama Pelapor</th>
          <th>Deskripsi Pengaduan</th>
          <th>Tanggal</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pengaduan as $data) : ?>
          <tr>
            <td><?php echo htmlspecialchars($data['judul_pengaduan']); ?></td>
            <td><?php echo htmlspecialchars($data['nama_user']); ?></td>
            <td><?php echo htmlspecialchars($data['deskripsi']); ?></td>
            <td><?php echo htmlspecialchars($data['tanggal_pengaduan']); ?></td>
            <td><?php echo htmlspecialchars($data['status_pengaduan'] ?? ''); ?></td>
            <td>
                <form action="edit_pengaduan.php" method="POST">
                    <input type="hidden" name="id_pengaduan" value="<?php echo htmlspecialchars($data['id_pengaduan'] ?? ''); ?>">
                    <select name="status_pengaduan">
                        <option value="Pending" <?php if ($data['status_pengaduan'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="In Progress" <?php if ($data['status_pengaduan'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                        <option value="Resolved" <?php if ($data['status_pengaduan'] == 'Resolved') echo 'selected'; ?>>Resolved</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <a href="logout.php" class="logout-btn">Logout</a>
  </div>
</body>
</html>
