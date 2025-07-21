<?php

            date_default_timezone_set('Europe/Paris');

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérifie si un fichier a bien été envoyé et s'il n'y a pas d'erreur
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

        // Récupérer le nom de l'auteur
        $author = htmlspecialchars($_POST['author']);

        // Dossier où enregistrer les images
        $uploadDir = 'uploads/';

        // Créer le dossier s'il n'existe pas
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Récupère le nom temporaire et le nom original du fichier
        $tmpName = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);

        // Nom du fichier daté et titré
        $timestamp = date('Y-m-d_H-i-s');
        $uniqueName = $timestamp . '-' . basename($_FILES['image']['name']);


        // Chemin de destination
        $destination = $uploadDir . $uniqueName;

        // Déplace le fichier téléchargé
        if (move_uploaded_file($tmpName, $destination)) {
            echo "<p>Image uploadée avec succès par <strong>$author</strong> !</p>";
            echo "<img src='$destination' alt='Image uploadée' style='max-width:300px;'>";
        } else {
            echo "Erreur lors du déplacement de l'image.";
        }

    } else {
        echo "Aucun fichier valide envoyé.";
    }

} else {
    echo "Formulaire non soumis correctement.";
}
// Fichier de données
$dataFile = 'data.txt';

// Contenu à ajouter : nom du fichier | auteur
$line = $uniqueName . '|' . $author . "\n";

// Écriture dans le fichier en mode ajout
file_put_contents($dataFile, $line, FILE_APPEND);

