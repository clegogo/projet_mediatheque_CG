<?php
      // session_name(         "MEDIATHEQUE"                   );
      session_name($_COOKIE["session_name"]);
      session_start ();
         
          echo '$_SESSION session_id = '.$_SESSION["session_id"].'<br />';
          echo 'session_id() = '.session_id().'<br />';
          echo 'session_name() = '.session_name().'<br />';

          echo "\$_COOKIE['Mediatheque'] = {$_COOKIE['session_name']} <br />";
		 
		 
		 
		 
		 
            
	 if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) 
     {   echo '<html>'; 
          echo '<head>'; 
          echo '<title>Page de notre section membre</title>'; 
          echo '</head>'; 
          echo '<body>'; 
          echo 'Votre login est '.$_SESSION['login'].' et votre mot de passe est '.$_SESSION['pwd'].'.'; 
          echo '<br />'; 
          echo '<a href="./logout.php">Déconnexion</a>';  
      }   else {   echo 'Les variables ne sont pas déclarées.';  }  
    ?>
	<?php
      // session_name(         "MEDIATHEQUE"                   );
      
     
      session_name($_COOKIE["session_name"]);
      session_start ();
      

          echo '$_SESSION session_id = '.$_SESSION["session_id"].'<br />';
          echo 'session_id() = '.session_id().'<br />';
          echo 'session_name() = '.session_name().'<br />';

          echo "\$_COOKIE['Mediatheque'] = {$_COOKIE['session_name']} <br />";
		 
		 
          
		 
		 
		 
            
	 if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) 
     {   echo '<html>'; 
          echo '<head>'; 
          echo '<title>Page de notre section membre</title>'; 
          echo '</head>'; 
          echo '<body>'; 
          // echo '<br />';
          // echo 'Voici la clé:';
          // echo '<br />';
          // echo '<br />';
          // echo 'Votre login est '.$_SESSION['login'].' et votre mot de passe est '.$_SESSION['pwd'].'.'; 
          echo '<br />';
          echo password_hash($_SESSION['pwd'], PASSWORD_DEFAULT);  //Affich le mot de passe crypté
          echo '<br />';
          echo "Le mot de passe est bien crypté";
          echo '<br />'; 
          echo '<br />'; 
          echo '<a href="./logout.php">Déconnexion</a>';  
      }   else {   echo 'Les variables ne sont pas déclarées.';  }  

     

    ?>