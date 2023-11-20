<!-- view_login.php -->
<body>
    <h1>ログイン</h1>
    <a href="index.php">トップページに戻る</a>

    <form method="post">
        <label for="company_name">企業名:</label>
        <input type="text" name="company_name" required /><br>

        <label for="admin_name">お名前:</label>
        <input type="text" name="user_name" required /><br>

        <label for="password">パスワード:</label>
        <input type="password" name="password" required /><br>

        <input type="hidden" name="action_type" value="adminSignup" />
        <button type="submit" class="input-submit-button">管理者アカウントを作成</button>        
    </form>
</body>
