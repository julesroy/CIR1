<?php
    //exercice 8
    function remplacerLettres($chaine){
        for($i = 0; $i < strlen($chaine); $i++){ //parcourt de la chaine
            if($chaine[$i] == "e"){ //si l'élément en court est e
                $chaine[$i] = "3"; //on le remplace par 3
            }
            else if($chaine[$i] == "i"){ //si l'élément en cours est i
                $chaine[$i] = "1"; //on le remplace par 1
            }
        }
        echo "<span>$chaine</span>"; //on affiche la chaine modifiée
    }

    //exercice 9
    function premierElementTableau($tableau){
        if($tableau == null){ //si le tableau est vide
            echo "<span>null</span><br><span>Le tableau est donc vide</span>"; //on précise que le tableau est vide
            return null;
        }
        else{
            echo "<span>Premier élément: $tableau[0]</span>"; //sinon, on affiche le premier élément du tableau (d'index 0)
        }
    }
?>