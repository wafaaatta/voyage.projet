<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des voyages</title>
    <link rel="stylesheet" href="../assets/css/styleedit.css">
    <link rel="stylesheet" href="../assets/js/edit.js">
</head>
<body>
<?php
include_once "../classes/voyages.php";

// Vérifier si l'ID du voyage est passé en paramètre
if(isset($_GET['id_voyage'])) {
    $id_voyage = $_GET['id_voyage'];
    
    $voyage = new Voyage($conn);

    // Récupère les données actuelles du voyage à partir de la base de données
    $voyageData = $voyage->getById($id_voyage); 
    
    // Affiche le formulaire de modification avec les données actuelles du voyage
    ?>

    <form method="post" action="edit.php" enctype="multipart/form-data">
        <!-- Champ caché pour stocker l'ID du voyage -->
        <input type="hidden" name="id_voyage" value="<?= htmlspecialchars($id_voyage) ?>">
        <label for="nom">Nom du voyage :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($voyageData['nom']) ?>">
        <label for="datedepart">Date de départ :</label>
        <input type="date" name="datedepart" id="datedepart" value="<?= htmlspecialchars($voyageData['datedepart']) ?>">
        <label for="datederetour">Date de retour :</label>
        <input type="date" name="datederetour" id="datederetour" value="<?= htmlspecialchars($voyageData['datederetour']) ?>">
        <label for="descriptionchamp">Description :</label>
        <textarea name="descriptionchamp"><?= htmlspecialchars($voyageData['descriptionchamp']) ?></textarea>
        <label for="id-categorie">ID Catégorie :</label>
        <input type="text" name="id-categorie" value="<?= htmlspecialchars($voyageData['id-categorie']) ?>">
        <label for="id-formule">ID Formule :</label>
        <input type="text" name="id-formule" value="<?= htmlspecialchars($voyageData['id-formule']) ?>">
        <label for="prix">Prix :</label>
        <input type="text" name="prix" value="<?= htmlspecialchars($voyageData['prix']) ?>">
        <label for="imgurl">Image :</label>
        <input type="file" name="imgurl">
        <input type="submit" name="submit" value="Modifier">
    </form>
    <?php
} else {
    echo "Le voyage spécifié n'existe pas.";
}

// Vérifier si le formulaire de modification a été soumis
if(isset($_POST['submit'])){
    // Récupère les données du formulaire
    $id_voyage = $_POST['id_voyage']; 
    $nom = $_POST['nom'];
    $datedepart = $_POST['datedepart'];
    $datederetour = $_POST['datederetour'];
    $description = $_POST['descriptionchamp'];
    $id_categorie = $_POST['id-categorie'];
    $id_formule = $_POST['id-formule'];
    $prix = $_POST['prix'];

    // Chemin où stocker les images (par défaut : le dossier 'uploads' dans le répertoire actuel)
    $uploadDirectory = 'uploads/';

    // Vérifie si le fichier image est réel ou une fausse image
    if(isset($_FILES["imgurl"]["tmp_name"]) && !empty($_FILES["imgurl"]["tmp_name"])) {
        $check = getimagesize($_FILES["imgurl"]["tmp_name"]);
        if($check === false) {
            echo "Le fichier n'est pas une image.";
            exit();
        }
    } else {
        echo "Aucun fichier image n'a été sélectionné.";
        exit();
    }

    // Vérifie la taille de l'image
    if ($_FILES["imgurl"]["size"] > 500000) {
        echo "L'image est trop grande. Veuillez sélectionner une image de moins de 500KB.";
        exit();
    }

    // Autorise certains formats de fichiers
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $imageFileType = strtolower(pathinfo($_FILES["imgurl"]["name"], PATHINFO_EXTENSION));
    if(!in_array($imageFileType, $allowedExtensions)) {
        echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        exit();
    }

    // Déplace le fichier vers le dossier de destination
    $targetFile = $uploadDirectory . basename($_FILES["imgurl"]["name"]);
    if (move_uploaded_file($_FILES["imgurl"]["tmp_name"], $targetFile)) {
        // Appelle la méthode edit() pour mettre à jour le voyage avec l'URL de la nouvelle image
        $voyage = new Voyage($conn);
        $result = $voyage->edit(intval($id_categorie), intval($id_formule), $nom, $description, $datedepart, $datederetour, intval($prix), intval($id_voyage), $targetFile);

        if ($result) {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Désolé, une erreur s'est produite lors du modife du voyage.";
        }
    }
}

?>


