<?php
session_start();
require_once(__DIR__ . '/../src/db_connect.php');

if (isset($_POST['action_type']) && $_POST['action_type']) {  // $_POST['action_type']という変数が存在することを確認してから$_POST['action_type']になんらかの値が入っていることを確認する
  if ($_POST['action_type'] === 'adminSignup') {
    require(__DIR__ . '/../src/insert_adminSignup.php');
  }
}
?>

<!-- view_adminSignup.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者サインアップ</title>
</head>
<body>
    <h1>サインアップ（管理者）</h1>

    <a href="index.php">トップページに戻る</a>

    <!-- フォーム -->
    <form method="post" action="">
        <label for="company_name">企業名:</label>
        <input type="text" name="company_name" required /><br>

        <label for="admin_name">管理者名:</label>
        <input type="text" name="user_name" required /><br>

        <label for="password">パスワード:</label>
        <input type="password" name="password" required /><br>

        <input type="hidden" name="action_type" value="adminSignup" />
        <button type="submit" class="input-submit-button">管理者アカウントを作成</button>
    </form>
</body>
</html>