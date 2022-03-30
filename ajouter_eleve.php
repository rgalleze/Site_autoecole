
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <?php
  include 'connexionbdd.php';
  if (empty($_POST['nom']) && empty($_POST['prenom']) && empty($_POST['dateNaiss'])) die('Vous devez remplir tout les champs!');
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql'); // Connexion à la bdd
  mysqli_set_charset($connect, 'utf8'); // Les données envoyées vers mysql sont encodées en UTF-8
  $query = 'insert into eleves values ( NULL,"'.$_POST['nom'].'", "'.$_POST['prenom'].'", "'.$_POST['dateNaiss'].'", "'.$date_today.'")'; // Requête pour ajouter un élève
  // echo "<br>$query<br>";
  $result = mysqli_query($connect, $query);
  if (!$result) echo "<br>c'est pas bon ! ".mysqli_error($connect);
  echo <<< html
  <br>
  <i class="bi bi-check-lg"></i>
  <p> L'élève a été ajouté.e ! </p>
  <table>
  <tr>
  <td>
  <a href="acceuil.html" >
  <button type="button" class='button effacer' ><span>Accueil</span></button>
  </a>
  </td>
  <td>
  <a href="ajout_eleve.html" >
  <button type="button" class='button valider' ><span>Recommancer</span></button>
  </a>
  </td>
  </tr>
  <table>
  html;
  mysqli_close($connect);
   ?>
</body>
</html>
