<?php


try {
    // Verbindung zur SQLite-Datenbank
    $db = new SQLite3('sqlite.db', SQLITE3_OPEN_READWRITE);
    $db->enableExceptions(true);

    // SQL-Abfrage vorbereiten
    $statement = $db->prepare('SELECT * FROM user');
    $result = $statement->execute();

    // Ergebnisse abrufen
    $row = $result->fetchArray(SQLITE3_ASSOC);

    if ($row) {
        print_r($row);
    } else {
        echo "Keine Daten gefunden in der Tabelle 'user'.";
    }

} catch (Exception $e) {
    // Fehlerbehandlung
    echo "Fehler: " . $e->getMessage();
}
?>