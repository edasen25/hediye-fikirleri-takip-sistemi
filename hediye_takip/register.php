<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-primary">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card p-4 shadow" style="width: 350px;">
        <h2 class="mb-4 text-center">Kayıt Ol</h2>

        <form method="post">
            <div class="mb-3">
                <input type="text" name="username" placeholder="Kullanıcı Adı" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Şifre" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Kayıt Ol</button>
        </form>

        <p class="mt-3 text-center">
            <a href="index.php">Giriş Yap</a>
        </p>
    </div>
</div>

</body>
</html>
