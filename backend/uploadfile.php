<?php
    error_reporting(0);
    session_start();        
    if(!isset($_SESSION['username'])||!isset($_SESSION['token']))
    {
        echo "<script type='text/javascript'>alert('您无权访问');</script>";
        echo "<script type='text/javascript'>window.open('./login_table.php','_self');</script>";
        die();
    }
    
    if($_FILES['files']['error']>0)
    {
        exit("上传失败，请重试");
    }

    $dir = "./chatroomfiles/";
    if(!file_exists($dir))
    {
        mkdir($dir);
    }
    $whitelist = array('jpg','png','txt','bmp','gif','jpeg');
    $split = explode('.',$_FILES['files']['name']);
    $backname = $split[1];
    //echo $backname;
    $value = $_FILES['files']['name'];
        if(in_array($backname,$whitelist))
        {
            $blacklist = ['<script>','</script>','<img>','/','<iframe>','</iframe>','alert','window','onerror','atob','btoa','String.fromCharCode','eval','Function'];
            foreach($blacklist as $key)
            {
                if(preg_match('/'.$key.'/',$value))
               {
                    echo '文件名不合法';
                    die();
               }
            }
            $name = $_FILES['files']['name']; 
            $dir = $dir.$name;

            $res = move_uploaded_file($_FILES['files']['tmp_name'],$dir);
    
            if($res)
           {
                echo "文件上传成功";
                die();
           }
           else
          {
                echo "文件上传失败";
                die();
          }
        }
        else
        {
            echo "文件格式暂不支持";
            die();
        }
?>
    

    