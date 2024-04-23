<?php

$dsn = "pgsql:host=localhost;dbname=jtollola";
$user = "db_jtollola";
$pass = getenv("DB_PASSWORD");
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

// Tarkistetaan, onko lomakkeelta saatu tarvittavat tiedot
if(isset($_POST['nimi'], $_POST['ohj'], $_POST['genre'], $_POST['vuosi'], $_POST['mp'], $_POST['np'])) {
    $nimi = $_POST['nimi'];
    $ohj = $_POST['ohj'];
    $genre = $_POST['genre'];
    $vuosi = $_POST['vuosi'];
    $mp = $_POST['mp'];
    $np = $_POST['np'];

    try {
        $yht = new PDO($dsn, $user, $pass, $options);
        
        $kys = "INSERT INTO elokuvat (nimi, ohjaaja, genre, vuosi, miespaaosa, naispaaosa) VALUES (?, ?, ?, ?, ?, ?)";
        
        $lause = $yht->prepare($kys);
        
        $lause->bindValue(1, $nimi);
        $lause->bindValue(2, $ohj);
        $lause->bindValue(3, $genre);
        $lause->bindValue(4, $vuosi);
        $lause->bindValue(5, $mp);
        $lause->bindValue(6, $np);
        
        $lause->execute();
        
        // Suljetaan tietokantayhteys
        $yht = null;

        // Ohjataan käyttäjä takaisin index.html-sivulle
        header('Location: index.html');
        exit();

    } catch (PDOException $e) {
        echo "Virhe: " . $e->getMessage();
        die();
    }
} else {
    echo "Kaikkia tietoja ei ole annettu. Täytä kaikki kentät ja yritä uudelleen.";
    die();
}
?>