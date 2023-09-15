<?php
session_start(); // Démarrez la session si elle n'est pas déjà démarrée

// Détruisez toutes les données de session
session_destroy();

// Redirigez l'utilisateur vers la page d'accueil ou une autre page de votre choix après la déconnexion
header("Location: /index.php"); // Vous pouvez changer "index.php" en URL de redirection souhaitée
exit();
?>
