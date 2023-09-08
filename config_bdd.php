<?php
$serveur = "localhost";
$utilisateur = "root";
$dbname = "fil_d'actu";
$password = "";

try {
    // Connexion à la base de données avec PDO
    $conn = new PDO("mysql:host=$serveur;dbname=$dbname", $utilisateur, $password);
    // Configuration des options de PDO pour afficher les erreurs en cas de problème
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

// Sélectionner les titres, le contenu et la date de publication des actualités depuis la base de données



?>