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

try {
    $yht = new PDO($dsn, $user, $pass, $options);
    if (!$yht) { die(); }

    $kys = "SELECT * FROM elokuvat ORDER BY nimi ASC";
    $lause = $yht->prepare($kys);
    $lause->execute();

    echo "<h2>Kaikki elokuvat</h2>";
    echo "<table>
        <tr>
            <th>Nimi</th>
            <th>Ohjaaja</th>
            <th>Genre</th>
            <th>Vuosi</th>
            <th>Miespääosa</th>
            <th>Naispääosa</th>
            </tr>";

while ($tulos = $lause->fetch(PDO::FETCH_ASSOC)) {
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
    echo $e->getMessage ();
    die ();
}
?>
<br>
<h2> Päävalikko </h2>
<br>
    <a href="list.php">Kaikki elokuvat</a><br>
    <a href="add.html">Lisää uusi</a><br>
    <a href="find.html">Hae elokuvaa</a><br>
    <a href="index.html">Etusivu</a><br>

</body>
</html>