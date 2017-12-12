<?php
// On démarre la session
session_start();
if (!isset($_SESSION['auth']) || !($_SESSION['auth'])){
  header('Location: deconnexion.php');
}
    include ('../assets/lang.php') ;
    if(isset($_GET['lang'])){
      $langage=$_GET['lang'];
    }
    else{
      $langage='en';
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
        <li><a href="https://www.isima.fr/">School</a></li>

        <li><a href="deconnexion.php">disconnect</a></li>
      </ul>
    </div>
  </div>
</nav>

<form name="mon-formulaire1" action="page-envoi.html" method="get" class="text-center">
<p>
   <input type="radio" name="civi" value="Sco" /> <?php echo $lang['ajout']['academic'][$langage]; ?>
   <input type="radio" name="civi" value="Pro" /> <?php echo $lang['ajout']['professionnal1'][$langage]; ?>
</p>
<p>
   <?php echo $lang['ajout']['firstname'][$langage]; ?><br />
   <input type="text" name="prenom" value="" />
</p>
<p>
   <?php echo $lang['ajout']['lastname'][$langage]; ?><br />
   <input type="text" name="nom" value="" />
</p>
<p>
   <?php echo $lang['ajout']['conference'][$langage]; ?><br />
   <input type="text" name="intitule" value="" />
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
   <textarea name="le-message" rows="6" cols="40"><?php echo $lang['ajout']['enterdetails'][$langage]; ?></textarea>
</p>
<p>
   <input type="submit" value="<?php echo $lang['ajout']['submit'][$langage]; ?>" />
   <input type="reset" value="<?php echo $lang['ajout']['cancel'][$langage]; ?>" />
</p>
</form>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p> <img src="..\assets\img\logIsima.png" alt="Logo Isima" id="foot-img">ZZgenda by JF and AD <a href="https://github.com/jeflagel">compte github</a></p>

 <a href="ajout.php?lang=fr">FR</a> <a href="ajout.php?lang=en">EN</a>

</footer>
</body>
</html>
