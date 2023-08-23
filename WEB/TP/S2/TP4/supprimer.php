<?php

	if(isset($_GET["ida"])){
		try{
			require("connexion.php"); 
               
			//Compléter ICI
			$reqPrep= "DELETE FROM adherents WHERE Id = ?"; //La requere SQL: DELETE
			$req = $conn->prepare($reqPrep); //Préparer la requete
			$req->execute([$_GET["ida"]]); //Executer la requete
			
			header("Location:TP4.php");
		}                 
		catch(Exception $e){
			die("Erreur : " . $e->getMessage());
        }
	}

?>