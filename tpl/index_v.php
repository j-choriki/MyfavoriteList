<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./css/destyle.css">
<link rel="stylesheet" href="./css/header.css">
<link rel="stylesheet" href="./css/index.css">
<title></title>
</head>
<body>
<header>
    <h1>My Favorite Restaurant</h1>
</header>
<main>
    <!-- 検索部(モーダル) -->
    <section>
        
        <label for="select_radius">検索範囲</label>
        <select id="select_radius">
            <?php foreach($radius_ary as $radius_key=> $radius):?>
                <option value="<?php echo $radius_key; ?>"> <?php echo $radius;?></option>
            <?php endforeach;?>
        </select>
        <button id="location">検索</button>
    </section>
    
    <button id="serch">検索</button>

    <!-- 取得データ表示部 -->
    <section>
        <div id="shop_card"></div>
    </section>

</main>
<fotter><fotter>
<script type="module" src="./js/index.js"></script>
</body>
</html>