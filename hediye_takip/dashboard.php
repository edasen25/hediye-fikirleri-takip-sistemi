<?php
require 'session.php';
require 'db.php';

$user_id = $_SESSION['user_id'];

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM gifts WHERE id=$id AND user_id=$user_id");
}

$result = $conn->query("SELECT * FROM gifts WHERE user_id=$user_id");
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Hediye Takip Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-white">

<div class="container mt-5">
    <h2 class="mb-4">Hediye Takip Paneli</h2>

    <a href="add.php" class="btn btn-primary mb-3">Yeni Hediye Ekle</a>
    <a href="logout.php" class="btn btn-danger mb-3 float-end">Çıkış Yap</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Başlık</th>
                <th>Açıklama</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Düzenle</a>
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Silinsin mi?')" class="btn btn-sm btn-danger">Sil</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
