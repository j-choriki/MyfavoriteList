'use strict';
import { getShop } from './comonn.js';

const pathName = location.pathname;


// URLパラメーターの取得
const url = new URL(window.location.href);
const params = url.searchParams;
const id = params.get('id');    //お店のID

const section = document.getElementById('shop_data');


document.addEventListener("DOMContentLoaded", function() {
    getShop(id, pathName, (error, result) => {
        if (error) { 
            alert(error);
        } else {
            // DOMParserを使用してXMLを解析
            const parser = new DOMParser();
            const xmlDoc = parser.parseFromString(result, "application/xml");
            // console.log(xmlDoc);
            // 表示したい項目をxmlDocから取り出し
            const shopElements = xmlDoc.querySelectorAll('shop')[0]; 
            console.log(shopElements);
            //表示情報取得部分
            const name = shopElements.querySelector('name').textContent;
            const address = shopElements.querySelector('address').textContent;
            const serviceTime = shopElements.querySelector('open').textContent;
            
            //表示画像の生成
            const photoUrl = shopElements.querySelector('l').textContent;       //表示画像URL
            const img = document.createElement('img');
            img.src = photoUrl
            const photo = document.createElement('div');
            photo.appendChild(img);
            section.appendChild(photo); 

            //pタグを生成して表示項目を追加していく
            for(let i = 0; i < 3; i++){
                const p = document.createElement('p');
                switch(i){
                    case 0:
                        p.textContent = name;
                        break;
                    case 1:
                        p.textContent = address;
                        break;
                    case 2:
                        p.textContent = serviceTime;
                }
                section.appendChild(p);
            }
        }
    }, 
    // (error) => {
    //     alert('情報の取得に失敗しました');
    // }
    );
});
