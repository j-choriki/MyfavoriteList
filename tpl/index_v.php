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
    <!-- 検索部 -->
    <section>

        <label for="select_radius"><span>検索範囲<span>
            <select id="select_radius">
                <?php foreach($radius_ary as $radius_key=> $radius):?>
                    <option value="<?php echo $radius_key; ?>"> <?php echo $radius;?></option>
                <?php endforeach;?>
            </select>
        </label>
        <button id="serch">検索</button>
    </section>
    
    

    <!-- 取得データ表示部 -->
    <section>
        <div id="shop_card"></div>
    </section>

</main>
<fotter><fotter>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
<script type="module" src="./js/index.js"></script>
</body>
</html>