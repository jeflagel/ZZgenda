<?php


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


// Start os the session
session_start();
if (!isset($_SESSION['auth']) || !($_SESSION['auth'])){
  header('Location: deconnexion.php');
}



// Set the language (english by default)
include '../assets/lang.php' ;
if(isset($_GET['lang'])){
  $langage=$_GET['lang'];
}
else{
  $langage='en';
}


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
}


// Popup telling whether the conference has been added
if(isSet($_GET['checkConf'])){
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
      $newConf->message = $_POST['le-message'];
      $newConf->day = $_POST['day'];
      $newConf->hour = $_POST['hour'];

      $myJSON = json_encode($newConf);

      /*$strConf = JSON.stringify($myJSON);*/
      fputs($confFile, $myJSON."\n");


      /*echo "<script type=\"text/javascript\">
          newConf={\"civi\" : $_POST['civi'], \c, \"nom\" : $_POST['nom'], \"intitule\" : $_POST['intitule'], \"profil\" : $_POST['profil'], \"public\" : $_POST['public'],
              \"le-message\" : $_POST['le-message'], \"day\" : $_POST['day'], \"hour\" : $_POST['hour'] };
          myJSON = JSON.stringify(newConf);
          localStorage.setItem($key, myJSON);
          </script>";*/

      /*fputs($confFile, "$date".";". $_POST['civi'].";". $_POST['prenom'].";". $_POST['nom'].";". $_POST['intitule'].";"
            . $_POST['profil'].";". $_POST['public'].";". $_POST['le-message'].";". $_POST['day'].";". $_POST['hour']."\n");*/

      fclose($confFile);
      echo '<script>alert("Conférence ajoutée");</script>';
      unset($_POST['civi'], $_POST['prenom'], $_POST['nom'], $_POST['intitule'], $_POST['profil'], $_POST['public'], $_POST['le-message'], $_POST['day'], $_POST['hour'], $_POST['min']);
  }
  else{
        echo '<script>alert("Formulaire incomplet");</script>';
  }
}

/*
// Popup telling whether the conference has been added
if(isset($_GET['conf'])){
  if($_GET['conf']==0){
    echo '<script>alert("Conférence ajoutée");</script>';
  }
  else if($_GET['conf']==1){
    echo '<script>alert("Formulaire incomplet");</script>';
  }
}*/


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>ZZgenda calendar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../assets/css/ajout.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      </button>

      <a class="navbar-brand" href="admin.php">Back to admin</a>

    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="https://www.isima.fr/">School</a></li>

        <li><a href="deconnexion.php">disconnect</a></li>
      </ul>
    </div>
  </div>
</nav>

<form name="mon-formulaire1" action="ajout.php?checkConf=1" method="post" class="text-center">
<p>
   <input type="radio" name="civi" <?php if (isset($_POST['civi']) && $_POST['civi']=="Sco") echo "checked"; ?> value="Sco" /> <?php echo $lang['ajout']['academic'][$langage]; ?>
   <input type="radio" name="civi" <?php if (isset($_POST['civi']) && $_POST['civi']=="Pro") echo "checked"; ?> value="Pro" /> <?php echo $lang['ajout']['professionnal1'][$langage]; ?>
</p>
<p>
   <?php echo $lang['ajout']['firstname'][$langage]; ?><br />
   <input type="text" name="prenom" value="<?php if(isset($_POST['prenom'])){ echo $_POST['prenom']; } ?>" />
</p>
<p>
   <?php echo $lang['ajout']['lastname'][$langage]; ?><br />
   <input type="text" name="nom" value="<?php if(isset($_POST['nom'])){ echo $_POST['nom']; } ?>" />
</p>
<p>
   <?php echo $lang['ajout']['conference'][$langage]; ?><br />
   <input type="text" name="intitule" value="<?php if(isset($_POST['intitule'])){ echo $_POST['intitule']; } ?>" />
</p>
<p>
   <?php echo $lang['ajout']['youare'][$langage]; ?><br />
   <select name="profil">
      <option value="parti"><?php echo $lang['ajout']['external'][$langage]; ?></option>
      <option value="profe" selected="selected"><?php echo $lang['ajout']['professionnal2'][$langage]; ?></option>
      <option value="insti"><?php echo $lang['ajout']['institutional'][$langage]; ?></option>
   </select>
</p>
<p>
   <?php echo $lang['ajout']['who'][$langage]; ?><br />
   <input type="checkbox" name="public" value="co" /> <?php echo $lang['ajout']['connoisseur'][$langage]; ?>
   <input type="checkbox" name="public" value="tp" /> <?php echo $lang['ajout']['anybody'][$langage]; ?>
</p>
<p>
   <?php echo $lang['ajout']['details'][$langage]; ?><br />
   <textarea name="le-message" rows="6" cols="40">
     <?php if(isset($_POST['le-message'])){echo $_POST['le-message'];} ?>
  </textarea>
</p>
<p>
   <?php echo $lang['ajout']['date'][$langage]; ?><br />
   <input type="text" name="day" value="<?php if(isset($_POST['day'])){ echo $_POST['day']; } ?>" placeholder="<?php echo $lang['ajout']['day'][$langage]; ?>" /><br />
   <?php echo $lang['ajout']['hour'][$langage]; ?>
   <input type="text" name="hour" value="<?php if(isset($_POST['hour'])){ echo $_POST['hour']; } ?>" />:<input type="text" name="min" value="<?php if(isset($_POST['min'])){ echo $_POST['min']; } ?>" />
</p>
<p>
   <input type="submit" value="<?php echo $lang['ajout']['submit'][$langage]; ?>" />
   <input type="reset" value="<?php echo $lang['ajout']['cancel'][$langage]; ?>" />
</p>
</form>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p> <img src="..\assets\img\logIsima.png" alt="Logo Isima" id="foot-img">ZZgenda by JF <a href="https://github.com/jeflagel">compte github</a></p>

 <a href="ajout.php?lang=fr">FR</a> <a href="ajout.php?lang=en">EN</a>

</footer>
</body>
</html>
