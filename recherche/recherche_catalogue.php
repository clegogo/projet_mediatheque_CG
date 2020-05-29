<?php

include('conn.php');

$nomAuteur = $_GET['nom_auteur'];
$nomEditeur = $_GET['nom_editeur'];


//requete nom auteur
$requeteEcrite = $bdd->query("SELECT titre_Ouvrage FROM ouvrage 
WHERE id_officielle_Ouvrage = (
SELECT id_officielle_Ouvrage FROM cree_par WHERE id_createur_Createur = (
SELECT id_createur_Createur FROM createur WHERE nom_createur_Createur LIKE '%$nomAuteur%'))");


if ($requeteEcrite != null) {
    while ($donnees = $requeteEcrite->fetch()) {
        echo '<tr>';
        echo '<td>' . $donnees["titre_Ouvrage"] . '</td>' . '<br />';
        echo '<tr/>';
    }
}

//requete editeur
$requeteEditeur = $bdd->query("SELECT titre_Ouvrage FROM ouvrage
WHERE id_officielle_Ouvrage = (
SELECT id_officielle_Ouvrage FROM edite_par WHERE id_editeur_Editeur = (
SELECT id_editeur_Editeur FROM editeur WHERE nom_editeur_Editeur LIKE '%$nomEditeur%'))");




if ($requeteEditeur != null) {
    while ($donnees = $requeteEditeur->fetch()) {
        echo '<tr>';
        echo '<td>' . $donnees["titre_Ouvrage"] . '</td>' . '<br />';
        echo '<tr/>';
    }
}