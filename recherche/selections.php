<?php

include('conn.php');

$requete = $_GET['requete'];

$numeroLangue = $_GET['numLangue'];
$reponse = $bdd->query("SELECT nom_langue_Langue FROM langue WHERE code_langue_Langue = $numeroLangue ");

while ($donnees = $reponse->fetch()) {
    echo '<tr>';
    echo '<td>' . $donnees["nom_langue_Langue"] . '</td>' . '<br />';
    echo '<tr/>';
}



$reponse->closeCursor();