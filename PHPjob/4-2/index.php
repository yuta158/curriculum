<?php
require_once 'getData.php';

// getDataクラスのインスタンス
$g = new getData();
// getDataクラスのメソッドでデータを取得
$userData = $g->getUserData();
$postData = $g->getPostData();

// category_noから文字列へ変換
$category_no = $postData[$i]['category_no'];
function to_category($category_no)
{
  $g = new getData();
  $postData = $g->getPostData();

  for ($i = 0; $i < count($postData); $i++) {
    if ($category_no == 1) {
      return '食事';
    } elseif ($category_no == 2) {
      return '旅行';
    } elseif ($category_no == 3) {
      return 'その他';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="jp">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.$i">
  <title>4章チェックテスト</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <header>
    <div class="flex">
      <div>
        <img src="logo/logo.png" alt="logo">
      </div>
      <div>
        <div class="header_top">ようこそ<?php echo $userData['last_name'] . $userData['first_name']; ?></div>
        <div class="header_bottom">最終ログイン日 : <?php echo $userData['last_login']; ?> </div>
      </div>
    </div>
  </header>
  <main>
    <table>
      <tr class="table_header">
        <th>記事ID</th>
        <th>タイトル</th>
        <th>カテゴリ</th>
        <th>本文</th>
        <th>投稿日</th>
      </tr>
      <tr class="table_data">
        <?php for ($i = 0; $i <= count($postData) - 1; $i++) : ?>
      <tr class="table_data">
        <!-- 取得したデータをrowごとに分けて、rowのカラムの値を取得 -->
        <td><?php echo $postData[$i]['id']; ?></td>
        <td><?php echo $postData[$i]['title']; ?></td>
        <td><?php $category_no = $postData[$i]['category_no'];
            echo to_category($category_no); ?></td>
        <td><?php echo $postData[$i]['comment']; ?></td>
        <td><?php echo $postData[$i]['created']; ?></td>
      </tr>
    <?php endfor; ?>
    </table>
  </main>
  <footer>
    <div class="footer">Y&I group.inc</div>
  </footer>
</body>

</html>