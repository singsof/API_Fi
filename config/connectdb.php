<?php
date_default_timezone_set('Asia/Bangkok');
define("DB_TYPE", "MySQL"); // MySQL & SQLite
define("DB_HOST", "localhost");
define("DB_USERNAME", "id19745545_api_fishtank_sw");
define("DB_PASSWORD", "FCNMR6i[ukQH}}aM");
define("DB_NAME", "id19745545_api_fishtank");  //id19745545_api_fishtank


// define("DB_USERNAME", "root"); //id19745545_api_fishtank_sw
// define("DB_PASSWORD", ""); //FCNMR6i[ukQH}}aM
// define("DB_NAME", "api_fishtank");  //id19745545_api_fishtank

define("DB_DNS_MYSQL", "mysql:host=" . DB_HOST . "; dbname=" . DB_NAME);
define("DB_DNS_SQLITE", "sqlite:db/sqlite_file");


class DB
{
    private static $link = null;
    private static function getLink()
    {
        if (self::$link) {
            return self::$link;
        }
        self::$link = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USERNAME, DB_PASSWORD);
        self::$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$link;
    }

    public static function __callStatic($name, $args)
    {
        $callback = array(self::getLink(), $name);
        return call_user_func_array($callback, $args);
    }



    public static function Con_delete()
    {
        self::getLink() == null;
    }
}
