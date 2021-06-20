## 什麼是 DOM？
DOM (Document Object Model)，中文翻譯為文件物件模型，主要是在說把一份HTML文件內的各種標籤定義成物件，而這些物件會以樹狀的結構呈現。

而為何需要DOM? 
這就得談到網頁主要是由瀏覽器來呈現，而世界上有許多的瀏覽器ex:IE, firefox, chrome....等，若每個瀏覽器有各自的規則來呈現HTML的話，那會非常混亂。
因此W3C (World Wide Web Consortium) 全球資訊網協會出現了，並制定了許多網頁的規則，讓各家瀏覽器可以按照規則去設計瀏覽器，DOM是其中的一項W3C用來推薦處理XML的標準程式介面。

DOM的樹狀結構:
在DOM中，每個element, text都是一個結點(node)，可分為以下四種:
1. Document: Document 就是指這份文件，也就是這份 HTML 檔的開端，所有的一切都會從 Document 開始往下進行。
2. Element: Element 就是指文件內的各個標籤，因此像是 <div>、<p> 等等各種 HTML Tag 都是被歸類在 Element 裡面。
3. Text: Text 就是指被各個標籤包起來的文字。
4. Attribute: Attribute 就是指各個標籤內的相關屬性。

因此可將HTML文件畫作DOM樹狀圖，也因此可以讓我們知道node彼此之間的關係:
1. Parent and Child: 簡單來說就是上下層節點，上層為 Parent Node ，下層為 Child Node 。
2. Siblings: 簡單來說就是同一層節點，彼此間只有 Previous 以及 Next 兩種。


## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
![](https://medium.com/itsems-frontend/javascript-event-bubbling-capturing-794cd2d01e61)
捕獲與冒泡是DOM事件傳遞的機制，由圖片來說明比較清楚，
當我們點擊<td>這個標籤(藍色)時，事件會由最外層(window)開始一層一層的往內傳遞到target，而這個過程就是所謂的「捕獲階段」。
而接著再從內往外傳的過程，稱之為「冒泡階段」。
也因此當最底層事件被觸發時，上層的節點也會被觸發。
而事件傳遞也有以下兩個原則:
1. 先捕獲，再冒泡。
2. 但當事件傳到target本身時，沒有分先捕獲再冒泡
然而第二點在 Chrome 89.0.4363.0 的版本之後，更改為先捕獲再冒泡了。

補充1:若要中止事件的傳遞，可以使用e.stopPropagation()，以上圖來說，若e.stopPropagation()放在左邊的捕獲階段，則事件不會向下傳遞，反之，若在右邊傳遞階段，事件則不會向上傳遞。

補充2:再addEventListener中有第三個參數，預設為false，若改為true，listener就會從冒泡階段轉至捕獲階段


## 什麼是 event delegation，為什麼我們需要它？
Event Delegation，中文直翻叫做事件的委派，這個概念主要來自於事件傳遞的冒泡機制。
主要的需求是當有過多重複的eventListener，怎麼可能幫每個元素都掛載一個專屬的eventListener。
因此我們只要將最上層的元素加上eventListener即可。

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？

event.preventDefault()是終止預設行為，而event.stopPropagation()是終止事件傳導，以下做個範例
```
  <body>
    <div class="outer">
      <div class="inner">
        <button class="btn"><a href="google.com">click1</a>click2</button>   
      </div>
    </div>
    <script>
      document.querySelector('.outer').addEventListener('click',
        function (e) {
          console.log('hi,1')
        }
      )
      document.querySelector('.inner').addEventListener('click',
        function (e) {
          console.log('hi,2')
        }
      )

      document.querySelector('.btn').addEventListener('click',
        function (e) {
          console.log('hi,3')
        }
      )

      document.querySelector('a').addEventListener('click',
        function (e) {
        }
      )
    </script>
  </body>
```

當我們點擊click1(超連結)時，會跳至超連結位置也會照順序印出hi,3 hi,2 hi,1，代表了捕獲與冒泡的機制。
此時我們在a這邊加上e.preventDefault()

```
      document.querySelector('a').addEventListener('click',
        function (e) {
          e.preventDefault()
        }
      )
```

當我們點擊click1時，此時便不會跳至超連結因為我們已經停止了他的預設行為，但依然會印出hi,3 hi,2 hi,1
這時我們再加上 e.stopPropagation()

```
      document.querySelector('a').addEventListener('click',
        function (e) {
          e.preventDefault()
          e.stopPropagation()
        }
      )
```
當我們點擊click1時，此時不會跳至超連結也不會印出任何東西，因為事件停留在target階段沒有進入冒泡階段。