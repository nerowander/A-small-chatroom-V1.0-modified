<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    session_start();        
    if(!isset($_SESSION['username'])||!isset($_SESSION['token']))
    {
        echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
        die();
    }
    $host = "localhost";
    $user = "root";
    $password = "root2497091708";
    $dbname = "user";
    $revtal = new mysqli($host,$user,$password,$dbname);
    if($revtal->connect_error)
    {
        die("数据库连接失败");
    }
    mysqli_select_db($revtal,'set names utf8');

    $sql = "select * from user";
    $res = $revtal->query($sql);
    $info = array();
    while($row=$res->fetch_assoc())
    {
        $info[] = $row;
    }
    echo json_encode($info);