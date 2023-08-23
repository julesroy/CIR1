<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>TP1 : web dynamique</title>
        <meta charset="utf-8" />
        <style>
            h1{text-align:center;}
            h2{color:red;}
            h3{color:green;}
            h4{color:blue;}
            h5{color:pink;}
        </style>
    </head>
    <body>
        <h1>TP1 : web dynamique</h1>
        <h2>Variables et constantes</h2>
        <h3>Exercice 1</h3>
        <h4>Enoncé</h4>
        <p>
        Donner la valeur des variables après chaque affectation, et corriger les "Warning". 
        Vous pouvez utiliser la fonction var_dump() qui donne plusieurs information sur une variable (type, taille ,valeur)
        </p>
        <h4>Solution</h4>
        <?php
            echo "<h5>Script 1</h5>";// affichage d'un code HTML
            $x="7 personnes"; 
            var_dump($x); //Utilisation de la fonction var_dump() qui donne : string(11) "7 personnes" : une chaine de 11 caracères
            echo "<br>"; // affichage d'un retour à la ligne
            $y=(integer)$x; //Conversion en entier
            $x="9E3";
            $z=(double)$x;
        
            echo "<h5>Script 2</h5>";
            $a="Les ";
            var_dump($a);
            echo "<br>"; // affichage d'un retour à la ligne
            $b="10 merveilles du monde";
            var_dump($b);
            echo "<br>"; // affichage d'un retour à la ligne
            $c=$a.$b;
            var_dump($c);
            echo "<br>"; // affichage d'un retour à la ligne
            $d=(integer)$b+13;
            var_dump($d);
            echo "<br>"; // affichage d'un retour à la ligne
            $b=&$c;
            var_dump($b);
            echo "<br>"; // affichage d'un retour à la ligne
            $b[1]=4;
            var_dump($b);
            echo "<br>"; // affichage d'un retour à la ligne

            echo "<h5>Script 3</h5>";
            $a="5+6";
            var_dump($a);
            echo "<br>"; // affichage d'un retour à la ligne
            $b="2E2";
            var_dump($b);
            echo "<br>"; // affichage d'un retour à la ligne
            $c=(integer)$a+(integer)$b;
            var_dump($c);
            echo "<br>"; // affichage d'un retour à la ligne
        
            echo "<h5>Script 4</h5>";
            $a="1";
            var_dump($a);
            echo "<br>"; // affichage d'un retour à la ligne
            $b="FALSE";
            var_dump($b);
            echo "<br>"; // affichage d'un retour à la ligne
            $c=FALSE;
            var_dump($c);
            echo "<br>"; // affichage d'un retour à la ligne
            $d=($a OR $b);
            var_dump($d);
            echo "<br>"; // affichage d'un retour à la ligne
            $e=($a AND $c);
            var_dump($e);
            echo "<br>"; // affichage d'un retour à la ligne
            $f=($a XOR $b);
            var_dump($f);
            echo "<br>"; // affichage d'un retour à la ligne

            echo "<h5>Script 5</h5>";
            $x="3 fois";
            var_dump($x);
            echo "<br>"; // affichage d'un retour à la ligne
            $x = (integer)$x*5.2;
            var_dump($x);
            echo "<br>"; // affichage d'un retour à la ligne
            $z=$x%5;
            var_dump($z);
            echo "<br>"; // affichage d'un retour à la ligne
            $x= "0" || 1;
            var_dump($x);
            echo "<br>"; // affichage d'un retour à la ligne
            $y=is_string($x);
            var_dump($y);
            echo "<br>"; // affichage d'un retour à la ligne
        ?>

        <h3>Exercice 2</h3>
        <h4>Enoncé</h4>
        <p>
        En utilisant les variables et les constantes prédéfinies du php, modifier les valeurs des variables afin d'afficher la version du php, 
        le système d'exploitation du serveur, le fichier courant, le host et la langue du navigateur client.<br>
        <a href="https://www.php.net/manual/fr/reserved.variables.php " target="_blank">Variables prédéfinies</a><br>
        <a href="https://www.php.net/manual/fr/reserved.constants.php  " target="_blank">Constantes prédéfinies</a>
        </p>
        <h4>Solution</h4>
        <?php
			$version=PHP_VERSION;
			$SE=PHP_OS;
			$FC=__FILE__;
			$Host=gethostname();
			$langue=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
			
            echo "La version du php est : $version <br>";
            echo "Le système d'exploitation: $SE <br>";
            echo "Le fichier courant:$FC <br>";
            echo "Le nom du host est : $Host<br>";
            echo "La langue du navigateur client:$langue<br>";
        ?>

        <h2>Structures conditionnelles et itératives</h2>
        <h3>Exercice 3</h3>
        <h4>Enoncé</h4>
        <p>Ecrire un script pour tester si un nombre est à la fois un multiple de 3 et de 5.</p>
        <h4>Solution</h4>
        <!-- Votre solution ici -->
        <?php
        function multiple_3_5($nombre){
            if(($nombre % 5 == 0) && ($nombre % 3 == 0)){ //si le nombre rempli les deux conditions
                echo "$nombre est multiple de 3 et de 5"; echo "<br>"; //on affiche le resultat
            }
            else{
                echo "$nombre n'est pas multiple de 3 et de 5"; echo "<br>"; //on affiche le resultat (faux)
            }
        }
        multiple_3_5(15);
        multiple_3_5(16);
        ?>
        <h3>Exercice 4</h3>
        <h4>Enoncé</h4>
        <p>En utilisant les variables $nombre1 $nombre2 et $operation, écrire un script effectuant une opération parmi les quatre 
            opérations arithmétiques élémentaires suivant la valeur de la variable $opération (utiliser l'instruction switch).</p>
        <h4>Solution</h4>
        <!-- Votre solution ici -->
        <?php
        function operations($nombre1, $nombre2, $operation){
            switch($operation){
                case "+": //si c'est une addition
                    $nombre3 = $nombre1 + $nombre2; 
                    echo "$nombre1 + $nombre2 = $nombre3"; echo "<br>";
                    break;
                case "-": //si c'est une soustraction
                    $nombre3 = $nombre1 - $nombre2;
                    echo "$nombre1 - $nombre2 = $nombre3"; echo "<br>";
                    break;
                case "*": //si c'est une multiplication
                    $nombre3 = $nombre1 * $nombre2;
                    echo "$nombre1 * $nombre2 = $nombre3"; echo "<br>";
                    break;
                case "/": //si c'est une division
                    $nombre3 = $nombre1 / $nombre2;
                    echo "$nombre1 / $nombre2 = $nombre3"; echo "<br>";
                    break;
                default: //sinon
                    echo "Opérateur non reconnu"; echo "<br>";
            }
        }
        //appels de la fonction
        operations(15, 3, "+");
        operations(15, 3, "-");
        operations(15, 3, "*");
        operations(15, 3, "/");
        ?>
        <h3>Exercice 5</h3>
        <h4>Enoncé</h4>
        <p>Ecrire un script affichant les nombres de 1 à 100, et mettant les nombres pairs en rouge et le fond des multiples de 5 en vert.</p>
        <h4>Solution</h4>
        <!-- Votre solution ici -->
        <?php
        for($i = 1; $i < 101; $i++){ //de 1 à 100
            if($i % 5 == 0){ //si le nombre est multiple de 5
                echo "<span style='color:green'>$i </span>";
            }
            else if($i % 2 == 0){ //si le nombre est pair
                echo "<span style='color:red'>$i </span>";
            }
            else{
                echo "<span>$i </span>";
            }
        }
        ?>
        <h3>Exercice 6</h3>
        <h4>Enoncé</h4>
        <p>Ecrire un script faisant une suite de tirages de nombres aléatoires jusqu’à obtenir une suite composée d’un nombre pair 
            suivi de deux nombres impairs. Afficher le nombre d'itérations réalisées.<br>
			Utiliser la fonction rand(min,max) pour générer un nombre aléatoire.</p>
        <h4>Solution</h4>
        <!-- Votre solution ici -->
        <?php
        //premiere valeur pour chaque variable
        $chiffre1 = rand(0, 100);
        $chiffre2 = rand(0, 100);
        $chiffre3 = rand(0, 100);
        $nb_iterations = 0; //variable qui stockera le nombre d'itérations nécessaires
        $result = false; //variable booléenne qui permettra d'arreter la boucle while lorsque l'on aura le résultat souhaité
        while($result == false){
            if($chiffre1 % 2 == 0 && $chiffre2 % 2 != 0 && $chiffre3 % 2 != 0){ //on analyse les nombres obtenus aléatoirement
                echo "<span>$chiffre1, $chiffre2, $chiffre3, en $nb_iterations itérations</span>"; //si le resultat est le bon, on affiche les informations
                $result = true; //on stoppe la boucle while
            }
            else{
                //sinon, on génère des nouveaux nombres aléatoires
                $chiffre1 = rand(0, 100);
                $chiffre2 = rand(0, 100);
                $chiffre3 = rand(0, 100);
                $nb_iterations++; //et on incrémente le nombre d'itérations
            }
        }
        ?>
        <h3>Exercice 7</h3>
        <h4>Enoncé</h4>
        <p>Écrire le code PHP/HTML/CSS permettant de réaliser le tableau montré sur le fichier pdf (il s'agit de la table de multiplication des nombres de 1 à 10) .</p>
        <table>
            <caption>Exemple de tableau</caption>
            <tr>
                <td> élément 1.1</td>
                <td> élément 1.2</td>
            </tr>
            <tr>
                <td> élément 2.1</td>
                <td> élément 2.2</td>
            </tr>
        </table>

        <h4>Solution</h4>
        <!-- Votre solution ici -->
        <table style="border: solid red;">
            <caption style="color: red;">Table de Pythagore</caption>
            <?php
            for($i = 1; $i < 11; $i++){ //de 1 à 10
                echo "<tr>"; //création de la ligne
                for($j = 1; $j < 11; $j++){ //de 1 à 11, pour chaque ligne
                    $k = $j * $i;
                    echo "<td style='width: 50px; text-align: right;'>$k</td>"; //on affche la case avec le nombre multiplié
                }
                echo "</tr>"; //fin de la ligne
            }
            ?>
        </table>
        <h2>Fonctions et tableaux</h2>

        <?php
        require_once "mesFonctions.php"; //on inclus le fichiers contenant les fonctions des exos 8 et 9
        ?>

        <h3>Exercice 8</h3>
        <h4>Enoncé</h4>
        <p>Créer une fonction appelée remplacerLettres(). Elle prendra un argument de type string. 
            Elle devra retourner ce même string mais en remplaçant les e par des 3, les i par des 1. </p>
        <h4>Solution</h4>

        <!-- Fonction à retrouver dans mesFonctions.php -->
        <?php
        remplacerLettres("ça marche effectivement"); //appel de la fonction
        ?>

        <h3>Exercice 9 (tableaux indexés)</h3>
        <h4>Enoncé</h4>
        <p>Créer une fonction appelée premierElementTableau(). Elle prendra un argument de type array. 
            Elle devra retourner le premier élément du tableau. Si l'array est vide, il faudra retourner null.</p>
        <h4>Solution</h4>
        <!-- Votre solution ici -->

        <!-- Fonction à retrouver dans mesFonctions.php -->
        <?php
        //appel de la fonction pour un tableau non vide
        echo "<p>Création d'un tableau tab1 avec les éléments [9,1,5,3,8]</p>";
        $tab1=[9,1,5,3,8];
        premierElementTableau($tab1);

        //appel de la fonction pour un tableau vide
        echo "<p>Création d'un tableau vide tab2</p>";
        $tab2=[];
        premierElementTableau($tab2);
        ?>
        
        <h3>Exercice 10 (tableaux associatifs)</h3>
        <h4>Enoncé</h4>
        <p>En utilisant un tableau associatif avec les valeurs ci-dessous, afficher seulement les pays qui ont une population 
            supérieure ou égale à 20 millions d'habitants. Afficher les pays en utilisant une liste non-ordonnée.</p>
        <ul>
            <li>France : 67595000,</li>
            <li>Suede : 9998000,</li>
            <li>Suisse : 8417000,</li>
            <li>Kosovo : 1820631,</li>
            <li>Malte : 434403,</li>
            <li>Mexique : 122273500,</li>
            <li>Allemagne : 82800000,</li>
        </ul>
        <h4>Solution</h4>
        <!-- Votre solution ici -->
        <?php
        $tableau = ["France"=>67595000, "Suede"=>9998000, "Suisse"=>8417000, "Kosovo"=>1820631, "Malte"=>434403, "Mexique"=>122273500, "Allemagne"=>82800000];
        echo "<p>Voici les pays avec une population supérieure à 20 millions d'habitants:</p>";
        echo "<ul>"; //création de la liste
        foreach($tableau as $cle=>$val){ //parcourt du tableau
            if($val >= 20000000){
                echo "<li>$cle</li>"; //pour chaque élément, on l'affiche comme élément de la liste
            }
        }
        echo "</ul>"; //fin de la liste
        ?>
        <h2>Factorisation du code</h2>
        <h3>Exercice 11</h3>
        <h4>Enoncé</h4>
        <p>Créer un fichier PHP appelé « mesFonctions.php »et y copier les fonctions définies dans les exercices 8 et 9 
            (supprimer la définition de ces fonctions de la page tp1.php). 
            Avant de tester ces fonctions dans les exercices 8 et 9, ajouter le fichier mesFonctions.php en utilisant : 
            inlude, include_once, require et require_once. 
            Laquelle de ces quatre options est la plus convenable ? justifier votre réponse.
			<a href="https://www.php.net/manual/fr/language.control-structures.php" target="_blank">inlude, include_once, require et require_once</a>
        </p>
        <h4>Justification</h4>
        <!-- Votre justification ici -->
        <p>require_once semble être le plus adapté, car en cas d'erreur, il stoppe complètement le script (alors qu'include continue le script malgré la présence d'erreurs), de plus, il vérifie que le fichier n'ait pas été inclus auparavant. Cela permet d'éviter les erreurs de redéfinitions.</p>
    </body>
</html>