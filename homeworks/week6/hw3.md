## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
  <sup>文字</sup>: 上標, 可用於次方。
  <bgsound />: 播放背景音樂, 可用loop屬性設定撥放次數
  <i>文字</i>: 斜體字。


## 請問什麼是盒模型（box modal）
  box model 可以由 content padding border margin 等四個部分由內而外構成， 其中 margin 代表外邊距 主要負責對外的距離且必定為透明，padding為內邊距是往內的距離設定，border則為邊框，可為box可視之最大範圍，content為內容。


## 請問 display: inline, block 跟 inline-block 的差別是什麼？
  inline: 元素可在同一行呈現，不可設定長寬， span、a、img等標籤為代表
  block: 一行只能有一個block 可自由設定長寬， div、p、ul li等標籤為代表
  inline-block: 結合前兩者，可在同一行餒有多個元素 卻又可以設店長寬

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
  position主要用來設定標籤的位置，可分為以下四種:
  1. static: 預設值，照著瀏覽器預設的配置自動排版在頁面上。
  2. relative: 初始設定與static一樣，但在relative 的元素內設定 top 、 right 、 bottom 和 left 屬性，會使設定的元素「相對地」調整其原本該出現的所在位置。
  3. absolute: 定位在他所處上層非"static"的相對位置，因此常與relative, fixed 配合著用。
  4. fixed: 相對於瀏覽器視窗來定位