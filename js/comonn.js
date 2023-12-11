/**
 * 非同期でお店一覧情報を取得
 * @param  lat   緯度
 * @param  lng   経度
 * @param  range 検索範囲(1~5)
 */
export const getData = (lat, lng, range, pathName, callback) => {
    let data = {
        'lat':      lat,
        'lng':      lng,
        'range':    range,
        'pathName': pathName,
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
                    callback(null, result); 
                } else {
                    callback('通信に失敗しました', null); 
                    console.error("Failed with status: " + xhr.status);
                }
            }
        } catch (e) {
            callback('情報の取得に失敗しました', null); 
            console.error("An error occurred: " + e);
        }
    }
    xhr.send(json); 
}

/**
 * お店の詳細情報を取得
 * @param  id 店舗id
 * @param  pathName 操作しているページのURL
 * @param callback 結果が返却される変数
 */

export const getShop = (id, pathName, callback) => {
    const data = {
        id: id,
        pathName: pathName,
    };

    let json = JSON.stringify(data);
    let xhr = new XMLHttpRequest();
    xhr.open('POST', './async.php');
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded;charset=UTF-8");

    xhr.onreadystatechange = () => {
        try {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    let result = xhr.response;
                    callback(null, result); 
                } else {
                    callback('通信に失敗しました', null); 
                    console.error("Failed with status: " + xhr.status);
                }
            }
        } catch (e) {
            callback('情報の取得に失敗しました', null); 
            console.error("An error occurred: " + e);
        }
    }
    xhr.send(json);
};


export const showShop  = (data,tag) => {
     // DOMParserを使用してXMLを解析
    const parser = new DOMParser();
    const xmlDoc = parser.parseFromString(data, "application/xml");
     // 取得値を入れてタグに入れていく
     const shopElements = xmlDoc.querySelectorAll('shop');   //XMLのshop情報を全件取得
     shopElements.forEach((shopElement) => {                 //お店件数分新しくタグを生成
        const div = document.createElement('div');
        div.className="restrant";
        const a = document.createElement('a');
        a.href = './shop.php?id= ';
        a.href += shopElement.querySelector('id').textContent;  //遷移先で詳細情報取得用
        div.appendChild(a);
        tag.appendChild(div);
        const flexBox = document.createElement('div');
        flexBox.className = 'flex';
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
            if(i != 0){
                flexBox.appendChild(p);
                a.appendChild(flexBox);
            }else{
                a.appendChild(p);
            }
        }
    });
}


