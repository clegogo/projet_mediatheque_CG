<?php
        $DB="mysql:host=localhost";
        $DBname="projet";
        $DBcode="utf8";
        $DBuser="root";
        $DBpwd='';
        $bdd = new PDO($DB.';dbname='.$DBname.';charset='.$DBcode,$DBuser,$DBpwd);
?>
