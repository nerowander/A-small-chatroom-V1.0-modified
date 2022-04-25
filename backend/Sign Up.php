<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    session_start();
    $host = "localhost";
    $user = "root";
    $pwd = "root2497091708";
    $dbname = "user";
    $revtal = mysqli_connect($host,$user,$pwd,$dbname);
    mysqli_select_db($revtal,'set names utf8');
    if(!$revtal)
    {
        die('Could not connect:'.mysqli_error());
    }
    function dealwith($data)
    {   $data = urldecode($data);
        $data = html_entity_decode($data);
        $data = htmlspecialchars($data);
        $data = rtrim($data);
        $data = stripcslashes($data);
        $data = trim($data);
        return $data;
    }
    $username = dealwith($_POST['username']);
    $password = dealwith($_POST['password']);
        if(preg_match("/group|union|select|from|or|and|regexp|substr|like|create|drop|\,|\`|\!|\@|\#|\%|\^|\&|\*|\(|\)|\（|\）|\_|\+|\=|\]|\;|\'|\’|\"|\"|\<|\>|\?/i",$username))
        {
            echo "<script type='text/javascript'>alert('你想得美');</script>";
            echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
            die();
        }
        if(preg_match("/group|union|select|from|or|and|regexp|substr|like|create|drop|\,|\`|\!|\@|\#|\%|\^|\&|\*|\(|\)|\（|\）|\_|\+|\=|\]|\;|\'|\’|\"|\"|\<|\>|\?/i",$password))
        {
            echo "<script type='text/javascript'>alert('你想得美');</script>";
            echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
            die();
        }
        $sql2 = "select username from user";
        $result2 = mysqli_query($revtal,$sql2);
        $res = array();
        while($row = mysqli_fetch_array($result2,MYSQLI_NUM))
        {
            $res[]=$row;
            foreach($row as $key)
            {
               if(preg_match('/'.$key.'/i',$username))
                {
                    echo "<script type='text/javascript'>alert('该用户名已存在');</script>";
                    echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
                    die();
                }
            } 
        }
        if(isset($username) && isset($password) && !empty($username) && !empty($password))
        {
            $time=date("Y-m-d H:i:s");
            $password = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `user` (id,username,pwdpwd,submission_date) VALUES (null,'$username','$password','$time')";
            $result = mysqli_query($revtal,$sql);
            if($result)
            {
                echo "<script type='text/javascript'>alert('用户注册成功');</script>";
                echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
                die();
                
            }
            else
            {
                echo "<script type='text/javascript'>alert('注册失败');</script>";
                echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
                die();
            }
 
        }
        else 
        {
            echo "<script type='text/javascript'>alert('请输入注册信息');</script>";
            echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
            die();
            
        }
?>