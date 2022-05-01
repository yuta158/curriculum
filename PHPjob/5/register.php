<?php
require_once 'db/dbc.php';

// POSTで受け取った値を変数に格納
$title = $_POST['title'];
$date = $_POST['date'];
$stock = $_POST['stock'];

if (!empty($_POST)) {

  if (empty($title)) {
    echo '※タイトルを入力してください' . '<br>';
  }
  if (empty($date)) {
    echo '※発売日を入力してください' . '<br>';
  }
  if (empty($stock)) {
    echo '※在庫数を入力してください' . '<br>';
  }
  if (!empty($title) && !empty($date) && !empty($stock)) {
    // DB接続
    $pdo = connect();
    try {
      // SQL文の準備
      $sql = 'INSERT INTO books(title, date, stock) VALUES(:title, :date, :stock)';
      // プリペアドステートメントの準備
      $stmt = $pdo->prepare($sql);
      // titleをバインド
      $stmt->bindValue(':title', $title);
      // titleをバインド
      $stmt->bindValue(':date', $date);
      // stockをバインド
      if ($stock >= 1) {
        $stmt->bindValue(':stock', $stock);
      } else {
        echo '※整数を入力してください' . '<br>';
        exit;
      }
      // 実行
      $stmt->execute();
      header('Location: main.php');
      exit;
    } catch (PDOException $e) {
      echo 'Error   :   ' . $e->getMessage();
      exit;
    }
  }
}

?>

<!doctype html>
<html lang="ja">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>本 登録画面</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <h2>本 登録画面</h2>
  <form action="" method="POST">
    <input class="form" type="text" name="title" placeholder="タイトル">
    <input class="form" type="date" name="date" placeholder="発売日">
    <p>在庫数</p>
    <input class="number_form" type="number" name="stock" placeholder="選択してください">
    <input class="register_btn" type="submit" name="login" value="登録">
  </form>

</body>

</html>