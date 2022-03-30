<?php
include 'connexionbdd.php';
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

$resultat_eleve = mysqli_query($connect, 'SELECT ideleve, nom, prenom FROM eleves');
assert($resultat_eleve);
$resultat_seance = mysqli_query($connect, 'SELECT idseance,themes.nom,DateSeance,EffMax FROM seances inner join themes on seances.IdTheme = themes.idTheme and DateSeance >= CURRENT_DATE ORDER BY DateSeance'); // lES SÉANCES FUTURS
assert($resultat_seance);
echo <<< html
<head>
  <link href="style.css" rel="stylesheet">
  <meta charset="utf-8">
</head>
<table>
<thead>
<tr>
  <th colspan="1">
    <h2><i class="bi bi-journal-plus"></i> Inscription élève </h2>
  </th>
</tr>
</thead>
<tr><td><label for='eleve' >Élève</label></td></tr>
<tr><td>
<form action='inscrire_eleve.php' method='POST'>
<select class='champ' name='eleve' size='1' >\n
html;
while ($row = $resultat_eleve->fetch_assoc()) {
  echo "<option value='".$row['ideleve']."'>".$row["prenom"]." ".$row["nom"]."</option>\n";
}

echo <<< html
</select>
</td></tr>
<tr><td><label for='seance' >Séance</label></td></tr>
<tr><td>
<select class='champ' name='seance' size='1' >
html;
while ($row = $resultat_seance->fetch_assoc()) {
  $eleves_inscrit = mysqli_query($connect, 'SELECT COUNT(idSeance) FROM inscription WHERE idSeance = "'.$row['idseance'].'"');
  assert($eleves_inscrit);
  $num_inscrits = $eleves_inscrit->fetch_assoc();
  $place_restantes = $row['EffMax'] - $num_inscrits['COUNT(idSeance)'];
  if ( $place_restantes > 0) {
    echo "<option value=".$row['idseance'].">".$row['nom']." ".$row['DateSeance']." ( ".$place_restantes." places restantes ) </option>\n";
  } else echo "<option value=".$row['idseance']." disabled >".$row['nom']." ".$row['DateSeance']."  séance pleine</option>\n";
}
echo <<< html
</select>
</td></tr>
<tr><td>
<input type='submit' class='button valider' value='Inscrire'>
</td></tr>
</form>
</table>
html;

mysqli_close($connect);
?>
