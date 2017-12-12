<?php
include('/home/travis/build/jeflagel/ZZgenda/assets/lang.php');

//include ('../assets/lang.php') ;
if(isset($_GET['lang'])){
  $langage=$_GET['lang'];
}
else{
  $langage='en';
}


function OpenFile($nom){
  if (($monfichier = fopen($nom, 'a+')) == NULL){
    echo '<script>alert("'.$lang['identification']['database'][$langage].'");</script>';
    exit ;
  }
  return $monfichier ;
}

function Chiffrement($pass){
  $options = [
  'cost' => 10,
  'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),   // mdp : coucou good lent
  ];
  return password_hash($pass, PASSWORD_BCRYPT, $options); // security process
}

function lecture($monfichier,$login,$passw,&$admin){
  $stop=0 ;
  // 2 : on lit le fichier
  while(!feof($monfichier) && $stop==0) {
    $ligne = fgets($monfichier);
    $log = strtok($ligne,";");
    $hash = strtok(";");
    $admin = strtok(";");
    if ($log==$login && password_verify("$passw", $hash)){
      $stop=1;
    }
  }
  if (!$stop) {
    // Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un petit javascript lui signalant ce fait
  //  echo '<script>alert(".$lang['identification']['authentification'][$langage].");</script>';
  }
  return $stop;
}

?>
