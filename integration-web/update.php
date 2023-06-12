<?php
// Include config file
require_once "../php/config.php";

// Define variables and initialize with empty values
$tache = "";
$tache_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_tache = trim($_POST["tache"]);
    if (empty($input_tache)) {
        $tache_err = "Please enter a tache.";
    } else {
        $tache = $input_tache;
    }

    // Check input errors before updating in database
    if (empty($tache_err)) {
        try {
            // Prepare an update statement
            $sql = "UPDATE todolist SET tache = :tache WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            // Bind parameters to statement
            $stmt->bindParam(":tache", $tache);
            $stmt->bindParam(":id", $_GET["id"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);
} else {
    // Check existence of id parameter
    if (empty(trim($_GET["id"]))) {
        // Redirect to error page
        header("location: error.php");
        exit();
    }

    // récupère la valeur existante
    try {
        // Prepare a select statement
        $sql = "SELECT tache FROM todolist WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        
        $stmt->bindParam(":id", $_GET["id"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                // Fetch the row data
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Retrieve the tache value
                $tache = $row["tache"];
            } else {
                // Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css" />
    <title>Update Record</title>
</head>

<body>
    <h1 class="updateTitle center-form">Update Record</h1>
    <div class="center-form">
    <form class="text-center" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $_GET["id"]; ?>" method="post">
        <div class="">
            <label for="tache" class="form-label">Tache</label>
            <input type="text" name="tache" id="tache" class="rounded-input" value="<?php echo $tache; ?>">
            <span class="invalid-feedback"><?php echo $tache_err; ?></span>
        </div>
        <div>
            <button type="submit" class="btn btn-lg btn-success">Update</button>
            <a href="index.php" class="btn btn-lg btn-secondary">Cancel</a>
        </div>
    </form>
    </div>
</body>

</html>