<?php
    session_start();
    $_SESSION['pseudo'] = [];
    $_SESSION['id'] = [];
?>

<html>
    <head>
        <title>CYN Account</title>
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

        <form action="" method="get">

            <div style="display: block;" id="part1">

                <input type="text" name="pseudo" placeholder="   Identifiant"><br>
                <input type="password" name="mdp" placeholder="   Mot de passe"><br>
            </div>
            <div style="display: none;" id="part2">

                <input type="text" name="nom" placeholder="   Nom"><br>
                <input type="text" name="prénom" placeholder="   Prénom"><br>
            </div>
            <input id="butt" type="button" name="next" value="Suivant" onclick="suivant()">
        </form>


        <script> 
            var div = document.getElementById("part2");

            function suivant() {
                document.getElementById("part1").style.display = "none";
                div.style.display = "block";
            }
        </script>  
    </body>
</html>    