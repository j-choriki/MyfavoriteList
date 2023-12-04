'use strict';

const btn = document.getElementById('location');
const selectRadius = document.getElementById('select_radius');

/**
 * 非同期でお店の情報を取得するときの処理
 * @param {*} lat   緯度
 * @param {*} lng   経度
 * @param {*} range 検索範囲(1~5)
 */
const getData = (lat, lng, range, callback) => {
    let data = {
        'lat': lat,
        'lng': lng,
        'range': range,
    }

    let json = JSON.stringify(data);
    let xhr = new XMLHttpRequest();
    xhr.open('POST', './async.php');
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded;charset=UTF-8");

    xhr.onreadystatechange = () => {
        try {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    let result = xhr.response;
                    callback(null, result); // Call the callback with the result
                } else {
                    callback('通信に失敗しました', null); // Call the callback with an error
                    console.error("Failed with status: " + xhr.status);
                }
            }
        } catch (e) {
            callback('情報の取得に失敗しました', null); // Call the callback with an error
            console.error("An error occurred: " + e);
        }
    }

    xhr.send(json);
}

// 検索ボタンが押された際の処理:
btn.addEventListener('click', () => {
    if ("geolocation" in navigator) {   //ブラウザがgeolocationAPIに対応しているかの処理
        navigator.geolocation.getCurrentPosition(
            function (position) {
                const latitude = position.coords.latitude;      //現在地の緯度取得
                const longitude = position.coords.longitude;    //現在地の経度取得
                const radius = selectRadius.value;              //選択された半径のkey

                getData(latitude, longitude, radius, (error, result) => {
                    if (error) { 
                        alert(error);
                    } else {
                        // DOMParserを使用してXMLを解析
                        const parser = new DOMParser();
                        const xmlDoc = parser.parseFromString(result, "application/xml");

                        // 取得値を入れてタグに入れていく
                        const shopElements = xmlDoc.querySelectorAll('shop');
                        shopElements.forEach((shopElement) => {
                            const shopCard = document.getElementById('shop_card');
                            const a = document.createElement('a');
                            a.href = './shop.php?id= ';
                            a.href += shopElement.querySelector('id').textContent;
                            shopCard.appendChild(p);
                            for(let i = 0; i < 3; i++){
                                let p = document.createElement('p');
                                switch(i){
                                    case 0:
                                        let img = document.createElement('img');
                                        img.src = shopElement.querySelector('logo_image').textContent;
                                        p.appendChild(img);
                                        break;
                                    case 1:
                                        p.textContent = shopElement.querySelector('name').textContent;
                                        break;
                                    case 2:
                                        p.textContent = shopElement.querySelector('access').textContent;
                                        break;
                                }
                                a.appendChild(p);
                            }
                        });
                    }
                });
            },
            function (error) {
                alert('位置情報の取得に失敗しました');
            }
        );
    } else {
        alert('このブラウザは位置情報を使えません');
        console.error("このブラウザはGeolocation APIをサポートしていません。");
    }
});


