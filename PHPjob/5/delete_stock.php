<?php
require_once 'db/dbc.php';

$delete_id = $_GET['delete'];

// DB接続
$pdo = connect();

try {

  // SQL文の準備
  $sql = 'DELETE FROM books WHERE id = :id';
  // プリペアドステイトメントの作成
  $stmt = $pdo->prepare($sql);
  // 値をセット
  $stmt->bindValue(':id', $delete_id);
  // 実行
  $stmt->execute();
  header("Location:  main.php");
  exit;
} catch (PDOException $e) {
  echo 'Error   :   ' . $e->getMessage();
  exit;
}
