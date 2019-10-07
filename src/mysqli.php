<?php

try {

    $link = mysqli_init();

    if ($link === false) {
        die('Could not initialize a resource link');
    }

    mysqli_options($link, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);

    $link->ssl_set(
        '/etc/ssl/mysql/client-key.pem',
        '/etc/ssl/mysql/client-cert.pem',
        '/etc/ssl/mysql/ca.pem',
        null,
        null
    );

    $databaseHost = $_ENV['DB_HOST'];
    $databaseUser = $_ENV['DB_USERNAME'];
    $databasePass = $_ENV['DB_PASSWORD'];
    $databaseName = $_ENV['DB_DATABASE'];
    $databasePort = $_ENV['DB_PORT'];

    if (false === $link->real_connect(
            $databaseHost,
            $databaseUser,
            $databasePass,
            $databaseName,
            $databasePort,
            null,
            MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT)
    ) {
        throw new Exception('Connection error :  [' . mysqli_connect_errno() . '] [' . mysqli_connect_error() . ']');
    }

    $result = mysqli_query($link, "SHOW DATABASES;");

    while ($row = mysqli_fetch_assoc($result)) {

        var_dump($row);

    };

} catch (Throwable $e) {

    echo $e->getMessage();

}

