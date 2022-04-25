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
        <title>一个简易小巧的聊天室</title>
        <link rel='stylesheet' href='./css/login.css'>
    </head>
        <body>
            <b>注册<br></b>
            <form action="./Sign Up.php" method="post">
            <br>
                <b>Username:<br></b><br>
                <input type="text" name="username"/>
                <br>
                <br>
                <b>Password:<br></b><br>
                <input type="text" name="password"/>
                <br>
                <br>
                <button type="submit" onclick="document.location.href='./login_table.php'">Register Now</button>
            </form>
                <br>
            <button type="button" onclick="document.location.href='./login_table.php'">Back to login</button> 
        </body>
</html>
