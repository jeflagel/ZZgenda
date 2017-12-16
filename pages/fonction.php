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
  return hash("md5",$pass); // security process
}

function lecture($monfichier,$login,$passw,&$admin){ // ask database in order to log in
  $stop=0 ;
  $passw=Chiffrement($passw) ;
  // 2 : on lit le fichier
  while(!feof($monfichier) && $stop==0) {
    $ligne = fgets($monfichier);
    $log = strtok($ligne,";");
    $hash = strtok(";");
    $admin = strtok(";");
    if ($log==$login && $passw==$hash){
      $stop=1;
    }
  }
  return $stop;
}

/**
 * conference part
 */


class Conference{
  public $key;
  public $prenom;
  public $nom;
  public $intitule;
  public $location;
  public $message;
  public $day;
  public $hour;
}

function displayConf($admin){
  $droit=0 ;
  $file = fopen('conf.json', "r");
  if ($file) {
    while (($line = fgets($file)) != false) {
        $Conf=json_decode($line);
        echo "<tr>";
        echo "<td>$Conf->day</td>";
        echo "<td>$Conf->hour</td>";
        echo "<td>$Conf->intitule</td>";
        echo "<td>".$Conf->prenom." ".$Conf->nom."</td>";
        echo "<td>$Conf->message</td>";
        echo "<td>$Conf->location</td>";
        if ($admin) {
          echo "<td> <a href='ajout.php?id=".$Conf->key."'> <button class='btn btn-info' name='edit' ><i class='fa fa-pencil' aria-hidden='true'></i></button></a>
                <a href='admin.php?id=".$Conf->key."'> <button class='btn btn-danger' name='delete'><i class='fa fa-trash-o' aria-hidden='true'></i></button></a>";
          echo "</tr>";
          $droit=1 ;
        }
    }
    fclose($file);
  }
  else {
      echo "Problème dans l'ouverture du fichier conf.json";
  }
  return $droit ;
}


// Check whether every field has been filled up
function isConfSet(){
    if(isset($_POST['le-message'], $_POST['day'], $_POST['hour'], $_POST['location'], $_POST['prenom'],$_POST['nom'], $_POST['intitule'])){
        return True;
    }
    else {
      return False;
    }
}



function edit($key){
    $EOF=False;
    $file = fopen('conf.json', "r");
    if ($file) {
      do{
        $line = fgets($file);
        $EOF=$line ;
      }while ($EOF and strstr($line,$key)==False );

      if($EOF) {
        $Conf=json_decode($line);
        file_put_contents("conf.json", str_replace($line, "", file_get_contents("conf.json")));

        $_POST['prenom'] = $Conf->prenom;
        $_POST['nom'] = $Conf->nom;
        $_POST['intitule'] = $Conf->intitule;
        $_POST['le-message'] = $Conf->message;
        $_POST['day'] = $Conf->day;
        $_POST['hour'] = $Conf->hour;
        $_POST['location'] = $Conf->location;
      }
      fclose($file);
    }
    else {
        echo "Problème dans l'ouverture du fichier conf.json";
    }

    unset($_POST['edit']);
  }

function Tri(&$file){

}



function add(){
  if(isConfSet()){
      $confFile=fopen('conf.json', 'a+');
      $splitString=explode("-", $_POST['day']);
      $splitString2=explode(":", $_POST['hour']);
      $key=$splitString[2].$splitString[1].$splitString[0].$splitString2[1].$splitString2[0];

      $newConf = new Conference;
      $newConf->key = $key;
      $newConf->prenom = $_POST['prenom'];
      $newConf->nom = $_POST['nom'];
      $newConf->intitule = $_POST['intitule'];
      $newConf->message = chunk_split($_POST['le-message'],40);
      $newConf->day = $_POST['day'];
      $newConf->hour = $_POST['hour'];
      $newConf->location = $_POST['location'];

      $myJSON = json_encode($newConf);

      fputs($confFile, $myJSON."\n");

      fclose($confFile);
      echo '<script>alert("Conférence ajoutée");</script>';
      unset( $_POST['prenom'], $_POST['nom'], $_POST['intitule'], $_POST['le-message'], $_POST['day'], $_POST['hour'], $_POST['location']);
  }
  else{
        echo '<script>alert("Formulaire incomplet");</script>';
  }
  return $key;
}

function delete($key){
  $EOF=False;
  $success=false ;
  $file = fopen('conf.json', "r");
  if ($file) {
    do{
      $line = fgets($file);
      $EOF=$line ;
    }while ($EOF and strstr($line,$key)==False );


    if($EOF) {
      file_put_contents("conf.json", str_replace($line, "", file_get_contents("conf.json")));
      $success=true ;
    }

    fclose($file);
  }
  else {
      echo "Problème dans l'ouverture du fichier conf.json";
  }

  unset($_POST['delete']);
  return $success ;
}
?>
