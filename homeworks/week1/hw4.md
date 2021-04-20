## 跟你朋友介紹 Git
[BGM](https://www.youtube.com/watch?v=q1bIr3pR3Jw) 

原來是介紹git的部分阿 (拍手)

git 簡介

所謂的git就是要做版本控制而開發出來的程式
可以把每次版本改動的歷史紀錄保存起來，因此可以方便復原到你想要的之前的狀態。另外，當多人協工時，也讓大家能夠家了解目前的版本有過什麼樣的改變，十分方便的工具。

如何使用

1.開啟gitbash先建立一個笑話資料夾 並宣告版本控制

```
mkdir 冷笑話大全
cd 冷笑話大全
git init
```

2.新增第一個笑話檔加入版本控制並開始記錄版本

```
 couch 諧音梗笑話1
 git add 諧音梗笑話1
 git commit -m "joke1"
```
3.利用GitHub讓菜哥的笑話更加發揚光大
```
註冊好GitHub後建立一個repository "冷笑話大全"
並根據GitHub的步驟複製貼上code至gitbash上建立GitHub與本機的連結
git push origin main 上傳至GitHub
當然菜哥也可以在GitHub上修改笑話後並下載下來至本機
git pull
```