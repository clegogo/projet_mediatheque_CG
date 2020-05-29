<?php

include('conn.php');


$nomAuteur = $_GET['nom_auteur'];
$nomEditeur = $_GET['nom_editeur'];
$numeroLangue = $_GET['numLangue'];
$Type = $_GET['type'];
$univers = $_GET['univers'];
$categorie = $_GET['categorie'];
$reponse = $bdd->query("SELECT titre_Ouvrage FROM ouvrage
WHERE code_langue_Langue = '$numeroLangue'
AND id_officielle_Ouvrage = (SELECT id_officielle_Ouvrage FROM cree_par WHERE id_createur_Createur = (SELECT id_createur_Createur FROM createur WHERE nom_createur_Createur = '$nomAuteur'))
AND titre_Ouvrage LIKE '%$nomAuteur%';");

if ($reponse == null ) {
    throw new PDOException('Erreur lors de la préparation de la requête');
}

if ($reponse != null) {
    while ($donnees = $reponse->fetch()) {
        echo '<tr>';
        echo '<td>' . $donnees["titre_Ouvrage"] . '</td>' . '<br />';
        echo '<tr/>';

    }
}


//requete nom auteur
$requeteEcrite = $bdd->query("SELECT titre_Ouvrage FROM ouvrage 
WHERE id_officielle_Ouvrage = (
SELECT id_officielle_Ouvrage FROM cree_par WHERE id_createur_Createur = (
SELECT id_createur_Createur FROM createur WHERE nom_createur_Createur = '$nomAuteur'))");

if ($requeteEcrite == null) {
    throw new PDOException('Erreur lors de la préparation de la requête simple');
}

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

if ($requeteEditeur == null) {
    throw new PDOException('Erreur lors de la préparation de la requête simple');
}

if ($requeteEditeur != null) {
    while ($donnees = $requeteEditeur->fetch()) {
        echo '<tr>';
        echo '<td>' . $donnees["titre_Ouvrage"] . '</td>' . '<br />';
        echo '<tr/>';
    }
}


//requête choix "ou"
 $reponseSimple = $bdd->query("SELECT titre_Ouvrage FROM ouvrage WHERE code_langue_Langue = '$numeroLangue'
 OR id_type_ouvrage_Type_ouvrage = '$Type'
 OR id_categorie_Categorie = '$categorie';");

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


// découverte par univers
$decouverte = $bdd->query("SELECT titre_Ouvrage FROM ouvrage WHERE id_univers_Univers = '$univers';");

if ($decouverte == null) {
    throw new PDOException('Erreur lors de la préparation de la requête simple');
}

if ($decouverte != null) {
    while ($donnees = $decouverte->fetch()) {
        echo '<tr>';
        echo '<td>' . $donnees["titre_Ouvrage"] . '</td>' . '<br />';
        echo '<tr/>';
    }
}


// requête avec type d'ouvrage, langue et catégorie

$reponse5select = $bdd->query("SELECT titre_Ouvrage FROM ouvrage WHERE code_langue_Langue = '$numeroLangue'
AND id_type_ouvrage_Type_ouvrage = '$Type'
AND id_categorie_Categorie = '$categorie';");





if ($reponse5select != null) {
    while ($donnees = $reponse5select->fetch()   ) {
        echo '<tr>';
        echo '<td>' . $donnees["titre_Ouvrage"] . '</td>' . '<br />';
        echo '<tr/>';
    }

}


$reponse->closeCursor();