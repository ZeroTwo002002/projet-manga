<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez s'il existe déjà une variable de session pour le nombre de tentatives
    if (!isset($_SESSION["login_attempts"])) {
        $_SESSION["login_attempts"] = 0;
    }

    // Vérifiez le nombre de tentatives
    if ($_SESSION["login_attempts"] >= 20) {
        $message_login_attempts = "Trop de tentatives de connexion. Veuillez réessayer plus tard.";
        $_SESSION['message_login_attempts'] = $message_login_attempts;
        header("Location: connexion.php"); // Redirige vers la page connexion
        exit(); // Assurez-vous de terminer le script après la redirection
    }
     else {
        $username_or_email = $_POST["username_or_email"];
        $pass = $_POST["pass"];

        // Vérifiez si des champs sont vides
        if (empty($username_or_email) || empty($pass)) {
            $message_coonexion = "Tous les champs doivent être remplis.";
            $_SESSION['message'] = $message_coonexion;
            header("Location: connexion.php"); // Redirige vers la page connexion
            exit(); 
        } else {
            // Connexion à la base de données (adapté à votre configuration)
            include_once('/laragon/www/PROJET-MANGA/config_bdd.php');
            // Recherchez l'utilisateur dans la base de données en fonction du pseudo ou de l'email
            $query = "SELECT * FROM utilisateur WHERE BINARY Pseudo = :username OR email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":username", $username_or_email);
            $stmt->bindParam(":email", $username_or_email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Vérifiez si l'utilisateur existe et si le mot de passe est correct
            if ($user && password_verify($pass, $user["Password"])) {
               
                // La connexion est réussie, réinitialisez le nombre de tentatives
                $_SESSION["login_attempts"] = 0;

                // Stockez les informations de l'utilisateur dans la session
                $_SESSION["UserID"] = $user["UserID"];
                $_SESSION["Pseudo"] = $user["Pseudo"];
                $_SESSION["email"] = $user["email"];
                
                 // Redirigez vers la page du tableau de bord après la connexion réussie
                 header("Location: /index.php");
                exit();
            } else {
                $message_id = "Identifiants incorrects";
                $_SESSION['message_id'] = $message_id;
                header("Location: connexion.php"); // Redirige vers la page connexion
                exit(); // Assurez-vous de terminer le script après la redirection
                // Incrémentez le nombre de tentatives infructueuses
                $_SESSION["login_attempts"]++;
            }
        }
    }
}
?>

