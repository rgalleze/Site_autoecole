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
$result=mysqli_query ($connect, 'select * from eleves ORDER by nom');
echo <<< html
<form method='POST' action='visualiser_calendrier_eleve.php'>
<table>
<thead>
  <tr>
    <th colspan="2">
      <h2><i class="bi bi-calendar2-date-fill"></i> Calendrier élève </h2>
    </th>
  </tr>
</thead>
<tr><td><label for='eleve' >Élève</label></td></tr>
<tr>
<td>
<select class='champ' name='eleve' id='eleve' >\n
html;
while ($row = mysqli_fetch_array($result))
     {echo'<option value="'.$row['ideleve'].'">'.$row['nom'].'  '.$row['prenom'].' </option>  '; echo "\n";}
echo <<< html
</select>
</td>
<td><input type='submit' class='button valider' value='Valider'></td>
</tr>
</tbody>
</table>
</form>
</body>
html ;
mysqli_close($connect);
?>
