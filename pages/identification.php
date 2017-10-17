<?php
if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['passw'])) {
  extract($_POST);
  // 1 : on ouvre le fichier
  if (($monfichier = fopen('../assets/db/database.txt', 'r+')) != NULL){
    $stop=0 ;
    // 2 : on lit le fichier
    while(!feof($monfichier) && $stop==0) {
      $ligne = fgets($monfichier);
      $log = strtok($ligne,";");
      $mdp = strtok(";");
      if ($log==$login && $mdp==$passw){
        $stop=1;
        header('Location: calendrier.php');
      }
    }
    if ($stop == 0) {
      echo '<script>alert("Erreur de Saise");</script>';
    }
  }
  else{
    echo "erreur avec le fichier database";
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
          <!--      <h1 data-animated="GoIn"><b>ZZgenda</b> Organize Easyer...</h1>-->
            </header>
            <div class="col-lg-4 col-lg-offset-4 mt centered">
            	<h4>Simply Gonna ZZgenda</h4>
				<form class="form-inline" action="identification.php" method="post" role="form">
				  <div class="form-group">
				    <label class="sr-only" for="login">login</label>
				    <input type="text" class="form-control" name="login" id="login" placeholder="Enter login">
            <label class="sr-only" for="passw">passw</label>
				    <input type="password" class="form-control" name="passw" id="passw" placeholder="Enter password">
				  </div>
				  <button type="submit" class="btn btn-info">Submit</button>
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