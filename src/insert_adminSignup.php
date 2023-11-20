<?php
// insert_adminSignup.php
// adminSignupページで入力された情報をdbに登録する

// 正規表現を用いて両端の空白を除去する処理（全角スペース等のマルチバイトにも対応）
function mbTrim($pString)
{
    return preg_replace('/\A[\p{Cc}\p{Cf}\p{Z}]++|[\p{Cc}\p{Cf}\p{Z}]++\z/u', '', $pString);
}

// 入力値を確認する（企業名）
$is_valid_company_name = true;
$input_company_name = '';
if (isset($_POST['company_name'])) {
    $input_company_name = mbTrim(str_replace("\r\n", "\n", $_POST['company_name']));
} else {
    $is_valid_company_name = false;
}
if ($is_valid_company_name && $input_company_name === '') {
    $is_valid_company_name = false;
}
if ($is_valid_company_name && mb_strlen($input_company_name) > 100) {
    $is_valid_company_name = false;
}

// 入力値を確認する（管理者名）
$is_valid_admin_name = true;
$input_admin_name = '';
if (isset($_POST['admin_name'])) {
    $input_admin_name = mbTrim(str_replace("\r\n", "\n", $_POST['admin_name']));
} else {
    $is_valid_admin_name = false;
}
if ($is_valid_admin_name && $input_admin_name === '') {
    $is_valid_admin_name = false;
}
if ($is_valid_admin_name && mb_strlen($input_admin_name) > 100) {
    $is_valid_admin_name = false;
}

// 入力値を確認する（パスワード）
$is_valid_password = true;
$input_password = '';
if (isset($_POST['password'])) {
    $input_password = mbTrim(str_replace("\r\n", "\n", $_POST['password']));
    $input_password = password_hash($input_password, PASSWORD_DEFAULT);     // パスワードをハッシュ化（ログイン時には password_verify 関数を使用してハッシュ化されたパスワードを検証）
} else {
    $is_valid_password = false;
}
if ($is_valid_password && $input_password === '') {
    $is_valid_password = false;
}
if ($is_valid_password && mb_strlen($input_password) > 100) {
    $is_valid_password = false;
}

// 投稿をデータベースへ保存する処理
if ($is_valid_company_name && $is_valid_admin_name && $is_valid_password) {
    // INSERT クエリを作成する
    $queryCompanyInfo = 'INSERT INTO CompanyInfo (company_name) VALUES (:company_name)';
    $queryUserInfo = 'INSERT INTO UserInfo (name) VALUES (:name)';
    $queryLoginInfo = 'INSERT INTO LoginInfo (password) VALUES (:password)';

    // SQL 実行の準備 (実行はされない)
    $stmtCompanyInfo = $dbh->prepare($queryCompanyInfo);
    $stmtUserInfo = $dbh->prepare($queryUserInfo);
    $stmtLoginInfo = $dbh->prepare($queryLoginInfo);

    // プレースホルダに値をセットする
    $stmtCompanyInfo->bindValue(':company_name', $input_company_name, PDO::PARAM_STR);
    $stmtUserInfo->bindValue(':name', $input_admin_name, PDO::PARAM_STR);
    $stmtLoginInfo->bindValue(':password', $input_password, PDO::PARAM_STR);

    // クエリを実行する
    $stmtCompanyInfo->execute();
    $stmtUserInfo->execute();
    // LoginInfoへの登録はまだうまくいかない
    // $stmtLoginInfo->execute();
}

header('Location: /view_adminHome.php');
exit();