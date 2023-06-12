<?php
// Configuration de la connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todolist";

try {
    // Création de l'objet PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration des options PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}
?>



