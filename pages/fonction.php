<?php
function OpenFile($monfichier){
  $retour=1 ;
  if (($monfichier = fopen('../assets/db/database.txt', 'a+')) == NULL){
    echo '<script>alert("'.$lang['identification']['database'][$langage].'");</script>';
    $retour = 0 ;
  }
  return $retour ;
}
?>
