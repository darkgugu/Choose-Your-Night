<?php
    session_start();
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
        <body class="background">
            <?php

                if(!isset($_GET['page'])){

                    header('Location: acceuil.php');
                    exit();
                }
                else{

                    if($_GET['page'] == 'contact'){

                        ?>
                            <div class="center">
                                <h1>Contacter Choose Your Night</h1>
                                <p><img style="float:inline-start;" heigth="400" width="250" src="../Images/icham.jpg"></p>
                                Icham Duret, créateur de Choose Your Night, étudiant à Intech Paris<br>
                                et membre du BDE du Groupe ESIEA<br><br>

                                LinkedIn : <a href="https://www.linkedin.com/in/icham-duret-86437514b">Icham Duret</a><br>
                                GitHub du projet : <a href="https://github.com/darkgugu/Choose-Your-Night">darkgugu/Choose-Your-Night</a><br>
                                Contact : chooseyournight.s2@gmail.com<br>
                            </div>
                        <?php
                    }
                    else if($_GET['page'] == 'propos'){

                        ?>
                            <div class="center">
                            
                                <img heigth="10" width="250" src="../Images/groupe_logo.png">
                                <img style="padding: 20 20 0 20;" heigth="250" width="250" src="../Images/cyn_logo.png">
                                <img heigth="100" width="250" src="../Images/intech_logo.png">
                                <br><br>
                                Choose Your Night est un projet informatique de 2ème semestre à Intech Paris<br><br>
                                Son but est de proposer à ses utilisateurs des soirées étudiantes en région parisienne,<br>
                                et de leur donner toutes les informations nécessaires pour passer une bonne soirée.<br>
                                Les utilisateurs peuvent choisir quelles soirées ils verront en premier grâce à leurs préférences<br>
                            </div>


                        <?php


                    }
                    else{
                        ?>
                            <div class="center">
                                Erreur 404, déso pas déso cette page n'existe pas
                            </div>
                        <?php
                    }
                }



            ?>

            <?php include 'sidebar.php';?>
        </body>
</html>