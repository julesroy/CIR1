<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>TP4 : web dynamique</title>
        <meta charset="utf-8" />
        <style>
			body{padding:3%;}
            h1{text-align:center;}
            h2{color:red;}
			table,td,th{border: solid; border-collapse:collapse;text-align:center;}
        </style>
    </head>
    <body>
		<h1>TP4 : web dynamique<br>Base de données</h1>
		<h2>Liste des Adhérents</h2>
		<?php

            try{
                require("connexion.php"); 
				
				$reqPrep= "SELECT * FROM adherents"; //La requere SQL: SELECT
				$req = $conn->prepare($reqPrep); //Préparer la requete
                $req->execute(); //Executer la requete
				
				$resultat = $req->fetchAll(PDO::FETCH_ASSOC); //récupération du résultat 
				
				//Affichage sous forme d'un tableau HTML
				echo "<table>
							<tr>
								<th>id</th>
								<th>Nom</th>
								<th>Prénom</th>
								<th>Email</th>
								<th>Date de naissance</th>
								<th colspan=2>Action</th>
							</tr>";
		
					//Compléter ICI
					foreach($resultat as $val){
						echo "<tr>";
						echo "<td>".$val['Id']."</td>";
						echo "<td>".$val['Nom']."</td>";
						echo "<td>".$val['Prenom']."</td>";
						echo "<td>".$val['Email']."</td>";
						echo "<td>".$val['DateNaissance']."</td>";
						echo "<td><a href='modifier.php?ida=".$val['Id']."'>Modifier</a></td>";
						echo "<td><a href='supprimer.php?ida=".$val['Id']."'>Supprimer</a></td>";
					}
				echo "</table>";
				
				$conn = NULL;// On ferme la connexion						
            }                 
            catch(Exception $e){
                die("Erreur : " . $e->getMessage());
            }

		?>

		<!-- Formulaire d'ajout -->
		<h2>Ajouter un adhérent</h2>
		<form name="ajout" action="ajouter.php" method="post">
			<fieldset>
				<legend>Ajouter un adhérent</legend>
				
				<label for="nom">Nom : </label>
				<input type="text" id="nom" name="nom"><br/>
				
				<label for="prenom">Prénom : </label>
				<input type="text" id="prenom" name="prenom"><br/>
				
				<label for="email">Email : </label>
				<input type="email" id="email" name="email"><br/>
				
				<label for="dateN">Date de naissance : </label>
				<input type="date" id="dateN" name="dateN"><br/>
				
				<input Type="submit" name="Ajouter" value="Ajouter">
			</fieldset>
		</form>
		
    </body>
</html>