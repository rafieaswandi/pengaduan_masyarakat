<?php
session_start();
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM User WHERE username = :username";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(['username' => $username]);

  $user = $stmt->fetch();
  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['role'] = $user['role'];
    header("Location: " . ($user['role'] == 'admin' ? 'admin_dashboard.php' : 'user_dashboard.php'));
  } else {
    echo "Login gagal! Username atau password salah.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">   
        <h1>Login</h1>
        <p>Login to <b>your</b> account!</p>
        <form method="POST">
            <label for="text">Username</label>
            <input type="text" name="username" placeholder="Username" required>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>


