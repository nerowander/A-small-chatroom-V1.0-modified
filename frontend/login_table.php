<?php
    error_reporting(E_ALL ^ E_DEPRECATED);      
    session_start();        
    if(isset($_SESSION['username'])&&isset($_SESSION['token']))
    {
        echo "<script type='text/javascript'>window.open('./chatroom.php','_self');</script>";
        die();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="chat" content="在线聊天系统">
        <meta name="author" content="R1esbyfe">
        <title>一个简易小巧的聊天室</title>
        <link rel='stylesheet' href='./css/login.css'> 
        
    </head>
        <body>
            <div class="center">
                <b>登录你的聊天室吧</b>
                <form action="./login.php" method="post">
                    <br>
                    <b>Username:<br></b><br>
                    <input type="text" name="username" />
                    <br>
                    <br>
                    <b>Password:<br></b><br>
                    <input type="text" name="password" />
                    <br>
                    <br>
                    <button type="sumbit">Sign In<br></button>
                    <br>
                    </form>
                    <br>
                    <button type="button" onclick="document.location.href='./Sign Up_table.php'">Sign Up</button>
            </div>
        </body>      
</html>