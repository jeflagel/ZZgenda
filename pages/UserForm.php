<?php
    // On démarre la session
    session_start();
    if (!isset($_SESSION['auth']) || !($_SESSION['auth'])){
      header('Location: deconnexion.php');
    }
    require_once('fonction.php') ;
    include ('../assets/lang.php') ;
    if(isset($_GET['lang'])){
      $langage=$_GET['lang'];
    }
    else{
      $langage='en';
    }
    if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['passw']) && !empty($_POST['administrateur']) ) {
      extract($_POST);
      // 1 : on ouvre le fichier
      $monfichier=OpenFile('../assets/db/database.txt') ;

      // 2 : on ecrit dans le fichier
      $pass=Chiffrement($_POST['passw']);
      $adm=(($_POST['administrateur']==="ok") ? "y;" : ";") ;         // using database file's syntax : login;hash;(y);   (y) if admin
      fputs($monfichier,$_POST['login'].";".$pass.";".$adm."\n");

      // 3 : quand on a fini de l'utiliser, on ferme le fichier
      fclose($monfichier);
    }
    header('Location: admin.php');
?>
