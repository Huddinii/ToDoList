<?php

 
        $this -> db = new SQLite3('sqlite.db', SQLITE3_OPEN_READWRITE);
        $statement = $this -> db->prepare('INSERT INTO user (username, mail, password)
            VALUES (:uid, :username, :mail, :password)');

        // Werte binden
        $statement->bindValue(':username', $username);
        $statement->bindValue(':mail', $mail);
        $statement->bindValue(':password', $hashedPassword);
        $result = $statement-> execute();
        $result -> fetchArray(SQLITE3_ASSOC);
        print_r($result->fetchArray(SQLITE3_ASSOC));


?>