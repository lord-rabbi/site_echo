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
      width: 300px;
      height: 200px;
      object-fit: cover;
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
      width: 0%;
      height: 100%;
      background-color: rgba(9, 0, 77, 0.65);
      transition: width 3s linear;
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

  <img src="images/imgl.jpg" alt="Image échographique" class="echographie-img">

  <div class="progress-title">Analyse échographique en cours...</div>
  
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
    const progress = document.getElementById('progressBar');
    const anomalies = document.getElementById('anomalies');
    const loadingText = document.getElementById('loadingText');


    setTimeout(() => {
      progress.style.width = '100%';
      loadingText.textContent = "Analyse en cours...";
    }, 300);

    setTimeout(() => {
      loadingText.textContent = "Détection des anomalies...";
    }, 1500);
    
    setTimeout(() => {
      loadingText.style.display = "none";
      anomalies.style.display = "block";
    }, 3300);
  </script>

</body>
</html>
