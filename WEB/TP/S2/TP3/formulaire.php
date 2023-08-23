<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Formulaire Action </title>
	<style>
		body{padding:3%;}
		table {
			border-collapse: collapse;
			border: solid 1px;
			width:50%;
		}
		td,th {
			border: solid 1px;
			text-align:left;
		}
	</style>
</head>
<body>
	<?php
		$civilite=$_POST["civilite"]; 
		$nom=$_POST["nom"];
		$email=$_POST["email"];
		$dateNaissance=$_POST["naissance"];
		$abonn=$_POST["abonnement"];
		$bio=$_POST["bio"];
		$lessports=$_POST["sports"];

		function valider_donnees($donnee){
			$donnee = trim($donnee);
			$donnee = stripslashes($donnee);
			$donnee = htmlspecialchars($donnee);
			return $donnee;
		}

		// on vérifie que la méthode est utilisée
		if($_SERVER['REQUEST_METHOD'] != 'POST'){
			header('location:TP3.php');
		}
		//on vérifie que les champs obligatoires existent
		if(!isset($civilite) || !isset($nom) || !isset($email) || !isset($dateNaissance) || !isset($abonn)){
			header('location:TP3.php');
		}
		else{
			//on vérifie chaque champ avec la fonction valider_donnees
			$civilite=valider_donnees($civilite); 
			$nom=valider_donnees($nom);
			$email=valider_donnees($email);
			$dateNaissance=valider_donnees($dateNaissance);
			$abonn=valider_donnees($abonn);
			$bio=valider_donnees($bio);
			foreach($lessports as $sport){
				$val=valider_donnees($sport);
			}
			
			//on vérifie que les champs obligatoires ne sont pas vides
			if(empty($civilite) || empty($nom) || empty($email) || empty($dateNaissance) || empty($abonn)){
				header('location:TP3.php');
			}
			else{
				$pattern = "/^[a-zA-Z-' ]{1,40}$/"; //définition du pattern
				if(!preg_match($pattern, $nom)){ //vérification du pattern
					header('location:TP3.php');
				}
				$pattern_mail = "/^[a-zA-Z.-]+@[a-zA-Z.]*junia.com$/"; //définition du pattern pour le mail
				if(!preg_match($pattern_mail, $email)){ //vérification du pattern
					header('location:TP3.php');
				}
			}
		}
	?>
	
	<h1>Informations sur : <?php echo "$civilite. $nom"; ?></h1>
	<table>
		<tr>
			<th>Email </th>
			<td><?php echo $email; ?></td>
		</tr>
		<tr>
			<th>Date de naissance </th>
			<td><?php echo $dateNaissance; ?> </td>
		</tr>
		<tr>
			<th>Abonnement </th>
			<td><?php echo $abonn; ?> </td>
		</tr>
		<tr>
			<th>Sport(s) pratiqué(s) </th>
			<td>
				<?php 
					if(isset($lessports) && count($lessports)>0){
						echo "<ul>";
						foreach ($lessports as $val){
							echo"<li>$val</li>";
						}
						echo "</ul>";
					}else 
						echo "Aucun sport";
				?>
				</ul>	
			</td>
		</tr>
		<tr>
			<th>Bio </th>
			<td><?php echo $bio;?> </td>
		</tr>
	</table>
</body>
</html>