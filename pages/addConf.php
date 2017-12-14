<?php

// Check whether every field has been filled up
function isConfSet(){
    if(isset($_POST['day'], $_POST['hour'], $_POST['min'], $_POST['civi'], $_POST['prenom'],
              $_POST['nom'], $_POST['intitule'], $_POST['profil'], $_POST['public'],
            $_POST['le-message'])){
        return True;
    }
    else {
      /*if(!isset($_POST['day']))
        echo "day";
      elseif (!isset($_POST['hour']))
        echo "hour";
      elseif(!isset($_POST['min']))
        echo "min";
      elseif(isset($_POST['civi']))
        echo "civi";
      elseif(!isset($_POST['prenom']))
        echo "prenom";
      elseif(!isset($_POST['nom']))
        echo "nom";
      elseif(!isset($_POST['intitule']))
        echo "intitule";
      elseif(!isset($_POST['profil']))
        echo "profil";
      elseif(!isset($_POST['public']))
        echo "public";
      elseif(!isset($_POST['le-message']))
        echo "le-message";*/

      return False;
    }
}


// Popup telling whether the conference has been added
if(isConfSet()){
    $confFile=fopen('conf.json', 'a+');
    $splitString=explode("/", $_POST['day']);
    $date=$splitString[2].$splitString[1].$splitString[0].$_POST['hour'].$_POST['min'];

    fputs($confFile, "$date".";". $_POST['civi'].";". $_POST['prenom'].";". $_POST['nom'].";". $_POST['intitule'].";"
          . $_POST['profil'].";". $_POST['public'].";". $_POST['le-message'].";". $_POST['day'].";". $_POST['hour']."\n");

    fclose($confFile);
    header('Location: ajout.php?conf=0');
}
else{
    header('Location: ajout.php?conf=1');
}



?>
