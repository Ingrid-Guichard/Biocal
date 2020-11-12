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
              
<li class="menu"><a class="active" href="fiches.php">Générer Fiches</a></li>
                     
<li class="menu"><a href="stock.php">Gestion Stocks</a></li>
        
<li class="menu"><a href="commandes.php">Suivi Commande</a></li>
     
<li class="menu"><a href="ajouter.php">Mise à jour</a></li>
  

</li>
            
</ul>  

        


<div id="global">
<h1>    GENERER UNE FICHE    </h1> 
</div>
</body>

<div id="container">
<div class="formulaire">

<div id="contenu">
<h2> Fiche Client </h2>
</div>

<form action='#showFiltered' method="POST">
	<label for="nom" >Nom client :</label> 
        <input type="hidden" name="action" value="filterShowData">
        <input type="text" name="nameFilter" class="inputbasic"></br>

        <input type="submit" value="Génerer fiche client" class="bouton">
    </form>

<style>
    table {
        border-collapse: collapse;  /* Pour fusionner les bordures des cases*/
    }

    th{
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
        $nameFilter = "%".$nameFilter."%";

        // On utilise l'opérateur LIKE qui tolère la présence de JOKER (%)
        $sql = "SELECT * FROM `clients` WHERE Nom LIKE :nameFilter ;";

        $statement = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement->bindParam(':nameFilter', $nameFilter);

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
    } else {
        echo '<br/>Veuillez remplir et soumettre le formulaire ci-dessus pour rechercher un client.';
    }
?>
</div>

<div class="formulaire">

<div id="contenu">
<h2> Fiche producteur </h2>
</div>

<form action1='#showFiltered' method="POST">

	 <label for="nom" >Nom producteur :</label> 
        <input type="hidden" name="action1" value="filterShowData">
        <input type="text" name="nameFilter1" class="inputbasic"></br>
        <input type="submit" value="Génerer fiche fournisseur" class="bouton">
    </form>

<?php
//Requete SQL Select from

    if (filter_input(INPUT_POST, "action1", FILTER_SANITIZE_STRING) === "filterShowData") { 

        $nameFilter1 = filter_input(INPUT_POST, "nameFilter1", FILTER_SANITIZE_STRING);
        $nameFilter1 = "%".$nameFilter1."%";
        $sql = "SELECT * FROM `producteurs` WHERE Nom LIKE :nameFilter1 ;";

        $statement = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement->bindParam(':nameFilter1', $nameFilter1);

        try {
            $response = $statement->execute();      
            $output = $statement->fetchAll(PDO::FETCH_CLASS); 
            echo "Si vous voyez ce message, c'est que tout s'est bien passé.<br/>";
        } catch (PDOException $ex) {
            echo "Quelque chose s'est mal passé. Avez-vous bien envoyé tous les champs ?";
            echo "<div style='color:red;'>" . $ex->getMessage() . "</div>";
        }

        if (isset($output)) { 
            echo "<table>"; 

            for ($ligne = 0; $ligne < count($output); $ligne++) { 
                echo "<tr>"; 

                if ($ligne == 0) { 
                    foreach ($output[$ligne] as $index => $valeur) { 
                        echo "<th>"; 

                        echo $index; 

                        echo "</th>"; 
                    }
                    echo "</tr><tr>"; 
                }

                foreach ($output[$ligne] as $index => $valeur) { 
                    echo "<td>"; 

                    echo $valeur; 

                    echo "</td>"; 
                }

                echo "</tr>"; 
            }

            echo "</table>"; 
        }
    } else {
        echo '<br/>Veuillez remplir et soumettre le formulaire ci-dessus pour rechercher un fournisseur.';
    }
?>
</div>

<div class="formulaire">

<div id="contenu">
<h2> Fiche produit </h2>
</div>


<form action2='#showFiltered' method="POST">

	 <label for="nom" >Nom du produit:</label> 
        <input type="hidden" name="action2" value="filterShowData">
        <input type="text" name="nameFilter2" class="inputbasic"></br>

        <input type="submit" value="Génerer fiche produit" class="bouton">
    </form>

<?php
//Requete SQL Select from

    if (filter_input(INPUT_POST, "action2", FILTER_SANITIZE_STRING) === "filterShowData") { 

        $nameFilter2 = filter_input(INPUT_POST, "nameFilter2", FILTER_SANITIZE_STRING);
        $nameFilter2 = "%".$nameFilter2."%";
        $sql = "SELECT * FROM `produits` WHERE Nom LIKE :nameFilter2 ;";

        $statement = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $statement->bindParam(':nameFilter2', $nameFilter2);

        try {
            $response = $statement->execute();      
            $output = $statement->fetchAll(PDO::FETCH_CLASS); 
            echo "Si vous voyez ce message, c'est que tout s'est bien passé.<br/>";
        } catch (PDOException $ex) {
            echo "Quelque chose s'est mal passé. Avez-vous bien envoyé tous les champs ?";
            echo "<div style='color:red;'>" . $ex->getMessage() . "</div>";
        }

        if (isset($output)) { 
            echo "<table>"; 

            for ($ligne = 0; $ligne < count($output); $ligne++) { 
                echo "<tr>"; 

                if ($ligne == 0) { 
                    foreach ($output[$ligne] as $index => $valeur) { 
                        echo "<th>"; 

                        echo $index; 

                        echo "</th>"; 
                    }
                    echo "</tr><tr>"; 
                }

                foreach ($output[$ligne] as $index => $valeur) { 
                    echo "<td>"; 

                    echo $valeur; 

                    echo "</td>"; 
                }

                echo "</tr>"; 
            }

            echo "</table>"; 
        }
    } else {
        echo '<br/>Veuillez remplir et soumettre le formulaire ci-dessus pour rechercher un fournisseur.';
    }
?>

</div>
</div>