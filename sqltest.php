<?php


try {
    // Verbindung zur SQLite-Datenbank
    $db = new SQLite3('sqlite.db', SQLITE3_OPEN_READWRITE);
    $db->enableExceptions(true);
    $id = 20;
    // SQL-Abfrage vorbereiten
    $statement = $db->prepare('SELECT * FROM ToDo WHERE id = :id');
    $statement->bindValue('id', $id);
    $result = $statement->execute();

    // Ergebnisse abrufen
    while (($row = $result -> fetchArray(SQLITE3_ASSOC)) != false) {
        print_r($row);
    }

} catch (Exception $e) {
    // Fehlerbehandlung
    echo "Fehler: " . $e->getMessage();
}
?>