'use strict';
import { getData } from './comonn.js';

const btn = document.getElementById('location');
const selectRadius = document.getElementById('select_radius');
const shopCard = document.getElementById('shop_card');
const pathName = location.pathname;


//ページ訪問時の処理
document.addEventListener("DOMContentLoaded", function() {
    if ("geolocation" in navigator) {   //ブラウザがgeolocationAPIに対応しているかの処理
        navigator.geolocation.getCurrentPosition(
            function (position) {
                const latitude = position.coords.latitude;      //現在地の緯度取得
                const longitude = position.coords.longitude;    //現在地の経度取得
                getData(latitude, longitude, 2, pathName, (error, result) => {
                    if (error) { 
                        alert(error);
                    } 
                    else {
                        // DOMParserを使用してXMLを解析
                        const parser = new DOMParser();
                        const xmlDoc = parser.parseFromString(result, "application/xml");
                        // console.log(xmlDoc);
                        // 取得値を入れてタグに入れていく
                        const shopElements = xmlDoc.querySelectorAll('shop');   //XMLのshop情報を全件取得
                        shopElements.forEach((shopElement) => {                 //お店件数分新しくタグを生成
                            const a = document.createElement('a');
                            a.href = './shop.php?id= ';
                            a.href += shopElement.querySelector('id').textContent;  //遷移先で詳細情報取得用
                            shopCard.appendChild(a);
                            for(let i = 0; i < 3; i++){     //表示項目を増やす場合以下をついき
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

// 検索ボタンが押された際の処理:
btn.addEventListener('click', () => {
     //ボタンが押される前に表示されていたものの削除
    navigator.geolocation.getCurrentPosition(
        function (position) {
            const latitude = position.coords.latitude;      //現在地の緯度取得
            const longitude = position.coords.longitude;    //現在地の経度取得
            const radius = selectRadius.value;              //選択された半径のkey

            getData(latitude, longitude, radius, pathName, (error, result) => {
                if (error) { 
                    alert(error);
                } else {
                    // DOMParserを使用してXMLを解析
                    const parser = new DOMParser();
                    const xmlDoc = parser.parseFromString(result, "application/xml");
                    // const a = document.createElement('a');
                    // 取得値を入れてタグに入れていく
                    const shopElements = xmlDoc.querySelectorAll('shop');
                    shopElements.forEach((shopElement) => {
                        const a = document.createElement('a');
                        a.href = './shop.php?id= ';
                        a.href += shopElement.querySelector('id').textContent;
                        console.log(a);
                        shopCard.appendChild(a);
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
});






