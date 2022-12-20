<!DOCTYPE html>

<html>
    <head>
        <title>黑心百貨</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="btnCss.css" >
        <style>
            *{
                box-sizing: border-box;
            }
            .boxjustify{
                display: flex;
                justify-content: center;

            }
            header{
                background-color: black;
                width: 1200px;
                height: 80px;
            }
            .navTable{
                width: 1200px;
                background-color: greenyellow;
            }
            .navTableTd{
                width: 20%;
                height: 40px;
                text-align: center;
                background-color: gray;
            }
            .navTableTd:hover{
                background-color: yellow;
            }
            .navTableTd a{
                text-decoration: none;
                font-size: 25px;
                font-weight: bolder;
            }
            iframe{
                border: 3px black solid;
                width: 100%;
                height: 100%;
            }
        </style>
    </head>
    <body>
        <div class="boxjustify">
            <header>
                <h1 align="center" style="color: white;">歡迎蒞臨梅糧馨百貨公司</h1>
            </header>
        </div>
        <div class="boxjustify">
            <nav>
                <table class="navTable">
                    <tr>
                        <td class="navTableTd"><a href="index.php">首　　頁</a></td>
                        <td class="navTableTd"><a href="AboutUs.html" target="maindisplay">關於我們</a></td>
                        <td class="navTableTd"><a href="ProductShow.php" target="maindisplay">商品總覽</a></td>
                        <td class="navTableTd"><a href="#">不知道要塞啥</a></td>
                        <td class="navTableTd"><a href="BaAdm\BaAdm_index.php">後台系統</a></td>
                    </tr>
                </table>
            </nav>
        </div>
        <div class="boxjustify">
            <main class="boxjustify" style="width:1200px;">
                <div style="background-color: lightgoldenrodyellow;width:20%;height:800px;">
                    <span>不常用功能</span><br/>
                    <span>　┣<a href="unitConv.html" target="maindisplay">單位轉換器</a></span><br/>
                    <span>帳號功能</span><br/>
                    <span>　<?php if(isset($_COOKIE['login'])){echo "使用者：{$_COOKIE['login'][1]}";}else{echo "使用者：未登入";}?></span><br/>
                    <span>　┣<a href="SignUp.php" target="maindisplay">帳號註冊</a></span><br/>
                    <span>　┗<a href="LogIn.php">登入</a></span><br/>
                    <span>會員功能(需登入)</span><br/>
                    <span>　┣<a href="Message.php" target="maindisplay">留言板</a></span><br/>
                    <span>　┣<a href="Order.php" target="maindisplay">商品訂購</a></span><br/>
                    <span>　┣<a href="Cart.php" target="maindisplay">購物車</a></span><br/>
                    <span>　┗<a href="OrderSearch.php" target="maindisplay">訂單查詢</a></span><br/>
                    <span style='float:right'><a href="LogOut.php" style='text-decoration: none;'>登出　　</a></span>
                </div>
                <div style="background-color: lightpink;width:80%;height:800px;">
                    <iframe name="maindisplay" src="Wellcome.html"></iframe>
                </div>
            </main>
        </div>
    </body>
</html>
