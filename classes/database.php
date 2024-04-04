<?php 
// Classe pour la connexion à la base de données
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "base2";
    public $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn; // Retourner la connexion réussie
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            return null; // Retourner null en cas d'échec de connexion
        }
    }
}

// Initialisation de la connexion à la base de données
$connexion = new Database();
$conn = $connexion->connect();


