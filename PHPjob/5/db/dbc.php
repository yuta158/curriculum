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
    return $pdo;
  } catch (PDOException $e) {
    exit;
  }
}
