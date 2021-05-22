## 請以自己的話解釋 API 是什麼
概略來說 API 就是程式與程式之間溝通的橋樑，當A程式需要B程式幫他拿某些資料時，就會透過API來進行。


## 請找出三個課程沒教的 HTTP status code 並簡單介紹
我是從這個網站上看到的，[常見與不常見的 HTTP Status Code](https://noob.tw/http-status-code/)，就介紹3個比較好玩的:
1. 418 I'm a teapot 我是個茶壺
    這是一個 1998年的老笑話 大意就是如果有人想用茶壺來泡咖啡，你應該回個它一個 418 的狀態碼，我是個茶壺，你幹嘛拿我來泡咖啡？
    雖然笑話本身不是那麼好笑，不過蠻有新意的。 後來好像還為要不要刪除418而有許多論戰呢!
2. 718 I am not a teapot (非官方惡搞HTTP Status Code)
    HTTP status code 是可以被擴充的，因此就有許許多多形形色色的奇怪Code，我不是茶壺也是其一。
3. 503 Service Unavailable：伺服器臨時維護或是快掛了，暫時無法處理請求
    正經一下，這應該也是常見的HTTP status code ,當伺服器臨時維護時出現。


## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

```
[
{
 "id": "1",
 "name": "W當勞",
 "phone": "1234567",
 "address": "ABCDEFG",
 "product": {
    "小min克" : 60
    "漢堡寶" : 70
    "可樂" : 30
 }
},
{
 "id": "2",
 "name": "咖哩娘",
 "phone": "7654321",
 "address": "HIJKLPM",
 "product": {
    "牛肉咖哩" : 90
    "印度感情咖哩" : 990
 }
},
{
 "id": "3",
 "name": "壽司娘",
 "phone": "987123",
 "address": "POIUYRFBJ",
 "product": {
    "鮭魚壽司" : 40
    "山葵" : 10
    "鮪魚中腹" : 1000
 }
},
]
```

Base URL: https://hw-restaurant-list.com

|說明|Method|path|參數|範例|
|----|----|----|----|----|
|獲取所有餐廳|GET|/rests| __limit:限制回傳資料數量|/rests?_limit=100|
|獲取單一餐廳|GET|/rests/:id|無|/rests/12|
|新增餐廳|POST|/rests|name:餐廳名|無|
|刪除餐廳|DELETE|/rests/:id|無|無|
|更改餐廳資訊|PATCH|/rests/:id|name:餐廳名|無|