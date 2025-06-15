<?php
require 'session.php';
require 'db.php';

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $desc = $_POST["description"];
    
    $stmt = $conn->prepare("UPDATE gifts SET title=?, description=? WHERE id=? AND user_id=?");
    $stmt->bind_param("ssii", $title, $desc, $id, $user_id);
    $stmt->execute();
    header("Location: dashboard.php");
}

$stmt = $conn->prepare("SELECT title, description FROM gifts WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$stmt->bind_result($title, $desc);
$stmt->fetch();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Hediye Güncelle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Hediyeyi Güncelle</h2>

    <form method="post" class="bg-white p-4 rounded shadow-sm">
        <div class="mb-3">
            <label for="title" class="form-label">Başlık</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($title) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Açıklama</label>
            <textarea id="desc" name="description" class="form-control"><?= htmlspecialchars($desc) ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Güncelle</button>
        <a href="dashboard.php" class="btn btn-secondary">İptal</a>
    </form>
</div>

</body>
</html>
