<?php

namespace App\Models;


class Db
{
    private $host;
    private $username;
    private $pass;
    private $db;

    /**
     * Db constructor.
     * @param $host
     * @param $username
     * @param $pass
     * @param $db
     */
    public function __construct($host, $username, $pass, $db)
    {
        $this->host = $host;
        $this->username = $username;
        $this->pass = $pass;
        $this->db = $db;
    }

    public function connect($some_arg = true)
    {
        // ...
        return false;
    }
}
