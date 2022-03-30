<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link href="style.css" rel="stylesheet">
  <title></title>
</head>
<?php
  include 'connexionbdd.php';
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
  $query = 'UPDATE themes SET supprime = 1 WHERE idTheme = "'.$_POST['theme'].'"';
  $result = mysqli_query($connect, $query);
  if (!$result) echo "<br>Erreur: ".mysqli_error($connect);
  else {
    echo <<< html
    <br>
    <i class="bi bi-check-lg"></i>
    <p> Le thème a été supprimé ! </p>
    <table>
    <tr>
    <td>
    <a href="acceuil.html" >
    <button type="button" class='button effacer' ><span>Accueil</span></button>
    </a>
    </td>
    <td>
    <a href="suppression_theme.php" >
    <button type="button" class='button valider' ><span>Recommancer</span></button>
    </a>
    </td>
    </tr>
    <table>
    html;
  }
  mysqli_close($connect);

?>
