# Demo of connecting PHP to MySQL over TLS

This project demonstrates encrypting data in transit when communicating between your PHP application and a MySQL database.

Even if you are the only tenant on the network you should consider encrypting data in transit so that if an attacker is able to
compromise a box on your network they will not be able to read your database traffic.

## Running the project

To run the project use the following commands:

    cd docker
    docker-compose build
    docker-compose up
    
Note that I'm not running it in the background because we want to stop the process once MySQL is ready to accept connections.
   
Wait for the MySQL server to come up and be ready to accept connections.  Press CTRL-C to abort docker-compose and then run these commands:

    sudo cp config/mysql/certs/*.pem ./data/db/
    docker-compose up -d
    docker exec -it php /bin/bash
    php pdo.php
    php mysqli.php
   
You should look for a line in the mysql log that looks like this to determine when to press CTRL-C and abort docker-compose:

    mysql    | [Entrypoint] Starting MySQL 5.7.27-1.1.12
    
## Translating to live

This project doesn't focus on the sysops side of setting up MySQL and is just a demonstration of the PHP client code.

The [MySQL manual](https://dev.mysql.com/doc/refman/5.7/en/using-encrypted-connections.html) does a good job of explaining how to configure the server to support encrypted connections.

The docker-compose file with this project sets up the server with some example certificates.  You should refer to the
[MySQL documentation](https://dev.mysql.com/doc/refman/5.7/en/creating-ssl-rsa-files.html) to see how to create your own certificates.
