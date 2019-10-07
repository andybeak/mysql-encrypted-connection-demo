<?php

try {

    $databaseHost = $_ENV['DB_HOST'];
    $databaseUser = $_ENV['DB_USERNAME'];
    $databasePass = $_ENV['DB_PASSWORD'];
    $databaseName = $_ENV['DB_DATABASE'];

    $dsn = "mysql:dbname=$databaseName;host=$databaseHost";

    $pdo = new PDO(
        $dsn,
        $databaseUser,
        $databasePass, [
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        PDO::MYSQL_ATTR_SSL_KEY => '/etc/ssl/mysql/client-key.pem',
        PDO::MYSQL_ATTR_SSL_CERT => '/etc/ssl/mysql/client-cert.pem',
        PDO::MYSQL_ATTR_SSL_CA => '/etc/ssl/mysql/ca.pem'
    ]);

    $query = $pdo->prepare("SHOW DATABASES");

    $query->execute();

    $result = $query->fetchall();

    var_dump($result);

} catch (Throwable $e) {

    echo $e->getMessage();

}
