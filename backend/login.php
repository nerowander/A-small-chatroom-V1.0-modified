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
    {
        $data = urldecode($data);
        $data = html_entity_decode($data);
        $data = htmlspecialchars($data);
        $data = rtrim($data);
        $data = stripcslashes($data);
        $data = trim($data);
        return $data;
    }
    $username = dealwith($_POST['username']);
    $password = dealwith($_POST['password']);
        if(preg_match("/group|union|select|from|or|and|regexp|substr|like|create|drop|\,|\`|\!|\@|\#|\%|\^|\&|\*|\(|\)|\（|\）|\_|\+|\=|\]|\;|\'|\’|\“|\"|\<|\>|\?/i",$username))
        {
            echo "<script type='text/javascript'>alert('你想得美');</script>";
            echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
            die();
        }
        if(preg_match("/group|union|select|from|or|and|regexp|substr|like|create|drop|\,|\`|\!|\@|\#|\%|\^|\&|\*|\(|\)|\（|\）|\_|\+|\=|\]|\;|\'|\’|\“|\"|\<|\>|\?/i",$password))
        {
            echo "<script type='text/javascript'>alert('你想得美');</script>";
            echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
            die();
        }
    
    
    if(isset($username)&&isset($password)&&!empty($username)&&!empty($password))
    {
        $sql = "select username,pwdpwd from user where username = '$username'";
        $result = mysqli_query($revtal,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $hash_password = $row['pwdpwd'];
        $input_password = $password;
        if(hash_equals($hash_password,crypt($input_password,$hash_password)) && $row['username'] === $username)
        {
            //$_SESSION['login'] = 'success';
            $token = $_SESSION['token'] = $hash_password;
            $session_name = $_SESSION['username'] = $username;
            echo "<script type='text/javascript'>alert('登录成功，开始畅快聊天吧');</script>";
            echo "<script type = 'text/javascript'>window.open('./chatroom.php','_self');</script>";
            //username和token放在$_session['username']和$_session['token']
            die();
        }
        else
        {
            echo "<script type='text/javascript'>alert('账号或密码错误');</script>";
            echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
            die();
        }  
    }
    else
    {
        echo "<script type='text/javascript'>alert('请输入账号和密码');</script>";
        echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
        die();
    }
    mysqli_close($revtal);

?>    
    