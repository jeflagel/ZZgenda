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

/**
 * conference part
 */


class Conference{
  public $key;
  public $civi;
  public $prenom;
  public $nom;
  public $intitule;
  public $profil;
  public $public;
  public $message;
  public $day;
  public $hour;
  public $min;
}

function displayConf($admin){
  $file = fopen("conf.json ", "r");
  if ($file) {
    while (($line = fgets($file)) != false) {
        $Conf=json_decode($line);

        echo "<tr>";
        echo "<td>$Conf->day</td>";
        echo "<td>$Conf->hour</td>";
        echo "<td>$Conf->intitule</td>";
        if ($admin) {
          echo "<td>
                <form action='ajout.php' method='post'>
                  <button name='edit' value=$Conf->key>Edit</button>
                </form>
                <form action='' method='post'>
                  <button name='delete' value=$Conf->key>Delete</button>
                </form></td>";
          echo "</tr>";
        }
    }
    fclose($file);
  }
  else {
      echo "Problème dans l'ouverture du fichier conf.json";
  }
}


// Check whether every field has been filled up
function isConfSet(){
    if(isset($_POST['day'], $_POST['hour'], $_POST['min'], $_POST['civi'], $_POST['prenom'],
              $_POST['nom'], $_POST['intitule'], $_POST['profil'], $_POST['public'],
            $_POST['le-message'])){
        return True;
    }
    else {
      return False;
    }
}



function edit(){
    $key=$_POST['edit'];
    $EOF=False;
    $file = fopen("conf.json ", "r");
    if ($file) {
      do{
        $EOF=($line = fgets($file));
      }while (!$EOF and !preg_match("/$key/", $line));

      if($EOF) {
        $Conf=json_decode($line);
        file_put_contents("conf.json", str_replace($line, "", file_get_contents("conf.json")));

        $_POST['civi'] = $Conf->civi;
        $_POST['prenom'] = $Conf->prenom;
        $_POST['nom'] = $Conf->nom;
        $_POST['intitule'] = $Conf->intitule;
        $_POST['profil'] = $Conf->profil;
        $_POST['public'] = $Conf->public;
        $_POST['le-message'] = $Conf->message;
        $_POST['day'] = $Conf->day;
        $_POST['hour'] = $Conf->hour;
        $_POST['min'] = $Conf->min;
      }
      fclose($file);
    }
    else {
        echo "Problème dans l'ouverture du fichier conf.json";
    }

    unset($_POST['edit']);
  }


function add(){
  if(isConfSet()){
      $confFile=fopen('conf.json', 'a+');
      $splitString=explode("/", $_POST['day']);
      $key=$splitString[2].$splitString[1].$splitString[0].$_POST['hour'].$_POST['min'].$_POST['nom'];

      $newConf = new Conference;
      $newConf->key = $key;
      $newConf->civi = $_POST['civi'];
      $newConf->prenom = $_POST['prenom'];
      $newConf->nom = $_POST['nom'];
      $newConf->intitule = $_POST['intitule'];
      $newConf->profil = $_POST['profil'];
      $newConf->public = $_POST['public'];
      $newConf->message = chunk_split($_POST['le-message'], 50);
      $newConf->day = $_POST['day'];
      $newConf->hour = $_POST['hour'];
      $newConf->min = $_POST['min'];

      $myJSON = json_encode($newConf);

      fputs($confFile, $myJSON."\n");

      fclose($confFile);
      echo '<script>alert("Conférence ajoutée");</script>';
      unset($_POST['civi'], $_POST['prenom'], $_POST['nom'], $_POST['intitule'], $_POST['profil'], $_POST['public'], $_POST['le-message'], $_POST['day'], $_POST['hour'], $_POST['min']);
  }
  else{
        echo '<script>alert("Formulaire incomplet");</script>';
  }
  return $key;
}

function delete($key){
  $EOF=False;
  $file = fopen('conf.json', "r");
  if ($file) {
    do{
      $EOF=($line = fgets($file));
    }while (!$EOF and !preg_match("/$key/", $line));

    if($EOF) {
      file_put_contents("conf.json", str_replace($line, "", file_get_contents("conf.json")));
    }

    fclose($file);
    $success=true ;
  }
  else {
      echo "Problème dans l'ouverture du fichier conf.json";
  }

  unset($_POST['delete']);
  return $success ;
}
?>
