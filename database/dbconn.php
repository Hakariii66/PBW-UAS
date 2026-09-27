<?php
$db_hostname = "db.fr-roub1.bengt.wasmernet.com";
$db_database = "phpuas"; // Ganti dengan nama database Anda
$db_username = "user_cb5cedda";         // Ganti dengan username MySQL Anda
$db_password = "pw_6WalbxgK4UkR304bME8gYxR060b76g04";             // Ganti dengan password MySQL Anda
$db_charset = "utf8mb4";

$dsn = "mysql:host=$db_hostname;dbname=$db_database;charset=$db_charset";

$opt = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
);

try {
    $pdo = new PDO($dsn, $db_username, $db_password, $opt);
} catch (PDOException $e) {
    exit("PDO Error: " . $e->getMessage() . "<br>");
}
?>