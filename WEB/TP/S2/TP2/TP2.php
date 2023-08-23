<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>TP2 : web dynamique</title>
        <meta charset="utf-8" />
        <style>
			body{padding:3%;}
            h1{text-align:center;}
            h2{color:red;}
            h3{color:green;}
            h4{color:blue;}
            h5{color:pink;}
	
			table{border-collapse:collapse;}
			td{border: 1px solid black; width: 100px; text-align:center;}
			div{border:solid red; padding:10px;}

        </style>
    </head>
    <body>
        <h1>TP2 : web dynamique<br>Les fonctions intégrées</h1>
        <h2>I. Manipulation des chaines de caractères</h2>
		<div>
			Aide:
			<ul>
				<li>Documentation: <a href="https://www.php.net/manual/fr/ref.strings.php" target="_blank">Liste des fonctions sur les chaines de caractères</a></li>
				<li>Fonctions utiles pour cette partie: strlen, preg_match, printf, str_pad, str_replace, ucwords, </li>
			</ul>
		</div>
		
		<h3>Exercice 1</h3>
        <h4>Enoncé</h4>
        <p>Etant donné le script ci-dessous, utiliser  la fonction "printf" afin d'afficher le même message:</p>
        <h4>Solution</h4>
		<?php
		$a=2.3;
		$b=10;
		$r=$a+$b;
		
		echo "$a + $b = $r \"avec la fonction echo\"<br>";
		echo "\$a + \$b = $r \"avec la fonction echo\" <br>";
		//Votre solution ici
		printf("<br>Ma solution (avec printf):<br>");
		printf("%.1f + %d = %.1f avec la fonction printf <br>", $a, $b, $r);
		printf("\$a + \$b = %.1f avec la fonction printf", $r);
		?>
		
        <h3>Exercice 2</h3>
        <h4>Enoncé</h4>
        <p>Ecrire un script affichant Tous les mots d'une phrase donnée avec une initiale en majuscule.</p>
        <h4>Solution</h4>
        <!-- Votre solution ici -->
		<span>Chaîne de caractère: cr7 a dit suuuu</span>
		<br>
		<?php
		$chaine = "cr7 a dit suuuu";
		echo "Avec des majuscules au début de chaque mot: <br>";
		echo ucwords($chaine);
		?>
		<h3>Exercice 3</h3>
        <h4>Enoncé</h4>
        <p>Ecrire un script remplaçant les caractères \n par &lt; br&gt;</p>
        <h4>Solution</h4>
		<?php
		$chaine="PHP \n est meilleur \n que ASP \n et JSP \n";
		echo "Avant: $chaine <br><br>";
		// Votre solution ici 
		echo "<span>Après remplacement:</span><br><br>";
		$replace = "\n";
		echo str_replace($replace, "<br>", $chaine);
		?>

		<h3>Exercice 4</h3>
        <h4>Enoncé</h4>
        <p>Ecrire un script permettant de formater l'affichage d'un sommaire composé d'une suite de titres et leurs numéros de page 
		(Voir image sur teams)</p>
        <h4>Solution</h4>
		<?php
		$titres="Chapitres";
		$pages="Pages";
		$titre1= "HTML";
		$titre2="CSS";
		$titre3="PHP";
		$page1="1";
		$page2="5";
		$page3="20";
		echo "<br>";
		echo "<pre>";
		//Votre solution ici
		echo str_pad($titres, 35, " ", STR_PAD_RIGHT);
		echo $pages;
		echo "<br>";
		echo str_pad($titre1, 39, ".", STR_PAD_RIGHT);
		echo $page1;
		echo "<br>";
		echo str_pad($titre2, 39, ".", STR_PAD_RIGHT);
		echo $page2;
		echo "<br>";
		echo str_pad($titre3, 38, ".", STR_PAD_RIGHT);
		echo $page3;
		echo "</pre>";
		?>
		
		
        <h3>Exercice 5</h3>
        <h4>Enoncé</h4>
        <p>Ecrire une fonction qui s'appelle verificationPassword(). Elle prendra un argument de type string.
		Elle devra retourner un boolean qui vaut true si le password respecte les règles suivantes :
		<ul>
			<li>faire au moins 8 caractères ;</li>
			<li>avoir au moins 1 chiffre ;</li>
			<li>avoir au moins une majuscule et une minuscule.</li>
		</ul>
		Utiliser les expressions régulières et la fonction preg_match().
		</p>
        <h4>Solution</h4>
        <!-- Votre solution ici -->
		<?php
		function verificationPassword($password){
			$test1 = preg_match('/[0-9]/', $password);
			$test2 = preg_match('/[a-z]/', $password);
			$test3 = preg_match('/[A-Z]/', $password);
			if($test1 && $test2 && $test3 && strlen($password) >= 8){ //si il y a au moins 8 caractères, et que preg_match pour chaque variable ci-dessus renvoie true
				echo "true"; //on affiche true
				return true; //on retourne true
			}
			else{ //sinon
				echo "false"; //on affiche false
				return false; //on retourne false
			}
		}

		//appels
		echo "<span>On teste avec: Abc010203:</span><br>";
		verificationPassword("Abc010203");

		echo "<br><span>On teste avec: abc010203:</span><br>";
		verificationPassword("abc010203");
		?>
		<h3>Exercice 6</h3>
        <h4>Enoncé</h4>
		<p>Ecrire une fonction qui s'appelle verificationEmail(). Elle prendra un argument de type string.
		Elle devra retourner un boolean qui vaut true si le email respecte les règles suivantes :<br>
		L'émail doit contenir des lettres, le caractère point "." ou le caractère "-", suivit du caractère "@" une seul fois, suivit de 0 ou plusieurs lettres ou caractère point, suivit de la chaine "junia.com qui doit être à la fin de l'émail"
		</p>
        <h4>Solution</h4>
        <!-- Votre solution ici -->
		<?php
		function verificationEmail($email){
			$pattern = '/[a-zA-Z.-]+@[a-zA-Z.]*junia.com$/'; //déclaration du pattern
			if(preg_match($pattern, $email)){ //si preg_match renvoie true
				echo "true <br>"; //on affiche true
				return true; //on retourne true
			}
			else{ //sinon
				echo "false <br>"; //on affiche false
				return false; //on retourne false
			}
		}

		//appels
		echo "<br><span>On teste avec jules.roy@student.junia.com:</span><br>";
		verificationEmail("jules.roy@student.junia.com");
		echo "<br><span>On teste avec jules.royastudent.junia.com:</span><br>";
		verificationEmail("jules.royastudent.junia.com");
		?>
        <h2>II. Manipulation des tableaux</h2>
		<div>
			Aide:
			<ul>
				<li>Documentation: <a href="https://www.php.net/manual/fr/ref.array.php" target="_blank">Liste des fonctions sur les tableaux</a>, 
				<a href="https://www.php.net/manual/fr/ref.math.php" target="_blank">Liste des fonctions mathématiques</a></li>
				<li>Fonctions utiles pour cette partie:  array_sum, round, array_merge, count, print_r, ksort, array_keys, unset, arsort, max, min,</li>
			</ul>
		</div>
        <h3>Exercice 7</h3>
        <h4>Enoncé</h4>
        <p>
		Considérant le tableau suivante des étudiants et leurs notes.</p>
		<table>
			<tr><td>Alixe</td><td>13</td></tr>
			<tr><td>Justine</td><td>16</td></tr>
			<tr><td>Raja</td><td>10</td></tr>
			<tr><td>Jean</td><td>15</td></tr>
			<tr><td>Clément</td><td>10</td></tr>
			<tr><td>Mathieu</td><td>12</td></tr>
			<tr><td>Claire</td><td>11</td></tr>
			<tr><td>Juliette</td><td>20</td></tr>
			<tr><td>Paul</td><td>12</td></tr>
		</table>
		<ol>
			<li>Créer et initialiser un tableau associatif $notes, sachant que les noms représentent les clés et les notes représentent les valeurs.
			Utiliser la fonction print_r pour afficher le contenu de votre tableau</li>
			<li>Afficher la note maximale, la note minimale et la moyenne de la classe (précision : deux chiffres après la virgule). 
			Utiliser les fonctions mathématiques intégrées min, max, round.</li>
			<li>Ecrire une fonction "Affichage" prenant un tableau associatif des notes comme argument et affiche son contenu à l'aide de la balise HTML table, 
			tout en respectant le style suivant:
				<ul>
					<li>Couleur du texte: la note maximale en rouge, la note minimale en vert</li>
					<li>Couleur du fond: les notes supérieures ou égale à la moyenne en orange, les notes inférieures à la moyenne en jaune.</li>
				</ul>
			</li>
			<li>Ajouter au tableau $note l'étudiant "Hugo" et sa note 14. Supprimer l'étudiant Clément du tableau. Trier votre tableau par ordre alphabétique des noms et afficher-le<br></li>
			<li>Trier le tableau par ordre décroissant des notes.</li>
			<li>Ajouter au début du tableau ces deux étudiants : "Cristophe"=>20 et "Karim" => 20. Afficher votre tableau.</li>
			<li>Créer deux tableaux $cleMax et $cleMin contenant les noms des étudiants qui ont la note maximale et minimale repectivement 
			(utiliser la fonction "array_keys")</li>
		</ol>
        <h4>Solution</h4>
        <!-- Votre solution ici -->
		<?php
		$notes = [ //création du tableau associatif
			"Alixe" => 13,
			"Justine" => 16,
			"Raja" => 10,
			"Jean" => 15,
			"Clément" => 10,
			"Mathieu" => 12,
			"Claire" => 11,
			"Juliette" => 20,
			"Paul" => 12
		];
		print_r($notes);
		echo "<br>Le minimum est: ".min($notes); //affichage du minimum
		echo "<br>Le maximum est: ".max($notes); //affichage du maximum
		$moyenne = array_sum($notes) / count($notes); //calcul de la moyenne
		echo "<br>La moyenne est: ".round($moyenne, 2); //affichage de la moyenne

		echo "<br><br><span>Avec la fonction affichage:</span><br>";
		function Affichage($tableau){
			$moyenne = array_sum($tableau) / count($tableau); //calcul de la moyenne
			echo "<table>";
			foreach($tableau as $cle=>$val){ //parcourt du tableau avec foreach
				echo "<tr>"; //creation de la ligne
				echo "<td>$cle</td>"; //on affiche le nom (la clé) dans la premiere colonne
				//on affiche la note (la valeur) dans la deuxieme colonne
				if($val == max($tableau)){ //si c'est la note maximale
					echo "<td style='color: red;'>$val</td>";
				}
				else if($val == min($tableau)){ //si c'est la note minimale
					echo "<td style='color: green;'>$val</td>";
				}
				else if($val >= $moyenne){ //si c'est superieur ou egal a la moyenne
					echo "<td style='background-color: orange;'>$val</td>";
				}
				else if($val < $moyenne){ //si c'est inferieur a la moyenne
					echo "<td style='background-color: yellow;'>$val</td>";
				}
				echo "</tr>"; //fin de la ligne
			}
			echo "</table>";
		}
		//appels
		Affichage($notes);

		echo "<br><span>Affichage avec noms ordre alphabétique:</span>";
		$notes["Hugo"] = 14; //on cree une nouvelle entrée dans le tableau
		unset($notes["Clément"]); //on supprime une entrée
		ksort($notes); //on trie le tableau dans l'ordre alphabétique
		Affichage($notes); //on fait appel a la fonction Affichage créée auparavant pour afficher le tableau

		echo "<br><span>Affichage avec notes décroissantes:</span>";
		arsort($notes); //on trie le tableau par notes dans l'ordre décroissant
		Affichage($notes); //on fait appel a la fonction Affichage créée auparavant pour afficher le tableau
		?>
		<h2>III. Manipulation des dates</h2>
		<div>
			Définitions:
			<ul>
				<li>Les fonctions date de PHP permettent d’afficher la date et l’heure sur les pages web.</li>
				<li>Les informaticiens ont défini une date de base arbitraire, correspondant au 1er janvier 1970 00h00m00s. À partir de cette date, le temps est compté en secondes.</li>
				<li>Ce nombre de secondes est nommé <span style="color:red;"> timestamp</span>, ou instant Unix</li>
				<li>Le timestamp est universel, puisqu'il y a pas de notion de fuseaux horaire.</li>
				<li>Le timestamp est passé en paramètre à d'autres fonctions pour réaliser l’affichage en clair de la date.</li>
			</ul>
			Exemples:
			<ul>
			<?php		
				echo "<li>La fonction time() retourne le timestamp actuelle : ".time()." secondes.</li>";
				echo "<li>La fonction date() affiche la date sous plusieurs formes : ".date('r')."</li>" ;
				echo "<li>La fonction date peut aussi prendre un timestamp comme paramètre pour l'afficher selon le format souhaité</li>.";
			?>
			</ul>
			Aide:
			<ul>
				<li>Documentation: <a href="https://www.php.net/manual/fr/ref.datetime.php" target="_blank">Liste des fonctions sur les dates</a>, 
				<a href="https://www.php.net/manual/fr/datetime.format.php" target="_blank">Les formats pour la fonction date()</a> </li>
				<li>Fonctions utiles pour cette partie: checkdate, date, time, mktime</li>
			</ul>
		</div>
		<h3>Exercice 8</h3>
        <h4>Enoncé</h4>
        <p>Vérifiez si la date du 29 février 2022 est valide.</p>
        <h4>Solution</h4>
		<!-- Votre solution ici -->
		<?php
		if (checkdate(2, 29, 2022)){ //on vérifie la date avec checkdate()
			echo "true"; //si true, on echo true
		}
		else{
			echo "false"; //si false, on echo false
		}
		?>

		<h3>Exercice 9</h3>
        <h4>Enoncé</h4>
        <p>Ecrire un script affichant la date et l'heure courantes sous les formes suivantes :</p>
		<p>Monday/January/2022<br>25/Jan/2022<br>25-01-22<br>23h: 31m: 01s</p>
        <h4>Solution</h4>
		<!-- Votre solution ici -->
		<?php
		//on affiche la date selon les différents formats souhaités
		echo date('l/M/Y');
		echo "<br>";
		echo date('d/M/Y');
		echo "<br>";
		echo date('d-m-Y');
		echo "<br>";
		echo date('H\h: i\m: s\s');
		?>
		
		<h3>Exercice 10</h3>
        <h4>Enoncé</h4>
        <p>Quel jour de la semaine était le 6 novembre 1975?</p>
        <h4>Solution</h4>
		<!-- Votre solution ici -->
		<?php
		$timestamp = strtotime('1975-11-06'); //on convertit une chaine de caractère en date
		$day = date('l', $timestamp); //on récupère le jour de la date
		echo $day; //on affiche le jour
		?>
		
		<h3>Exercice 11</h3>
        <h4>Enoncé</h4>
        <p>Ecrire un script affichant si une année est bissextile.</p>
        <h4>Solution</h4>
        <!-- Votre solution ici -->
		<?php
		function bissextile($annee){
			if(checkdate(2, 29, $annee)){ //on regarde si le 29 février existe pour l'année passée en paramètre
				echo "$annee est une année bissextile<br>"; //si oui
			}
			else{
				echo "$annee n'est pas une année bissextile<br>"; //sinon
			}
		}
		//appels
		bissextile(2020);
		bissextile(2022);
		?>
		
		<h3>Exercice 12</h3>
        <h4>Enoncé</h4>
        <p>Calculez votre âge à l’instant en cours (soustraction de deux timestamp), en secondes puis en années.</p>
        <h4>Solution</h4>
		<!-- Votre solution ici -->
		<?php
		$naissance = mktime(0, 0, 0, 1, 4, 2004);
		echo $naissance;
		echo "<br>";
		$actuel = time();
		echo $actuel;
		echo "<br>";
		$difference = $actuel - $naissance;
		echo $difference;
		$annees = $difference / 60 /60 / 24 / 365; //division des secondes pour obtenir le timestamp en année
		echo "<br>En année: $annees"
		?>
    </body>
</html>