## 請解釋後端與前端的差異。
先從整個上網的過程開始講起，首先當你開啟瀏覽器並輸入你想去的網址，網址經過DNS的翻譯找到你想去網址的IP位置，接著便朝那個IP位置丟了個request至那個IP位置的伺服器，伺服器從database中提取資料，response回你本地的主機端。而在request (or response)的前面就是前端在做的事，反之就是後端。
因此前端主要在做的是你在瀏覽的網站, 排版, 互動....等；而後端主要在server及database相關的工作。


## 假設我今天去 Google 首頁搜尋框打上：JavaScript 並且按下 Enter，請說出從這一刻開始到我看到搜尋結果為止發生在背後的事情。
首先你的電腦經過DNS的翻譯找到了google的IP位置，而你電腦的網卡便經由網際網路朝那個IP位置request了個封包過去google的伺服器；google伺服器接收封包後，在資料庫搜尋有關JavaScript的網站，接著將此封包response回你的主機並顯示在你的螢幕上。



## 請列舉出 3 個「課程沒有提到」的 command line 指令並且說明功用
* control : 開啟控制台，突然從圖形介面照不到控制台?沒關係，在command line裡輸入control就行
* systeminfo :  查詢系統資訊, 當你很無聊,想知道你的電腦有什麼資訊時。
* ipconfig : 查詢IP位置

