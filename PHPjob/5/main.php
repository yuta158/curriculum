<?php
require_once 'db/dbc.php';
require_once 'function.php';

// セッションにuser_nameの値がなければlogin.phpにリダイレクト
check_user_logged_in();

// booksテーブルからデータを降順で取得
$pdo = connect();
try {
  $sql = 'SELECT * FROM books ORDER BY id DESC';
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
} catch (PDOException $e) {
  echo 'Error   :  ' . $e->getMessage();
}

?>

<!doctype html>
<html lang="ja">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <?php
  echo 'ようこそ　' . $_SESSION['user_name'] . 'さん';
  ?>
  <title>在庫一覧画面</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <h2>在庫一覧画面</h2>
  <form action="register.php" method="POST">
    <input class="new_register_btn" type="submit" name="new_register" value="新規登録">
  </form>
  <form action="logout.php" method="POST">
    <input class="logout_btn" type="submit" name="logout" value="ログアウト">
  </form>
  <table>
    <tr>
      <th>タイトル</th>
      <th>発売日</th>
      <th>在庫数</th>
      <th></th>
    </tr>
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
      <tr>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['date']; ?></td>
        <td><?php echo $row['stock']; ?></td>
        <form action="delete_stock.php?id=<?php echo $row['id'] ?>" method="GET">
          <td><input class="delete_btn" type="submit" value="削除" ?></td>
          <!-- 削除列のidをGETで送る -->
          <input type="hidden" name="id" value="<?php echo $row['id'] ?>" name="id">
        </form>
      </tr>
    <?php endwhile ?>
  </table>

</body>

</html>