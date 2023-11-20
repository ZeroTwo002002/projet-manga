<?php
session_start();

function verifdonnées($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire d'inscription et appliquez la fonction de validation
    $pseudo = verifdonnées($_POST["pseudo"]);
    $email = verifdonnées($_POST["email"]);
    $pass = verifdonnées($_POST["pass"]);

    // Vérifiez si des champs sont vides
    if (empty($pseudo) || empty($email) || empty($pass)) {
        $message_form = "Tous les champs doivent etre remplies";
        $_SESSION['message_form'] = $message_form;
        header("Location: inscription.php"); // Redirige vers la page inscription
        exit(); // Assurez-vous de terminer le script après la redirection
    } else {
        if (!preg_match("/^[a-zA-Z0-9_]+$/", $pseudo)) {
            $message_pseudo = "Le champ 'Pseudo' ne doit contenir que des lettres, des chiffres et des underscores (_) et pas d'espace.";
        $_SESSION['message_pseudo'] = $message_pseudo;
        header("Location: inscription.php"); // Redirige vers la page inscription
        exit(); // Assurez-vous de terminer le script après la redirection
        } else {
            // Connexion à la base de données (adapté à votre configuration)
            include_once('/laragon/www/PROJET-MANGA/config_bdd.php');

            // Vérifiez si l'email est déjà pris
            $query = "SELECT email FROM utilisateur WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $message_email = "Cet email est déjà utilisé. Utilisez un autre email.";
                $_SESSION['message_email'] = $message_email;
                header("Location: inscription.php"); // Redirige vers la page inscription
                exit(); // Assurez-vous de terminer le script après la redirection
            } else {
                // Vérifiez si le pseudo est déjà pris
                $query = "SELECT * FROM utilisateur WHERE BINARY Pseudo = :pseudo";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
                $stmt->execute();

                

                if ($stmt->rowCount() > 0) {
                    $message_user = "Ce pseudo est déjà pris. Choisissez un autre pseudo.";
                    $_SESSION['message_user'] = $message_user;
                    header("Location: inscription.php"); // Redirige vers la page inscription
                    exit(); // Assurez-vous de terminer le script après la redirection
                } else {
                    // Le pseudo est unique, nous pouvons procéder à l'inscription

                    // Hachez le mot de passe
                    $password_hashed = password_hash($pass, PASSWORD_BCRYPT);

                    // Insérez les données dans la base de données
                    $query = "INSERT INTO utilisateur (Pseudo, email, Password) VALUES (:pseudo, :email, :pass)";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(":pseudo", $pseudo);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":pass", $password_hashed);
                    $stmt->execute();

                    // Définir un message de confirmation dans la variable de session
                    $_SESSION['confirmation_message'] = "Inscription réussie. Vous pouvez maintenant vous connecter";
                    // Redirigez l'utilisateur vers la page de connexion ou affichez un message de succès
                    header("Location: connexion.php");
                    exit();
                }
            }
        }
    }
}
?>