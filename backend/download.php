<?php
    error_reporting(E_ALL ^ E_DEPRECATED);      
    session_start();        
    if(!isset($_SESSION['username'])||!isset($_SESSION['token']))
    {
        echo "<script type='text/javascript'>alert('您无权访问');</script>";
        echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
        die();
    }
    $filename = $_GET['filename'];
    $path = "/chatroomfiles/";
    getfiledown($filename,$path);

    function getfiledown($filename,$path)
    {
            $file_path = $_SERVER['DOCUMENT_ROOT'].$path.$filename;
            if(!file_exists($file_path))
            {
                echo "该文件不存在，请返回上一页";
                return;
            }
                $fp=fopen($file_path,'r');
                $file_size = filesize($file_path);
                header("Content-type:application/octet-stream");
                header("Accept-Length:".$file_size);
                header("Content-Disposition:attachment;filename=".$filename);
                
                $file_count = 0;
                $buffer = 1024;
                while(!feof($fp) && ($file_size-$file_count>0))
                {
                    $file_data = fread($fp,$buffer);
                    $file_count +=$buffer;
                    echo $file_data;
                }
                fclose($fp);
        }