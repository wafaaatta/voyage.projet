<?php
session_start(); // Démarrez la session au début de votre script

include_once "database.php";

// Fonction pour vérifier l'utilisateur
function verifyUser($nomdutilisateur, $motdepasse) {
    $db = new Database();
    $conn = $db->connect();

    try {
        $stmt = $conn->prepare("SELECT * FROM user WHERE nomdutilisateur = :nomdutilisateur AND motdepasse = :motdepasse");
        $stmt->bindParam(':nomdutilisateur', $nomdutilisateur);
        $stmt->bindParam(':motdepasse', $motdepasse);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['role'] : false; // Return le rôle si l'utilisateur est trouvé
    } catch(PDOException $e) {
        // Log l'erreur plutôt que de l'afficher à l'utilisateur
        error_log("Erreur : " . $e->getMessage(), 0);
        return false;
    }
}

// Vérifier si le formulaire est soumis
if(isset($_POST['nomdutilisateur'], $_POST['motdepasse'])) {
    $nomdutilisateur = $_POST['nomdutilisateur'];
    $motdepasse = $_POST['motdepasse'];

    // Vérification de l'utilisateur et récupération du rôle
    $role = verifyUser($nomdutilisateur, $motdepasse);

    if($role) { // Si l'utilisateur est trouvé
        // Stocker des informations sur l'utilisateur connecté dans la session
        $_SESSION['nomdutilisateur'] = $nomdutilisateur;
        $_SESSION['role'] = $role;

        // Redirection vers le tableau de bord approprié selon le rôle
        if($role === "employe") {
            header("Location: ../templates/dashboard.php"); // Rediriger vers le tableau de bord des employés
        } elseif($role === "utilisateur") {
            header("Location: ../templates/dashboard.php"); // Rediriger vers la page des voyages pour les utilisateurs
        } else {
            header("Location: ../index.php"); // Rediriger vers la page d'accueil si le rôle n'est pas correct
        }
        exit(); // Assurez-vous de terminer le script après la redirection
    } else {
        header("Location: ../index.php");
        exit(); // Assurez-vous de terminer le script après la redirection
    }
} else {
    // Si le formulaire n'est pas soumis, vérifier si l'utilisateur est déjà connecté
    if(isset($_SESSION['nomdutilisateur'], $_SESSION['role'])) {
        if($_SESSION['role'] === "employe") {
            // L'employé a accès aux fonctionnalités d'ajout, mise à jour et suppression de voyages
            // Vous pouvez ajouter le code correspondant ici
        } elseif($_SESSION['role'] === "utilisateur") {
            // L'utilisateur a seulement le droit de voir les voyages
            // Vous pouvez ajouter le code correspondant ici
        } else {
            // Si le rôle de l'utilisateur n'est pas correct, déconnectez-le et redirigez-le vers la page d'accueil
            session_unset();
            session_destroy();
            header("Location: ../index.php");
            exit();
        }
    } else {
        // Si l'utilisateur n'est pas connecté, redirigez-le vers la page d'accueil
        header("Location: ../index.php");
        exit();
    }
}

?>


