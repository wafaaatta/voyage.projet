<?php
// Inclure le fichier contenant la classe Database
require_once 'database.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le bouton Déconnecter a été cliqué
    if (isset($_POST['logout'])) {
        // Assurez-vous que la session est démarrée
        session_start();
        
        session_unset();
        
        session_destroy();
        
        
        header("Location: ../templates/loginForm.php");
        exit(); 
    }
}