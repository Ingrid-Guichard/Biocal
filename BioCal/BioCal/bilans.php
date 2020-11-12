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
    //echo "Si vous voyez ce message, c'est que la connexion à la base de donnée s'est bien passée.";
    } catch(PDOException $ex) { // On attrape les Exceptions (si quelquechose s'est mal passé).
        echo "Si vous voyez ce message, c'est qu'une erreur s'est produite (XAMPP n'est pas lancé, le nom de la base de donnée n'est pas bon, vous avez mis un mot de passe sur le compte root, etc.<br/>";
        echo "<div style='color:red;'>".$ex->getMessage()."</div>";
    }

?>

<head>
        
<title>BIOCAL</title>
        
<meta charset="utf-8">
        
<link rel="stylesheet" type="text/css" href="sourcecode.css">
    
</head>
    

<body>

        
<ul class="menu">
  
<li class="menu"><a  href="index.php">Accueil</a></li>
        
<li class="menu"><a class="active" href="bilans.php">Bilan Ventes</a></li>
  
                       
<li class="menu"><a href="fiches.php">Générer Fiches</a></li>
            
<li class="menu"><a href="stock.php">Gestion Stocks</a></li>
        
<li class="menu"><a href="commandes.php">Suivi Commande</a></li>
     
<li class="menu"><a href="ajouter.php">Mise à jour</a></li>
     
</ul> 


<div id="global">
<h1>           Bilan des ventes           </h1>
Cette page vous permet de générer des bilans de ventes selon une catégorie ou une année précise. 
</div>
</body>

<div id="container">
<div class="formulaire">

<div id="contenu">
<h2>   Consulter les ventes par catégorie  </h2>
</div>

<form action="bilans.php" method="POST">
<form class="form_style">

    Catégorie :  <select name="Categorie">
	    <option value="">--Choisissez une catégorie --</option>
         <option value="cremerie">Crèmerie</option>
         <option value="epicerie salee">Epicerie salée</option>
         <option value="epicerie sucree">Epicerie sucrée</option>
		 <option value="fruits et legumes">Fruits et légumes</option>
		 <option value="viande et poisson">Viandes et poissons</option>
     </select>
	
	 <input type="hidden" name="action" value="filterShowData">
	 <input type="submit" value="Afficher le bilan" class="bouton">
	 </form>
</form>
	 
	 
<style>
    table {
        border-collapse: collapse;  /* Pour fusionner les bordures des cases*/
	
    }
	th {
		background-color: #F66913; /* Fond de la case*/
		border: 5px solid #F66913; /* Bordure des cases*/
        	padding: 8px; 
	}

    	td{
        	border: 5px solid #F66913; /* Bordure des cases*/
        	padding: 8px; 
    }
</style>
	 
<?php
//Requete SQL Select from

    if (filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING) === "filterShowData") { // La fonction filter_input permet d'accéder de manière sécurisé aux valeurs de $_POST.

        // On récupère la valeur du champ du formulaire
        $Categorie = filter_input(INPUT_POST, "Categorie", FILTER_SANITIZE_STRING);
		
		print "<br><div style='color:green;font-weight : bolder;' align='justify'>Bilan pour la catégorie $Categorie:</div><br/>";
		

        // On rajoute % devant et derrière car % est le caractère JOKER de l'opérateur LIKE
        $Categorie = "%".$Categorie."%";

        // On utilise l'opérateur LIKE qui tolère la présence de JOKER (%)
        $sql = "SELECT sum(achats.Quantité*produits.Prix) AS 'Montant total des ventes de la categorie' FROM achats INNER JOIN produits ON produits.ID_Produit=achats.ID_Produit WHERE produits.categories_produit LIKE :Categorie ;";
	

        $statement = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement->bindParam(':Categorie', $Categorie);

        try {
            $response = $statement->execute(); // Execution de la requête a proprement parlé.

            // ATTENTION, lorsqu'on utilise un $statement, il faut appliquer le fetchAll sur l'objet $statement et non $response !
            $output = $statement->fetchAll(PDO::FETCH_CLASS); // L'option PDO::FETCH_CLASS récupère les données sous forme de tableau associatif
            //echo "<br>Si vous voyez ce message, c'est que tout s'est bien passé.<br/>";
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
    } else {
        echo 'Veuillez sélectionner la catégorie dans le menu déroulant ci-dessus puis cliquez sur "Afficher le bilan" pour visualiser le bilan des ventes dans cette catégorie de produits.';
    }
	
	if (filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING) === "filterShowData") { // La fonction filter_input permet d'accéder de manière sécurisé aux valeurs de $_POST.

        // On récupère la valeur du champ du formulaire
        $Categorie = filter_input(INPUT_POST, "Categorie", FILTER_SANITIZE_STRING);
		
		print "<br><div style='color:green;font-weight : bolder;' align='justify'>Détails des ventes de la catégorie $Categorie:</div><br/>";
		

        // On rajoute % devant et derrière car % est le caractère JOKER de l'opérateur LIKE
        $Categorie = "%".$Categorie."%";

        // On utilise l'opérateur LIKE qui tolère la présence de JOKER (%)
        $sql = "SELECT commandes.Date AS 'Date de lachat',clients.Nom AS 'Nom du client', produits.Nom As 'Article', produits.sous_categories_produit AS 'Sous catégorie', (achats.Quantité*produits.Prix) AS ' Montant de lachat' FROM achats INNER JOIN produits ON produits.ID_Produit=achats.ID_produit INNER JOIN commandes ON commandes.ID_Commande=achats.ID_commande INNER JOIN clients ON commandes.ID_Client=clients.ID_client WHERE produits.categories_produit LIKE :Categorie ;";
	

        $statement = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement->bindParam(':Categorie', $Categorie);

        try {
            $response = $statement->execute(); // Execution de la requête a proprement parlé.

            // ATTENTION, lorsqu'on utilise un $statement, il faut appliquer le fetchAll sur l'objet $statement et non $response !
            $output = $statement->fetchAll(PDO::FETCH_CLASS); // L'option PDO::FETCH_CLASS récupère les données sous forme de tableau associatif
            //echo "<br>Si vous voyez ce message, c'est que tout s'est bien passé.<br/>";
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
    } else {
       
    }
	
	
?>	 
	 
</div>

<div class="formulaire">

<div id="contenu">
<h2>   Consulter les ventes par année  </h2>
</div>


<form action2='#showFiltered' method="POST">
        <input type="hidden" name="action2" value="filterShowData2">
    Année: <input type="text" name="nameFilter2">
        <input type="submit" value="Afficher le bilan" class="bouton">
    </form>
	
<?php
//Requete SQL Select from

    if (filter_input(INPUT_POST, "action2", FILTER_SANITIZE_STRING) === "filterShowData2") { // La fonction filter_input permet d'accéder de manière sécurisé aux valeurs de $_POST.

        // On récupère la valeur du champ du formulaire
        $nameFilter2 = filter_input(INPUT_POST, "nameFilter2", FILTER_SANITIZE_STRING);

        // On rajoute % devant et derrière car % est le caractère JOKER de l'opérateur LIKE
        $nameFilter2 = "%".$nameFilter2."%";

        // On utilise l'opérateur LIKE qui tolère la présence de JOKER (%)
        $sql = "SELECT sum(achats.Quantité*produits.Prix) AS 'Montant total des achats de cette annee' FROM achats INNER JOIN produits ON produits.ID_Produit=achats.ID_Produit INNER JOIN commandes ON commandes.ID_Commande=achats.ID_Commande WHERE YEAR(commandes.Date) LIKE :nameFilter2 ;";

        $statement = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement->bindParam(':nameFilter2', $nameFilter2);

        try {
            $response = $statement->execute(); // Execution de la requête a proprement parlé.

            // ATTENTION, lorsqu'on utilise un $statement, il faut appliquer le fetchAll sur l'objet $statement et non $response !
            $output = $statement->fetchAll(PDO::FETCH_CLASS); // L'option PDO::FETCH_CLASS récupère les données sous forme de tableau associatif
            //echo "Si vous voyez ce message, c'est que tout s'est bien passé.<br/>";
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
    } else {
        echo 'Veuillez saisir l`année (ex: 2019) dans le champ ci-dessus, puis appuyez sur "Afficher le bilan" pour consulter le bilan des ventes de cette année.';
    }
	
	

	echo '<br>';
	    if (filter_input(INPUT_POST, "action2", FILTER_SANITIZE_STRING) === "filterShowData2") { // La fonction filter_input permet d'accéder de manière sécurisé aux valeurs de $_POST.

        // On récupère la valeur du champ du formulaire
        $nameFilter2 = filter_input(INPUT_POST, "nameFilter2", FILTER_SANITIZE_STRING);

        // On rajoute % devant et derrière car % est le caractère JOKER de l'opérateur LIKE
        $nameFilter2 = "%".$nameFilter2."%";
	        // On utilise l'opérateur LIKE qui tolère la présence de JOKER (%)
        $sql = "SELECT produits.categories_produit AS 'Catégories',sum(achats.Quantité*produits.Prix) AS 'Montant total des ventes' FROM achats INNER JOIN produits ON produits.ID_Produit=achats.ID_Produit INNER JOIN commandes ON commandes.ID_Commande=achats.ID_Commande WHERE YEAR(commandes.Date) LIKE :nameFilter2 GROUP BY produits.categories_produit ;";

        $statement = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement->bindParam(':nameFilter2', $nameFilter2);

        try {
            $response = $statement->execute(); // Execution de la requête a proprement parlé.

            // ATTENTION, lorsqu'on utilise un $statement, il faut appliquer le fetchAll sur l'objet $statement et non $response !
            $output = $statement->fetchAll(PDO::FETCH_CLASS); // L'option PDO::FETCH_CLASS récupère les données sous forme de tableau associatif
            //echo "Si vous voyez ce message, c'est que tout s'est bien passé.<br/>";
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
    } else {
        
    }	
	
?>
</div>
</div>