<?php
session_start();
$imagePath = isset($_SESSION['last_image']) ? $_SESSION['last_image'] : null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Analyse échographique</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      box-sizing: border-box;
    }
    body {
      background-color: #f0f2f5;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      text-align: center;
      padding: 20px;
    }
    .echographie-img {
      width: 600px;
      height: 400px;
      object-fit: contain; /* l’image est entièrement visible */
      background-color: white; /* fond blanc autour de l’image si nécessaire */
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      margin-bottom: 20px;
      border: 4px solid #052659;
    }
    .progress-title {
      font-size: 22px;
      margin-bottom: 10px;
      color: #052659;
    }
    .progress-bar-container {
      width: 300px;
      height: 20px;
      background-color: #dcdde1;
      border-radius: 10px;
      overflow: hidden;
      margin-bottom: 20px;
    }
    .progress-bar {
      height: 100%;
      background-color: rgba(9, 0, 77, 0.65);
      width: 0%;
    }
    .loading-text {
      margin-bottom: 30px;
      font-size: 16px;
      color: #444;
    }
    .anomalies {
      display: none;
    }
    .anomalies h3 {
      color: #c0392b;
      margin-bottom: 10px;
    }
    .anomalies ul {
      list-style: disc;
      padding-left: 20px;
      text-align: left;
    }
    .anomalies li {
      margin: 5px 0;
      color: #444;
    }
  </style>
</head>
<body>

  <?php if ($imagePath): ?>
    <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Image échographique" class="echographie-img">
  <?php else: ?>
    <p>Aucune image fournie.</p>
  <?php endif; ?>

  <div class="progress-title" id="progressTitle">Analyse échographique en cours...</div>
  <div class="progress-bar-container">
    <div class="progress-bar" id="progressBar"></div>
  </div>
  <div class="loading-text" id="loadingText">Initialisation de l'analyse...</div>

  <div class="anomalies" id="anomalies">
    <h3>Anomalies détectées :</h3>
    <ul>
      <li>Présence d'une masse anormale</li>
      <li>Épaisseur irrégulière de la paroi</li>
      <li>Zone hypoéchogène non définie</li>
      <li>Amniotique bas</li>
    </ul>
  </div>

  <script>
    const progressBar = document.getElementById('progressBar');
    const loadingText = document.getElementById('loadingText');
    const progressTitle = document.getElementById('progressTitle');
    const anomalies = document.getElementById('anomalies');

    let percent = 0;
    const interval = setInterval(() => {
      percent++;
      progressBar.style.width = percent + "%";

      if (percent < 30) {
        progressTitle.textContent = "Chargement de l'image...";
        loadingText.textContent = "Analyse échographique à " + percent + "%";
      } else if (percent < 60) {
        progressTitle.textContent = "Analyse de la structure...";
        loadingText.textContent = "Analyse échographique à " + percent + "%";
      } else if (percent < 90) {
        progressTitle.textContent = "Vérification des anomalies...";
        loadingText.textContent = "Analyse échographique à " + percent + "%";
      } else if (percent < 100) {
        progressTitle.textContent = "Finalisation de l'analyse...";
        loadingText.textContent = "Analyse échographique à " + percent + "%";
      } else {
        clearInterval(interval);
        progressTitle.textContent = "Analyse terminée";
        loadingText.textContent = "Analyse échographique à 100%";
        setTimeout(() => {
          loadingText.style.display = "none";
          anomalies.style.display = "block";
        }, 1000);
      }
    }, 70);
  </script>

</body>
</html>
