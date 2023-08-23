<?php
	//ETAPE 1: Récupération de la BD les données de l'adhérent dont l'id est passé dans URL
	//			Les valeurs récupérées de la BD vont être affichées dans le formulaire ci-dessous
	if(isset($_GET["ida"])){
		try{
			require("connexion.php");
			//Compléter ICI
			$reqPrep= "SELECT * FROM adherents WHERE Id = ?"; //La requere SQL: SELECT
			$req = $conn->prepare($reqPrep); //Préparer la requete
            $req->execute([$_GET["ida"]]); //Executer la requete
			
			$resultat = $req->fetch(PDO::FETCH_ASSOC); //récupération du résultat
			
			$ids = $resultat['Id'];
			$nom = $resultat['Nom'];
			$prenom = $resultat['Prenom'];
			$email = $resultat['Email'];
			$date = $resultat['DateNaissance'];
			$conn= NULL;
		}
		catch(Exception $e){
			die("Erreur : " . $e->getMessage());
        }
	}

	//ETAPE 2: Mettre à jours les données de la BD selon les valeurs modifiées envoyées par le formulaire ci-dessous
	if(isset($_POST["Modifier"])){
		try{
			require("connexion.php");
			$nom_m = $_POST["nom"];
			$prenom_m = $_POST["prenom"];
			$email_m = $_POST["email"];
			$dateN_m = $_POST["dateN"];
			//Compléter ICI
			$req = $conn->prepare("UPDATE adherents SET Nom = :nom_m, Prenom = :prenom_m, Email = :email_m, DateNaissance = :dateN_m WHERE Id = :id"); //La requere SQL: SELECT
			$req->execute(array(
				':nom_m' => $nom_m,
				':prenom_m' => $prenom_m,
				':email_m' => $email_m,
				':dateN_m' => $dateN_m,
				':id' => $_POST["id"]
			));
			$conn= NULL;		
			header("Location:TP4.php");
		}                 
		catch(Exception $e){
			die("Erreur : " . $e->getMessage());
        }
	}

?>

<!-- Formulaire de modification -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>TP4 : web dynamique</title>
        <meta charset="utf-8" />
        <style>
			body{padding:3%;}
        </style>
    </head>
    <body>
		<h1>Modifier un adhérent</h1>
		<form action="modifier.php" method="post">
			<fieldset>
				<legend>Modifier un étudiant</legend>
				<input type="hidden" id="id" name="id" value="<?php if(isset($ids)) { echo $ids; } ?>"><br/>
				
				<label for="nom">Nom : </label>
				<input type="text" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>"><br/>
				
				<label for="prenom">Prénom : </label>
				<input type="text" id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>"><br/>
				
				<label for="email">Email : </label>
				<input type="mail" id="email" name="email" value="<?php if(isset($email)) { echo $email; } ?>"><br/>
				
				<label for="dateN">Date de naissance: </label>
				<input type="date" id="dateN" name="dateN" value="<?php if(isset($date)) { echo $date; } ?>"><br/>
					
				<input Type="submit" name="Modifier" value="Modifier">
			</fieldset>
		</form>
	</body>
</html>