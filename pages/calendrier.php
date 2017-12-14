<?php
// On démarre la session
session_start();
if (!isset($_SESSION['auth']) || !($_SESSION['auth'])){
  header('Location: deconnexion.php');
}
    include '../assets/lang.php' ;
    if(isset($_GET['lang'])){
      $langage=$_GET['lang'];
    }
    else{
      $langage='en';
    }


function displayConf(){
  $file = fopen("conf.json ", "r");
  if ($file) {
    while (($line = fgets($file)) !== false) {
        $strConf=json_decode($line);
        //sujet, date, heure
        echo "<tr>";
        echo "<td>$strConf->day</td>";
        echo "<td>$strConf->hour</td>";
        echo "<td>$strConf->intitule</td>";
        echo "</tr>";
    }

    fclose($file);
  }
  else {
      echo "Problème dans l'ouverture du fichier conf.json";
  }
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>ZZgenda calendar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="../assets/css/calendrier.css" rel="stylesheet">
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
      <a class="navbar-brand" href="https://www.google.com/calendar"><?php echo $lang['calendrier']['available'][$langage]; ?></a>

      <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      </button>  -->

    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="https://www.isima.fr/">School</a></li>
        <li><a href="deconnexion.php"> disconnect</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="authentification">
  <p>Hey <?php echo $_SESSION['login'] ?> : Let's have a look </p>
</div>

<div class="container">
 <h2>Calendrier des conférences</h2>
  <table class="table table-condensed">
    <thead>
      <tr>

        <th>Date</th>
        <th>Heure</th>
        <th>Conférence</th>

      </tr>
    </thead>
    <tbody>
      <?php displayConf(); ?>
    </tbody>
  </table>
</div>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p> <img src="..\assets\img\logIsima.png" alt="Logo Isima" id="foot-img">ZZgenda by JF <a href="https://github.com/jeflagel">compte github</a></p>
   <a href="calendrier.php?lang=fr">FR</a> <a href="calendrier.php?lang=en">EN</a>
</footer>
</body>
</html>
