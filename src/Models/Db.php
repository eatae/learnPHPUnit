<?php

namespace App\Models;



class Db
{
    private static $_instance;
    /** @var \mysqli */
    private $ins_db = null;

    /**
     * Db constructor.
     */
    private function __construct(){}


    public static function get_instance()
    {
        if (self::$_instance instanceof static) {
            return self::$_instance;
        }
        return self::$_instance = new static();
    }

    /**
     * @param $host
     * @param $username
     * @param $pass
     * @param $db
     */
    public function setConnection($host, $username, $pass, $db)
    {
        try {
            $this->ins_db = new \mysqli($host, $username, $pass, $db);
            if ($this->ins_db->connect_error) {
                throw new \Exception('Ошибка соединения: '.$this->ins_db->connect_error);
            }
            $this->ins_db->query("SET NAMES 'UTF8'");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param string $sql
     * @return mixed
     */
    public function query(string $sql)
    {
        return $this->ins_db->query($sql);
    }

    /**
     * @return mixed
     */
    public function getLastId()
    {
        return $this->ins_db->insert_id;
    }





}
