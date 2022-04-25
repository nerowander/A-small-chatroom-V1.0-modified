<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    session_start();        
    if(!isset($_SESSION['username'])||!isset($_SESSION['token']))
    {
        echo "<script type='text/javascript'>alert('您无权访问');</script>";
        echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
        die();
    }
    $host = "localhost";
    $user = "root";
    $password = "root2497091708";
    $dbname = "photos";

    $conn = new mysqli($host,$user,$password,$dbname);
    if($conn->connect_error)
    {
        exit('数据库连接失败');
    }
    $sql = 'select sender,name,time from photos';
    $result = $conn->query($sql);
    $info = array();
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
        $info[]=$row;
    }
    echo json_encode($info);
    
    mysqli_close($conn);
?>