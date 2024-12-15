<?php

if (!file_exists('sqlite.db')) {
    $db = new SQLite3('sqlite.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
    $db -> enableExceptions(true);
    $db -> query('CREATE TABLE IF NOT EXISTS "user" (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    username VARCHAR NOT NULL UNIQUE,
    mail VARCHAR NOT NULL UNIQUE,
    password VARCHAR
    )');

    $db -> query('CREATE TABLE IF NOT EXISTS team (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name varchar(255) NOT NULL
    )');

    $db -> query('CREATE TABLE IF NOT EXISTS project (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name varchar(255) NOT NULL
    )');

    $db -> query('CREATE TABLE IF NOT EXISTS todo (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    priority INTEGER NOT NULL,
    name TEXT NOT NULL,
    description TEXT,
    enddate DATE,
    position INTEGER,
    project_id INTEGER UNIQUE,
    FOREIGN KEY (project_id) REFERENCES project(id)
    )');

    $db -> query('CREATE TABLE IF NOT EXISTS user_team (
    user_id INTEGER,
    team_id INTEGER,
    role TEXT DEFAULT "member",
    PRIMARY KEY (user_id, team_id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (team_id) REFERENCES team(id)
    )');

    $db -> query('CREATE TABLE IF NOT EXISTS team_project (
    team_id INTEGER,
    project_id INTEGER,
    PRIMARY KEY (team_id, project_id),
    FOREIGN KEY (team_id) REFERENCES team(id),
    FOREIGN KEY (project_id) REFERENCES project(id)
    )');

    $db -> query('CREATE TABLE IF NOT EXISTS user_project (
    user_id INTEGER,
    project_id INTEGER,
    PRIMARY KEY (user_id, project_id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (project_id) REFERENCES project(id)
    )');
} else {
    $db = new SQLite3('sqlite.db', SQLITE3_OPEN_READWRITE);
    $db -> enableExceptions(true);
}
?>