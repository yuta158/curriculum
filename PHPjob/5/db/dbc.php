<?php

const DSN = 'mysql:host=localhost; charset=utf8; dbname=checktest5';
const DB_USER = 'root';
const DB_PW = 'root';

function connect()
{
  try {
    $pdo = new PDO(DSN, DB_USER, DB_PW, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo '<h1>' . '接続成功' . '</h1>';
    return $pdo;
  } catch (PDOException $e) {
    echo '<h1>' . '接続失敗' . ' : ' . $e->getMessage() . '</h1>';
    die();
  }
}
