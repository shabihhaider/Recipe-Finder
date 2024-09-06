<?php

//Connect to out MySQL database

class Database {
    public $connection;

    public function __construct($config)
    {

        $dsn = "mysql:" . http_build_query($config, '', ';'); // build query like this: host=localhost;port=3306;dbname=recipe finder;charset=utf8mb4

        $this->connection = new PDO($dsn, 'root', '', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = []) {
        

        $statement = $this->connection->prepare($query);
        $statement->execute($params); // execute the query with the parameters

        return $statement;

    }
}
