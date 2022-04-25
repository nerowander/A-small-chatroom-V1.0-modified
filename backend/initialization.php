<?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    session_start();
    $host = "localhost";
    $user = "root";
    $pwd = "root2497091708";
    $database1 = "user";
    $database2 = "chatroom";
    $database3 = "photos";

    $conn = new mysqli($host,$user,$pwd);
    $conn->query("set names utf8");
    $sql4 = "create database if not exists $database1"; 
    if(!$conn->query($sql4))
    {
        die("数据库创建失败1");
    }

    $sql5 = "create database if not exists $database2";
    if(!$conn->query($sql5))
    {
        die("数据库创建失败2");
    }

    $sql6 = "create database if not exists $database3";
    if(!$conn->query($sql6))
    {
        die("数据库创建失败3");
    }

    $conn->select_db($database1);
    $sql1 = 'create table if not exists `user`(
            '.'`username` varchar(100) not null,
            '.'`pwdpwd` varchar(100) not null,
            '.'`id` int unsigned auto_increment,
            '.'`submission_date` DATETIME not null,
            '.'primary key (`id`)'.')ENGINE=InnoDB DEFAULT CHARSET=utf8;';
    $result1 = $conn->query($sql1);
    
    $conn->select_db($database2);
    $sql2 = 'create table if not exists `chatroom`(`username` varchar(100) not null,`color` varchar(100) not null,`content` varchar(1000) not null,`time` DATETIME not null)ENGINE=InnoDB DEFAULT CHARSET=utf8;';
    $result2 = $conn->query($sql2);

    $conn->select_db($database3);
    $sql3 = 'create table if not exists `photos`(`sender` varchar(30) not null,`name` varchar(150) not null,`time` DATETIME not null)ENGINE=InnoDB DEFAULT CHARSET=utf8;';
    $result3 = $conn->query($sql3);

    if($result1 && $result2 && $result3)
    {
        sleep(5);
        echo("初始化成功，请登录");
        die();
    }
    else
    {
        sleep(3);
        echo("初始化失败，请重试");
        die();
    }

            