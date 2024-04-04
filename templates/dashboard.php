<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des voyages</title>
    <link rel="stylesheet" href="../assets/css/style.css">
   
</head>
<body>
    <?php 
    require_once "../classes/voyages.php";

    ?>
<div class="container">
    <!-- Colonne 1 -->
    <div class="dashboard">
        <div class="profile">
            <img src="../assets/img/alma.webp" alt="Photo du client">
            <h2>Alma</h2>
            <p>alma04@gmail.com</p><br>
        </div>
    </div>


    <div class="trip-container">
    <form action="" method="get">
        <input type="radio" name="filter_type" value="formule" checked> Filtrer par ID de formule
        <input type="text" name="id-formule" placeholder="ID de formule">
        <br>
        <input type="radio" name="filter_type" value="categorie"> Filtrer par ID de catégorie
        <input type="text" name="id-categorie" placeholder="ID de catégorie">
        <br>
        <button type="submit">Filtrer</button>
    </form>
    
<?php


/*//une instance de la classe Voyage
$tour = new Voyage ($conn);
// j'appelle la méthode add pour ajouter un voyage dans la base de données
$id_formule = isset($_GET['id-formule']) ? $_GET['id-formule'] : null;
$id_categorie = isset($_GET['id-categorie']) ? $_GET['id-categorie'] : null;
$id_specifique = isset($_GET['id-specifique']) ? $_GET['id-specifique'] : null;

if ($id_formule!== null) {
    $results = $tour->showAllByIdFormule($id_formule);
    var_dump($id_formule);
    var_dump("bonjour");

} elseif ($id_categorie !== null) {
    $results = $tour->showAllByIdCategorie($id_categorie);
    var_dump("lundi");
}

else {
    $results = $tour->showAll();
    var_dump("mardi");
}
*/


$tour = new Voyage ($conn);

$id_formule = isset($_GET['id-formule']) ? $_GET['id-formule'] : null;
$id_categorie = isset($_GET['id-categorie']) ? $_GET['id-categorie'] : null;

//var_dump($id_formule);
if (!empty($id_formule)) {
    $results = $tour->showAllByIdFormule($id_formule);
    
    //var_dump("bonjour");
} elseif (!empty($id_categorie)) {
    $results = $tour->showAllByIdCategorie($id_categorie);
    //var_dump("lundi");
} else {
    $results = $tour->showAll();
   // var_dump("mardi");
}


echo "<h1>Liste des voyages</h1>"; // Titre ajouté

foreach ($results as $row) {
    echo "<div class='trip'>";
    echo "<h3>".$row['nom']."</h3>";
    echo "<p>Date de départ: ".$row['datedepart']."</p>";
    echo "<p>Date de retour: ".$row['datederetour']."</p>";
    echo "<p>Description: ".$row['descriptionchamp']."</p>";
    echo "<p>ID Catégorie: ".$row['id-categorie']."</p>";
    echo "<p>ID Formule: ".$row['id-formule']."</p>";
    echo "<p>Prix: ".$row['prix']."</p>";
    echo "<p>URL de l'image: ".$row['imgurl']."</p>";
            
    $id_voyage = $row['id-voyage'];
    
    // Affichage conditionnel des boutons Modifier et Supprimer en fonction du rôle de l'utilisateur
    if ($_SESSION['role'] === "employe") {
        // Seuls les employés ont le droit de modifier et supprimer
        echo "<a href='../controlers/edit.php?id_voyage=".$id_voyage."'><button class='edit-trip-btn'>Modifier</button></a>";
        echo "<a href='../controlers/delete.php?id_voyage=".$id_voyage."'><button class='delete-trip-btn'>Supprimer</button></a>";
    }

    echo "</div>";
}

// Bouton pour ajouter un nouveau voyage
if ($_SESSION['role'] === "employe") {
    echo "<a href='formulaire.php'><button class='add-trip-btn'>Ajouter un voyage</button></a>";
}

?>


    </div>
    <div id="right-panel">
        <div class="logo">
            <img src="../assets/img/logo.png" alt="Logo Agence">
        </div>
       
        <form action="../classes/verifLogOut.php" method="post">
    <input type="submit" name="logout" value="Déconnecter">
</form>
    </div>
</div>
</body>
</html>
