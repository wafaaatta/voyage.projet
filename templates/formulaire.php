<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../assets/css/formulaire.css">
  
</head>
<body>
<div class="container">
    <!-- Colonne 1 -->
    <div class="dashboard">
        <div class="profile">
            <img src="../assets/img/alma" alt="Photo du client">
            <h2>Alma</h2>
            <p>alma04@gmail.com</p><br>
        </div>
    </div>
    
    <form id="add-trip-form"action="../controlers/verifVoyage.php" method="post" enctype="multipart/form-data">
      <h2>Ajouter un voyage</h2>
      <div>
        <input type="text" placeholder="nom" name="nom">
      </div>
      <div>
        <input type="date" placeholder="datedépart" name=datedepart>
      </div>
      <div>
        <input type="date" placeholder="datederetour" name="datederetour">
      </div>
      <div>
        <input type="text" placeholder="descriptionchamp" name="descriptionchamp">
      </div>
      <div>
        <input type="text" placeholder="categorie" name="categorie">
      </div>
      <div>
        <input type="text" placeholder="formule" name="formule">
      </div>
      <div>
        <input type="text" placeholder="prix" name="prix">
      </div>
      <div>
      <input type="file" name="imgurl" id="imgurl">
    </div>
      <button type="submit" name='submit'>Publier le voyage</button>
      
    </form>

    <div id="right-panel">
        <div class="logo">
            <img src="../assets/img/logo.png" alt="Logo Agence">
        </div>
        <form action="../classes/verifLogOut.php" method="post">
    <button type="submit" name="logout">Déconnecter</button>
</form>
    </div>
      <img src="../assets/img/back1" width=100%>
      
      <img src="../assets/img/back2" width=100% height= 64%>

      <img src="../assets/img/back1" width=100%>
  </div>
  
</body>
</html>
