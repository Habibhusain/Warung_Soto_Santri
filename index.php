<?php
session_start();
require "functions.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $login = login();

    if($login){
        $_SESSION['id'] = $login;
        echo "<script>
        alert('Berhasil Login');
        window.location = 'dashboard.php';
        </script>";
    }else{
        echo "<script>
        alert('Username atau Password salah');
        window.location = 'index.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warung Soto Santri</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h2>Login</h2>
<div class="container-login">
<form method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <label for="password">Password:</label>
    <input type="text" name="password" required>
    <button type="submit" name="submit">Login</button>
</form>
</div>
<footer>
        <p>&copy; 2024 by Habib Husain Nurrohim. All rights reserved.</p>
    </footer>
</body>
</html>