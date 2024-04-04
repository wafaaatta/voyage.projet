<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../assets/css/loginForm.css">
<title>Formulaire de connexion</title>
</head>
<body>
<nav class="navbar">
    <div class="logo">
    <img src="http://localhost/sql/projet.voyage/assets/img/logo.png" alt="Logo" width="100">
    </div>
    <ul class="nav-links">
      <li><a href="Accueil.html">Accueil</a></li><br>
      <li><a href="Adhérez.html">Adhérez!</a></li><br>
      <li><a href="Séjour.html">Séjour 2 pour 1</a></li><br>
      <li><a href="Parrainez.html">Parrainez tous vos amis!</a></li><br>
      <li><a href="contact.html">Contact</a></li><br>

    </ul>
</nav>
<div class="form-container">
<form action="classes/verifLogin.php" method="post">
<div class="input-container"> 
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Nom d'utilisateur" name="nomdutilisateur">
  </div>
    <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Mot de passe" name="motdepasse">
  </div>
    <input type="submit" value="Se connecter">
</form>
</div>

