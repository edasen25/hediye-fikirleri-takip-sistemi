<?php
require 'session.php';
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $desc = $_POST["description"];
    $user_id = $_SESSION['user_id'];
    
    $stmt = $conn->prepare("INSERT INTO gifts (user_id, title, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $title, $desc);
    $stmt->execute();
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yeni Hediye Ekle</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-succes">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Yeni Hediye Ekle</h4>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Başlık</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Açıklama</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Kaydet</button>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="dashboard.php" class="btn btn-link">Geri Dön</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
