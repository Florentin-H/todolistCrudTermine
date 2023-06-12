<?php
// Include config file
require_once "../php/config.php";

try {
    // Préparer une requête de suppression
    $sql = "DELETE FROM todolist";
    $stmt = $pdo->prepare($sql);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Rediriger vers la page index.php après la suppression
        header("location: index.php");
        exit();
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
