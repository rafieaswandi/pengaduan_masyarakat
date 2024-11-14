<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=pengaduan_masyarakat2', 'root', 'root');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Koneksi gagal: " . $e->getMessage());
}
?>
