<?php

namespace App\Classes;
use PDO;
use PDOException;

/**
 * Handle MySQL Connection with PDO.
 * Class DB
 */
class DB {
    private $server = "localhost";
    private $db = "clavardage";
    private $user = "root";
    private $pwd = "";

    private static ?PDO $dbInstance = NULL;

    /**
     * DbStatic constructor.
     */
    public function __construct() {
        try {
            self::$dbInstance = new PDO("mysql:host=$this->server;dbname=$this->db;charset=utf8", $this->user, $this->pwd);
            self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$dbInstance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Return PDO instance.
     */
    public static function getInstance(): ?PDO {
        if( is_null(self::$dbInstance) ) {
            new self();
        }
        return self::$dbInstance;
    }

    /**
    * Return sanitized string to have secure data to insert into the database.
    * @param $data
    * @return string
    */
    public static function sanitizeString($data): string {
        $data = strip_tags($data);
        $data = addslashes($data);
        return trim($data);
    }

    /**
     * Return sanitized int to have secure data to insert into the database.
     * @param $data
     * @return int
     */
    public static function sanitizeInt($data): int {
        return intval($data);
    }

    /**
     * Avoid instance to be cloned.
     */
    public function __clone() {}
}
