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

    
    
    $color = $_POST['color'];
    $message = $_POST['message'];
    $username = $_POST['username'];
    
    if(preg_match("/group|union|select|from|or|and|regexp|substr|like|create|drop|\,|\`|\!|\@|\#|\%|\^|\&|\*|\(|\)|\（|\）|\_|\+|\=|\]|\;|\'|\’|\“|\"|\<|\>|\?/i",$username)||$username!=$_SESSION['username'])
    {
        exit('不要作坏事哦');
    }
    if(preg_match("/group|union|select|from|or|and|regexp|substr|like|create|drop|\,|\`|\!|\@|\%|\^|\&|\*|\(|\)|\（|\）|\_|\+|\=|\]|\;|\'|\’|\“|\"|\<|\>|\?/i",$color))
    {
        exit('不要作坏事哦');
    }
    if(preg_match("/group|union|select|from|or|and|regexp|substr|like|create|drop|\,|\`|\!|\@|\#|\%|\^|\&|\*|\(|\)|\（|\）|\_|\+|\=|\]|\;|\'|\’|\“|\"|\<|\>|\?/i",$message))
    {
        exit('不要作坏事哦');
    }
    if(isset($username) && isset($message) && isset($color) && !empty($username) && !empty($message) && !empty($color)){
            $time = date("Y-m-d H:i:s");         
            $sql = "INSERT INTO `chatroom` (username,color,content,time) VALUES ('$username','$color','$message','$time')";
            $result = mysqli_query($revtal,$sql);
        if($result)
        {
        echo "发送成功";
        }
        else
        {
        echo "发送失败";
        }
    }
    else
    {
        echo "不能输入空数据呢亲";
    }
    mysqli_close($revtal);  
?>

