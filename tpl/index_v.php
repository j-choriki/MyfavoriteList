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
<header></header>
<main>
    <section>
        <label for="">半径を選択</label>
        <select id="select_radius">
            <?php foreach($radius_ary as $radius_key=> $radius):?>
                <option value="<?php echo $radius_key; ?>"> <?php echo $radius;?></option>
            <?php endforeach;?>
        </select>
        <button id="location">検索</button>
    </section>
</main>
<fotter><fotter>
<script src="./js/index.js"></script>
</body>
</html>