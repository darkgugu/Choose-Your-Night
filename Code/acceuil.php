<?php
    session_start();
?>

<html>
    <head>
        <title>CYN Connection</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
        <body onload="setSelected(<?php if(isset($_GET['order'])){echo $_GET['order'];}else{ echo 'default';}?>)">

        <form style="position: fixed; right: 0; top: -5;" action="" method="GET">            
            <select name="order">
                <option id="default" value="default">Options de tri</option>
                <option id="prix_asc" value="prix_asc">Prix (Décroissant)</option>
                <option id="prix_desc" value="prix_desc">Prix (Croissant)</option>
                <option id="date_near" value="date_near">Date (Au plus près)</option>
                <option id="date_far" value="date_far">Date (Au plus loin)</option>
                <option id="lieu_asc" value="lieu_asc">Bars</option>
                <option id="lieu_desc" value="lieu_desc">Salles</option>
            </select>
            <input type="submit" value="Trier">
        </form>

        <div id="main" class="center_tile">

            <?php
            
                $bdd = new PDO('mysql:host=localhost;dbname=CYN;charset=utf8', 'root', '');

                $req = $bdd->query('SELECT COUNT(ID) as total from soirees WHERE statut = "approved" AND Etat IN ("coming", "notation")');
                $donnees = $req->fetch();
                $nb_soirees = $donnees['total'];

                $req = $bdd->query('SELECT * FROM soirees');
                $donnees = $req->fetchAll();
                $soirees = $donnees;

                for($count = 0;$count != count($soirees);$count++){

                    $dates[$count] = "20".$soirees[$count]['Date'][2].$soirees[$count]['Date'][3]."/".$soirees[$count]['Date'][5].$soirees[$count]['Date'][6]."/".$soirees[$count]['Date'][8].$soirees[$count]['Date'][9]." ".$soirees[$count]['Heure_début'][0].$soirees[$count]['Heure_début'][1].":00:00";
                }
                for($count = 0;$count != count($soirees);$count++){

                    if(strtotime($dates[$count]) +172800 < (strtotime("now") + 7200)){

                        $id_date = $count + 1;
                        $req = $bdd->query('UPDATE soirees SET `Etat` = "over" WHERE `ID` = "'.$id_date.'"');
                    }
                    if(strtotime($dates[$count]) < (strtotime("now") + 7200) && strtotime($dates[$count]) + 172800 > (strtotime("now") + 7200)){

                        $id_date = $count + 1;
                        $req = $bdd->query('UPDATE soirees SET `Etat` = "notation" WHERE `ID` = "'.$id_date.'"');
                    }
                }

                if(isset($_POST['note'])){

                    $req = $bdd->query('INSERT INTO noted (utilisateurs_ID, soirees_ID, note) VALUES ("'.$_SESSION['id'].'","'.$_POST['id'].'", "'.$_POST['note'].'")');
                    header('Location: acceuil.php');
                    exit();
                    
                }

                if(isset($_GET['order'])){

                    switch($_GET['order']){
                        case 'prix_asc':

                            $req = $bdd->query('SELECT * from soirees WHERE statut = "approved" AND Etat IN ("coming", "notation") ORDER BY Prix DESC');
                        break;
                        case 'prix_desc':

                            $req = $bdd->query('SELECT * from soirees WHERE statut = "approved" AND Etat IN ("coming", "notation") ORDER BY Prix ASC');
                        break;
                        case 'date_near':

                            $req = $bdd->query('SELECT * from soirees WHERE statut = "approved" AND Etat IN ("coming", "notation") ORDER BY Date ASC');
                        break;
                        case 'date_far':

                            $req = $bdd->query('SELECT * from soirees WHERE statut = "approved" AND Etat IN ("coming", "notation") ORDER BY Date DESC');
                        break;
                        case 'lieu_asc':

                            $req = $bdd->query('SELECT * from soirees WHERE statut = "approved" AND Etat IN ("coming", "notation") ORDER BY Lieu_type DESC');
                        break;
                        case 'lieu_desc':

                            $req = $bdd->query('SELECT * from soirees WHERE statut = "approved" AND Etat IN ("coming", "notation") ORDER BY Lieu_type ASC');
                        break;
                        default:

                            $req = $bdd->query('SELECT * from soirees WHERE statut = "approved" AND Etat IN ("coming", "notation")');
                        break;
                    }
                }
                if(!isset($_GET['order'])){

                    $req = $bdd->query('SELECT * from soirees WHERE statut = "approved" AND Etat IN ("coming", "notation")');
                }
                $donnees = $req->fetchAll();
                $soirees = $donnees;

                function str_date($date){

                    $string = "";

                    if($date[8] != '0'){$string .= $date[8];}
                    $string .= $date[9];

                    switch($date[6]){
                        case '0':

                            $string .= ' Octobre';
                        break;
                        case '1':

                            if($date[5] == 0){$string .= ' Janvier';}
                            else{$string .= ' Novembre';}
                        break;
                        case '2':

                            if($date[5] == 0){$string .= ' Février';}
                            else{$string .= ' Décembre';}
                        break;
                        case '3':

                            $string .= ' Mars';
                        break;
                        case '4':

                            $string .= ' Avril';
                        break;
                        case '5':

                            $string .= ' Mai';
                        break;
                        case '6':

                            $string .= ' Juin';
                        break;
                        case '7':

                            $string .= ' Juillet';
                        break;
                        case '8':

                            $string .= ' Aout';
                        break;
                        case '9':

                            $string .= ' Septembre';
                        break;     
                    }

                    if($date[2] != '2' || $date[3] != '0'){$string .= ' 20'.$date[2].$date[3];}

                    return $string;
                }

                for($count = 0;$count != $nb_soirees;$count++){
                    $count2 = 1;
                    $soiree_ID = $soirees[$count][0];

                    $req = $bdd->query('SELECT Nom FROM ecoles WHERE ID IN (SELECT ecoles_ID FROM ecoles_has_associations WHERE ID IN (SELECT ecoles_has_associations_ID FROM organisateurs WHERE soirees_ID = "'.$soiree_ID.'"))');
                    $donnees = $req->fetchAll();
                    $orga = $donnees;

                    $req = $bdd->query('SELECT COUNT(ID) FROM ecoles WHERE ID IN (SELECT ecoles_ID FROM ecoles_has_associations WHERE ID IN (SELECT ecoles_has_associations_ID FROM organisateurs WHERE soirees_ID = "'.$soiree_ID.'"))');
                    $donnees = $req->fetch();
                    $orga_count = $donnees[0];
            ?>

            <div style="display: inline-block;" class="tile"> 
                <form action="display_tile.php" method="get">
                    <input class="name_button" type="submit" name="soiree" value="<?php echo $soirees[$count][1];?>">
                </form>
                <?php echo $soirees[$count]["Lieu_nom"];?><br>
                <?php echo str_date($soirees[$count]["Date"]);?><br>
                <?php echo $soirees[$count]["Heure_début"];?> - <?php echo $soirees[$count]["Heure_fin"];?><br>
                Prix : <?php if($soirees[$count]["Prix"] == 0){echo "Entrée Gratuite";}else{echo $soirees[$count]["Prix"]."€";}?>
                / Nombre de places : <?php echo $soirees[$count]["Places"];?><br> Organisée par : <?php for($i = 0;$i != $orga_count;$i++){echo $orga[$i][0]; if($i != $orga_count-1){echo ", ";}}?>
                <?php
                    if($soirees[$count]['Etat'] == "notation"){
                        
                        $req = $bdd->query('SELECT * FROM noted WHERE utilisateurs_ID = "'.$_SESSION['id'].'" AND soirees_ID = "'.$soirees[$count]['ID'].'"');
                        $donnees = $req->fetch();
                        if($donnees == NULL){

                            ?><p style="color: red;">Notez les organisateurs !</p><?php
                        }
                        else{

                            ?><p style="color: green;">Merci d'avoir pris le temps de noter !</p><?php
                        }
                    }
                    else{
                        ?><p style="color: white;">Si je met pas ça, c'est tout décalé</p><?php
                    }
                ?>
            </div>
                
            <?php }?>

            <?php include 'sidebar.php';?>

            <script>

                function setSelected(element) {

                    console.log(element);
                    document.getElementById(element['id']).setAttribute("selected", "true");
                }
            </script>

        </body>
</html>