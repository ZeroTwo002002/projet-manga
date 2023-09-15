<?php 
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once('script.php') ?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <a class="navbar-brand" href="#"><span>D.</span>Manga Actu</a>
    <?php
    // Vérifiez si l'utilisateur est connecté en vérifiant la présence des variables de session
    if (isset($_SESSION["UserID"], $_SESSION["Pseudo"])) {
        echo '<div class="user-welcome ml-auto d-flex align-items-center">';
        echo '    <p class="mr-3 mb-0">Bonjour ' . $_SESSION["Pseudo"] . '</p>';
        echo '    <a href="utilisateur/deconnexion.php" class="btn btn-primary">Déconnexion</a>';
        echo '</div>';
    } else {
        // Si l'utilisateur n'est pas connecté, affichez les boutons Connexion et Inscription
        echo '<form class="form-inline ml-auto ">';
        echo '    <input class="form-control mr-2" type="search" placeholder="Rechercher" aria-label="Rechercher">';
        echo '    <a href="utilisateur/inscription.php" class="btn btn-primary mr-2">Inscription</a>';
        echo '    <a href="utilisateur/connexion.php" class="btn btn-primary">Connexion</a>';
        echo '</form>';
    }
    ?>
</nav>

<!-- Header avec l'image de fond -->
<header>
    <div class="container">
            <div class="header-text">
                <h1>ACTUALITÉS</h1>
                <div class="description-box">
                <p>Découvrez les dernières nouvelles, les annonces excitantes et les tendances palpitantes de l'univers du manga dans notre site <span>D.</span>Manga Actu</p>
            </div>
            </div>
        </div>
</header>

<div class="container mt-4">
<h1 class="text-center mb-4">Liste <span>D</span>'actu</h1> <!-- Ajoutez le titre ici -->
    <div class="row">
        <?php
        include_once('config_bdd.php');
        $sql = "SELECT articleid, titre, mini_contenu, contenu, datedepublication, Images FROM actu";
        $result = $conn->query($sql);
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="col-md-6 mb-4">'; // Réduisez la largeur de la colonne
                echo '<div class="card card-custom">';
                echo '<img src="' . $row['Images'] . '" class="card-img-top" alt="Image">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . strtoupper($row['titre']) . '</h5>';
                echo '<p class="card-text">' . $row['mini_contenu'] . '</p>';
                echo '<p class="card-text"><small class="text-muted">Date de Publication: ' . $row['datedepublication'] . '</small></p>';
                echo '<button class="btn btn-primary voir-plus-btn" data-toggle="modal" data-target="#myModal' . $row['articleid'] . '">Voir plus</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p class="aucune-actualite">Aucune actualité trouvée.</p>';
        }
        // Modal
        if ($result->rowCount() > 0) {
            $result->execute();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="modal fade" id="myModal' . $row['articleid'] . '">';
                echo '    <div class="modal-dialog modal-xl">';
                echo '        <div class="modal-content">';
                echo '            <div class="modal-body">';
                echo '                <h5 class="modal-title" style="color: black; font-size: 30px; font-weight: bold; margin-bottom: 10px;">' . strtoupper($row['titre']) . '</h5>';
                echo '                <p style="color: black; font-size: 20px; margin-bottom: 15px;">' . $row['mini_contenu'] . '</p>';
                echo '                <img src="' . $row['Images'] . '" class="img-fluid modal-image w-100" style="max-height: 300px; object-fit: cover;" alt="Image">';
                echo '                <p style="color: black; font-size: 16px; font-style: italic; line-height: 2; margin-top: 10px">' . $row['contenu'] . '</p>';
                echo '                <p class="card-text"><small class="text-muted">Date de Publication: ' . $row['datedepublication'] . '</small></p>';
                
                // Récupération des commentaires depuis la base de données en utilisant PDO
                $articleId = $row['articleid'];
                $query = "SELECT Userid, contenu, datedepublication FROM commentaire WHERE articleid = :articleID";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':articleID', $articleId, PDO::PARAM_INT);
                $stmt->execute();
                
                $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo '<h5 style="color: black; font-size: 30px; margin-top: 20px;">Commentaires :</h5>';
                if (!empty($comments)) {
                    echo '<ul style="list-style-type: none; padding: 0;">';
                    foreach ($comments as $comment) {
                        echo '<li style="color: black; font-size: 16px;">';
                        echo 'Contenu: ' . $comment['contenu'] . '<br>';
                        echo 'Date de Publication: ' . $comment['datedepublication'];
                        echo '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p style="color: black;">Aucun commentaire pour cet article.</p>';
                }
                
                echo '            </div>';
                echo '            <div class="modal-footer">';
                echo '                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>';
                echo '            </div>';
                echo '        </div>';
                echo '    </div>';
                echo '</div>';
                
        }
    }
        ?>
        
        
    </div>
</div>

<div class="container mt-4">   
        <a href="add_actu.php" class="btn btn-primary">Ajouter une Actualité</a>
</div>

<script src="script.js"></script>
</body>
</html>