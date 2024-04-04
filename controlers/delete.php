<?php

include_once "../classes/voyages.php";

// Vérification de l'existence du paramètre id dans l'URL que je l'avais mis dans voyages.php

if(isset($_GET['id_voyage'])) {

    $id_voyage = $_GET['id_voyage'];

    // Inclure le fichier contenant la classe voyage
    include '../classes/voyages.php';

   
    $voyage = new Voyage($conn);
 //$id_voyage = 35; 
    // Appel de la fonction delete avec l'id récupéré
    $voyage->delete($id_voyage);
} else {
    //header("Location: ../templates/dashboard.php");
}

    
?>
