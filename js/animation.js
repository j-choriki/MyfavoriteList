//ハンバーガーメニューがクリックされたときの処理
$(".openbtn").click(function () {
    $(this).toggleClass('active');
    $("#g-nav").toggleClass('panelactive');//ナビゲーションにpanaelactiveクラスを付与
});

//メニュー表示のアニメーションの処理
$("#g-nav a").click(function () {//ナビゲーションのリンクがクリックされたら
    $(".openbtn").removeClass('active');//ボタンのactiveクラスを除去し
    $("#g-nav").removeClass('panelactive');//ナビーゲーションのpanaelactiveクラスも除去
});