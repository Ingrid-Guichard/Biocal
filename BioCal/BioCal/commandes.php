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
    echo "Si vous voyez ce message, c'est que la connexion à la base de donnée s'est bien passée.";
    } catch(PDOException $ex) { // On attrape les Exceptions (si quelquechose s'est mal passé).
        echo "Si vous voyez ce message, c'est qu'une erreur s'est produite (XAMPP n'est pas lancé, le nom de la base de donnée n'est pas bon, vous avez mis un mot de passe sur le compte root, etc.<br/>";
        echo "<div style='color:red;'>".$ex->getMessage()."</div>";
    }

?>

<head>
              
<meta charset="utf-8">
        
<link rel="stylesheet" type="text/css" href="sourcecode.css">
    

</head>
 

<body>
        
<ul class="menu">
    
        
<li class="menu"><a  href="index.php">Accueil</a></li>
            
<li class="menu"><a  href="bilans.php">Bilan Ventes</a></li>
                        
<li class="menu"><a href="fiches.php">Générer Fiches</a></li>
            
<li class="menu"><a href="stock.php">Gestion Stocks</a></li>
        
<li class="menu"><a class="active" href="commandes.php">Suivi Commande</a></li>     
<li class="menu"><a href="ajouter.php">Mise à jour</a></li>
  

</li>
            
</ul> 
 

    
<div id="global">
<h1>          SUIVI COMMANDES           </h1>
</div>
</body>

<div id="container">
<div class="formulaire">

<div id="contenu">
<h2> Suivre une commande </h2>
</div>

<form action='#showFiltered' method="POST">
<form class="form_style">

        <label for="numero" >Numéro client :</label> 
	<input type="hidden" name="action" value="filterShowData">
        <input type="text" name="nameFilter" class="inputbasic"><br/>

        <input type="submit" value="Afficher les commandes" class="bouton">
    </form>
</form>

<style>
    table {
        border-collapse: collapse;  /* Pour fusionner les bordures des cases*/
	
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
//Requete SQL Select from

    if (filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING) === "filterShowData") { // La fonction filter_input permet d'accéder de manière sécurisé aux valeurs de $_POST.

        // On récupère la valeur du champ du formulaire
        $nameFilter = filter_input(INPUT_POST, "nameFilter", FILTER_SANITIZE_STRING);

        // On rajoute % devant et derrière car % est le caractère JOKER de l'opérateur LIKE
        

        // On utilise l'opérateur LIKE qui tolère la présence de JOKER (%)
        $sql = "SELECT * FROM `commandes` WHERE ID_Client LIKE :nameFilter ;";

        $statement = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement->bindParam(':nameFilter', $nameFilter);

        try {
            $response = $statement->execute(); // Execution de la requête a proprement parlé.

            // ATTENTION, lorsqu'on utilise un $statement, il faut appliquer le fetchAll sur l'objet $statement et non $response !
            $output = $statement->fetchAll(PDO::FETCH_CLASS); // L'option PDO::FETCH_CLASS récupère les données sous forme de tableau associatif
            /*echo "Si vous voyez ce message, c'est que tout s'est bien passé.<br/>";*/
        } catch (PDOException $ex) {
            echo "Quelque chose s'est mal passé. Avez-vous bien envoyé tous les champs ?";
            echo "<div style='color:red;'>" . $ex->getMessage() . "</div>";
        }

        if (isset($output)) { // On reprend la variable $output chargé à "l'exercice" précédent, on vérifie donc qu'elle existe bien avec isset()
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
    } 
?>


</div>

<div class="formulaire">

<div id="contenu">
<h2> Consulter l'état d'une livraison </h2>
</div>

<form livraison='#showFiltered' method="POST">
<form class="form_style">

	<label for="numérolivraison" >Numéro livraison :</label> 
	<input type="hidden" name="livraison" value="filterShowData2">
        <input type="text" name="nameFilter2" class="inputbasic"><br/>

        <input type="submit" value="Afficher les livraisons" class="bouton">
</form>
</form>

<?php
//Requete SQL Select from

    if (filter_input(INPUT_POST, "livraison", FILTER_SANITIZE_STRING) === "filterShowData2") { // La fonction filter_input permet d'accéder de manière sécurisé aux valeurs de $_POST.

        // On récupère la valeur du champ du formulaire
        $nameFilter2 = filter_input(INPUT_POST, "nameFilter2", FILTER_SANITIZE_STRING);

        // On rajoute % devant et derrière car % est le caractère JOKER de l'opérateur LIKE
        $nameFilter2 = "%".$nameFilter2."%";

        // On utilise l'opérateur LIKE qui tolère la présence de JOKER (%)
        $sql = "SELECT clients.Nom As 'Nom de famille', livraisons.Date_prévue As 'Date de livraison prévue', livraisons.Date_effective As 'Date de livraison effective', commandes.Etat_Commande As 'Etat de la livraison' FROM `livraisons` INNER JOIN commandes ON `commandes`.ID_Commande=`livraisons`.ID_Commande INNER JOIN clients ON `clients`.ID_Client=`commandes`.ID_Client WHERE ID_Livraison LIKE :nameFilter2 ;";

        $statement = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement->bindParam(':nameFilter2', $nameFilter2);

        try {
            $response = $statement->execute(); // Execution de la requête a proprement parlé.

            // ATTENTION, lorsqu'on utilise un $statement, il faut appliquer le fetchAll sur l'objet $statement et non $response !
            $output = $statement->fetchAll(PDO::FETCH_CLASS); // L'option PDO::FETCH_CLASS récupère les données sous forme de tableau associatif
            echo "Si vous voyez ce message, c'est que tout s'est bien passé.<br/>";
        } catch (PDOException $ex) {
            echo "Quelque chose s'est mal passé. Avez-vous bien envoyé tous les champs ?";
            echo "<div style='color:red;'>" . $ex->getMessage() . "</div>";
        }

        if (isset($output)) { // On reprend la variable $output chargé à "l'exercice" précédent, on vérifie donc qu'elle existe bien avec isset()
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
    } 

?>

<?php

    $sql = "SELECT * from livraisons WHERE Date_prévue < NOW() AND Date_effective =0;";

    try {
        $response = $bdd->query($sql); // Execution de la requête a proprement parlé.
        $output = $response->fetchAll(PDO::FETCH_ASSOC); // Récupération des données.
        //print_r($output);
        //echo "<br/>Si vous voyez ce message, c'est que tout s'est bien passé.<br/>";
    } catch (PDOException $ex) {
        echo "Quelque chose s'est mal passé. Est-ce que la table existe bien ?";
        echo "<div style='color:red;'>" . $ex->getMessage() . "</div>";
    }
	if(count($output)>0) {

echo'<script type="text/javascript">
alert("Attention commandes en retard :\n';
foreach($output as $livraison) {
		
	echo 'Livraison '.$livraison["ID_Livraison"].' en retard ! Date prévue : '.$livraison["Date_prévue"].'\n';
	}
echo '");
</script>';
	
	
	}
?>
</div>
</div>

