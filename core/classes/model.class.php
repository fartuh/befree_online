<?php

namespace Core\Classes;

use \Core\Classes\DB as DB;
use \PDO;

class Model
{

    /*
     * Class that contains the whole structure and methods of every model
     */

    protected static $table = null;

    public static function getDB(){
        return DB::getDB();
    }

    public static function find($id){
        $table = static::$table;
        $stmt = self::prepare("SELECT * FROM $table WHERE id = ?");

        $stmt->execute([$id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public static function get($get = '*'){
        $table = static::$table;
        $stmt = self::prepare("SELECT $get FROM $table");
        $stmt->execute();

        $data = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function prepare($sql){
        $pdo = self::getDB();
        $stmt = $pdo->prepare($sql);

        return $stmt;
    }

}
