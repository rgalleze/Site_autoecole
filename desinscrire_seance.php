<?php
include 'connexionbdd.php';
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Error connecting to mysql'); // Connexion à la bdd
mysqli_set_charset($connect, 'utf8'); // Les données envoyées vers mysql sont encodées en UTF-8
if (isset($_POST['eleve']) and isset($_POST['seance'])) {
    $query = 'delete from inscription where idseance="' . $_POST['seance'] . '" and ideleve = "' . $_POST['eleve'] . '"'; // Requête pour ajouter un élève
    // echo "<br>$query<br>";
    $result = mysqli_query($connect, $query);
    if (!$result) echo "<br>c'est pas bon ! " . mysqli_error($connect);
    else {
        echo <<< html
        <link href="style.css" rel="stylesheet" />
        <br />
        <i class="bi bi-check-lg"></i>
        <p>L'élève a été désinscrit.e !</p>
        <table>
          <tr>
            <td>
              <a href="acceuil.html">
                <button type="button" class="button effacer">
                  <span>Accueil</span>
                </button>
              </a>
            </td>
            <td>
              <a href="desinscription_seance.php">
                <button type="button" class="button valider">
                  <span>Recommancer</span>
                </button>
              </a>
            </td>
          </tr>
          <table></table>
        </table>
  html;
    }
}
mysqli_close($connect);
