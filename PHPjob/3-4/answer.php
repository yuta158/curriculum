<link rel="stylesheet" href="css/style.css">
<?php
$name = $_POST['name'];
// 選択した回答
$answer1 = $_POST['answer1'];
$answer2 = $_POST['answer2'];
$answer3 = $_POST['answer3'];
// 正解
$correct_answer1 = $_POST['correct_answer1'];
$correct_answer2 = $_POST['correct_answer2'];
$correct_answer3 = $_POST['correct_answer3'];

//選択した回答と正解が一致していれば「正解！」、一致していなければ「残念・・・」と出力される処理を組んだ関数を作成する
function judge($a, $ca)
{
    if ($a === $ca) {
        echo '正解！';
    } else {
        echo '残念・・・';
    }
}
?>
<div class="answer">
  <p><?php echo $name; ?>さんの結果は・・・？</p>
  <p>①の答え</p>
  <!--作成した関数を呼び出して結果を表示-->
  <?php echo judge($answer1, $correct_answer1); ?>
  
  <p>②の答え</p>
  <!--作成した関数を呼び出して結果を表示-->
  <?php echo judge($answer2, $correct_answer2); ?>
  
  <p>③の答え</p>
  <!--作成した関数を呼び出して結果を表示-->
  <?php echo judge($answer3, $correct_answer3); ?>
</div>



