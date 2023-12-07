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
            
            //表示情報取得部分
            const name = shopElements.querySelector('name').textContent;            //店舗名
            const address = shopElements.querySelector('address').textContent;      //住所
            const serviceTime = shopElements.querySelector('open').textContent;     //営業時間
            const shopUrl = shopElements.querySelector('urls').querySelector('pc').textContent; //お店webサイトのwebサイトのURL

            const shopParam = [name, address, serviceTime,shopUrl];

            //表示画像の生成
            const photoUrl = shopElements.querySelector('photo').querySelector('pc').querySelector('l').textContent;       //表示画像URL
            const img = document.createElement('img');
            img.src = photoUrl
            const photo = document.createElement('div');
            photo.appendChild(img);
            section.appendChild(photo); 

            //pタグを生成して表示項目を追加していく
            for(let i = 0; i < shopParam.length; i++){
                const p = document.createElement('p');
                if(i == 3){
                    const a = document.createElement('a');
                    a.href = shopParam[i];
                    a.textContent = 'ネット予約はこちらから';
                    p.appendChild(a);
                }else{
                    p.textContent = shopParam[i];
                }
                section.appendChild(p);
            }
            
        }

        
    }, 
    (error) => {
        alert('情報の取得に失敗しました');
    }
    );
});
