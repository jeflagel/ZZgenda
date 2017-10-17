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
      <a class="navbar-brand" href="admin.php">..........</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="https://www.isima.fr/">School</a></li>
        <li><a href="identification.php">disconnect</a></li>
      </ul>
    </div>
  </div>
</nav>

<form name="mon-formulaire1" action="page-envoi.html" method="get" class="text-center">
<p>
   <input type="radio" name="civi" value="Sco" /> Scolaire
   <input type="radio" name="civi" value="Pro" /> Professionel
</p>
<p>
   Votre prénom :<br />
   <input type="text" name="prenom" value="" />
</p>
<p>
   Votre nom :<br />
   <input type="text" name="nom" value="" />
</p>
<p>
   Intitulé de la réunion :<br />
   <input type="text" name="intitule" value="" />
</p>
<p>
   Vous êtes<br />
   <select name="profil">
      <option value="parti">Un particulier</option>
      <option value="profe" selected="selected">Un professionnel</option>
      <option value="insti">Un institutionnel</option>
   </select>
</p>
<p>
   A qui s'adresse la conférence ?<br />
   <input type="checkbox" name="public" value="co" /> connaisseurs
   <input type="checkbox" name="public" value="tp" /> tout public
</p>
<p>
   Détails :<br />
   <textarea name="le-message" rows="6" cols="40">Vous pouvez saisir ici un message.</textarea>
</p>
<p>
   <input type="submit" value="Valider" />
   <input type="reset" value="Annuler" />
</p>
</form>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p> <img src="assets\img\logIsima.png" alt="Logo Isima" id="foot-img">ZZgenda by JF <a href="https://github.com/jeflagel">compte github</a></p>
</footer>
</body>
</html>