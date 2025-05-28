<?php
session_start();
require_once "connexion.php";

if (!isset($_SESSION['id'])) {
    header("Location: connection.php");
    exit();
}

$id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["photo"])) {
    $targetDir = "images/";
    $fileName = uniqid() . "_" . basename($_FILES["photo"]["name"]);
    $targetFile = $targetDir . $fileName;

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
        $stmt = $conn->prepare("UPDATE medecins SET photo = ? WHERE id = ?");
        $stmt->bind_param("si", $targetFile, $id);
        $stmt->execute();
    }
}

$stmt = $conn->prepare("SELECT prenom, hopital, photo FROM medecins WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($prenom, $hopital, $photo);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Utilisateur</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="profil-container">
    <img src="<?= htmlspecialchars($photo ?: 'images/default.jpg') ?>" alt="Photo de profil" width="150">

    <div class="profil-info">
        <h2>Prénom : <?= htmlspecialchars($prenom) ?></h2>
        <p><strong>Hôpital :</strong> <?= htmlspecialchars($hopital) ?></p>
    </div>

    <form action="profil.php" method="POST" enctype="multipart/form-data">
        <label for="photo">Changer la photo :</label>
        <input type="file" name="photo" id="photo" accept="image/*" required>
        <button type="submit">Téléverser</button>
    </form>

    <button onclick="window.location.href='deconnexion.php'">Déconnexion</button>
</div>

</body>
</html>
