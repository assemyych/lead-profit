<?php
include 'Init.php';
echo 'TASK 1<br>';

$host = "127.0.0.1";
$username = "root";
$password = "Password123#@!";
$dbname = "mydb";
$charset = 'utf8mb4';

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach ((new Init($pdo))->get() as $row) {
        echo 'ID: '. $row['id'] .', TITLE: '. $row['title'] .', DESCRIPTION: '. $row['description']
            .', CREATED_AT: '. $row['created_at'] .', RESULT: '. $row['result'] . "\n";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
