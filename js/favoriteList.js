'use strict';
import { showShop } from './comonn.js';

//レストラン情報を追加する要素
const shop = document.getElementById('shop');
let btnDelete;

//phpから渡ってきたデータが０件でなければAPIからデータを取得する
if(restrantIds.length != 0){
    let sendData = {
        'restrant_data': restrantIds,
    }
    
    fetch('./async.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(sendData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text(); 
    })
    .then(xmlText => {
        //生成されたボタン情報を格納する配列
        let saveBtn = [];
        //レストラン概要表示用関数
        showShop(xmlText, shop);
        //削除ボタンを追加するため全てのaタグを取得
        const restrant = document.getElementsByClassName('restrant');
        //削除ボタンをレストランごとに追加
        for(let i = 0; i < restrant.length; i++) {
            btnDelete = document.createElement('button');
            btnDelete.textContent = "削除";
            btnDelete.id = restrantIds[i];  //ボタンにレストランIDを付与する
            restrant[i].appendChild(btnDelete);
            saveBtn.push(btnDelete);        //配列に生成したボタン情報を格納
        }

        //削除ボタンが押されたときの処理
        saveBtn.forEach(button =>{
            button.addEventListener('click', () => {
                //クリックされたボタンの親要素を取得
                const parent = button.parentNode;
                const btnId = button.id;
                //要素の削除
                parent.remove();

                const btnIdData = {
                    'btnIdData' : btnId,
                }
                fetch('./async.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(btnIdData)
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
        })

    })
    .catch(error => {
        console.error('Fetch failed:', error);
    });
}


    

