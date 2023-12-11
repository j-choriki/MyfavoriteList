<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./css/destyle.css">
<!-- <link rel="stylesheet" href="./css/style.css"> -->
<title>新規登録</title>
</head>
<body>
<header>
    <h1>My Favorite Restaurant</h1>
</header>

<main>
    <form action="./entry.php" method="post">
        <h1>会員登録</h1>
        <div>
            <label for="mail">メールアドレス<span><?php echo $mail_msg;?></span></label>
            <input type="text" name="mail">
        </div>

        <div>
            <label for="pass">パスワード<span><?php echo $pass_msg;?></span></label>
            <input type="pass" name="pass" placeholder="4~10文字以内の英数字で入力"> 
        </div>
        <button name="btn" value="conf">確認</button>
    </form>
    <p><a href="./login.php">ログイン画面</a></p>
    <p><a href="./index.php">戻る</a></p>
</main>

<footer>
</footer>


<!-- <script></script> -->
</body>
</html>