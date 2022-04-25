<?php
error_reporting(E_ALL ^ E_DEPRECATED); 
session_start();        
if(!isset($_SESSION['username'])||!isset($_SESSION['token']))
{
    echo "<script type='text/javascript'>alert('您无权访问');</script>";
    echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
    die();
}
$path = "./chatroomfiles";
$all_file=scandir($path);
$url = "./download.php?filename=";

function check($value)
{
    $blacklist = ['<script>','</script>','<img>','/','<iframe>','</iframe>','alert','window','onerror','atob','btoa','String.fromCharCode','eval','Function'];
    foreach($blacklist as $key)
    {
        if(preg_match('/'.$key.'/',$value))
        {
           die('文件名不合法');
        }
    }
}
    for($i=2;$i<count($all_file);$i++)
       {
            $value = $all_file[$i];
            echo "<a href='$url$value'>".$value."</a><br/>";
        }
?>
