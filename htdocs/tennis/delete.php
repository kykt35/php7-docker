<?php
  $id = intval($_POST['id']);
  $pass = $_POST['pass'];

  // validation
  if ($id == '' || $pass == '') {
    header('Location: bbs.php');
    exit();
  }

  // database connect
  $dsn = 'mysql:host=mysql; dbname=tennis; charset=utf8';
  $user = 'root';
  $password = 'password';

  try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("DELETE FROM bbs WHERE id=:id AND pass=:pass");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

    $stmt->execute();

    header('Location: bbs.php');
    exit();
  } catch(PDOException $e) {
    die('エラー: ' . $e->getMessage());
  }
?>