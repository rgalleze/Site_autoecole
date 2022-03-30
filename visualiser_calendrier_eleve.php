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
$result=mysqli_query ($connect, 'SELECT seances.idSeance,DateSeance,nom FROM inscription inner join seances on inscription.ideleve = "'.$_POST['eleve'].'" and inscription.idseance = seances.idSeance join themes on themes.idTheme = seances.IdTheme ORDER by DateSeance');
if (!$result) {
    printf("Error: %s\n", mysqli_error($connect));
    exit();
}
$ligne_eleve = mysqli_query($connect, 'select nom,prenom from eleves where ideleve = "'.$_POST['eleve'].'"')->fetch_assoc();
echo <<< html
<h2>Séance non faites par {$ligne_eleve['nom']}  {$ligne_eleve['prenom']}</h2>
<table class="consult">
<thead>
<tr>
    <th>ID</th>
    <th>Date</th>
    <th>Thème</th>
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

mysqli_close($connect);
?>
