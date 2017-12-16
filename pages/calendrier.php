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

if(isset($_POST['delete'])){
  delete();
}

require_once('fonction.php') ;

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
        <li><a href="https://www.isima.fr/"><?php echo $lang['calendrier']['School'][$langage]; ?></a></li>
        <li><a href="deconnexion.php"><?php echo $lang['calendrier']['Disconnect'][$langage]; ?></a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="authentification">
  <p>Hey <?php echo $_SESSION['login'] ?> :<?php echo $lang['calendrier']['look'][$langage]; ?> </p>
</div>

<div class="container">
  <h2><?php echo $lang['admin']['Calendrier'][$langage]; ?></h2>
   <table class="table table-condensed">
     <thead>
       <tr>

         <th><?php echo $lang['admin']['date'][$langage]; ?></th>
         <th><?php echo $lang['admin']['hour'][$langage]; ?>  <i class="fa fa-clock-o" aria-hidden="true"></i></th>
         <th><?php echo $lang['admin']['ConferenceAff'][$langage]; ?></th>
         <th><?php echo $lang['admin']['speaker'][$langage]; ?></th>
         <th>Details</th>
         <th><?php echo $lang['ajout']['location'][$langage]; ?></th>

      </tr>
    </thead>
    <tbody>
      <?php displayConf($_SESSION['admin']); ?>
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
