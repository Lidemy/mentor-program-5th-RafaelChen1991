## 什麼是 Ajax？
Ajax 是 Asynchronous JavaScript and XML 的縮寫，中文直翻:非同步的JavaScript與XML技術，其中XML是用戶端(Client)與伺服器端(Server)交換資料用的資料與方法，不過Ajax所處理的資料並不只限於XML，JSON等格式也包含在內。

## 用 Ajax 與我們用表單送出資料的差別在哪？
主要差異在如何去處利資料回傳的結果，Ajax為當Server端回傳一個response，Clint端的瀏覽器接收response時，資料會轉傳至Javascript處理，因此不需換頁面就能即時更新頁面；而表單則是以html的形式來傳送資料，Clint端的瀏覽器接收response時，頁面會重新刷新。

## JSONP 是什麼？
JSONP 全名 JSON with Padding，是JSON的一種使用模式，由於同源策略的關係，兩個網頁若沒有有相同的URI、主機名和埠號，則無法相互取得資料，然而我們可以使用html的<script>或是<img>等不受同源政策影響的標籤，從其他來源動態產生JSON資料，並在透過指定的function進行輸出拿到想要的資料。

## 要如何存取跨網域的 API？
除了JSONP之外，可透過一種機制'跨來源資源共享'(cross-origin resource sharing, CORS)提供了網頁伺服器跨網域的存取控制，Server端在response header加上'Access-Control-Allow-Origin: 允許對象(若要對全部的網頁開發可以使用*)'即可讓不同源的網域存取資料。

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
因為第四周是使用 'Node.js'途中沒有經過瀏覽，因此並不會收到瀏覽器的限制。
