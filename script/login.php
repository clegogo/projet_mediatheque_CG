<?php
$login_valide = "test@test.fr";
$pwd_valide = "bonjour";

if (isset($_POST['login']) && isset($_POST['pwd'])) {
  if ($login_valide == $_POST['login'] && $pwd_valide == $_POST['pwd']) {
    session_start();
    $_SESSION['session_id'] = true;
    header('location: ../index2.html');
    
  } else {
    echo '<body onLoad="alert(\'Membre non reconnu...\')">';
    echo '<meta http-equiv="refresh" content="0;URL=../membres.html">';
  }
} else {
  echo 'Les variables du formulaire ne sont pas déclarées.';
}
