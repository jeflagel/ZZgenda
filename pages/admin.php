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

if(isset($_POST['delete']))
{
    $key=$_POST['delete'];
    $EOF=False;
    $file = fopen("conf.json ", "r");
    if ($file) {
      do{
        $EOF=($line = fgets($file));
      }while (!$EOF and !preg_match("/$key/", $line));

      if($EOF) {
        file_put_contents("conf.json", str_replace($line, "", file_get_contents("conf.json")));
      }

      fclose($file);
    }
    else {
        echo "Problème dans l'ouverture du fichier conf.json";
    }

    unset($_POST['delete']);
}

function displayConf(){
  $file = fopen("conf.json ", "r");
  if ($file) {
    while (($line = fgets($file)) != false) {
        $Conf=json_decode($line);

        echo "<tr>";
        echo "<td>$Conf->day</td>";
        echo "<td>$Conf->hour</td>";
        echo "<td>$Conf->intitule</td>";
        echo "<td>
              <form action='ajout.php' method='post'>
                <button name='edit' value=$Conf->key>Edit</button>
              </form>
              <form action='' method='post'>
                <button name='delete' value=$Conf->key>Delete</button>
              </form></td>";
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
        <li><a href="https://www.isima.fr/"><?php echo $lang['calendrier']['School'][$langage]; ?></a></li>
        <li><a href="deconnexion.php"><?php echo $lang['calendrier']['Disconnect'][$langage]; ?></a></li>

      </ul>
    </div>
  </div>
</nav>


<div class="container">
  <div class="row">
    <div class="col-lg-8">
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
      <div class="col-lg-4">
        <form name="ajout_utilisateur" action="UserForm.php" method="post" class="text-center">
          <b><?php echo $lang['admin']['NewUser'][$langage]; ?></b>
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
