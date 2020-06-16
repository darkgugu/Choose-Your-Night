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
                width: 33.3%;
                display: inline-block;
                padding: 0;
                text-align: center;
            }
        </style>
    </head>
        <body>
            <?php
                
                //var_dump($_SESSION);
                $bdd = new PDO('mysql:host=localhost;dbname=cyn;charset=utf8', 'root', '');

                if(isset($_GET['nom_asso'])){

                    //var_dump($_GET);
                    $infos = $_GET;
                    $infos['complete_adress'] = $_GET['rue'].", ".$_GET['ville'];

                    $req = $bdd->query('INSERT INTO associations (Nom, Adresse, Lien, statut) VALUES ("'.$infos['nom_asso'].'","'.$infos['complete_adress'].'", "'.$infos['lien_asso'].'", "pending")');
                    $req = $bdd->query('SELECT COUNT(*) FROM associations');
                    $donnees = $req->fetch();
                    $partner_count = $donnees[0];
                    $req = $bdd->query('UPDATE utilisateurs SET `partnership` = "'.$partner_count.'" WHERE ID = "'.$_SESSION['id'].'"');
                    $req = $bdd->query('INSERT INTO ecoles (Nom, Adresse, Numero, Responsable, Etudes, Lien, statut) VALUES ("'.$infos['nom_ecole'].'","'.$infos['complete_adress'].'", "'.$infos['numero_ecole'].'", "'.$infos['respo'].'", "'.$infos['etudes'].'", "'.$infos['lien_ecole'].'", "pending")');

                    ?>
                        <div class="center">
                        
                            <h1>Votre demande à été prise en compte</h1>
                        </div>   
                    <?php
                }
                else{

                    if($_SESSION['perm'] == 'user'){

                        ?>
                            <div id="user" class="center">
                            
                                <h1>Vous n'êtes pas partenaire</h1>
                                <button onclick="display()">Devenir Partenaire</button>
                            </div>   
                        <?php
                    }  
                    if($_SESSION['perm'] != 'user'){
                        ?>
                            <div id="not_user" class="center">

                                <?php 
                                
                                    $req = $bdd->query('SELECT * FROM associations WHERE ID = (SELECT partnership FROM utilisateurs WHERE ID = "'.$_SESSION['id'].'")');
                                    $donnees = $req->fetch();
                                    $asso = $donnees;

                                    $req = $bdd->query('SELECT * FROM ecoles WHERE ID = (SELECT ecoles_ID FROM ecoles_has_associations WHERE associations_ID = (SELECT partnership FROM utilisateurs WHERE ID = "'.$_SESSION['id'].'"))');
                                    $donnees = $req->fetch();
                                    $ecole = $donnees;

                                    $req = $bdd->query('SELECT * FROM soirees WHERE ID = (SELECT soirees_ID FROM organisateurs WHERE ecoles_has_associations_ID = (SELECT ID FROM ecoles_has_associations WHERE associations_ID = (SELECT partnership FROM utilisateurs WHERE ID = "'.$_SESSION['id'].'")))');
                                    $donnees = $req->fetch();
                                    $soirees = $donnees;
                                ?>

                                <div class="third" style="float:left;">
                                    
                                    <h1>ASSO</h1>
                                    <?php var_dump($asso)?>
                                </div>

                                <div class="third">
                                    
                                    <h1>ECOLE</h1>
                                    <?php var_dump($ecole)?>
                                </div>

                                <div class="third" style="float:right;">

                                    <h1>SOIREES</h1>
                                    <?php var_dump($soirees)?>
                                </div>
                            </div>   
                        <?php
                    }
                }
            ?>

            <div id="partner" class="center" hidden>

                Vous voulez que votre association étudiante puisse profiter gratuitement de <br>
                la plateforme Choose Your Night pour la promotion de ses évènements ? <br>
                Pas de problèmes, remplissez ce formulaire, <br>
                vous recevrez un mail lorsque votre demande auras été résolue <br><br>

                <form id="partner_form" action="" method="get" hidden>

                    Nom de l'association et numéro de téléphone<br>
                    <input type="text" name="nom_asso" placeholder="Nom de association">
                    <input type="text" name="numero_asso" placeholder="Numéro de téléphone"><br>

                    Nom de l'école et numéro de téléphone<br>
                    <input type="text" name="nom_ecole" placeholder="Nom de l'école">
                    <input type="text" name="numero_ecole" placeholder="Numéro de téléphone"><br>

                    Adresse <br>
                    <input id="rue" type="text" name="rue" placeholder="Rue et Numéro de rue">
                    <input id="ville" type="text" name="ville" placeholder=" Ville"><br>

                    Nom du responsable et type d'école<br>
                    <input type="text" name="respo" placeholder="Nom de la personne responsable">
                    <input type="text" name="etudes" placeholder="Type d'école (Ecole d'ingénieur, de commerce, ect)"><br>

                    Liens des sites <br>
                    <input type="text" name="lien_asso" placeholder="Association">
                    <input type="text" name="lien_ecole" placeholder="Ecole"><br>
                    <input id="validate" type="submit" name="Valider" value="Valider">

                </form>
            </div>

            <script>
                function display(){

                    document.getElementById("partner_form").removeAttribute("hidden");
                    document.getElementById("partner").removeAttribute("hidden");
                    document.getElementById("user").setAttribute("hidden", "true");
                }
            </script>
            <?php include "sidebar.php";?>
        </body>
</html>