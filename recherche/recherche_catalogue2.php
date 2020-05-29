<?php

include('conn.php');

$numeroLangue = $_GET['numLangue'];
$Type = $_GET['type'];


//requête type/langue
$reponseSimple = $bdd->query("SELECT titre_Ouvrage FROM ouvrage WHERE code_langue_Langue = '$numeroLangue'
 AND id_type_ouvrage_Type_ouvrage = '$Type';");

if ($reponseSimple == null) {
    throw new PDOException('Erreur lors de la préparation de la requête simple');
}

if ($reponseSimple != null) {
    while ($donnees = $reponseSimple->fetch()) {
        echo '<tr>';
        echo '<td>' . $donnees["titre_Ouvrage"] . '</td>' . '<br />';
        echo '<tr/>';
    }
}

