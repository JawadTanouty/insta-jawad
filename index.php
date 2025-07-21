<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Instagram - Upload</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<img class= logo src= "mininiinsta.jpg">

<h2>Uploader une image</h2>

<form action="upload.php" method="POST" enctype="multipart/form-data">
    <label for="author">Auteur :</label><br>
    <input type="text" id="author" name="author" required><br><br>

    <label for="image">Choisir une image :</label><br>
    <input type="file" id="image" name="image" accept="image/*" required><br><br>

    <button type="submit">Envoyer</button>
</form>

</body>
</html>

<h2>Mur d'images</h2>

<?php
$uploadDir = 'uploads/';

// Vérifie si le dossier existe
if (is_dir($uploadDir)) {
    // Ouvre le dossier
    $files = scandir($uploadDir);

// Fichier de données
$dataFile = 'data.txt';

// Tableau pour stocker les correspondances
$authors = [];

// Si le fichier existe
if (file_exists($dataFile)) {
    $lines = file($dataFile, FILE_IGNORE_NEW_LINES);

    // Remplir le tableau associatif image => auteur
    foreach ($lines as $line) {
        list($imageName, $authorName) = explode('|', $line);
        $authors[$imageName] = $authorName;
    }
}

    // Récupère la liste des fichiers
    $files = scandir($uploadDir);


    // Parcourt les fichiers du dossier
    foreach ($files as $file) {
        // Ignore les fichiers . et ..
        if ($file !== '.' && $file !== '..') {
            echo "<div style='display:inline-block; margin:10px; text-align:center;'>";
            echo "<img src='$uploadDir$file' alt='Image' style='max-width:200px; display:block;'><br>";
            
            // Affiche l'auteur s'il existe pour cette image
if (isset($authors[$file])) {
    echo "<p style='margin:5px 0; font-weight:bold;'>Auteur : " . htmlspecialchars($authors[$file]) . "</p>";
}
            // AJOUT DU BOUTON SUPPRIMER 
            echo "<form action='delete.php' method='POST' onsubmit='return confirm(\"Supprimer cette image ?\");'>";
            echo "<input type='hidden' name='file' value='$file'>";
            echo "<button type='submit' style='margin-top:5px;'>Supprimer</button>";
            echo "</form>";
            //
            echo htmlspecialchars($file);
            echo "</div>";
        }
    }
} else {
    echo "Aucune image à afficher.";
}


?>

</body>
</html>