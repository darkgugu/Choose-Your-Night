<?php
    session_start();
    $_SESSION['nom'] = [];
    $_SESSION['id'] = [];
?>

<html>
    <head>
        <title>CYN Connection</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
        <body class="background">
        
            <?php
            
                $bdd = new PDO('mysql:host=localhost;dbname=cyn;charset=utf8', 'root', '');

                if(isset($_GET['pseudo']) && isset($_GET['mdp']) && isset($_GET['con'])){

                    $infos[0] = $_GET['pseudo'];
                    $infos[1] = $_GET['mdp'];
                    $req = $bdd->query('SELECT * FROM utilisateurs WHERE username = "'.$infos[0].'" AND password = "'.$infos[1].'"');
                    $donnees = $req->fetch();

                    if($donnees == false){

                        echo "Mot de passe ou Identifiant invalide";
                    }
                    else{
    
                        $_SESSION['nom'] = $donnees['nom'];
                        header('Location: acceuil.php');
                        exit();
                    }
                }    
            ?>

            <div class="center">

            <h1>Choose Your Night</h1>

                <form action="" method="get">

                    <input type="text" name="pseudo" placeholder="   Identifiant"><br>
                    <input type="password" name="mdp" placeholder="   Mot de passe"><br>
                    <input type="submit" name="con" value="Se connecter"><br>
                    <a href="account.php"><input type="button" name="cre" value="Creer un compte"></a>
                </form>
            </div>
        </body>
</html>