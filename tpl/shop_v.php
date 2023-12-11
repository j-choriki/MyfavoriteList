<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/destyle.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/shop.css">
<title>店舗詳細</title>
</head>
<body>
<header>
    <h1>My Favorite Restaurant</h1>
</header>

<main>
    <!-- 取得データ表示部分 -->
    <section id="shop_data"></section>
</main>
 <!-- 画面下に表示するメニュ -->
 <div id="menu">
    <ul>
        <li><a href="./">戻る</a></li>
        <li><a>マップ情報</a></li>
        <li><a>Hot Pepper</a></li>
        <?php if($mail != '') :?>
            <button id="heart"><img src="./img/heart.png" alt="ハートマーク" width="40"></button>
        <?php endif;?>
    </ul>
</div>
<footer>
    <p>Powered by <a href="http://webservice.recruit.co.jp/">ホットペッパーグルメ Webサービス</a></p>
</footer>

<script type="module" src="./js/shop.js"></script>
</body>
</html>