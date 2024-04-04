<?php

include_once "../classes/voyages.php";

// Vérification si le formulaire a été soumis et la méthode de requête est POST
if(isset($_POST["submit"]) && ($_SERVER["REQUEST_METHOD"] == "POST")) {
    // Récupération des données du formulaire
    $id_formule = $_POST['formule'];
    $id_categorie = $_POST['categorie'];
    $nom = $_POST['nom'];
    $description = $_POST['descriptionchamp'];
    $datedepart = $_POST['datedepart'];
    $datederetour = $_POST['datederetour'];
    $prix = $_POST['prix'];

    // Chemin où stocker les images (par défaut : le dossier 'uploads' dans le répertoire actuel)
    $uploadDirectory = dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'uploads';

    // Crée le dossier s'il n'existe pas
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    // Vérifie si le fichier image est réel ou une fausse image
    $check = getimagesize($_FILES["imgurl"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    } 

    // Vérifie la taille de l'image
    if ($_FILES["imgurl"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Autorise certains formats de fichiers
    $imageFileType = strtolower(pathinfo($_FILES["imgurl"]["name"],PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Vérifie si $uploadOk est à 0 à cause d'une erreur
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // Si tout est bon, tente d'uploader l'image
    } else {
        
        $imageName = uniqid() . "." . $imageFileType; 
        $targetFile = $uploadDirectory . DIRECTORY_SEPARATOR . $imageName;

        if (move_uploaded_file($_FILES["imgurl"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars($imageName) . " has been uploaded.";
            
            // Création d'un nouvel objet voyage
            $voyage = new Voyage($conn);
            
            // Ajout du voyage avec le nom de l'image unique
            $ajoutReussi = $voyage->add($id_formule, $id_categorie, $nom, $description, $datedepart, $datederetour, $prix, $imageName);
            
            if ($ajoutReussi) {
                header("Location: ../templates/dashboard.php");
                exit(); 
            } else {
                echo "Désolé, une erreur s'est produite lors de l'ajout du voyage.";
            }
        }            
    }
}


?>

    

    
  
