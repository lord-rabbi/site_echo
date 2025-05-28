<?php
session_start();
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $date = $_POST['date'];
    $image = $_FILES['echographie'];

    if ($image['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'images/';
        $uniqueName = uniqid() . '_' . basename($image['name']);
        $uploadPath = $uploadDir . $uniqueName;

        if (move_uploaded_file($image['tmp_name'], $uploadPath)) {
            $stmt = $conn->prepare("INSERT INTO echographies (date_echographie, image_path) VALUES (?, ?)");
            $stmt->bind_param("ss", $date, $uploadPath);
            $stmt->execute();
            $stmt->close();

            $_SESSION['last_image'] = $uploadPath;
            header("Location: resultat.php");
            exit();
        } else {
            $error = "Erreur lors du téléchargement de l'image.";
        }
    } else {
        $error = "Erreur de téléchargement du fichier.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire Échographie</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form-container">
    <h2>Formulaire d'Échographie</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="input-group">
            <label for="date">Date :</label>
            <input type="date" name="date" id="date" required>
        </div>
        <div class="input-group">
            <label for="echographie">Échographie :</label>
            <input type="file" name="echographie" id="echographie" accept="image/*" required>
        </div>
        <button type="submit">Envoyer</button>
    </form>
</div>
</body>
</html>
