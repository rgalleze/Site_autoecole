<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet">
  <meta charset="utf-8">
</head>
    <?php
    include 'connexionbdd.php';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8');
    $result = mysqli_query($connect,"SELECT * FROM themes where supprime=0 "); // On récupère les thèmes actifs
    echo <<< html
    <body>
      <h2><i class="bi bi-calendar-plus"></i>  Séances </h2>
      <form action="ajouter_seance.php" method="post">
        <table>
          <tr>
            <td><label for='nom'>Date</label></td>
            <td><input type='date' id='nom' class='champ' name='date' min="$date_today" required></td>
          </tr>
          <tr>
            <td><label for='effmax'>Effectif Max</label></td>
            <td><input type='number' class='champ' name='effmax' id='effmax' min="0" required></td>
          </tr>
          <tr>
            <td><label for='theme'> Thème </label> </td>
            <td><select class='champ' name='theme' id='theme'>\n
    html ;
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
    echo <<< html
                     <option value={$row[0]}>{$row[1]}</option>\n
    html ;
    }
    echo <<< html
                </select></td>
          </tr>
          <tr>
            <td><input type='reset' class='button effacer' value='Effacer'></td>
            <td><input type='submit' class='button valider' value='Valider'></td>
          </tr>
        </table>
      </form>
    html ;
    mysqli_close($connect);
    ?>
</body>
</html>
