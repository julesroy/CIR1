<?php

	if(isset($_POST["Ajouter"])){
		try{
			require("connexion.php");               
			
			//Compléter ICI
			$req = $conn->prepare("INSERT INTO adherents (Nom, Prenom, Email, DateNaissance) VALUES (:nom, :prenom, :email, :dateNaissance)");
			$req->execute(array(
				':nom' => $_POST['nom'],
				':prenom' => $_POST['prenom'],
				':email' => $_POST['email'],
				':dateNaissance' => $_POST['dateN']
			));
			
			$conn= NULL;
			header("Location:TP4.php");
		}                 
		catch(Exception $e){
			die("Erreur : " . $e->getMessage());
        }
	}

?>