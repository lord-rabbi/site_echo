<?php
session_start();
require_once 'connexion.php'; // fichier de connexion à la base de données

$erreur = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['prenom'], $_POST['hopital'], $_POST['password'])) {
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $hopital = htmlspecialchars(trim($_POST['hopital']));
        $password = $_POST['password'];

        if (empty($prenom) || empty($hopital) || empty($password)) {
            $erreur = "Tous les champs sont obligatoires.";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO medecins (prenom, nom, hopital, password) VALUES (?, '', ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("sss", $prenom, $hopital, $passwordHash);
                if ($stmt->execute()) {
                    $success = "Inscription réussie. Vous pouvez maintenant vous connecter.";
                } else {
                    $erreur = "Erreur lors de l'inscription. Veuillez réessayer.";
                }
                $stmt->close();
            } else {
                $erreur = "Erreur de connexion à la base de données.";
            }
        }
    } else {
        $erreur = "Formulaire invalide.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Inscription</h2>

        <?php if ($erreur): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?= $erreur ?>
            </div>
        <?php elseif ($success): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?= $success ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="hopital">Hôpital :</label>
            <input type="text" id="hopital" name="hopital" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">S'inscrire</button>
        </form>

        <p>Déjà inscrit ? <a href="connection.php">Connectez-vous</a></p>
    </div>
</body>
</html>
