<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet">
  <meta charset="utf-8">
  <title>Ajout séance</title>
</head>
  <body>
    <h2> <i class="bi bi-calendar2-check-fill"></i> Séléctionner une séance </h2>
        <form action="valider_seance.php" method="post">
          <table>
    <?php
    include 'connexionbdd.php';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8');
    $result = mysqli_query($connect,"Select * from seances,themes where seances.IdTheme = themes.idTheme and DateSeance <= CURRENT_DATE()");
    echo <<< html
    <tr><td> <label for='seance'> Séance </label> </td></tr>
    <tr><td> <select class='champ' name='seance' id='seance'>\n
    html ;
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
    echo <<< html
    <option value='$row[0]'>$row[5]    $row[1]</option>\n
    html ;
    }
    echo <<< html
    </select></td>
    <td><input type='submit' class='button valider' value='Valider'></td>
    </tr>
    </table>
    </form>
    html ;
    mysqli_close($connect);
    ?>


</body>
</html>
