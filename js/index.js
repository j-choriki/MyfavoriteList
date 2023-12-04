'use strict';

const btn = document.getElementById('location');
const selectRadius = document.getElementById('select_radius');

//検索ボタンが押されたときの処理
btn.addEventListener('click', () =>{
    // ブラウザが Geolocation API をサポートしているか確認
    if ("geolocation" in navigator) {
        // Geolocationがサポートされている場合の処理
        // ユーザーに位置情報の使用許可を求める
        navigator.geolocation.getCurrentPosition(
        // 位置情報取得成功時のコールバック
            function(position) {
                // 取得した位置情報
                const latitude = position.coords.latitude;      //緯度
                const longitude = position.coords.longitude;    //経度

                const radius = selectRadius.value;
                
                //現在地付近から選択された範囲の店舗情報の取得
                getData(latitude, longitude,radius,4);


            },
            // 位置情報取得失敗時のコールバック
            function(error) {
                alert('位置情報の取得に失敗しました');
            } 
        );
    } else {
        alert('このブラウザは位置情報を使えません');
        // Geolocationがサポートされていない場合の処理
        console.error("このブラウザはGeolocation APIをサポートしていません。");
    }
})





/**
 * 非同期でお店の情報を取得するときの処理
 * @param {*} lat   緯度
 * @param {*} lng 　経度
 * @param {*} range 検索範囲(1~5)
 * @param {*} order おすすめ順(1~4)
 */
const getData = (lat, lng, range, order) => {
    //お店情報取得に必要なデータを格納する
    let data = {
        'lat': lat,
        'lng': lng,
        'range': range,
        'order':order
    }
    //JSONに変換し、PHPサイドへデータ送る
    let json = JSON.stringify(data);
    let xhr = new XMLHttpRequest();
    xhr.open('POST','./async.php');
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded;charset=UTF-8");
    xhr.send(json);
    //データを受けとる
    xhr.onreadystatechange = () => {
        try{
            if (xhr.readyState == 4) {
                if(xhr.status == 200){//通信が成功したときの処理
                    //ここに受け取ったデータが入る
                    let result = xhr.response;
                    console.log(result);
                }
                else {
                    alert('通信に失敗しました');
                    console.error("Failed with status: " + xhr.status);
                }
            }
        }catch(e){
            alert('情報の取得に失敗しました');
            console.error("An error occurred: " + e);
        }
    }
}



