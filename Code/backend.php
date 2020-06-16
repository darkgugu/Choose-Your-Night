<?php
    session_start();
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="domtab.css">
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <script type="text/javascript" src="domtab.js"></script>
        <style>
            input{
                border: 0;
                border-radius: 0;
                padding: 0;
                margin: 0;
                opacity: 1;
            }
        </style>
    </head>
        <body onload="notifs('assos'), notifs('ecoles'), notifs('soirees'), notifs('users')">
            <?php

                $bdd = new PDO('mysql:host=localhost;dbname=cyn;charset=utf8', 'root', '');

                if(isset($_GET['ID_asso'])){

                    if($_GET['Ans'] == "✅"){
                        $req = $bdd->query('UPDATE associations SET `statut` = "approved" WHERE `ID` = "'.$_GET['ID_asso'].'"');
                        $req = $bdd->query('UPDATE utilisateurs SET `raison` = "partner" WHERE `partnership` = "'.$_GET['ID_asso'].'"');
                    }
                    else if($_GET['Ans'] == "❌"){$req = $bdd->query('UPDATE associations SET `statut` = "denied" WHERE `ID` = "'.$_GET['ID_asso'].'"');}
                    else if($_GET['Ans'] == "✘"){$req = $bdd->query('UPDATE associations SET `statut` = "deleted" WHERE `ID` = "'.$_GET['ID_asso'].'"');}
                }
                if(isset($_GET['ID_ecoles'])){

                    if($_GET['Ans'] == "✅"){$req = $bdd->query('UPDATE ecoles SET `statut` = "approved" WHERE `ID` = "'.$_GET['ID_ecoles'].'"');}
                    else if($_GET['Ans'] == "❌"){$req = $bdd->query('UPDATE ecoles SET `statut` = "denied" WHERE `ID` = "'.$_GET['ID_ecoles'].'"');}
                    else if($_GET['Ans'] == "✘"){$req = $bdd->query('UPDATE ecoles SET `statut` = "deleted" WHERE `ID` = "'.$_GET['ID_ecoles'].'"');}
                }
                if(isset($_GET['ID_soirees'])){

                    if($_GET['Ans'] == "✅"){$req = $bdd->query('UPDATE soirees SET `statut` = "approved" WHERE `ID` = "'.$_GET['ID_soirees'].'"');}
                    else if($_GET['Ans'] == "❌"){$req = $bdd->query('UPDATE soirees SET `statut` = "denied" WHERE `ID` = "'.$_GET['ID_soirees'].'"');}
                    else if($_GET['Ans'] == "✘"){$req = $bdd->query('UPDATE soirees SET `statut` = "deleted" WHERE `ID` = "'.$_GET['ID_soirees'].'"');}
                }

                $req = $bdd->query('SELECT * FROM associations');
                $donnees = $req->fetchAll();
                $assos = $donnees;

                $req = $bdd->query('SELECT * FROM ecoles');
                $donnees = $req->fetchAll();
                $ecoles = $donnees;

                $req = $bdd->query('SELECT * FROM soirees');
                $donnees = $req->fetchAll();
                $soirees = $donnees;

                $req = $bdd->query('SELECT * FROM utilisateurs');
                $donnees = $req->fetchAll();
                $users = $donnees;
            ?>

            <div class="domtab">
                <ul class="domtabs">
                    <li><a href="#t1">Associations <span id="assos" style="color: red; font-weight: bold;"></span></a></li>
                    <li><a href="#t2">Ecoles <span id="ecoles" style="color: red; font-weight: bold;"></span></a></li>
                    <li><a href="#t3">Soirées <span id="soirees" style="color: red; font-weight: bold;"></span></a></li>
                    <li><a href="#t4">Utilisateurs <span id="users" style="color: red; font-weight: bold;"></span></a></li>
                </ul>

                <div>
                    <h2><a name="t1" id="t1"></a></h2>
                    <?php //var_dump($assos);?>
                    <table>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Note</th>
                            <th scope="col">Lien</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Actions</th>
                        </tr>
                        <?php for($count = 0;$count != count($assos);$count++){
                            if($assos[$count]['statut'] == "pending"){?>
                                <tr style="background-color: #F9DC5C;">
                            <?php }else if($assos[$count]['statut'] == "denied"){?>
                                <tr style="background-color: #DA2C38;">
                            <?php }else if($assos[$count]['statut'] == "deleted"){?>
                                <tr style="background-color: grey;">
                            <?php }else{?>
                                <tr style="background-color: green;">
                            <?php }?>
                                    <th><?php echo $assos[$count]['Nom'];?></th>
                                    <td><?php echo $assos[$count]['Adresse'];?></td>
                                    <td><?php echo $assos[$count]['Note'];?></td>
                                    <td><a style="color: #00B4D4; font-size: 100%; padding: 0;" href="<?php echo $assos[$count]['Lien'];?>"><?php echo $assos[$count]['Lien'];?></a></td>
                                    <td><?php echo $assos[$count]['statut'];?></td>
                                    <td>
                                        <?php if($assos[$count]['statut'] == "pending"){ ?>
                                            <form action="" method="get">
                                                <input type="text" name="ID_asso" value="<?php echo $assos[$count]['ID']?>" hidden>
                                                <input type="submit" name="Ans" value="&#9989;"> / 
                                                <input type="submit" name="Ans" value="&#10060;">
                                            </form>
                                        <?php }else if($assos[$count]['statut'] == "approved"){?>
                                            <form action="" method="get">
                                                <input type="text" name="ID_asso" value="<?php echo $assos[$count]['ID']?>" hidden>
                                                <input style="background-color: #3FE533;" type="submit" name="Ans" value="&#10008;">
                                            </form>
                                        <?php }?>
                                    </td>
                                </tr>
                        <?php }?>
                    </table>
                </div>

                <div>
                    <h2><a name="t2" id="t2"></a></h2>
                    <?php //var_dump($ecoles);?>
                    <table>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Numero</th>
                            <th scope="col">Responsable</th>
                            <th scope="col">Types d'études</th>
                            <th scope="col">Lien</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Actions</th>
                        </tr>
                        <?php for($count = 0;$count != count($ecoles);$count++){
                            if($ecoles[$count]['statut'] == "pending"){?>
                                <tr style="background-color: #F9DC5C;">
                            <?php }else if($ecoles[$count]['statut'] == "denied"){?>
                                <tr style="background-color: #DA2C38;">
                            <?php }else if($ecoles[$count]['statut'] == "deleted"){?>
                                <tr style="background-color: grey">
                            <?php }else{?>
                                <tr style="background-color: green">
                            <?php }?>
                                    <th><?php echo $ecoles[$count]['Nom'];?></th>
                                    <td><?php echo $ecoles[$count]['Adresse'];?></td>
                                    <td><?php echo $ecoles[$count]['Numero'];?></td>
                                    <td><?php echo $ecoles[$count]['Responsable'];?></td>
                                    <td><?php echo $ecoles[$count]['Etudes'];?></td>
                                    <td><a style="color: #00B4D4; font-size: 100%; padding: 0;" href="<?php echo $ecoles[$count]['Lien'];?>"><?php echo $ecoles[$count]['Lien'];?></a></td>
                                    <td><?php echo $ecoles[$count]['statut'];?></td>
                                    <td>
                                        <?php if($ecoles[$count]['statut'] == "pending"){ ?>
                                            <form action="" method="get">
                                                <input type="text" name="ID_ecoles" value="<?php echo $ecoles[$count]['ID']?>" hidden>
                                                <input type="submit" name="Ans" value="&#9989;"> / 
                                                <input type="submit" name="Ans" value="&#10060;">
                                            </form>
                                        <?php }else if($ecoles[$count]['statut'] == "approved"){?>
                                            <form action="" method="get">
                                                <input type="text" name="ID_ecoles" value="<?php echo $ecoles[$count]['ID']?>" hidden>
                                                <input style="background-color: #3FE533;" type="submit" name="Ans" value="&#10008;">
                                            </form>
                                        <?php }?>
                                    </td>
                                </tr>
                        <?php }?>
                    </table>
                </div>
                
                <div>
                    <h2><a name="t3" id="t3"></a></h2>
                    <?php //var_dump($soirees);?>
                    <table>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Lieu</th>
                            <th scope="col">Date</th>
                            <th scope="col">Heure de début</th>
                            <th scope="col">Heure de fin</th>
                            <th scope="col">Thème</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Affiche</th>
                            <th scope="col">Places Restantes/Places</th>
                            <th scope="col">Billeterie</th>
                            <th scope="col">Type du Lieu</th>
                            <th scope="col">Nom du DJ</th>
                            <th scope="col">Etat</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Actions</th>
                        </tr>
                        <?php for($count = 0;$count != count($soirees);$count++){
                            if($soirees[$count]['statut'] == "pending"){?>
                                <tr style="background-color: #F9DC5C;">
                            <?php }else if($soirees[$count]['statut'] == "denied"){?>
                                <tr style="background-color: #DA2C38;">
                            <?php }else if($soirees[$count]['statut'] == "deleted"){?>
                                <tr style="background-color: grey;">
                            <?php }else{?>
                                <tr style="background-color: green">
                            <?php }?>
                                    <th><?php echo $soirees[$count]['Nom'];?></th>
                                    <td><?php echo $soirees[$count]['Adresse'];?></td>
                                    <td><?php echo $soirees[$count]['Lieu_nom'];?></td>
                                    <td><?php echo $soirees[$count]['Date'];?></td>
                                    <td><?php echo $soirees[$count]['Heure_début'];?></td>
                                    <td><?php echo $soirees[$count]['Heure_fin'];?></td>
                                    <td><?php echo $soirees[$count]['Theme'];?></td>
                                    <td><?php echo $soirees[$count]['Prix'];?></td>
                                    <td><a style="color: #00B4D4; font-size: 100%; padding: 0;" href="<?php echo $soirees[$count]['Affiche'];?>">Lien Affiche</a></td>
                                    <td><?php echo $soirees[$count]['Places_restantes'];?>/<?php echo $soirees[$count]['Places'];?></td>
                                    <td><a style="color: #00B4D4; font-size: 100%; padding: 0;" href="<?php echo $soirees[$count]['Billeterie'];?>"><?php echo $soirees[$count]['Billeterie'];?></a></td>
                                    <td><?php echo $soirees[$count]['Lieu_type'];?></td>
                                    <td><a style="color: #00B4D4; font-size: 100%; padding: 0;" href="<?php echo $soirees[$count]['DJ_lien'];?>"><?php echo $soirees[$count]['DJ'];?></a></td>
                                    <td><?php echo $soirees[$count]['Etat'];?></td>
                                    <td><?php echo $soirees[$count]['statut'];?></td>
                                    <td>
                                        <?php if($soirees[$count]['statut'] == "pending"){ ?>
                                            <form action="" method="get">
                                                <input type="text" name="ID_soirees" value="<?php echo $soirees[$count]['ID']?>" hidden>
                                                <input type="submit" name="Ans" value="&#9989;"> / 
                                                <input type="submit" name="Ans" value="&#10060;">
                                            </form>
                                        <?php }else if($soirees[$count]['statut'] == "approved"){?>
                                            <form action="" method="get">
                                                <input type="text" name="ID_soirees" value="<?php echo $soirees[$count]['ID']?>" hidden>
                                                <input style="background-color: #3FE533;" type="submit" name="Ans" value="&#10008;">
                                            </form>
                                        <?php }?>
                                    </td>
                                </tr>
                        <?php }?>
                    </table>
                </div>

                <div>
                    <h2><a name="t4" id="t4"></a></h2>
                    <?php //var_dump($users);?>
                    <table>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Mail</th>
                            <th scope="col">Membre depuis</th>
                            <th scope="col">Raison</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Latitude / Longitude</th>
                            <th scope="col">Pref Code</th>
                            <th scope="col">Partnership status</th>
                            <th scope="col">Actions</th>
                        </tr>
                        <?php for($count = 0;$count != count($users);$count++){
                            if($users[$count]['partnership'] == "pending"){?>
                                <tr style="background-color: #F9DC5C;">
                            <?php }else{?>
                                <tr>
                            <?php }?>
                                    <th><?php echo $users[$count]['username'];?></th>
                                    <td><?php echo $users[$count]['email'];?></td>
                                    <td><?php echo $users[$count]['create_time'];?></td>
                                    <td><?php echo $users[$count]['raison'];?></td>
                                    <td><?php echo $users[$count]['nom'];?></td>
                                    <td><?php echo $users[$count]['adresse'];?></td>
                                    <td><?php echo $users[$count]['latitude'];?> / <?php echo $users[$count]['longitude'];?></td>
                                    <td><?php echo $users[$count]['pref'];?></td>
                                    <td><?php echo $users[$count]['partnership'];?></td>
                                </tr>
                        <?php }?>
                    </table>
                </div>    
            </div>

            <script>
                function notifs(id){

                    var span_id = document.getElementById(id);
                    var pending = 0;

                    if(id == 'assos'){var array = <?php echo json_encode($assos)?>;}
                    if(id == 'ecoles'){var array = <?php echo json_encode($ecoles)?>;}
                    if(id == 'soirees'){var array = <?php echo json_encode($soirees)?>;}
                    if(id == 'users'){var array = <?php echo json_encode($users)?>;}
                    
                    for(count = 0;count != array.length;count++){

                        if(array[count]["statut"] == "pending"){

                            pending++;
                        }
                    }
                    if(pending != 0){span_id.textContent = pending;}
                }
            </script>

            <?php include 'sidebar.php';?>
        </body>
</html>