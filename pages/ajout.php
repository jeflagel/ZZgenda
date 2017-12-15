<?php
// Start the session
session_start();
if (!isset($_SESSION['auth']) || !($_SESSION['auth'])){
  header('Location: deconnexion.php');
}

require_once('fonction.php') ;

// Set the language (english by default)
include '../assets/lang.php' ;
if(isset($_GET['lang'])){
  $langage=$_GET['lang'];
}
else{
  $langage='en';
}

// if click on edit
if(isset($_POST['edit'])){
  edit();
}

// Popup telling whether the conference has been added
if(isSet($_GET['checkConf'])){
  add();
}


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
        <li><a href="https://www.isima.fr/"><?php echo $lang['calendrier']['School'][$langage]; ?></a></li>
        <li><a href="deconnexion.php"><?php echo $lang['calendrier']['Disconnect'][$langage]; ?></a></li>
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
   <input type="radio" name="public" <?php if (isset($_POST['public']) && $_POST['public']=="co") echo "checked"; ?> value="co" /> <?php echo $lang['ajout']['connoisseur'][$langage]; ?>
   <input type="radio" name="public" <?php if (isset($_POST['public']) && $_POST['public']=="tp") echo "checked"; ?> value="tp" /> <?php echo $lang['ajout']['anybody'][$langage]; ?>
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
