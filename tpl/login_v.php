<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./css/destyle.css">
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="./css/login.css">
<title>ログイン画面</title>
</head>
<body>
<header>
    <h1>My Favorite Restaurant</h1>
</header>
<main>
    <form action="./login.php" method="post">
        <h1>ログイン</h1>
        <p id="err_msg"><?php echo $msg;?></p>
        <div>
            <label for="mail">メールアドレス</label>
            <input type="text" name="mail" value="" id="mail">
        </div>
        <div>
            <label for="pass">パスワード</label>
            <input type="password" name="pass" id="pass">
        </div>
        <div id="btn">
            <p><a href="./index.php">戻る</a></p>
            <button name="btn" value="login">ログイン</button>
        </div>
    </form>
    <p><a href="./entry.php">新規登録</a>
    <p><a href="./index.php">ホーム</a></p>
</main>
<footer>
    <p>Powered by <a href="http://webservice.recruit.co.jp/">ホットペッパーグルメ Webサービス</a></p>
</footer>

<!-- <script></script> -->
</body>
</html>