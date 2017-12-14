<?php
$filename='../assets/lang.php' ;
if (file_exists($filename)) {
  include ('../assets/lang.php') ;
}
else include('/home/travis/build/jeflagel/ZZgenda/assets/lang.php'); // include for Travis
if(isset($_GET['lang'])){
  $langage=$_GET['lang'];
}
else{
  $langage='en';
}


function OpenFile($nom){
  if  (file_exists($nom)) {
    if (($monfichier = fopen($nom, 'a+')) == NULL){
      echo '<script>alert("'.$lang['identification']['database'][$langage].'");</script>';
      exit ;
    }
  }
  else $monfichier=0 ;
  return $monfichier ;
}

function Chiffrement($pass){
  $options = [
  'cost' => 10,
  'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),   // pass : coucou good lent david
  ];
  return password_hash($pass, PASSWORD_BCRYPT, $options); // security process
}

function lecture($monfichier,$login,$passw,&$admin){ // ask database in order to log in
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
  return $stop;
}

?>
