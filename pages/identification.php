<?php
include ('../assets/lang.php') ;
if(isset($_GET['lang'])){
  $langage=$_GET['lang'];
}
else{
  $langage='en';
}
if(isset($_GET['match'])&& $_GET['match']==0){
  echo "<script type='text/javascript'>alert('{$lang['identification']['authentification'][$langage]}');</script>";
}

require_once('fonction.php') ;

if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['passw'])) {
  extract($_POST);
  // 1 : on ouvre le fichier
  $monfichier=OpenFile('../assets/db/database.txt') ;
  $admin="" ;
  if (lecture($monfichier,$login,$passw,$admin)){
    // dans ce cas, tout est ok, on peut démarrer notre session
    // on la démarre :)
		session_start ();
		// on enregistre les paramètres de notre visiteur comme variables de session ($login et $passw)
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['passw'] = $_POST['passw'];
    $_SESSION['auth']  = true ;
    $_SESSION['admin']  = ($admin=="y")  ;
    // Création du cookie
    setcookie('login', $_POST['login'],time()+3600*24*31);
    if ($_SESSION['admin']){
      if ($langage=='en'){
        header('Location: admin.php?lang=en');
      }
      else header('Location: admin.php?lang=fr');
    }
    else {
      if ($langage=='en'){
        header('Location: calendrier.php?lang=en');
      }
      else header('Location: calendrier.php?lang=fr');
    }
  }
  else{
    if ($langage=='en'){
      header('Location: identification.php?match=0&lang=en');
    }
    else header('Location: identification.php?match=0&lang=fr');
  }
  // 3 : quand on a fini de l'utiliser, on ferme le fichier
  fclose($monfichier);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">


    <title>ZZgenda Identification</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/soon.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

  </head>
  <!-- START BODY -->
  <body class="nomobile">

    <!-- START HEADER -->
    <section id="header">
        <div class="container">
            <header>
                <!-- HEADLINE -->

                   <a href="identification.php?lang=fr">FR</a> <a href="identification.php?lang=en">EN</a>
          <!--      <h1 data-animated="GoIn"><b>ZZgenda</b> Organize Easyer...</h1>-->
            </header>
            <div class="col-lg-4 col-lg-offset-4 mt centered">
            	<h4>Simply Gonna ZZgenda</h4>

				<form class="form-inline" action="identification.php?lang=<?php echo $langage ?>" method="post" role="form">
				  <div class="form-group">
				    <label class="sr-only" for="login">login</label>
				    <input type="text" class="form-control" name="login" id="login" placeholder="<?php echo $lang['identification']['login'][$langage]; ?>" value=<?php echo !empty($_COOKIE['login']) ?  $_COOKIE['login'] : ""; ?>>
            <label class="sr-only" for="passw">passw</label>
				    <input type="password" class="form-control" name="passw" id="passw" placeholder="<?php echo $lang['identification']['password'][$langage]; ?>">      <!-- -->
				  </div>
				  <button type="submit" class="btn btn-info"><?php echo $lang['identification']['submit'][$langage]; ?></button>
				</form>
			</div>

        </div>
        <!-- LAYER OVER THE SLIDER TO MAKE THE WHITE TEXTE READABLE -->
        <div id="layer"></div>
        <!-- END LAYER -->
        <!-- START SLIDER -->
        <div id="slider" class="rev_slider">
            <ul>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="../assets/img/slider/1.jpg">
                <img src="../assets/img/slider/1.jpg">
              </li>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="../assets/img/slider/2.jpg">
                <img src="../assets/img/slider/2.jpg">
              </li>
            </ul>
        </div>
        <!-- END SLIDER -->
    </section>
    <!-- END HEADER -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/modernizr.custom.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/soon/plugins.js"></script>
    <script src="../assets/js/soon/jquery.themepunch.revolution.min.js"></script>
    <script src="../assets/js/soon/custom.js"></script>

  </body>
  <!-- END BODY -->
</html>
