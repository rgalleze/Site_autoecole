<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link href="style.css" rel="stylesheet">
  <meta charset="utf-8">
  <title>Ajout séance</title>
</head>
  <body>
    <h2><i class="bi bi-dash-circle"></i> Suppression thème </h2>
        <form action="supprimer_theme.php" method="post">
          <table>
    <?php
    include 'connexionbdd.php';
    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
    mysqli_set_charset($connect, 'utf8');
    $result = mysqli_query($connect,"SELECT * FROM themes where supprime=0 ");
    echo <<< html
    <br>
    <tr>
    <td> <label for='theme'> Thème </label> </td> </tr>
    <tr>
    <td> <select class='champ' name='theme' id='theme'>
    html ;
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)){
    echo <<< html
    <option value='$row[0]'>
    $row[1]
    </option>
    html ;
    }
    echo <<< html
    </select></td>
    <td><input type='submit' class='button effacer' value='Supprimer'></td>
    </tr>
    </table>
    </form>
    html ;
    mysqli_close($connect);
    ?>


</body>
</html>
