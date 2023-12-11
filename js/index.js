'use strict';
import { getData, showShop } from './comonn.js';

//モーダルを開くようのボタン
const btnSerch = document.getElementById('serch');
//選択半径のselectタグ
const selectRadius = document.getElementById('select_radius');
//レストラン表示用のボックス
const shopCard = document.getElementById('shop_card');
//非同期通信用にURLを取得
const pathName = location.pathname;

//ページ訪問時の処理
document.addEventListener("DOMContentLoaded", function() {
    console.log('load');
    if ("geolocation" in navigator) {   //ブラウザがgeolocationAPIに対応しているかの処理
        navigator.geolocation.getCurrentPosition(
            function (position) {
                const latitude = position.coords.latitude;      //現在地の緯度取得
                const longitude = position.coords.longitude;    //現在地の経度取得
                console.log('load2');
                getData(latitude, longitude, 2, pathName, (error, result) => {
                    if (error) { 
                        alert(error);
                    } 
                    else {
                        showShop(result ,shopCard);
                        console.log('load3');
                    }
                });
            }
        );
    } else {
        alert('このブラウザは位置情報を使えません');
        console.error("このブラウザはGeolocation APIをサポートしていません。");
    }
});

// 半径選択後の検索ボタンが押された際の処理:
    btnSerch.addEventListener('click', () => {
        shopCard.innerHTML = '';
        //ボタンが押される前に表示されていたものの削除
        navigator.geolocation.getCurrentPosition(
            function (position) {
                const latitude = position.coords.latitude;      //現在地の緯度取得
                const longitude = position.coords.longitude;    //現在地の経度取得
                const radius = selectRadius.value;              //選択された半径のkey

                getData(latitude, longitude, radius, pathName, (error, result) => {
                    if (error) { 
                        alert(error);
                    } 
                    else {
                        showShop(result, shopCard);
                    }
                });
            },

        );
    });






