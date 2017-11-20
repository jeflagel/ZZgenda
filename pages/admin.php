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

  <link href="../assets/css/admin.css" rel="stylesheet">
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
      <a class="navbar-brand" href="ajout.php"><?php echo $lang['admin']['conference'][$langage]; ?></a>

    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="https://www.isima.fr/">School</a></li>
        <li><a href="deconnexion.php">disconnect</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <h2>Condensed Table</h2>
      <p>The .table-condensed class makes a table more compact by cutting cell padding in half:</p>
      <table class="table table-condensed">
        <thead>
          <tr>

            <th><?php echo $lang['admin']['firstname'][$langage]; ?></th>
            <th><?php echo $lang['admin']['lastname'][$langage]; ?></th>

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
    <div class="col-lg-4">
      <form name="ajout_utilisateur" action="UserForm.php" method="post" class="text-center">
      <p>
         <?php echo $lang['admin']['login'][$langage]; ?><br />
         <input type="text" name="login" value="" />
      </p>
      <p>
         <?php echo $lang['admin']['passw'][$langage]; ?><br />
         <input type="password" name="passw" value="" />
      </p>
      <p>
         <?php echo $lang['admin']['level'][$langage]; ?><br />
         <input type="radio" name="administrateur" value="ok" /> <?php echo $lang['admin']['administrator'][$langage]; ?>
         <input type="radio" name="administrateur" value="no" /> <?php echo $lang['admin']['user'][$langage]; ?>
      </p>
      <p>
         <input type="submit" value="<?php echo $lang['admin']['submit'][$langage]; ?>" />
         <input type="reset" value="<?php echo $lang['admin']['cancel'][$langage]; ?>" />
      </p>
      </form>

    </div>
  </div>
</div>


<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p> <img src="..\assets\img\logIsima.png" alt="Logo Isima" id="foot-img">ZZgenda by JF <a href="https://github.com/jeflagel">compte github</a></p>

 <a href="admin.php?lang=fr">FR</a> <a href="admin.php?lang=en">EN</a>

</footer>
</body>
</html>
