<?php
include('conn.php');

$requete = $_GET['requete'];


$reponse = $bdd->query("SELECT * FROM ouvrage WHERE titre_Ouvrage LIKE '$requete%'");

while ($donnees = $reponse->fetch())
{
    echo $donnees['titre_Ouvrage'].'<br />';
}

$reponse->closeCursor();
