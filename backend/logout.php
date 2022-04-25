<?php
    error_reporting(0);
    session_start();
    if(isset($_SESSION['username']))
    {
        unset($_SESSION['username']);
    }
    if(isset($_SESSION['token']))
    {
        unset($_SESSION['token']);
    }
    if(isset($_SESSION['login']))
    {
        unset($_SESSION['login']);
    }
    echo "登出成功";
    echo "<script type='text/javascript'>alert('登出成功');</script>";
    echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";;
    


?>