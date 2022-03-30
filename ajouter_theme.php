
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet">
  <title></title>
</head>
<body>
  <?php
  include 'connexionbdd.php';

  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql'); // Connexion à la bdd
  mysqli_set_charset($connect, 'utf8'); // Les données envoyées vers mysql sont encodées en UTF-8
  $query = 'SELECT * FROM themes WHERE nom = "'.$_POST['nom'].'" and supprime = 1 ';
  // echo "<br>$query<br>";
  $verif = mysqli_query($connect, $query);
  if (empty($_POST['nom']) && empty($_POST['descriptif']) ) die('Vous devez remplir tout les champs!');
  if (!empty(mysqli_fetch_array($verif))) {
    $query = 'UPDATE themes SET supprime = 0 WHERE nom = "'.$_POST['nom'].'"';
    // echo "<br>$query<br>";
    $result = mysqli_query($connect, $query);
    if (!$result) echo "<br>Erreur: ".mysqli_error($connect);
    else {
      echo <<< html
      <br>
      <i class="bi bi-check-lg"></i>
      <p> Le thème a été réactivé ! </p>
      <table>
      <tr>
      <td>
      <a href="acceuil.html" >
      <button type="button" class='button effacer' ><span>Accueil</span></button>
      </a>
      </td>
      <td>
      <a href="ajout_theme.html" >
      <button type="button" class='button valider' ><span>Recommancer</span></button>
      </a>
      </td>
      </tr>
      <table>
      html;
    }
  }else {
  $query = 'insert into themes values ( NULL,"'.$_POST['nom'].'", 0 , "'.$_POST['descriptif'].'")'; // Requête pour ajouter un thème
  // echo "<br>$query<br>";
  $result = mysqli_query($connect, $query);
  if (!$result) echo "<br>c'est pas bon ! ".mysqli_error($connect);
  else {
    echo <<< html
    <br>
    <i class="bi bi-check-lg"></i>
    <p> Le thème a été ajouté ! </p>
    <table>
    <tr>
    <td>
    <a href="acceuil.html" >
    <button type="button" class='button effacer' ><span>Accueil</span></button>
    </a>
    </td>
    <td>
    <a href="ajout_theme.html" >
    <button type="button" class='button valider' ><span>Recommancer</span></button>
    </a>
    </td>
    </tr>
    <table>
    html;
  }
}
  mysqli_close($connect);
    ?>
</body>

</html>
