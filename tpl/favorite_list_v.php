<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./css/destyle.css">
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="./css/favorite_list.css">
<title>お気に入りリスト</title>
</head>
<body>
<header>
    <h1>My Favorite Restaurant</h1>
    <!-- ハンバーガーメニュー -->
    <div class="openbtn"><span></span><span></span><span></span></div>
    <!-- グローバルナビゲーション -->
    <nav id="g-nav">
            <div class="g-nav-list">
                <ul>
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./index.php?send=logout">Logout</a></li>
                </ul>
            </div>
        </nav>
</header>
<main>
    <div id="shop"></div>
</main>

<footer>
    <p>Powered by <a href="http://webservice.recruit.co.jp/">ホットペッパーグルメ Webサービス</a></p>
</footer>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
<script src="./js/animation.js"></script>
<script type="module" src="./js/favoriteList.js"></script>
</body>
</html>