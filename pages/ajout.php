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
if(isset($_GET['id'])){
  $key=$_GET['id'];
  edit($key);
}

/*Check the input*/
if(isset($_POST) &&!empty($_POST['intitule']) &&!empty($_POST['hour']) && !empty($_POST['nom']) && !empty($_POST['day']) && !empty($_POST['prenom']) && !empty($_POST['location']) && !isset($_GET['add'])){
  /*Check forbidden characters*/
  $_POST['intitule']=htmlentities($_POST['intitule']);
  $_POST['nom']=htmlentities($_POST['nom']);
  $_POST['prenom']=htmlentities($_POST['prenom']);
  $_POST['location']=htmlentities($_POST['location']);
  $_POST['le-message']=htmlentities($_POST['le-message']);
  /*----------------------------------------------*/
  $today=getdate();
	/*Check the date*/
	 if (checkdate(substr($_POST['day'], 5, 2), substr($_POST['day'], 8, 2), substr($_POST['day'], 0, 4))){
			$today=$today['mday'].'-'.$today['mon'].'-'.$today['year'];
			if(strtotime($_POST['day']) > strtotime($today)){
				extract($_POST);
        // Popup telling whether the conference has been added
				add();
        header('Location:admin.php?add=');
			}
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




<div class="container">
    <form name="mon-formulaire1" action="ajout.php" method="post" class="text-center">
      <div class="col-md-4">
      </div>
      <div class="col-md-4">
            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label"><?php echo $lang['ajout']['conference'][$langage]; ?></label>
              <div class="col-5">
                <input class="form-control monstyle" type="text" name="intitule" value="<?php if(isset($_POST['intitule'])){ echo $_POST['intitule']; } ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label"><?php echo $lang['ajout']['firstname'][$langage]; ?></label>
              <div class="col-5">
                <input class="form-control monstyle" type="text" name="prenom" value="<?php if(isset($_POST['prenom'])){ echo $_POST['prenom']; } ?>" id="example-text-input">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label"><?php echo $lang['ajout']['lastname'][$langage]; ?></label>
              <div class="col-5">
                <input class="form-control monstyle" type="text" name="nom" value="<?php if(isset($_POST['nom'])){ echo $_POST['nom']; } ?>" id="example-text-input">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label"><?php echo $lang['ajout']['location'][$langage]; ?></label>
              <div class="col-5">
                <input class="form-control monstyle" type="text" name="location" value="<?php if(isset($_POST['location'])){ echo $_POST['location']; } ?>" id="example-text-input">
              </div>
            </div>
            <div class="form-group row">
              <label for="example-date-input" class="col-2 col-form-label"><?php echo $lang['ajout']['date'][$langage]; ?></label>
              <div class="col-5">
                <input class="form-control monstyle" type="date" name="day" value="<?php if(isset($_POST['day'])){ echo $_POST['day']; } ?>" placeholder="<?php echo $lang['ajout']['day'][$langage]; ?>" />
              </div>
            </div>
            <div class="form-group row">
                <label for="example-time-input" class="col-2 col-form-label"><?php echo $lang['ajout']['date'][$langage]; ?> </label>
                <div class="col-5">
                  <input class="form-control monstyle"type="time" name="hour" value="<?php if(isset($_POST['hour'])){ echo $_POST['hour']; } ?>" />
                </div>
            </div>
            <div class="form-group row">
              <label for="example-text-input" class="col-2 col-form-label"><?php echo $lang['ajout']['details'][$langage]; ?></label>
              <div class="col-5">
                 <textarea name="le-message" class="form-control monstyle descr" type="textarea"><?php if(isset($_POST['le-message'])){echo $_POST['le-message'];} ?></textarea>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <button type="submit" class="btn btn-secondary" ><?php echo $lang['ajout']['submit'][$langage]; ?> </button>
                <button type="reset" class="btn btn-secondary" > <?php echo $lang['ajout']['cancel'][$langage]; ?></button>
              </div>
            </div>
        </div>

    </form>
</div>
</form>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p> <img src="..\assets\img\logIsima.png" alt="Logo Isima" id="foot-img">ZZgenda <a href="https://github.com/jeflagel">on github</a></p>

 <a href="ajout.php?lang=fr">FR</a> <a href="ajout.php?lang=en">EN</a>

</footer>
</body>
</html>
