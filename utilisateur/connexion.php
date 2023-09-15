<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <!-- Inclure le lien vers Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php
    // Affichez le message de confirmation s'il existe
    if (!empty($_SESSION['confirmation_message'])) {
        echo '<div class="confirmation">';
        echo '<span class="close-button" onclick="this.parentElement.style.display=\'none\'">X</span>';
        echo $_SESSION['confirmation_message'];
        echo '</div>';
        // Supprimez le message de confirmation de la session
        unset($_SESSION['confirmation_message']);
    }
    ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <!-- Formulaire de Connexion -->
            <h2 class="text-center">Connexion</h2>
            <form method="POST" action="/utilisateur/connexion_bdd.php">
                <div class="form-group">
                <p><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?></p>
                <p style="background-color: red; color: white; font-size: 25px; border-radius: 15px; text-align: center;"><?php echo isset($_SESSION['message_id']) ? $_SESSION['message_id'] : ''; ?></p>
                <p style="background-color: red; color: white; font-size: 25px; border-radius: 15px; text-align: center;"><?php echo isset($_SESSION['message_login_attempts']) ? $_SESSION['message_login_attempts'] : ''; ?></p>
                    <label for="username_or_email">Pseudo ou Email :</label>
                    <input type="text" name="username_or_email" class="form-control" id="username_or_email" placeholder="Entrez votre email ou votre pseudo">
                </div>
                <div class="form-group">
                    <label for="loginPassword">Mot de passe</label>
                    <input type="password" name="pass" class="form-control" id="loginPassword" placeholder="Entrez votre mot de passe">
                </div>
                <button type="submit" value="Se connecter" class="btn btn-primary btn-block">Se connecter</button>
                <p class="text-center mt-2">Vous n'avez pas encore de compte ? <a href="inscription.php">Inscription</a></p>
                
                
                <?php unset($_SESSION['message']); // Supprimez la variable de session après l'affichage du message
                      unset($_SESSION["message_login_attempts"]); // Supprimez la variable de session
                      unset($_SESSION["message_id"]);  ?>
            </form>
        </div>
    </div>
</div>

<!-- Bouton "Retourner à l'accueil" en haut à gauche avec une flèche vers la droite -->
<a href="/index.php" class="btn btn-light position-fixed" style="top: 20px; left: 10px;">
    <i class="fas fa-chevron-left"></i> Retourner à l'accueil
</a>

<!-- Inclure les scripts Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
