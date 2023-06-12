<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <title>To Fait Quoi Today</title>

    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
</head>

<!-- body aura un fond bleu dégradé vers le blanc en diagonale vers le bas gauche -->

<body>
    <!-- main sera blanc et contiendra les éléments d'ajouts dans le top. 
    la section corps contiendra les tâches ainsi que le bouton poubelle et la case valide
    la section bottom contiendra le nombre de tâches restantes à valider + un bouton pour supprimer toutes les tâches -->
    <main>
        <div class="top">
            <h1>To Fait Quoi Today?</h1>


        </div>
        <div class="containerDePasseAction-effaceTout">
            <!--grand container dans le main qui permet d'agencer tout le bloc de la div passe à l'action au bouton efface tout-->
            <div class="ajoutTache">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Passe à l'action</label>
                        <input type="text" name="tache" class="form-control <?php echo (!empty($tache_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $tache; ?>">
                        <input type="submit" name="submit" class="go" value="Go" />

                        <span class="invalid-feedback"><?php echo $tache_err; ?></span>
                    </div>
                    <!--permet d'écrire ce que l'on veut mettre dans la TodoList (non fonctionnel au 27/10/2022)-->

                    <div class="wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">




                </form>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="alert alert-danger">

                    <input type="submit" name="delete" class="delete" value="effaceTout!" />
                </div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

</html>