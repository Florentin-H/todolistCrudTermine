<?php
// Include config file
require_once "../php/config.php";

// Vérifiez si l'identifiant de l'enregistrement à supprimer est spécifié
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Préparez une instruction de suppression
    $sql = "DELETE FROM todolist WHERE id = :id";

    if ($stmt = $pdo->prepare($sql)) {
        // Lie le paramètre :id à la valeur de l'identifiant
        $stmt->bindParam(":id", $param_id);

        // Définissez les paramètres et exécutez la requête
        $param_id = trim($_GET["id"]);
        if ($stmt->execute()) {
            // Enregistrement supprimé avec succès. Redirigez vers la page d'accueil
            header("location: index.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Ferme la déclaration
    unset($stmt);
}

// Ferme la connexion PDO
unset($pdo);
?>
