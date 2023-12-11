'use strict';
import { getShop } from './comonn.js';

//非同期通信で使用するためのファイルパス
const pathName = location.pathname;

// URLパラメーターの取得
const url = new URL(window.location.href);
const params = url.searchParams;
const id = params.get('id');    //お店のID
//非同期通信で使うHTMLタグ
const section = document.getElementById('shop_data');
const menu = document.getElementById('menu');
const menuUl = menu.children[0];

document.addEventListener("DOMContentLoaded", function() {
    getShop(id, pathName, (error, result) => {
        if (error) { 
            alert(error);
        } else {
            // DOMParserを使用してXMLを解析
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(result, "application/xml");
            
            // 表示したい項目をxmlDocから取り出し
            const shopElements = xmlDoc.querySelectorAll('shop')[0]; 

            //XMLから表示情報取得部分
            const logoImage = shopElements.querySelector('logo_image').textContent; //レストランロゴ
            const name = shopElements.querySelector('name').textContent;            //レストラン名
            const photoUrl = shopElements.querySelector('photo').querySelector('pc').querySelector('m').textContent; //表示画像URL        
            const address = shopElements.querySelector('address').textContent;           //住所
            const serviceTime = shopElements.querySelector('open').textContent;         //営業時間
            const closeTime = shopElements.querySelector('close').textContent;          //営業時間
            const card = shopElements.querySelector('card').textContent;                //カードの利用可否
            const partyCapa = shopElements.querySelector('party_capacity').textContent; //最大人数
            const smoking = shopElements.querySelector('non_smoking').textContent;      //喫煙可否
            const parking = shopElements.querySelector('parking').textContent;          //駐車場情報
            const shopUrl = shopElements.querySelector('urls').querySelector('pc').textContent; //お店webサイトのwebサイトのURL
            const mapUrl = shopElements.querySelector('coupon_urls').querySelector('pc').textContent; //Hot Pepperの地図情報掲載ページへのURL

          //======ロゴとレストラン名======================================
            const h3 = document.createElement('h3');
            h3.textContent = name;
            let img = document.createElement('img');
            img.src= logoImage;
            const div_header = document.createElement('div');
            div_header.className = "div_header";
            div_header.appendChild(img);
            div_header.appendChild(h3);
            section.appendChild(div_header);


            //======レストラン画像、住所、営業時間を表示======================================
            const div_main = document.createElement('div');
            div_main.className = "div_main";

            // レストラン画像の生成
            img = document.createElement('img');
            img.src = photoUrl
            const div_photo = document.createElement('div');
            div_photo.appendChild(img);
            div_main.appendChild(div_photo); 


            //ロゴとレストラン名を以外をtableで表示
            const table = document.createElement('table');

            //以下for文で使うための配列
            const shopParam = [address,serviceTime,closeTime, card, partyCapa, smoking, parking];
            const thName = ['Address', 'Open','Close', 'Card', 'Capacity' ,'Smoke', 'Parking']

            //trタグを生成して表示項目を追tdに追加
            for(let i = 0; i < shopParam.length; i++){
                const tr = document.createElement('tr');
                const th = document.createElement('th');
                const td = document.createElement('td');
                th.textContent = thName[i];
                tr.appendChild(th);
                td.textContent = shopParam[i];
                tr.appendChild(td);
                table.appendChild(tr);
            }
            div_main.appendChild(table);
            section.appendChild(div_main);

            //メニューのボタンに遷移先のURLを追加する
            let a = menuUl.children[1].querySelector('a');
            a.href = mapUrl;
            a = menuUl.children[2].querySelector('a');
            a.href = shopUrl;
        }
    }, 
    (error) => {
        alert('情報の取得に失敗しました');
    }
    );
});

//ハートボタンが押されたときの処理
const btnHeart = document.getElementById('heart');
btnHeart.addEventListener('click', () => {
    //ボタンの色変更
    if(btnHeart.className == ''){
        btnHeart.className = 'on';
        btnHeart.value = '1'; 
    } else{
        btnHeart.className = '';
        btnHeart.value = '0'; 
    }

    const postData = {
        'btnData':btnHeart.value,
        'id':id
    };
    
    fetch('./async.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(postData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Fetch failed:', error);
    });
})
