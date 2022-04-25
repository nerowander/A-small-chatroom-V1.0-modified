<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    session_start();        
    if(!isset($_SESSION['username'])||!isset($_SESSION['token']))
    {
        echo "<script type='text/javascript'>alert('您无权访问');</script>";
        echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
        die();
    }

    $dir = './chatroomphotos/';
    if($_FILES['photos']['error']>0)
    {
        exit("上传失败，请重试");
    }
    
    if(!file_exists($dir))
    {
        mkdir($dir);
    }
    
    $whitelist = array('jpg','png','bmp','gif','jpeg');
    $split = explode('.',$_FILES['photos']['name']);
    $backname = $split[1];
    //echo $backname;
        if(in_array($backname,$whitelist))
        {
            $name = $_FILES['photos']['name'];
            $dir = $dir.$name;
            $res = move_uploaded_file($_FILES['photos']['tmp_name'],$dir);
    
            if($res)
            {
               echo "图片上传成功<br/>";
            }

            else
            {
               echo "图片上传失败<br/>";
               die();
            }
    
            $host = "localhost";
            $user = "root";
            $password = "root2497091708";
            $dbname = "photos";

            $conn = new mysqli($host,$user,$password,$dbname);
            if($conn->connect_error)
            {
               exit("数据库连接失败");
            }

            $time = date("Y-m-d H:i:s");
            $name = $_FILES['photos']['name'];
            $username = $_SESSION['username'];
            $sql1 = "INSERT INTO `photos` (`sender`,`name`,`time`) VALUES ('$username','$name','$time')";
            $conn->query($sql1);
            if($conn)
            {
               echo("数据导入成功");
               die();
            }
            else
            {
               echo("数据导入失败，请重试");
               die();
            }
        }
        else
        {
            echo "文件格式暂不支持";
            die();
        }
?>