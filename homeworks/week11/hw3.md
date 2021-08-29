## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
  加密(Encrypt): 需要金鑰(key)來加密或解密。
  雜湊(Hashing): 把資料丟進一串複雜的公式後得到的結果。
  最主要的差別在可不可逆，加密可透過解密得到原始資料，但雜湊不行。
  雖然可能用暴力解法將雜湊後的值找出，但可以利用加鹽的方式增加暴力解法的難度。
  因此駭客只要能透過各種方式得到金鑰就可以解密，相對於雜湊來說安全性較低，密碼雜湊後再存入資料庫較佳。


## `include`、`require`、`include_once`、`require_once` 的差別
  以上四個都是可以引入外部檔案的函式，
  require是直接將外部檔案引入主程式碼內，成為主程式的一部分；  
  include是將外部檔案讀入並執行。  
  require的執行是在PHP引擎編譯程式碼的時候發生的，這在PHP4.0 (PHP4.0是先把整個程式程式碼全部編譯完成後，再將這些編譯好的程式程式碼一次執行完畢，在編譯的過程中不會執行任何程式程式碼) 上，通常用於匯入靜態的內容，include則適合匯入動態的程式碼，主要差別在引入發生錯誤(ex:檔案不存在)時，include還是會繼續執行程式，require則會暫停。  
  如果是include_once 或 require_once，執行時會先檢查要匯入的檔案是否已經在該程式的其他地方已被匯入過，如果有就不會重複匯入相同內容，這個的好處是如果在同一個程式重複匯入這個檔案，在第二次匯入的時候便會發生錯誤訊息，因為 PHP 不允許相同名稱的函式被重複宣告第二次。

## 請說明 SQL Injection 的攻擊原理以及防範方法
  SQL Injection 便是駭客透過修改 SQL 語句，改變他的語意，達成竊取資料/破壞資料的行為。  
  假設一個登入的方法如下:  
  `sql = "SELECT * FROM users WHERE username=$username and password=$password"`  
  在username 跟 password方面填入:  
  `$username= "' OR '1'='1"'`  
  `$password= "' OR '1'='1"'`  
  這樣將導致原本的SQL字串被填為:  
  `sql = "SELECT * FROM users WHERE username = '' OR '1'='1' AND password = '' OR '1'='1';"`  
  也就是實際上執行的SQL命令會變成下面這樣的:  
  `sql = "SELECT * FROM users"`  
  因此達到無帳號密碼，亦可登入網站，類似此類從SQL注入，駭客透過截斷你原本程式的語意，改為插入他希望執行的程式碼，達成攻擊的效果。  
  在PHP中可以使用PreparedStatement來防止SQL Injection  
##  請說明 XSS 的攻擊原理以及防範方法
  XSS 全稱為 Cross-Site Scripting，主要是利用特別的 JS 語法來竄改網頁或竊取資料。
  像是輸入:
  `<script> alert('You have been hacked'); </script>` 之類的來竄改網頁。
  XSS 漏洞分為幾種類型：
  1. 儲存型 XSS ( Stored )
  2. 反射型 XSS ( Reflected )
  3. DOM 型 XSS 
  防範的話可以從輸入或輸出時檢查，然而XSS 有太多漏洞可以鑽，要很完整對輸入做防範非常困難。
  輸出方面最常見的是使用使用跳脫字元 escape，在PHP裡則可使用htmlspecialchars函式來轉換輸出的字元。


## 請說明 CSRF 的攻擊原理以及防範方法
  大部分的網站應用都是採用cookie或session的方式進行登入驗證，當通過登入驗證之後，這時壞人(?)可能用一些欺騙的手段讓使用者"自己"去存去曾經驗證過的網站並進行一些操作，由於是"自己"點的所以暨通過了驗證有可以達到壞人想做的事。  
  這邊使用者能做的是有限，因此靠SERVER端來處理比較有效，首先，由於CSRF的reuqest跟使用者本人發出的request在domain上有所不同 (CSRF是從任意一個 domain 發出的，使用者本人是從同一個 domain 發出的)，因此，檢查 Referer是可行的方法，或是可以加上圖形驗證碼或簡訊認證增加是本人親自執行的保證。
  若要再進階，則是在form當中用hidden增加一個驗證的token,因為攻擊者並不知道token的值是什麼，也猜不出來，所以自然就無法進行攻擊了。