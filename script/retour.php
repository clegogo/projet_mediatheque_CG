<?php

	//connexion à la BDD ($bdd)
	Require ("base.php");
	try {
        //Vérifie si utilisateur connecté
		if (!isset($_GET["id_util"]) | $_GET["id_util"] == '') {
			$rep= "1";
            header("Location: ../retourner.php?rep=$rep");
            exit();
        }

        //Vérifie si l'id d'un ouvrage a été soumis
        if (!isset($_GET["id_ouv"]) | $_GET["id_ouv"] == '') {
            $rep = "2";
            header("Location: ../retourner.php?rep=$rep");
            exit();
        }

        //Récupère les id utilisateur + ouvrage
		$utilisateur = $_GET["id_util"];
		$ouvrage=$_GET["id_ouv"];
        
		//Vérifie si l'ouvrage est emprunté par l'utilisateur
        $select="select * from `emprunte` where id_utilisateur_Utilisateur= :idu and id_officielle_Ouvrage= :ido and en_cours_Emprunt = true";
        $requete = $bdd->prepare($select) ;
        if ( !$requete ) { 		
            throw new PDOException('Erreur lors de la préparation de la requête');
        }
        $res = $requete->bindParam(':idu',$utilisateur,PDO::PARAM_INT);
        $res = $requete->bindParam(':ido',$ouvrage,PDO::PARAM_STR);
        if ($res == null) { 			
            throw new Exception('Erreur lors de l’attachement de la variable à la requête') ;
        } 
        $requete ->execute();
        if ($requete == null) {			 
            throw new Exception('Erreur lors de l’execution de la requête') ;
        }
        $res = $requete->fetch(PDO::FETCH_ASSOC);	

        /* OUVRAGE NON EMPRUNTE */
        if ( empty($res)) { 
            $requete->closeCursor(); 
            $rep = "3";
			header("Location: ../retourner.php?rep=$rep");
        }
        /* OUVRAGE EMPRUNTE */  
        else {
            $id= $res['id_emprunt_Ouvrage'];
            $requete->closeCursor(); 

            //Requête de mise à jour de l'emprunt 
            $update="update `emprunte` set date_retour_Emprunt= :date, en_cours_Emprunt = False where id_emprunt_Ouvrage = :id";
            $requete = $bdd->prepare($update);
            if ( !$requete ) { 		
                throw new PDOException('Erreur lors de la préparation de la requête');
            }
            
            //Attache les variables aux paramètres de la requête
            $res = $requete->bindParam(':id',$id,PDO::PARAM_INT);
            $res = $requete->bindValue(':date',date('Y-m-d H:i:s', strtotime("now")),PDO::PARAM_STR);
            if ($res == null) { 			
                throw new Exception('Erreur lors de l’attachement de la variable à la requête') ;
            }
            $requete ->execute();
            $rep ="4";
            header("Location: ../retourner.php?rep=$rep");   
		}
		$bdd = null; 
    }
	catch(PDOException $e) {
		$msg = 'Erreur PDO  :'.$e->getFile(). ' Ligne. '.$e->getLine();	
		echo $msg;
    }   
?>