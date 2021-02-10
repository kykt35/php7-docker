<?php
  session_start();

  if (isset($_SESSION['id'])) {
    header('Location: index.php');
  } else if (isset($_POST['name']) && isset($_POST['password'])) {
    $dsn = 'mysql:host=mysql; dbname=tennis; charset=utf8';
    $user = 'root';
    $password = 'password';

    try {
      $db = new PDO($dsn, $user, $password);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $db->prepare("
        SELECT * FROM users WHERE name=:name AND password=:password");

      $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
      $stmt->bindParam(':password', sha1($_POST['password']), PDO::PARAM_STR);

      $stmt->execute();

      if ($row = $stmt->fetch()) {
        $_SESSION['id'] = $row['id'];
        header('Location: index.php');
        exit();
      } else {
        header('Location: login.php');
        exit();
      }
    } catch (PDOException $e) {
      die('エラー:'. $e->getMessage());
    }
  } else {
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;
  charset=UTF-8">
    <title>テニスサークル交流サイト</title>
</head>
<body>
  <h1>テニス交流サイト</h1>

  <h2>ログイン</h2>
  <form action="login.php" method="post">
    <p>ユーザー名: <input type="text" name="name"></p>
    <p>パスワード: <input type="password" name="password"></p>
    <p><input type="submit" value="ログイン"></p>
  </form>
</body>
</html>
<?php } ?>