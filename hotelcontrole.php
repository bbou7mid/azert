<?php
include(__DIR__. '/../config/database.php');
include(__DIR__. '/../model/hotel.php');

class HotelController
{
    private $pdo;

    public function __construct() {
        
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=travel", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
    public function showHotel($id)
    {
        $sql = "SELECT * FROM hotel WHERE id = :id";
        $db = config::getConnexion();
    
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $hotel = $stmt->fetch(PDO::FETCH_ASSOC);
            return $hotel ?: null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function listHotels()
    {
        $sql = "SELECT * FROM hotel";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function deleteHotel($id)
    {
        $sql = "DELETE FROM hotel WHERE id = :id";
        $db = config::getConnexion();

        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
            if ($req->rowCount() > 0) {
                echo "L'hôtel a été supprimé avec succès.";
            } else {
                echo "Aucun hôtel trouvé avec l'ID $id.";
            }
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression de l'hôtel : " . $e->getMessage());
        }
    }

    public function addHotel($hotel) {
    try {
        // Commencer la transaction
        $this->pdo->beginTransaction();

        // Récupérer les valeurs dans des variables
        $nom = $hotel->getNom();
        $ville = $hotel->getVille();
        $etoile = $hotel->getEtoile();
        $prix_nuit = $hotel->getPrixNuit();
        $description = $hotel->getDescription();

        // Préparer l'instruction SQL
        $stmt = $this->pdo->prepare(
            "INSERT INTO hotel (nom, ville, etoile, prix_nuit, description) 
            VALUES (:nom, :ville, :etoile, :prix_nuit, :description)"
        );

        // Lier les paramètres avec les variables
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':etoile', $etoile);
        $stmt->bindParam(':prix_nuit', $prix_nuit);
        $stmt->bindParam(':description', $description);

        // Exécuter la requête
        $stmt->execute();

        // Valider la transaction
        $this->pdo->commit();

        echo "Hotel added successfully!";
    } catch (PDOException $e) {
        // Annuler la transaction en cas d'erreur
        $this->pdo->rollBack();
        echo 'Error: ' . $e->getMessage();
    }
}

    

    public function updateHotel($hotel, $id)
    {
        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                'UPDATE hotel SET 
                    nom = :nom,
                    ville = :ville,
                    etoile = :etoile,
                    prix_nuit = :prix_nuit,
                    description = :description
                WHERE id = :id'
            );

            // Exécution avec les paramètres
            $query->execute([
                ':id' => $id,
                ':nom' => $hotel->getNom(),
                ':ville' => $hotel->getVille(),
                ':etoile' => $hotel->getEtoile(),
                ':prix_nuit' => $hotel->getPrixNuit(),
                ':description' => $hotel->getDescription(),
            ]);

            echo $query->rowCount() . " enregistrement(s) mis à jour avec succès ! <br>";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>
