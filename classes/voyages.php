<?php
require_once "database.php";
require_once "verifLogin.php";

class Voyage {

public $id_categorie;
public $id_formule;
public $id_voyage;
public $nom;
public $description;
public $descriptionchamp;
public $datededepart;
public $datederetour;
public $prix;
public $imgurl;
public $conn;


public function __construct($conn){
        $this->conn = $conn;
    }

public function add($id_formule, $id_categorie, $nom, $description, $datededepart, $datederetour, $prix, $imgurl) {
   
    try {
        // Requête SQL pour insérer les données dans la base de données
        $request = "INSERT INTO `voyage` (`id-formule`, `id-categorie`, `nom`, `description`, `datedepart`, `datederetour`, `prix`, `imgurl`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $reponse = $this->conn->prepare($request);
        $reponse->execute([$id_formule, $id_categorie, $nom, $description, $datededepart, $datederetour, $prix, $imgurl]);
        
        // Redirection vers dashboard.php si l'ajout est réussi
        header("Location: ../templates/dashboard.php");
        exit();
    } catch(PDOException $e) {
        echo "Erreur lors de l'ajout du voyage : " . $e->getMessage();
    }
}



public function getById($id_voyage) {
  

    try {
        $request = "SELECT * FROM voyage WHERE `id-voyage`=?";
        $reponse = $this->conn->prepare($request);
        $reponse->execute([$id_voyage]);
        $voyage = $reponse->fetch(PDO::FETCH_ASSOC);
        
        if ($voyage) {
            return $voyage; // Retourne les détails du voyage sous forme de tableau associatif
        } else {
            return null; // Aucun voyage trouvé avec cet identifiant
        }
    } catch(PDOException $e) {
        echo "Erreur lors de la récupération du voyage : " . $e->getMessage();
        return null; // En cas d'erreur, retourne null
    }
}




public function edit($id_formule, $id_categorie, $nom, $description, $datededepart, $datederetour, $prix, $id_voyage, $_imgurl){
  

    try {
        $request = "UPDATE voyage SET `id-formule`=?, `id-categorie`=?, `nom`=?, `description`=?, `datedepart`=?, `datederetour`=?, `prix`=?, `imgurl`=? WHERE `id-voyage`=?";
        $reponse = $this->conn->prepare($request);
        $reponse->execute([$id_formule, $id_categorie, $nom, $description, $datededepart, $datederetour, $prix, $_imgurl, $id_voyage]);
       // Redirection vers dashboard.php si l'ajout est réussi
       header("Location: ../templates/dashboard.php");
       exit();
    } catch(PDOException $e) {
        echo "Erreur lors de la mise à jour : " . $e->getMessage();
    }
}


public function delete($id_voyage){

   
    try  {
        $request = "DELETE FROM voyage WHERE `id-voyage`=?";
        $reponse = $this->conn->prepare($request);
        $reponse->execute([$id_voyage]);
        echo "Suppression réussie";
    } catch(PDOException $e) {
        echo "Erreur lors de la suppression : " . $e->getMessage();
    } 
}


public function showAll() {
 

    try {
        $request = "SELECT * FROM voyage";
        $response = $this->conn->prepare($request);
        $response->execute();
        return $response->fetchAll();
        
    } catch(PDOException $e) {
        echo "Erreur lors de la récupération des données : " . $e->getMessage();
    }
}


////filtrage


public function showAllByIdFormule($id_formule) {
    $query = "SELECT * FROM voyage WHERE `id-formule` = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$id_formule]);
    return $stmt->fetchAll();
}

public function showAllByIdCategorie($id_categorie) {
    $query = "SELECT * FROM voyage WHERE `id-categorie` = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([$id_categorie]);
    return $stmt->fetchAll();
}
}