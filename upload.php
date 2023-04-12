<?php

// TRAITEMENT DU FORMULAIRE


//<?php
// On vérifie si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // On vérifie que le champ "avatar" est bien présent et qu'il n'y a pas d'erreur lors de l'upload
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        // Sécurisation des données
        $firstName = htmlspecialchars($_POST['firstName']);
        $lastName = htmlspecialchars($_POST['lastName']);
        $age = htmlspecialchars($_POST['age']);

        // Chemin vers un dossier sur le serveur qui va recevoir les fichiers uploadés (attention ce dossier doit être accessible en écriture)
        $uploadDir = 'public/uploads/';
        // Le nom de fichier sur le serveur est généré à partir du nom de fichier sur le poste du client (mais d'autres stratégies de nommage sont possibles)
        $uniqueFileName = uniqid() . '_' . basename($_FILES['avatar']['name']);
        $uploadFile = $uploadDir . $uniqueFileName;

        // Récupération de l'extension du fichier
        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        // Extensions autorisées
        $authorizedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        // Poids max géré par PHP par défaut est de 1M
        $maxFileSize = 1000000;

        // Vérification de l'extension et du poids du fichier
        if (!in_array($extension, $authorizedExtensions)) {
            $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png ou gif ou webp !';
        }

        if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
            $errors[] = "Votre fichier doit faire moins de 1M !";
        }

        // S'il n'y a pas d'erreur, on peut uploader le fichier
        if (empty($errors)) {
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                echo "Le fichier " . htmlspecialchars($uniqueFileName) . " a été uploadé avec succès.";

                // On affiche le nom, prénom et l'âge de l'utilisateur
                echo "<p>Nom: " . $lastName . "</p>";
                echo "<p>Prénom: " . $firstName . "</p>";
                echo "<p>Âge: " . $age . "</p>";

                // On affiche le fichier uploadé
                echo '<img src="' . $uploadFile . '" alt="Image uploadée" />';

                // On ajoute le bouton "Delete"
                echo '<form method="post">';
                echo '<input type="hidden" name="fileToDelete" value="' . $uniqueFileName . '">';
                echo '<button type="submit" name="delete">Delete</button>';
                echo '</form>';
            } else {
                $errors[] = "Une erreur est survenue lors de l'upload du fichier.";
            }
        }
    }
}

// On vérifie si le bouton "Delete" a été cliqué