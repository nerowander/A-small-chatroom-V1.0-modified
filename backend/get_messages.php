<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    session_start();        
    if(!isset($_SESSION['username'])||!isset($_SESSION['token']))
    {
        echo "<script type='text/javascript'>alert('您无权访问');</script>";
        echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
        die();
    }
    $host = 'localhost';
    $user = 'root';
    $password = 'root2497091708';
    $dbname = 'chatroom';
    $revtal = new mysqli($host,$user,$password,$dbname);
    if($revtal->connect_error)
    {
        die('数据库连接失败');
    }
    mysqli_select_db($revtal,'set names utf8');
    
    $sql = 'select * from chatroom'; //chatroom是表名
    $result = $revtal->query($sql);
    
    $cross = array();
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {

        $cross[]=$row;
    }

    
    echo json_encode($cross);
    mysqli_close($revtal);
?>
    