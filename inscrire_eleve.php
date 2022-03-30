<?php
  include 'connexionbdd.php';
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');

  // Vérifier si l'élève n'est pas déjà inscrit à la séance !
  $query = 'SELECT * FROM inscription WHERE idseance = "'.$_POST['seance'].'" and ideleve = "'.$_POST['eleve'].'"';
  $verif = mysqli_query($connect, $query);
  if (!empty(mysqli_fetch_array($verif))) {
    echo <<< html
    <link href="style.css" rel="stylesheet">
    <br>
    <i class="bi bi-exclamation-triangle-fill"></i>
    <p> L'élève est déjà inscrit.e à  cette séance ! </p>
    <table>
    <tr>
    <td>
    <a href="acceuil.html" >
    <button type="button" class='button effacer' ><span>Accueil</span></button>
    </a>
    </td>
    <td>
    <a href="inscription_eleve.php" >
    <button type="button" class='button valider' ><span>Recommancer</span></button>
    </a>
    </td>
    </tr>
    <table>
    html;
  }

  else { // Si non --> inscrire l'élève à la séance
    $query = 'insert into inscription values ( "'.$_POST['seance'].'","'.$_POST['eleve'].'", NULL)';
    $result = mysqli_query($connect, $query);
    if (!$result) echo "<br>Erreur: ".mysqli_error($connect);
    else {
      echo <<< html
      <link href="style.css" rel="stylesheet">
      <br>
      <i class="bi bi-check-lg"></i>
      <p> L'élève a été inscrit.e ! </p>
      <table>
      <tr>
      <td>
      <a href="acceuil.html" >
      <button type="button" class='button effacer' ><span>Accueil</span></button>
      </a>
      </td>
      <td>
      <a href="inscription_eleve.php" >
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
