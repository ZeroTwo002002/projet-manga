<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST["titre"];
    $contenu = $_POST["mini_contenu"];
    $description = $_POST["contenu"];
    

    // Gestion de l'image téléchargée
    $target_dir = "css/uploads/"; // Dossier où vous souhaitez stocker les images téléchargées

    // Vérifiez si un fichier a été téléchargé
    if (isset($_FILES["Images"]) && $_FILES["Images"]["error"] === UPLOAD_ERR_OK) {
        $target_file = $target_dir . basename($_FILES["Images"]["name"]);

        // Déplacez le fichier téléchargé vers le dossier cible
        if (move_uploaded_file($_FILES["Images"]["tmp_name"], $target_file)) {
            // Le téléchargement a réussi, vous pouvez maintenant insérer les données dans la base de données
            $imagePath = $target_file; // Stockez le chemin de l'image

            try {
                // Connexion à la base de données avec PDO (vous devez configurer ceci)
                $pdo = new PDO("mysql:host=localhost;dbname=fil_d'actu", "root", "");
                
                // Préparez et exécutez la requête d'insertion
                $stmt = $pdo->prepare("INSERT INTO actu (titre, mini_contenu, contenu, datedepublication, Images) VALUES (:titre, :mini_contenu, :contenu, CURRENT_DATE(), :Images)");
                $stmt->bindParam(':titre', $titre);
                $stmt->bindParam(':mini_contenu',$contenu );
                $stmt->bindParam(':contenu', $description);
                $stmt->bindParam(':Images', $imagePath);
                if ($stmt->execute()) {
                    header("Location: index.php");
                    echo "L'insertion dans la base de données a réussi.";
                } else {
                    echo "Erreur lors de l'insertion dans la base de données.";
                }
            } catch (PDOException $e) {
                die("Erreur de base de données : " . $e->getMessage());
            }

            // Fermez la connexion
            $pdo = null;
        } else {
            echo "Erreur lors du déplacement du fichier téléchargé.";
        }
    } else {
        echo "Aucun fichier n'a été téléchargé ou une erreur s'est produite.";
    }
}
?>
