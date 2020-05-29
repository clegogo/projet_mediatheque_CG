<?php
include('conn.php');

$reponse = $bdd->query("SELECT titre_Ouvrage FROM ouvrage WHERE id_univers_Univers =2");

if ($reponse == null ) {
    throw new PDOException('Erreur lors de la préparation de la requête');
}

while ($donnees = $reponse->fetch()) {
    echo '<tr>';
    echo '<td>' . $donnees["titre_Ouvrage"] . '</td>' . '<br />';
    echo '<tr/>';
}

$reponse->closeCursor();