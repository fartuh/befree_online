<?php

namespace Core\Classes;

class QueryBuilder
{
    public static function execute($sql, $params = []){
        $pdo = DB::getDB();       
        $stmt = $pdo->prepare($sql);

        $stmt->execute($params);
    }

    public static function destroy($table){
        self::execute("DROP TABLE $table"); 
    }
}
