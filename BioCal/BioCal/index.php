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
        
<title>BIOCAL</title>
        
<meta charset="utf-8">
        
<link rel="stylesheet" type="text/css" href="sourcecode.css">
    
</head>
    

<body>

        
<ul class="menu">
            
<li class="menu"><a class="active" href="index.php">Accueil</a></li>
            
<li class="menu"><a href="bilans.php">Bilan Ventes</a></li>
                       
<li class="menu"><a href="fiches.php">Générer Fiches</a></li>
            
<li class="menu"><a href="stock.php">Gestion Stocks</a></li>
        
<li class="menu"><a href="commandes.php">Suivi Commande</a></li>
     
<li class="menu"><a href="ajouter.php">Mise à jour</a></li>
     
</ul>    

        
<h1>Bienvenue sur Biocal! </h1>
        
      
<p>Bienvenue sur le sie internet de BioCal. Cet outil vous permettra de garder un oeil sur vos commandes, 
	vos stocks et de pouvoir facilement mettre vos listes produits et clients. </p> 
  
      
<img	src="images/BioCal.png"
	alt="Le bio Made in France"
/>
  
</body>

</html> 