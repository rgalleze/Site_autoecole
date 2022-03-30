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
$result=mysqli_query ($connect, 'select * from eleves where ideleve ="'.$_POST['eleve'].'"');
if (!$result) {
    printf("Error: %s\n", mysqli_error($connect));
    exit();
}
echo <<< html
<h2>Elève </h2>
<table class="consult">
<thead>
<tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Date de naissance</th>
    <th>Date inscription</th>
</tr>
</thead>
<tr>
html;
while ($row = $result -> fetch_assoc()) {
  foreach ($row as $key => $col) {
    echo "<td>".$col."</td>";
  }
  echo"</tr>";
}
echo"</table>";
echo <<< html
<br>
<table>
<tr>
<td><a href="consultation_eleve.php">
  <button type="button" class='button effacer'><span>Retour</span></button>
</a></td>

</tr>
</table>
html;

mysqli_close($connect);
?>
