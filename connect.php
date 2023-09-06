<?php
$serverName = "localhost";
$username = "username";
$password = "password";

$conn = mysqli_connect($serverName, $username, $password);
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    mysqli_select_db($conn, "QuizSite");

    // Password is stored as an sha512 hash, which is 128 characters long.
    $createTableQuery = "CREATE TABLE IF NOT EXISTS Users (
                                            username VARCHAR(50) NOT NULL,
                                            password VARCHAR(128) NOT NULL,
                                            firstName VARCHAR(40) NOT NULL,
                                            lastName VARCHAR(40) NOT NULL,
                                            birthDate DATE NOT NULL,
                                            propic VARCHAR (50),
                                            timesTaken INT(1) NOT NULL,
                                            bestScore INT(3) NOT NULL,
                                            PRIMARY KEY(username))";
    mysqli_query($conn, $createTableQuery);
}