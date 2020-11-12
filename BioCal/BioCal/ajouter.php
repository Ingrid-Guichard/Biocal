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
        
<li class="menu"><a href="commandes.php">Suivi Commande</a></li>
     
<li class="menu"><a class="active" href="ajouter.php">Mise à jour</a></li>


</li>
            
</ul>  

        

<div id="global">
<h1>    METTRE LA BASE DE DONNEES A JOUR    </h1> 
</div>
</body>

<div id="container">
<div class="formulaire">

<div id="contenu">
<h2> Ajouter un client </h2>
</div>

<form action='#showFiltered' method="POST">
<form class="form_style">

        <label for="nom" >Nom :</label> 
        <input type="text" name="nameFilter" class="inputbasic"><br/>
        <label for="prénom" >Pénom :</label> 
        <input type="text" name="surnameFilter" class="inputbasic"><br/>
	<label for="adresse" >Adresse :</label> 
        <input type="text" name="adressFilter" class="inputbasic"><br/>
        <label for="code" >Code_postal :</label>
        <input type="text" name="codeFilter" class="inputbasic"><br/>
	<label for="ville" >Ville :</label> 
        <input type="text" name="villeFilter" class="inputbasic"><br/>
        <label for="pays" >Pays :</label> 
        <input type="text" name="paysFilter" class="inputbasic"><br/>
	<label for="tel" >Téléphone :</label> 
        <input type="text" name="telFilter" class="inputbasic"><br/>
        <label for="email" >email :</label> 
        <input type="text" name="emailFilter" class="inputbasic"><br/>
	<label for="compte" >compte :</label>
        <input type="text" name="compteFilter" class="inputbasic"><br/>

        <input type="submit" value="Ajouter un client" class="bouton">

    </form>
</form>


<?php
//Requete SQL insert into

    if (filter_input(INPUT_POST, "action1", FILTER_SANITIZE_STRING) === "filterShowData") { 
	
	$sql = "INSERT INTO `clients`(Nom, Prénom, Adresse, Code_postal, Ville, Pays, Telephone, email, compte_fidelite) VALUES (:nameFilter, :surnameFilter, :adressFilter, :codeFilter, :villeFilter, :paysFilter, :telFilter, :emailFilter, :compteFilter);";
	$statement = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        
$nameFilter = filter_input(INPUT_POST, "nameFilter", FILTER_SANITIZE_STRING);
$statement->bindParam(':nameFilter', $nameFilter);
$surnameFilter = filter_input(INPUT_POST, "surnameFilter",FILTER_SANITIZE_STRING);
$statement->bindParam(':surnameFilter', $surnameFilter);	
$adressFilter = filter_input(INPUT_POST, "adressFilter", FILTER_SANITIZE_STRING);
$statement->bindParam(':adressFilter', $adressFilter);
$codeFilter = filter_input(INPUT_POST, "codeFilter", FILTER_SANITIZE_STRING);
$statement->bindParam(':codeFilter', $codeFilter);
$villeFilter = filter_input(INPUT_POST, "villeFilter", FILTER_SANITIZE_STRING);
$statement->bindParam(':villeFilter', $villeFilter);
$paysFilter = filter_input(INPUT_POST, "paysFilter", FILTER_SANITIZE_STRING);
$statement->bindParam(':paysFilter', $paysFilter);
$telFilter = filter_input(INPUT_POST, "telFilter", FILTER_SANITIZE_STRING);
$statement->bindParam(':telFilter', $telFilter);
$emailFilter = filter_input(INPUT_POST, "emailFilter", FILTER_SANITIZE_STRING);
$statement->bindParam(':emailFilter', $emailFilter);
$compteFilter = filter_input(INPUT_POST, "compteFilter", FILTER_SANITIZE_STRING);
$statement->bindParam(':comtpeFilter', $compteFilter);

        try {
            $response = $statement->execute();      
            $output = $statement->fetchAll(PDO::FETCH_CLASS); 
            echo "Si vous voyez ce message, c'est que tout s'est bien passé.<br/>";
            } 
	    catch (PDOException $ex) {
            echo "Quelque chose s'est mal passé. Avez-vous bien envoyé tous les champs ?";
            echo "<div style='color:red;'>" . $ex->getMessage() . "</div>";
            }

 
        echo '<br/>Veuillez remplir et soumettre le formulaire ci-dessus pour rechercher un fournisseur.';
    }
?>


</div>

<div class="formulaire">

<div id="contenu">
<h2> Ajouter un producteur </h2>
</div>

<form action='#showFiltered' method="POST">
<form class="form_style">

        <label for="nom" >Nom :</label> 
        <input type="text" name="nameFilter1" class="inputbasic"><br/>
	<label for="adresse" >Adresse :</label> 
        <input type="text" name="adressFilter1" class="inputbasic"><br/>
       
        <input type="submit" value="Ajouter un producteur" class="bouton">

    </form>
</form>


<?php
//Requete SQL insert into

    if (filter_input(INPUT_POST, "action1", FILTER_SANITIZE_STRING) === "filterShowData") { 
	
	$sql = "INSERT INTO `producteurs`(Nom, Adresse) VALUES (:nameFilter1, :adressFilter1);";
	$statement = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        
$nameFilter1 = filter_input(INPUT_POST, "nameFilter1", FILTER_SANITIZE_STRING);
$statement->bindParam(':nameFilter1', $nameFilter1);	
$adressFilter1 = filter_input(INPUT_POST, "adressFilter1", FILTER_SANITIZE_STRING);
$statement->bindParam(':adressFilter1', $adressFilter1);

        try {
            $response = $statement->execute();      
            $output = $statement->fetchAll(PDO::FETCH_CLASS); 
            echo "Si vous voyez ce message, c'est que tout s'est bien passé.<br/>";
            } 
	    catch (PDOException $ex) {
            echo "Quelque chose s'est mal passé. Avez-vous bien envoyé tous les champs ?";
            echo "<div style='color:red;'>" . $ex->getMessage() . "</div>";
            }

 
        echo '<br/>Veuillez remplir et soumettre le formulaire ci-dessus pour rechercher un fournisseur.';
    }
?>

</div>

<div class="formulaire">

<div id="contenu">
<h2> Ajouter un produit </h2>
</div>

<form action='#showFiltered' method="POST">
<form class="form_style">

        <label for="nom" >Nom :</label> 
        <input type="text" name="nameFilter2" class="inputbasic"><br/>
        <label for="description" >Description :</label> 
        <input type="text" name="descriptionFilter" class="inputbasic"><br/>
	<label for="prix" >Prix :</label> 
        <input type="text" name="prixFilter" class="inputbasic"><br/>
        <label for="quantite" >Quantité :</label> 
        <input type="text" name="qteFilter" class="inputbasic"><br/>
	<label for="categorie_pdt" >Catégorie :</label> 
        <input type="text" name="catego_pdtFilter" class="inputbasic"><br/>
        <label for="sous_categorie_produit" >Sous_Catégorie :</label> 
        <input type="text" name="ss_catego_pdtFilter" class="inputbasic"><br/> 

        <input type="submit" value="Ajouter un produit" class="bouton">

    </form>
</form>


<?php
//Requete SQL insert into

    if (filter_input(INPUT_POST, "action1", FILTER_SANITIZE_STRING) === "filterShowData") { 
	
	$sql = "INSERT INTO `produits`(Nom, Description, Prix, Quantité, categories_produit, sous_categories_produit) VALUES (:nameFilter2, :descriptionFilter, :prixFilter, :qteFilter, :catego_pdtFilter, :ss_catego_pdt);";
	$statement = $bdd->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        
$nameFilter2 = filter_input(INPUT_POST, "nameFilter2", FILTER_SANITIZE_STRING);
$statement->bindParam(':nameFilter2', $nameFilter2);
$descriptionFilter = filter_input(INPUT_POST, "descriptionFilter",FILTER_SANITIZE_STRING);
$statement->bindParam(':descriptionFilter', $descriptionFilter);	
$prixFilter = filter_input(INPUT_POST, "prixFilter", FILTER_SANITIZE_STRING);
$statement->bindParam(':prixFilter', $prixFilter);
$qteFilter = filter_input(INPUT_POST, "qteFilter", FILTER_SANITIZE_STRING);
$statement->bindParam(':qteFilter', $qteFilter);
$catego_pdtFilter = filter_input(INPUT_POST, "catego_pdtFilter", FILTER_SANITIZE_STRING);
$statement->bindParam(':catego_pdtFilter', $catego_pdtFilter);
$ss_catego_pdtFilter = filter_input(INPUT_POST, "ss_catego_pdtFilter", FILTER_SANITIZE_STRING);
$statement->bindParam(':ss_catego_pdtFilter', $ss_catego_pdtFilter);
$telFilter = filter_input(INPUT_POST, "telFilter", FILTER_SANITIZE_STRING);

        try {
            $response = $statement->execute();      
            $output = $statement->fetchAll(PDO::FETCH_CLASS); 
            echo "Si vous voyez ce message, c'est que tout s'est bien passé.<br/>";
            } 
	    catch (PDOException $ex) {
            echo "Quelque chose s'est mal passé. Avez-vous bien envoyé tous les champs ?";
            echo "<div style='color:red;'>" . $ex->getMessage() . "</div>";
            }

 
        echo '<br/>Veuillez remplir et soumettre le formulaire ci-dessus pour rechercher un fournisseur.';
    }
?>

</div>

</div>


