<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Inscription</title>
    <!-- Inclure le lien vers Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Inscription</h2>
    <form method="POST" action="/utilisateur/inscription_bdd.php">
    <div class="form-group">
    <p><?php echo isset($_SESSION['message_form']) ? $_SESSION['message_form'] : ''; ?></p>
    <p><?php echo isset($_SESSION['message_pseudo']) ? $_SESSION['message_pseudo'] : ''; ?></p>
    <p><?php echo isset($_SESSION['message_email']) ? $_SESSION['message_email'] : ''; ?></p>
    <p><?php echo isset($_SESSION['message_user']) ? $_SESSION['message_user'] : ''; ?></p>
        <label for="pseudo">Pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo">
    </div>
    <div class="form-group">
        <label for="email">Adresse Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="pass" placeholder="Entrez votre mot de passe">
    </div>
        <button type="submit" class="btn btn-success">S'inscrire</button>
        <?php unset($_SESSION['message_form']);
        unset($_SESSION['message_pseudo']); 
        unset($_SESSION['message_email']); 
        unset($_SESSION['message_user']); 
        ?>
    </form>
    <p class="text-center mt-2">Vous avez déjà un compte ? <a href="/utilisateur/connexion.php">Se connecter</a></p>
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
