<link rel="stylesheet" href="css/style.css">
<?php
$name = $_POST['name'];
//①画像を参考に問題文の選択肢の配列を作成してください。
$question1 = [80, 22, 20, 21];
$question2 = ['PHP', 'Python', 'JAVA', 'HTML'];
$question3 = ['join', 'select', 'insert', 'update'];

//② ①で作成した、配列から正解の選択肢の変数を作成してください
$correct_answer1 = $question1[0];
$correct_answer2 = $question2[3];
$correct_answer3 = $question3[1];
?>

<form action="answer.php" method="POST">
<p>お疲れ様です<?php echo $name; ?>さん</p>
<input type="hidden" name="name" value="<?php echo $name; ?>">
  <h2>①ネットワークのポート番号は何番？</h2>

  <!--③ 問題のradioボタンを「foreach」を使って作成する-->
  <?php foreach ($question1 as $q): ?>
      <input type="radio" name="answer1" value="<?php echo $q; ?>"><?php echo $q; ?>
  <?php endforeach; ?>
  <input type="hidden" name="correct_answer1" value="<?php echo $correct_answer1; ?>">

  <h2>②Webページを作成するための言語は？</h2>
  <!--③ 問題のradioボタンを「foreach」を使って作成する-->
  <?php foreach ($question2 as $q): ?>
      <input type="radio" name="answer2" value="<?php echo $q; ?>"><?php echo $q; ?>
  <?php endforeach; ?>
  <input type="hidden" name="correct_answer2" value="<?php echo $correct_answer2; ?>">

  <h2>③MySQLで情報を取得するためのコマンドは？</h2>
  <!--③ 問題のradioボタンを「foreach」を使って作成する-->
  <?php foreach ($question3 as $q): ?>
      <input type="radio" name="answer3" value="<?php echo $q; ?>"><?php echo $q; ?>
  <?php endforeach; ?>
  <input type="hidden" name="correct_answer3" value="<?php echo $correct_answer3; ?>">

  <br>
  <input class="btn" type="submit" value="回答する">
</form>

 <!--問題の正解の変数と名前の変数を[answer.php]に送る -->

