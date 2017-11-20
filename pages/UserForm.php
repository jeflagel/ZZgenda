<?php
    // On démarre la session
    session_start();
    if (!isset($_SESSION['auth']) || !($_SESSION['auth'])){
      header('Location: deconnexion.php');
    }
    include ('fonction.php');
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
      if (($monfichier = fopen('../assets/db/database.txt', 'a+')) != NULL){
        // 2 : on ecrit dans le fichier
        $options = [
        'cost' => 10,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),   // mdp : coucou good lent
        ];
        $pass=password_hash($_POST['passw'], PASSWORD_BCRYPT, $options); // security process
        echo $_POST['administrateur'] ;
        $adm=(($_POST['administrateur']==="ok") ? "y;" : ";") ;         // using database file's syntax : login;hash;(y);   (y) if admin
        fputs($monfichier,$_POST['login'].";".$pass.";".$adm."\n");
      }
      else{
        echo '<script>alert("'.$lang['identification']['database'][$langage].'");</script>';
      }
      // 3 : quand on a fini de l'utiliser, on ferme le fichier
      fclose($monfichier);
    }
    header('Location: admin.php');
?>
