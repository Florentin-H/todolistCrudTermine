<?php

require_once "../php/config.php";


$tache = "";
$tache_err = "";

// vérifie les données du form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_tache = trim($_POST["tache"]);
    if (empty($input_tache)) {
        $tache_err = "Please enter a tache.";
    } else {
        $tache = $input_tache;
    }

    //vérifie les données avant insertion
    if (empty($tache_err)) {
        try {
            // prepare l'insertion 
            $sql = "INSERT INTO todolist (tache) VALUES (:tache)";
            $stmt = $pdo->prepare($sql);

            // 
            $stmt->bindParam(":tache", $tache);

            
            if ($stmt->execute()) {
                //l'enregistrement dans la bb a été un succès
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style/style.css" />
    <title>To Fait Quoi Today</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
</head>

<body>
    <main>
        <div class="top">
            <h1>To Fait Quoi Today?</h1>
        </div>
        <div class="containerDePasseAction-effaceTout mx-4">
            <div class="ajoutTache">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Passe à l'action</label>
                        <input type="text" name="tache" class="form-control <?php echo (!empty($tache_err)) ? 'is-invalid' : ''; ?>" value="<?php echo isset($tache) ? $tache : ''; ?>">
                        <input type="submit" name="submit" class="go mt-2" value="Go" />
                        <span class="invalid-feedback"><?php echo $tache_err; ?></span>
                    </div>
                </form>
            </div>
        </div>
        <section class="corps">
            <?php
            try {
                $sql = "SELECT * FROM todolist";
                $stmt = $pdo->query($sql);
                $rows = $stmt->fetchAll();

                if (count($rows) > 0) {
                    echo '<div class="table-container ">';
                    echo '<table class="table table-bordered table-striped">';
                    echo '<thead>';
                    echo '<tr class="col-8">';
                    echo '<th class="w-75">Tache</th>';
                    echo '<th class="w-12.5">update</th>';
                    echo '<th class="w-12.5">delete</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($rows as $row) {
                        echo '<tr>';
                        echo '<td>' . $row["tache"] . '</td>';
                        echo '<td>';
                        echo '<a href="read.php?id=' . $row["id"] . '" class="mr-3" title="vue" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                        echo '<a href="update.php?id=' . $row["id"] . '" class="btn btn-primary" title="Modifier" data-toggle="tooltip">Modifier</a>';
                        echo '</td>';
                        echo '<td>';
                        echo '<button class="btn btn-danger " onclick="deleteRecord(' . $row['id'] . ')" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></button>';
                        echo '</td>';

                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo '<div class="alert mx-4 alert-success d-flex justify-content-center align-items-center"><em>Aucune tache en cours actuellement .</em></div>';
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            ?>
        </section>
        <div class="bottom">
            <p>Bouges toi t'as <span><?php echo count($rows); ?></span> tâches en attente!</p>
            <form id="deleteAllForm" action="delete-all.php" method="post">
                <div class="">
                    <input type="button" class="delete" onclick="confirmDeleteAll()" value="Efface Tout!" />
                </div>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

<script src="js/function.js"></script>

</html>