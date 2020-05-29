<?php

	//connexion à la BDD ($bdd)
	Require ("base.php");
	try {
        //Vérifie si utilisateur connecté
		if (!isset($_GET["id"]) | $_GET["id"] == '') {
               header("Location: ../emprunts.html");
               exit();
        }
		$utilisateur = $_GET["id"];
        
        // Requête dans la BDD
        $select="select * from `emprunte`, `ouvrage` where emprunte.id_officielle_Ouvrage = ouvrage.id_officielle_Ouvrage and id_utilisateur_Utilisateur= :id";
        $requete = $bdd->prepare($select) ;
        if ( !$requete ) { 		
            throw new PDOException('Erreur lors de la préparation de la requête');
        }
        $res = $requete->bindParam(':id',$utilisateur,PDO::PARAM_INT);
        if ($res == false) { 			
            throw new Exception('Erreur lors de l’attachement de la variable à la requête') ;
        }
        $requete ->execute();
        if ($requete == false) {			 
            throw new Exception('Erreur lors de l’execution de la requête') ;
        }
        $res = $requete->fetchall(PDO::FETCH_ASSOC);	
        echo (json_encode($res));

		$bdd = null; 
    }
	catch(PDOException $e) {
		$msg = 'Erreur PDO  :'.$e->getFile(). ' Ligne. '.$e->getLine();	
		echo $msg;
    }   
?>