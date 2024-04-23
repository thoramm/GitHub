<html>
<head>
<link rel="stylesheet" href="pefostyle.css">
<meta charset="UTF-8">

</head>
<body>
<h1>Joonaksen elokuvat</h1>

<?php
$dsn = "pgsql:host=localhost;dbname=jtollola";
$user = "db_jtollola";
$pass = getenv("DB_PASSWORD");
$options = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];

$nimi = $_POST['nimi'];

$nimi = "%" . $nimi . "%";

try {
  $yht = new PDO($dsn, $user, $pass, $options);
  if (!$yht) { die(); }

  $ins = "SELECT * FROM elokuvat where nimi like ?";
  $lause = $yht->prepare($ins);
  $lause->bindValue(1, $nimi);
  $lause->execute();

  echo "<table>
  <tr>
      <th>Nimi</th>
      <th>Ohjaaja</th>
      <th>Genre</th>
      <th>Vuosi</th>
      <th>Miespääosa</th>
      <th>Naispääosa</th>
      </tr>";
  
while ($tulos = $lause->fetch()) {

      echo "<tr>";
      echo "<td>" . $tulos['nimi'] . "</td>";
      echo "<td>" . $tulos['ohjaaja'] . "</td>";
      echo "<td>" . $tulos['genre'] . "</td>";
      echo "<td>" . $tulos['vuosi'] . "</td>";
      echo "<td>" . $tulos['miespaaosa'] . "</td>";
      echo "<td>" . $tulos['naispaaosa'] . "</td>";
      echo "</tr>";
          
      }
      echo "</table>";
  }

catch (PDOException $e) {
  echo "Virhe: " . $e->getMessage();
}
?>

<br>
<h2>Päävalikko</h2>

<a href="list.php">Kaikki elokuvat</a><br>
<a href="add.html">Lisää uusi</a><br>
<a href="find.html">Hae elokuvaa</a><br>
<a href="index.html">Etusivu</a><br>


</body></html>