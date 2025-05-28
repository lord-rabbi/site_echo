<?php
session_start();
require_once 'connexion.php'; 

$erreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['prenom'], $_POST['password'])) {
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $password = $_POST['password'];

        $sql = "SELECT * FROM medecins WHERE prenom = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $prenom);
            $stmt->execute();
            $result = $stmt->get_result();
            $medecin = $result->fetch_assoc();

            if ($medecin && password_verify($password, $medecin['password'])) {
                $_SESSION['prenom'] = $medecin['prenom'];
                $_SESSION['id'] = $medecin['id'];
                header('Location: index.php'); 
                exit();
            } else {
                $erreur = "Identifiants incorrects.";
            }

            $stmt->close();
        } else {
            $erreur = "Erreur de connexion à la base de données.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Connexion</h2>

        <?php if ($erreur): ?>
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?= $erreur ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Se connecter</button>
        </form>
        <p>Pas encore de compte ? <a href="inscription.php">Inscrivez-vous</a></p>
    </div>
</body>
</html>
