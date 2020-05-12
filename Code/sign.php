<?php
    session_start();
    $_SESSION['pseudo'] = [];
    $_SESSION['id'] = [];
?>

<html>
    <head>
        <title>CYN Connection</title>
        <style>
            body {
                color:black;
                background-color:white;
                background-image:url("background.png");
            }
        </style>
    </head>
        <body>
        

            <?php
            
                $bdd = new PDO('mysql:host=localhost;dbname=AddBook;charset=utf8', 'root', '');

                if(isset($_GET['pseudo']) && isset($_GET['mdp']) && isset($_GET['con'])){

                    $infos[0] = $_GET['pseudo'];
                    $infos[1] = $_GET['mdp'];
                    $req = $bdd->query('SELECT * FROM Users WHERE Pseudo = "'.$infos[0].'" AND Password = "'.$infos[1].'"');
                    $donnees = $req->fetch();

                    if($donnees == false){

                        echo "Mot de passe ou Identifiant invalide";
                    }
                    else{

                        $_SESSION['pseudo'] = $donnees[1];
                        header('Location: acceuil.php');
                        exit();
                    }
                }    
            ?>

            <form action="" method="get">

                Identifiant : <input type="text" name="pseudo"><br>
                Password : <input type="password" name="mdp"><br>
                <input type="submit" name="con" value="Se connecter">
            </form>
        </body>
</html>