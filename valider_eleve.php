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
  $query = 'SELECT * FROM eleves WHERE nom = "'.$_POST['nom'].'" and prenom = "'.$_POST['prenom'].'" ';
  $verif = mysqli_query($connect, $query);
  //$query = 'insert into eleves values ( NULL,"'.$_POST['nom'].'", "'.$_POST['prenom'].'", "'.$_POST['dateNaiss'].'", "'.$date_today.'")'; // Requête pour ajouter un élève
  if ( strtotime($_POST['dateNaiss']) <= strtotime("- 15 years") ) {
    if (!empty(mysqli_fetch_array($verif))) {
  	  echo <<< html
      <br>
      <i class="bi bi-exclamation-triangle-fill"></i>
      <p> Un élève avec le même nom et prénom existe ! <br> Voulez vous continuez ? </p>
      <form method='POST' action='ajouter_eleve.php'>
        <table>
          <tr>
            <td>
              <input name='nom' type='hidden' value='{$_POST['nom']}'>
              <input name='prenom' type='hidden' value='{$_POST['prenom']}'>
              <input name='dateNaiss' type='hidden' value='{$_POST['dateNaiss']}'>
              <button type="submit" class='button valider'><span>OUI</span></button>
            </td>
            <td>
              <a href="ajout_eleve.html">
                <button type="button" class='button effacer'><span>NON</span></button>
              </a>
            </td>
          </tr>
        </table>
      </form>
      html;
    }else {
      $query = 'insert into eleves values ( NULL,"'.$_POST['nom'].'", "'.$_POST['prenom'].'", "'.$_POST['dateNaiss'].'", "'.$date_today.'")'; // Requête pour ajouter un élève
      $result = mysqli_query($connect, $query);
      if (!$result) echo "<br>c'est pas bon ! ".mysqli_error($connect);
      else {
        echo <<< html
        <br>
        <i class="bi bi-check-lg"></i>
        <p> L'élève a été ajouté.e ! </p>
        <table>
          <tr>
            <td>
              <a href="acceuil.html">
                <button type="button" class='button effacer'><span>Accueil</span></button>
              </a>
            </td>
            <td>
              <a href="ajout_eleve.html">
                <button type="button" class='button valider'><span>Recommancer</span></button>
              </a>
            </td>
          </tr>
        </table>
        html;
    }
  }
} else {
  echo <<< html
  <script> alert("L'élève n'a pas l'âge légal ! ") </script>
  <META HTTP-EQUIV='refresh' CONTENT=0;URL='ajout_eleve.html'>
  html;

}

  mysqli_close($connect);
    ?>
</body>
</html>
