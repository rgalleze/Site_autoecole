<head>
  <link href="style.css" rel="stylesheet">
  <meta charset="utf-8">
</head>
<?php
include 'connexionbdd.php';
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
mysqli_set_charset($connect, 'utf8');
$query = 'SELECT * FROM inscription WHERE idseance = "'.$_POST['idseance'].'" ';
$result = mysqli_query($connect,$query);
//echo "<br>$query<br>";
while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
  if (!empty($_POST[$row[1]])){
  if ($_POST[$row[1]]>40 or $_POST[$row[1]] < 0){die('Les notes sont comprises entre 0 et 40!');}
  $query = 'UPDATE `inscription` SET note = "'.$_POST[$row[1]].'" WHERE ideleve = "'.$row[1].'" and idseance = "'.$_POST['idseance'].'"';
  //echo "<br>$query<br>";
  $changer_note = mysqli_query($connect,$query);
  if (!$changer_note) echo "<br>c'est pas bon ! ".mysqli_error($connect);

}
}
echo <<< html
<br>
<i class="bi bi-check-lg"></i>
<p> Les notes ont été mises à jour ! </p>
<table>
<tr>
<td>
<a href="acceuil.html" >
<button type="button" class='button effacer' ><span>Accueil</span></button>
</a>
</td>
<td>
<a href="validation_seance.php" >
<button type="button" class='button valider' ><span>Recommancer</span></button>
</a>
</td>
</tr>
<table>
html;
  /*else {
    echo <<< html
    <link href="style.css" rel="stylesheet">
    <br>
    <i class="bi bi-check-lg"></i>
    <p> Les notes ont été mis à jour ! </p>
    <table>
    <tr>
    <td>
    <a href="acceuil.html" >
    <button type="button" class='button effacer' ><span>Accueil</span></button>
    </a>
    </td>
    <td>
    <a href="validation_seance.php" >
    <button type="button" class='button valider' ><span>Retour</span></button>
    </a>
    </td>
    </tr>
    <table>
    html;
      }
 }}*/
mysqli_close($connect);
 ?>
