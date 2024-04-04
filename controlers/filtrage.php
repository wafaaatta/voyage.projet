<?php 
include_once "../classes/voyages.php";

$id_formule = isset($_GET['id-formule']) ? $_GET['id-formule'] : null;
$id_categorie = isset($_GET['id-categorie']) ? $_GET['id-categorie'] : null;

if ($id_formule!== null) {
    $filteredData = $dataManager->showAllByFormuleId($id_formule);
   
} elseif ($id_categorie !== null) {
    $filteredData = $dataManager->showAllByCategoryId($id_categorie);

} else {
    
}
