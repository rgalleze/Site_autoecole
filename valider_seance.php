<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet">
  <meta charset="utf-8">
  <title>Séance</title>
</head>


    <?php
    include 'connexionbdd.php';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8');
    $nom_seance = mysqli_query($connect,'SELECT idseance,DateSeance, themes.nom FROM seances inner join themes WHERE idseance = "'.$_POST['seance'].'" and seances.IdTheme = themes.idTheme');
    $result = mysqli_query($connect,'select inscription.ideleve,nom,prenom,idseance,note from inscription  join eleves  on  eleves.ideleve = inscription.ideleve and idseance = "'.$_POST['seance'].'" ');
    if (!$result) echo "<br>Erreur: ".mysqli_error($connect);
    $row = $nom_seance -> fetch_array(MYSQLI_NUM);
    echo <<< html
    <br>
    <form action="noter_eleves.php" method="post">
    <table class="consult">
    <thead>
    <tr><th colspan="3" >Liste élèves inscrits à la séance du {$row[1]} : {$row[2]} </th></tr>
    <tr><th>Nom</th><th>Prénom</th><th>Nombre de fautes</th></tr>
    </thead>
    <tr>
    html;
    while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      echo <<< html
      <td>{$row['nom']}</td>
      <td>{$row['prenom']}</td>
      <td><input type='number' min=0 max=40 name='{$row['ideleve']}' placeholder='{$row['note']}'></td>
      </tr>
      html;
  }
    echo <<< html
    </table><br>
    <table>
    <tr>
    <td><a href="validation_seance.php">
      <button type="button" class='button effacer'><span>Retour</span></button>
    </a></td>
    <td><input type='submit' class='button valider' value='Mettre à jour' ></td>
    </tr>
    <input type='number' name='idseance' value='{$_POST['seance']}' hidden >
    </table>

    </form>
    html;

    mysqli_close($connect);
    ?>


</body>
</html>
