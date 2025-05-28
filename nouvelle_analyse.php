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
        <form action="" method="post" enctype="multipart/form-data">
            
            <div class="input-group">
                <label for="date">Date :</label>
                <input type="date" name="date" id="date" required>
            </div>
            <div class="input-group">
                <label for="echographie">Échographie :</label>
                <input type="file" name="echographie" id="echographie" accept="image/*" required>
            </div>
            <button type="submit"><a href="resultat.html">Envoyer</a></button>
        </form>
    </div>
</body>
</html>
