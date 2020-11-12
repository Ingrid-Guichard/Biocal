
<!DOCTYPE html>
<html lang="fr-FR">
 

<?php

/* En général on configure les paramètres de configuration dans des variables partagées 
 
* entre toutes les pages avec la commande include() (plus facile quand on veut changer
 
* les paramètres du site)
 

*/
    
	$hostname = "localhost";
    
	$database = "biocal_vf";
    
	$username = "root";
   
	$password = "";

    
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    
	try {
    
	$bdd = new PDO('mysql:host=' . $hostname . ';dbname=' . $database.';charset=UTF8', $username, $password, $pdo_options); // Connexion à la BDD
    
	echo "Si vous 	voyez ce message, c'est que la connexion à la base de 	donnée s'est bien passée.";
    } 
	catch(PDOException $ex) { // On attrape 	les Exceptions (si 	quelquechose 	s'est mal passé).
        
	echo "Si vous voyez ce message, c'est qu'une erreur s'est produite (XAMPP 		n'est pas lancé, le nom de la base de donnée n'est pas bon, vous avez mis 		un mot de passe sur le compte root, etc.<br/>";
        echo "<div 			style='color:red;'>".$ex->getMessage()."

</div>";
    }


?>

<head>
        
<title>SUIVI DES STOCKS</title>
        
<meta charset="utf-8">
 
<link rel="stylesheet" type="text/css" href="sourcecode.css">
        
    
</head>
    

<body>
 
<ul class="menu">
  
<li class="menu"><a  href="index.php">Accueil</a></li>
    
<li class="menu"><a  href="bilans.php">Bilan Ventes</a></li>
      
          
       
<li class="menu"><a href="fiches.php">Générer Fiches</a></li>
            
<li class="menu"><a class="active" href="stock.php">Gestion Stocks</a></li>       
<li class="menu"><a href="commandes.php">Suivi Commande</a></li>
     
<li class="menu"><a href="ajouter.php">Mise à jour</a></li>
     
</ul>    

<div id="global">
<h1>SUIVI DES STOCKS</h1>
               
</div>

</body>

<div id="container_table">
<div id="contenu">
<h2>Bilan des stocks critiques </h2>
 
</div>

<style>
    

	table {
        
		border-collapse: collapse;  /* Pour fusionner les bordures des 	cases*/
    
	}

    
		th {
        
			background-color: #F66913; /* Fond de la case*/
        
			border: 5px solid #F66913; /* Bordure des cases*/
        
			padding: 8px; /* Pour laisser "respirer" un peu le texte*/
    
		}
    
		td{
        
			border: 5px solid #F66913; /* Bordure des cases*/
        
			padding: 8px; /* Pour laisser "respirer" un peu le texte*/
    
		}


</style>



<?php
    // La requête SQL à exécuter (ici, DROP TABLE)
    
	
	$sql = "SELECT `ID_Produit`, `Nom`, `Description`, `Quantité`, `categories_produit`, `sous_categories_produit` FROM `produits` WHERE `Quantité` < 5";

    

try {
        
	$response = $bdd->query($sql); // Execution de la requête a proprement parlé.
        
	$output = $response->fetchAll(PDO::FETCH_ASSOC); // Récupération des données.
        //print_r($output);
        
	echo "<br/>Si vous voyez ce message, c'est que tout s'est bien passé.";
    } 
	catch (PDOException $ex) {
        echo "Quelque chose s'est mal passé. Est-ce que la table existe bien ?";
        
	echo "<div style='color:red;'>" . $ex->getMessage() . "</div>";
    }


if(isset($output)) { // On reprend la variable $output chargé à "l'exercice" précédent, on vérifie donc qu'elle existe bien avec isset()

        
echo "<table>"; // Début du tableau

        
	for ($ligne = 0; $ligne < count($output); $ligne++) { // Pour chaque ligne
            
	echo "<tr>"; // début de ligne

            
	if ($ligne == 0) { // Pour la première ligne, on commence par générer la ligne de titre

                foreach ($output[$ligne] as $index => $valeur) { // Pour 	chaque colonne
                    
	echo "<th>"; // début de colonne

                    
	echo $index; // Affichage du nom de la colonne (qui sert d'index)

                    
	echo "</th>"; // fin de colonne
                }
                
	echo "</tr><tr>"; // Nouvelle ligne (pour les données)
            }

            
	foreach ($output[$ligne] as $index => $valeur) { // Pour chaque colonne
                echo "<td>"; // début de colonne

                echo $valeur; // 	Affichage de la valeur de la case.

                echo "</td>"; // fin de colonne
            }

            
	echo "</tr>"; // fin de ligne
        }

       
	echo "</table>"; // fin du tableau
    } 
		else {
        echo "La variable <code>$output</code> n'existe pas encore. Faites les exercices précédents.";
    

}

?>




<div id="contenu">
<h2>Bilan des stocks général </h2>
 
</div>

  


<?php
    // La requête SQL à exécuter (ici, DROP TABLE)
    

$sql = "SELECT `ID_Produit`, `Nom`, `Description`, `Quantité`, `categories_produit`, `sous_categories_produit` FROM `produits` WHERE 1";

    
	try {
        
		$response = $bdd->query($sql); // Execution de la requête a proprement parlé.
        
		$output = $response->fetchAll(PDO::FETCH_ASSOC); // Récupération des données.
        
        
		echo "<br/>Si vous voyez ce message, c'est que tout s'est bien passé.";
    } 
	catch (PDOException $ex) {
        echo "Quelque chose s'est mal passé. Est-ce que la table existe bien ?";
        
		echo "<div style='color:red;'>" . $ex->getMessage() . "</div>";
    }
		
if(isset($output)) { // On reprend la variable $output chargé à "l'exercice" précédent, on vérifie donc qu'elle existe bien avec isset()

        
			echo "<table>"; // Début du tableau

        
			for ($ligne = 0; $ligne < count($output); $ligne++) { // Pour chaque ligne
            
				echo "<tr>"; // début de ligne

            
					if ($ligne == 0) { // Pour la première ligne, on commence par générer la ligne de titre

                
					foreach ($output[$ligne] as $index => $valeur) { // Pour chaque colonne
                    
					echo "<th>"; // début de colonne

                    
					echo $index; // Affichage du nom de la colonne (qui sert d'index)

                    
					echo "</th>"; // fin de colonne
                }
                
				echo "</tr><tr>"; // Nouvelle ligne (pour les données)
            }

            
				foreach ($output[$ligne] as $index => $valeur) { // Pour chaque colonne
                
				echo "<td>"; // début de colonne

                
				echo $valeur; // Affichage de la valeur de la case.

                		
				echo "</td>"; // fin de colonne
            }

            
			echo "</tr>"; // fin de ligne
        }

        
			echo "</table>"; // fin du tableau
    } 
				else {
        
					echo "La variable <code>$output</code> n'existe pas encore. Faites les exercices précédents.";
    }


?>

    
</div>