<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>TP3</title>
        <meta charset="utf-8" />
        <style>
			body{padding:3%;}
            h1{text-align:center;}
            h2{color:red;}
            h3{color:green;}
            h4{color:blue;}
            h5{color:pink;}
        </style>
    </head>
    <body>
        <h1>TP3 : web dynamique<br>Les formulaires</h1>
		<h2>Exercice 1 : Récupération et validation des données d'un formulaire</h2>

		<form method="post" action="formulaire.php">
			<fieldset style="width:50%;">
				<legend>Informations sur vous</legend>
				
				<label>Civilité :</label>
				<input type="radio" name="civilite" id="male" value="M" required/><label for="male">Monsieur</label>
				<input type="radio" name="civilite" id="female" value="Mme" required/><label for="female">Madame</label>
				
				<hr>
				<label for="nom">Nom :</label>
				<input type="text" name="nom" id="nom" required pattern="[a-zA-Z-' ]*" maxlength="40"/>
				
				<hr>
				<label for="mail">Email :</label>
				<input type="email" name="email" id="mail" placeholder="prénom.nom@junia.com" required pattern="[a-zA-Z.-]*@[a-zA-Z.]*junia.com"/>
				
				<hr>
				<label for="dnaissance">Date de naissance :</label>
				<input type="date" name="naissance" id="dnaissance" required/>
				
				<hr>
				<label for="abonnement">Abonnement :</label>
				<select name="abonnement" id="abonnement" required>
					<option value="">--Merci de choisir un type d'abonnement--</option>
					<option value="Mensuel">Mensuel</option>
					<option value="Trimestriel">Trimestriel</option>
					<option value="Semestriel">Semestriel</option>
					<option value="Annuel">Annuel</option>
				</select>
				
				<hr>
				<label>Sports pratiqués :</label>
				<input type="checkbox" id="fbl" name="sports[]" value="Football" /><label for="fbl">Football</label>
				<input type="checkbox" id="rgb" name="sports[]" value="Rugby"/><label for="rgb">Rugby</label>
				<input type="checkbox" id="glf" name="sports[]" value="Golf" /><label for="glf">Golf</label>
				<input type="checkbox" id="jgn" name="sports[]" value="Jogging" /><label for="jgn">Jogging</label>
				<input type="checkbox" id="atr" name="sports[]" value="Autre" /><label for="atr">Autre</label>
				
				<hr>
				<label for="bio">Bio :</label>
				<textarea name="bio" id="bio" rows="3" cols="33"></textarea>

				<hr>
				<input type="submit" name="Envoyer" Value="Envoyer le formulaire"/>
				
			</fieldset>
		</form>
		

		<h3>Exercice 2: Création d'un dossier d'upload</h3>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
			<label>Choisir une image:</label>
			<input type="file" name="fichier" required accept="images/*"/>
			
			<br><br>
			
			<input type="submit" name="Charger" value="Charger l'image"/>
		</form>
		
		<!-- ICI: Script php d'enregistrement des images-->
		<?php
		if(isset($_FILES["fichier"])){ //si le champ fichier existe
			$cheminsource = $_FILES["fichier"]["tmp_name"]; //chemin temporaire
			$chemindestination = "images/".basename($_FILES["fichier"]["name"]); //chemin de destination
			$filesize = $_FILES["fichier"]["size"]; //taille du fichier
			if($filesize > 1000000){ //si le fichier est supérieur à 1 Mo
				echo "L'image est trop volumineuse<br>";
				afficherImages(); //on affiche les images déja uploadées
				return; //on arrête le script
			}
			$verif_file_extension = pathinfo($_FILES["fichier"]["name"]); //on récupère les informations du fichier
			if($verif_file_extension["extension"]  != "jpg" && $verif_file_extension["extension"]  != "gif" && $verif_file_extension["extension"]  != "png"){ //si l'extension n'est pas du type souhaité: jpg, gif ou png
				echo "L'extension du fichier n'est pas valide<br>";
				afficherImages(); //on affiche les images déja uploadées
				return; //on arrête le script
			}
			$upload = move_uploaded_file($cheminsource, $chemindestination); //on déplace le fichier dans le dossier de destination
			if($upload){
				echo "Image uploadée avec succès<br>"; //en cas de succès
			}
			else{
				echo "Erreur lors de l'upload de l'image<br>"; //en cas d'erreur
			}
		}
		?>

		<!-- ICI: Script php d'affichage des images à partir d'un dossier-->
		<?php
		function afficherImages(){ //on définit la fonction qui affiche les images
			echo "<br><h2>Images:</h2>";
			$dir='images/'; //on définit le dossier où se trouvent les images           
			if ($dh = opendir($dir)) { //on ouvre le dossier
				while (($file = readdir($dh)) !== false) { //on lit le dossier tant qu'il y a des fichiers
					if(filetype($dir.$file)=='file'){ //si c'est un fichier (pour éviter les images "vides" à l'écran)
			?>
					<img src="images/<?=$file?>" style="height: 200px; width:auto;"> <!-- on affiche les images -->
		<?php
				}
			}
				closedir($dh); //on ferme le dossier
			}
		}

		afficherImages(); //on appelle la fonction
        ?>
    </body>
</html>