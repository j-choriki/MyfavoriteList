/**
 * 非同期でお店一覧情報を取得
 * @param {*} lat   緯度
 * @param {*} lng   経度
 * @param {*} range 検索範囲(1~5)
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
 * @param {*} id 店舗id
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



