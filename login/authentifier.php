<?php 

 function authentification($message) {
	header("WWW-Authenticate: Basic realm=$message");
	header('HTTP/1.0 401 Unauthorized');
	include('authentifier-erreur.php'); // Si annuler
	exit;
	}
   if (!isset($_SERVER['PHP_AUTH_USER'])) {
	authentification('Login');
	} else {
	    $identifiant = $_SERVER['PHP_AUTH_USER'];
		$mot_de_passe = $_SERVER['PHP_AUTH_PW'];
	
	header('location: connect.html');
	exit;
	
	}
?>