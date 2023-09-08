<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Manga</title>
    <?php include_once('script.php')  ?>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container mt-5">
    <h2>Ajouter une Actualité</h2>
    <form action="add_bdd_actu.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="titre">Titre de l'Actualité :</label>
            <input type="text" class="form-control" id="titre" name="titre" required>
        </div>
        <div class="form-group">
        <label for="mini_description">Phrase d'accroche :
</label>
            <textarea class="form-control" id="mini_description" name="mini_contenu" rows="2" required></textarea>
        </div>
        <div class="form-group">
    <label for="description">Description :</label>
    <textarea class="form-control" id="description" name="contenu" rows="4" required></textarea>
</div>
        <div class="form-group custom-file" style="margin-bottom: 20px; margin-top: 20px;">
    <label for="Images" class="custom-file-label" id="imageLabel">Choisir une image</label>
    <input type="file" class="custom-file-input" id="Images" name="Images" accept="image/*" onchange="displaySelectedFileName()">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<script src="script.js"></script>

</body>
</html>
