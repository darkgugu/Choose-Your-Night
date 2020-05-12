<?php
    session_start();
    $_SESSION['pseudo'] = [];
    $_SESSION['id'] = [];
?>

<html>
    <head>
        <title>CYN Connection</title>
        <style>
            body{
                color:black;
                background-color:white;
                background-image:url("../Images/background2.png");
                background-repeat: round;
            }
            .center{
                text-align: center;
                margin-top: 50vh;
                transform: translateY(-50%);
            }
            input{
                border: 1px solid grey;
                border-radius: 10px;
                padding: 12px 20px;
                margin: 8px 0;
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

            <div class="center">
                <form action="" method="get">

                    <input type="text" name="pseudo" placeholder="   Identifiant"><br>
                    <input type="password" name="mdp" placeholder="   Mot de passe"><br>
                    <input type="submit" name="con" value="Se connecter"><br>
                    <input type="submit" name="cre" value="Creer un compte">
                </form>
            </div>
        </body>
</html>