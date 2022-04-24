<?php
const DSN = 'mysql:host=localhost; charset=utf8; dbname=checktest4';
const DB_USER = 'root';
const DB_PW = 'root';

function connect()
{
    try {
        // dbh : database handler
        $dbh = new PDO(DSN, DB_USER, DB_PW, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        echo '接続成功';
    } catch (PDOException $e) {
        echo '接続失敗' . $e->getMessage();
        exit();
    }
}

?>
