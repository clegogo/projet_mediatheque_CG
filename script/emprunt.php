<?php

	//connexion à la BDD ($bdd)
	Require ("base.php");
	try {
        //Vérifie si utilisateur connecté
		if (!isset($_GET["id_util"]) | $_GET["id_util"] == '') {
            $rep= "1";
               header("Location: ../emprunter.php?rep=$rep");
               exit();
        }
        

        //Vérifie si l'id d'un ouvrage a été soumis
        if (!isset($_GET["id_ouv"]) | $_GET["id_ouv"] == '') {
            $rep = "2";
            header("Location: ../emprunter.php?rep=$rep");
            exit();
        }
       

        //Récupère les id utilisateur + ouvrage
		$utilisateur = $_GET["id_util"];
		$ouvrage=$_GET["id_ouv"];
        
		//Vérifie si l'ouvrage existe dans le catalogue
		$select="select * from `ouvrage` where id_officielle_Ouvrage= :id;";
		$requete = $bdd->prepare($select) ;
		if ( !$requete ) { 		
			throw new PDOException('Erreur lors de la préparation de la requête') ;
		}
		$res = $requete->bindParam(':id',$ouvrage,PDO::PARAM_STR);
		if ($res == null) { 			
			throw new Exception('Erreur lors de l’attachement de la variable à la requête');
		}
		$requete ->execute();
		if ($requete == null) {			 
			throw new Exception('Erreur lors de l’execution de la requête') ;
		}
        $res = $requete->fetch();

        /* OUVRAGE N'EXISTE PAS */
		if (empty($res)) {
			$rep = "3";
            header("Location: ../emprunter.php?rep=$rep");
            exit();
        }
        
        /* OUVRAGE EXISTE */
        //Vérifie si l'ouvrage est disponible
        $select="select * from `emprunte` where id_officielle_Ouvrage= :id and en_cours_Emprunt = true";
        $requete = $bdd->prepare($select) ;
        if ( !$requete ) { 		
            throw new PDOException('Erreur lors de la préparation de la requête');
        }
        $res = $requete->bindParam(':id',$ouvrage,PDO::PARAM_STR);
        if ($res == null) { 			
            throw new Exception('Erreur lors de l’attachement de la variable à la requête') ;
        }
        $requete ->execute();
        if ($requete == null) {			 
            throw new Exception('Erreur lors de l’execution de la requête') ;
        }
        $res = $requete->fetch(PDO::FETCH_ASSOC);	
    
        /* OUVRAGE NON DISPONIBLE */
        if ( !empty($res)) { 
            $date = date('d-m-Y ', strtotime($res['date_retour_prevu_Emprunt']));
            $requete->closeCursor(); 
            $rep = "4:".$date;
            header("Location: ../emprunter.php?rep=$rep");
        }
        /* OUVRAGE DISPONIBLE */  
        else {
            $requete->closeCursor(); 

            //Requête d'insertion d'un emprunt 
            $insert="insert into `emprunte` (id_utilisateur_Utilisateur, id_officielle_Ouvrage, date_retrait_Emprunt, date_retour_prevu_Emprunt, en_cours_Emprunt )
                    values (:id_util, :id_ouv, :date_retrait, :date_retour, True)";
            $requete = $bdd->prepare($insert);
            if ( !$requete ) { 		
                throw new PDOException('Erreur lors de la préparation de la requête');
            }
            
            //Attache les variables aux paramètres de la requête
            $durée_pret = "+2 weeks";		
            $res = $requete->bindParam(':id_util',$utilisateur,PDO::PARAM_INT);
            $res = $requete->bindParam(':id_ouv',$ouvrage,PDO::PARAM_STR);
            $res = $requete->bindValue(':date_retrait',date('Y-m-d H:i:s', strtotime("now")),PDO::PARAM_STR);
            $res = $requete->bindValue(':date_retour',date('Y-m-d H:i:s', strtotime($durée_pret)),PDO::PARAM_STR);
            if ($res == null) { 			
                throw new Exception('Erreur lors de l’attachement de la variable à la requête') ;
            }
            $requete ->execute();
            $date = date('d-m-Y ', strtotime($durée_pret));
            $rep ="5:".$date;
            header("Location: ../emprunter.php?rep=$rep");   
		}
		$bdd = null; 
    }
	catch(PDOException $e) {
		$msg = 'Erreur PDO  :'.$e->getFile(). ' Ligne. '.$e->getLine();	
		echo $msg;
    }   
?>