<head>
  <link href="style.css" rel="stylesheet">
  <meta charset="utf-8">
  <title>Ajout eleve</title>
</head>
<?php
  include 'connexionbdd.php';
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
  $query = 'SELECT * FROM seances WHERE DateSeance = "'.$_POST['date'].'" and "'.$_POST['theme'].'"';
  // echo "<br>$query<br>";
  $verif = mysqli_query($connect, $query);
  if (!empty(mysqli_fetch_array($verif))) {
    echo <<< html
    <br>
    <i class="bi bi-exclamation-triangle-fill"></i>
    <p> Vous ne pouvez pas créer 2 séances avec le même thème pour la même journée ! </p>
    <table>
    <tr>
    <td>
    <a href="acceuil.html" >
    <button type="button" class='button effacer' ><span>Accueil</span></button>
    </a>
    </td>
    <td>
    <a href="ajout_seance.php" >
    <button type="button" class='button valider' ><span>Recommancer</span></button>
    </a>
    </td>
    </tr>
    <table>
    html;
  } else {
      $query = 'insert into seances values ( NULL,"'.$_POST['date'].'", "'.$_POST['effmax'].'", "'.$_POST['theme'].'")';
      // echo "<br>$query<br>";
  	  $result = mysqli_query($connect, $query);
      if (!$result) echo "<br>Erreur: ".mysqli_error($connect);
      else {
        echo <<< html
        <script> alert('La séance a bien été ajouté') </script>
        <subtitle>Redirection vers l'accueil ...</subtitle>
        <META HTTP-EQUIV='refresh' CONTENT=1;URL='acceuil.html'>
        html;
  	  }
  }
  mysqli_close($connect);

?>
