<?php
    session_start();
?>
<html>
    <head>
        <title>Mon compte</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
        <body id="main">

            <div id="compte">
                <h1>Mon compte</h1>
                <h2>Mes informations personelles</h2>
                <?php
                
                    $bdd = new PDO('mysql:host=localhost;dbname=cyn;charset=utf8', 'root', '');

                    $req = $bdd->query('SELECT * FROM utilisateurs WHERE id = "'.$_SESSION['id'].'"');
                    $donnees = $req->fetch();

                    $pref = [

                        0 => "",
                        1 => "",
                        2 => "",
                        3 => "",
                    ];

                    $code = $donnees['pref'];
                    $rang = 10000000;

                    for($count = 0;$count != count($pref);$count++){

                        $pref[$count] = floor($code / $rang);
                        $code -= $rang * $pref[$count];
                        $rang /= 10;
                    }

                    if($pref[0] == 1){$pref[0] = "Homme";}
                    else if($pref[0] == 2){$pref[0] = "Femme";}
                    else{$pref[0] = "Question ignorée";}

                    if($pref[1] == 1){$pref[1] = "Hommes";}
                    else if($pref[1] == 2){$pref[1] = "Femmes";}
                    else if($pref[1] == 3){$pref[1] = "Hommes & Femmes";}
                    else{$pref[1] = "Question ignorée";}

                    if($pref[2] == 1){$pref[2] = "Chill";}
                    else if($pref[2] == 2){$pref[2] = "Grosse Soirée";}
                    else if($pref[2] == 3){$pref[2] = "Chill et Grosses soirées";}
                    else{$pref[2] = "Question ignorée";}

                    if($pref[3] == 1){$pref[3] = "Bar";}
                    else if($pref[3] == 2){$pref[3] = "Salle/Boite";}
                    else if($pref[3] == 3){$pref[3] = "Bar et Boites";}
                    else{$pref[3] = "Question ignorée";}

                    //$pref['gender'] = floor($donnees['pref'] / 10000000);
                    //var_dump($donnees);
                ?>

                Nom : <?php echo $donnees['nom'];?><br>
                Username : <?php echo $donnees['username'];?><br>
                Mail : <?php echo $donnees['email'];?><br>
                Adresse Physique : <?php echo $donnees['adresse'];?><br>
                Membre depuis : <?php echo $donnees['create_time'];?><br>

                <h2>Mes préférences</h2>

                Genre : <?php echo $pref[0];?><br>
                Attirance : <?php echo $pref[1];?><br>
                Ambiance préférée : <?php echo $pref[2];?><br>
                Lieu préféré : <?php echo $pref[3];?><br>

                <?php include 'sidebar.php';?>

        </body>
</html>