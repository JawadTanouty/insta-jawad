<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['file'])) {
        $file = $_POST['file'];
        $filePath = 'uploads/' . basename($file);

        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                echo "Image supprimée avec succès.";
            } else {
                echo "Erreur lors de la suppression de l'image.";
            }
        } else {
            echo "Fichier introuvable.";
        }
    } else {
        echo "Aucun fichier spécifié.";
    }
} else {
    echo "Requête invalide.";
}
?>
<a href="index.php">Retour</a>
