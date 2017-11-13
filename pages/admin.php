<?php
<<<<<<< HEAD
    include '../assets/lang.php' ;
    if(isset($_GET['lang'])){
      $langage=$_GET['lang'];
    }
    else{
      $langage='en';
=======

    // On démarre la session
    session_start();
    if (!isset($_SESSION['auth']) || !($_SESSION['auth'])){
      header('Location: deconnexion.php');
>>>>>>> ajout-des-pages
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>ZZgenda calendar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<<<<<<< HEAD
  <link href="../assets/css/calendrier.css" rel="stylesheet">
=======
  <link href="../assets/css/admin.css" rel="stylesheet">
>>>>>>> ajout-des-pages
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
<<<<<<< HEAD
      <a class="navbar-brand" href="ajout.html"><?php echo $lang['admin']['conference'][$langage]; ?></a>
=======
      <a class="navbar-brand" href="ajout.php">Add Meeting</a>
>>>>>>> ajout-des-pages
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="https://www.isima.fr/">School</a></li>
<<<<<<< HEAD
        <li><a href="identification.php">disconnect</a></li>
=======
        <li><a href="deconnexion.php">disconnect</a></li>
>>>>>>> ajout-des-pages
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  <h2>Condensed Table</h2>
  <p>The .table-condensed class makes a table more compact by cutting cell padding in half:</p>
  <table class="table table-condensed">
    <thead>
      <tr>
<<<<<<< HEAD
        <th><?php echo $lang['admin']['firstname'][$langage]; ?></th>
        <th><?php echo $lang['admin']['lastname'][$langage]; ?></th>
=======
        <th>Firstname</th>
        <th>Lastname</th>
>>>>>>> ajout-des-pages
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
      </tr>
      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
      </tr>
    </tbody>
  </table>
</div>


<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p> <img src="..\assets\img\logIsima.png" alt="Logo Isima" id="foot-img">ZZgenda by JF <a href="https://github.com/jeflagel">compte github</a></p>
<<<<<<< HEAD
  <li> <a href="admin.php?lang=fr">FR</a> <a href="admin.php?lang=en">EN</a> </li>
=======
>>>>>>> ajout-des-pages
</footer>
</body>
</html>
