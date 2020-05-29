<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Médiathèque de quartier</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" content="Projet BTS SIO - SLAM" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style/bootstrap-dev/css/bootstrap.css" >
    <link rel="stylesheet" href="style/main.css" />
  <!-- <script type="text/javascript" src="script/emprunter.js"></script>--> 
    
</head>

<body>
  <div class="container">
    <header class="row">
          <nav class="navbar navbar-expand-md navbar-dark col-sm-12">
            <a class="navbar-brand" href="index.html">La médiathèque</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            
            <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active"><a class="nav-link" href="index.html">Accueil</a></li>
              <li class="nav-item"><a class="nav-link" href="catalogue.html">Catalogue</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Emprunts</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="emprunter.php">Emprunter</a>
                  <a class="dropdown-item" href="retourner.php">Retourner</a>
                  <a class="dropdown-item" href="emprunts.html">Mes emprunts</a>
                </div>
              </li>
            </ul>
            <a class="btn btn-warning my-2 my-sm-0" href="membres.html">Adhérents</a>
          </div>
        </nav>
    </header>
  
    <h1>Emprunter un ouvrage</h1>    
    <div class="row">
        <nav class="col-sm-2 side">   
          <p>Utilisateur</p>   
          <a href="emprunts.html" class="btn btn-success">Mes emprunts</a>
        </nav>

        <section class="col-sm-10">
          <div class="card col-sm-10 offset-1">
            <div class="card-header">
                Quel ouvrage ?
            </div>
            <div class="card-body">
              <form id="emprunt"  method="get" action="script/emprunt.php">
                <div class="form-group" style ="display:none;">
                    <label>Test utilisateur until login set up</label>
                    <input type="text" class="form-control" name="id_util" value="1">
                  </div>
                  <div class="form-group">
                    <label>ISBN</label>
                    <input type="text" class="form-control" name="id_ouv" autofocus>
                  </div>
                  <button class="btn btn-outline-success" type="submit">Envoyer</button>
              </form>
              <?php
                if (isset($_GET["rep"])) {
                  $reponse = $_GET["rep"];
                  $code = substr($reponse,0,1);
                  $date = substr($reponse,2);
                  
                  switch ($code) {
                    case 1:
                      $message = "Vous devez être connecté pour utiliser cette fonctionnalité";
                      break;
                    case 2:
                      $message = "Vous devez entrer un identifiant pour l'ouvrage demandé";
                      break;
                    case 3:
                      $message = "Cet ouvrage n'existe pas dans le catalogue";
                      break;
                    case 4:
                      $message = "Ouvrage indisponible. Retour prevu :".$date;
                      break;
                    case 5:
                      $message = "Emprunt enregistré. Date de retour :".$date;
                      break;
                  }
                  if (!empty($reponse)) {
                    echo ('<div class="alert alert-block alert-success alert-dismissible" >');
                    echo ('<button type="button" class="close" data-dismiss="alert">&times;</button>');
                    echo ("<p>$message</p>");
                    echo ("</div>");
                  }
                }
              ?>
            </div>
          </div>
        </section>
    </div>

    <footer class="row ">
        <div class="card footer col-sm-12">
          <p>Tous droits réservés...</p>
        </div>
    </footer>
  </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.js"></script>
    <script src="style/bootstrap-dev/js/popper.js"></script>
    <script src="style/bootstrap-dev/js/bootstrap.js"></script>
</body>

</html>
