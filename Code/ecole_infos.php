<?php
    session_start();
?>

<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <style>
            .third{
                height: 100%;
                width: 33%;
                display: inline-block;
                padding: 0;
                text-align: center;
                border: 1px solid grey;
                border-radius: 10px;
                background:-webkit-linear-gradient(top, grey 0%, grey 10%, white 10%);
            }
        </style>
    </head>
        <body>
            <?php

                $bdd = new PDO('mysql:host=localhost;dbname=cyn;charset=utf8', 'root', '');
                $req = $bdd->query('SELECT * FROM ecoles WHERE ID = (SELECT ecoles_ID FROM ecoles_has_associations WHERE associations_ID = (SELECT partnership FROM utilisateurs WHERE ID = "'.$_SESSION['id'].'"))');
                $donnees = $req->fetch();
                $ecole = $donnees;
            ?>
            
            <div class="third">                        
                <h1>ECOLE</h1>
                <?php //var_dump($ecole)?>

                    Nom de l'école : <?php echo $ecole[1];?><br>
                    Adresse de l'école : <?php echo $ecole[2];?><br>
                    Lien du site de l'école : <a href="https://www.<?php echo $ecole[7];?>"><?php echo $ecole[7];?></a>
            </div>

            <?php include "sidebar.php";?>
        </body>
</html>