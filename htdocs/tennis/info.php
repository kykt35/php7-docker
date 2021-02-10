<?php
  include 'includes/login.php';
  $fp = fopen("info.txt", "r");
  $lines = array();

  if ($fp) {
    while(!feof($fp)) {
      $lines[] = fgets($fp);
    }
    fclose($fp);
  }
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
    <title>テニスサークル交流サイト</title>
  </head>
  <body>
    <h1>テニスサークル交流サイト</h1>
    <p><a href="index.php">トップページへ戻る</a></p>
    <h2>お知らせ</h2>
    <?php
      if (count($lines) > 0) {
        for($i = 0; $i < count($lines); $i++) {
          if($i === 0) {
            echo '<h3>' . $lines[0] . '</h3>';
          } else {
            echo $lines[$i] . '<br />';
          }
        }
      } else {
        echo 'お知らせはありません。';
      }
    ?>
  </body>
</html>