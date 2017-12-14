<?php
    // start session
    session_start();
    if (!isset($_SESSION['auth']) || !($_SESSION['auth'])){ // if disconnect
      header('Location: deconnexion.php');
    }
    require_once('fonction.php') ;
    include ('../assets/lang.php') ;
    if(isset($_GET['lang'])){  // which language ?
      $langage=$_GET['lang'];
    }
    else{
      $langage='en';
    }
    if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['passw']) && !empty($_POST['administrateur']) ) { // if everything is filled
      extract($_POST);
      // 1 : open file
      $monfichier=OpenFile('../assets/db/database.txt') ;

      // 2 : write into the file
      $pass=Chiffrement($_POST['passw']);
      $adm=(($_POST['administrateur']==="ok") ? "y;" : ";") ;         // using database file's syntax : login;hash;(y);   (y) if admin
      fputs($monfichier,$_POST['login'].";".$pass.";".$adm."\n");

      // 3 : end : close file
      fclose($monfichier);
    }
    header('Location: admin.php');
?>
