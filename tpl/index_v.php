<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./css/style.css">
<title></title>
</head>
<body>
<header>
    <h1>行きたいお店リスト</h1>
</header>
<main>
    <!-- 検索部 -->
    <section>
        <label for="select_radius">半径を選択</label>
        <select id="select_radius">
            <?php foreach($radius_ary as $radius_key=> $radius):?>
                <option value="<?php echo $radius_key; ?>"> <?php echo $radius;?></option>
            <?php endforeach;?>
        </select>
        <button id="location">検索</button>
    </section>
    
    <!-- 取得データ表示部 -->
    <section>
        <div id="shop_card"></div>
    </section>

</main>
<fotter><fotter>
<script type="module" src="./js/index.js"></script>
</body>
</html>