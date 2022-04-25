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
    $pwd = "root2497091708";
    $dbname = "user";
    $conn = new mysqli($host,$user,$pwd,$dbname);
    
    if($conn->connect_error)
    {
        die('数据库连接失败');
    }
    $username = $_SESSION['username'];
    $token = $_SESSION['token'];
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="chat" content="在线聊天系统">
        <meta name="author" content="R1esbyfe">
        <title>一个简易小巧的聊天室</title>
        <!--CSS-->
        <link rel='stylesheet' type='text/css' href='./chatroom.css'>
        
    </head>
<body style="background-image: url(./img/hills.jpg);"> 
    <h1 style="text-align:center">A small chatroom</h1>
    <div style="position: absolute;top: 30%;left: 10%;">
        <button onclick="reset()" style="width: 135px;height: 45px;">刷新聊天室成员</button><br/><br/>
        <button onclick="upload1()" style="width: 135px;height: 45px;">上传文件</button><br/><br/>
        <button onclick="upload2()" style="width: 135px;height: 45px;">上传图片</button><br/><br/>
        <button onclick="files()" style="width: 135px;height: 45px;">查看已上传文件</button><br/><br/>
        <button onclick="logout()" style="width: 135px;height: 45px;">退出账户</button><br/><br/>
        <div id="logout_result"></div>
    </div>
    <div style="position: absolute;left: 80%;">聊天室成员</div><br/>
    <span id="getusername" style="position: absolute;left: 80%;"></span><br/>
    <div style="text-align:center;">
    <div style="top:12%;">历史聊天记录</div>
    <span id="show_messages"></span>
    <span style="top:23%;color: #00FFFF">历史图片记录</span>
    <div id="show_photos"></div>
    </div>
    <h2 style="text-align:center;">字符输入框</h2>
    <form id="uploadform">
        <div style="text-align:center;">字体颜色:<select name="color">
            <option style="color: #FF0000" value="#FF0000">红色</option>
            <option checked style="color: #FF7F00" value="#FF7F00">橙色</option>
            <option style="color: #FFFF00" value="#FFFF00">黄色</option>
            <option style="color: #00FF00" value="#00FF00">绿色</option>
            <option style="color: #00FFFF" value="#00FFFF">青色</option>
            <option style="color: #0000FF" value="#0000FF">蓝色</option>
            <option style="color: #8B00FF" value="#8B00FF">紫色</option>
                </select>
                </div>
        <div id="send"> 
            <input type="hidden" name="username" value='<?php echo $username;?>' />
            <div style="text-align:center;">
               <input id="message" name="message" style="width: 15%;height: 10%;right:50%;" placeholder="show friends your entertainment!!!"></input>
               <!--输入你想说的话-->
                <button style="width: 5%;height: 10%;" type="button" onclick="sendmsg()">发送</button>
                <span id="sendresult"></span>
                </div>
                </form>
                </div>
            </div>
    </div>

    <div id="upload" style="display:none;width:35%;height:35%;background-color:darkorchid;z-index: 1000;position: absolute;top: 30%;left: 30%;">      <!--文件上传的界面，该窗口默认不展示-->
        <span style="float: right;cursor: pointer;" onclick="close1()">x</span>
        <div style="text-align: center;padding-top: 20%;">
            <form id="upload_data">
                <h2>选择你想上传的文件</h2>
                <input type="file" name="files" />
                <input type="hidden" value="<?php echo $username;?>" name="user">
                <input type="hidden" value="<?php echo $token;?>" name="token">
                <button onclick="uploadfile();return false;">上传文件</button>
            </form>
            <div id = "result"></div>
        </div>
    </div>     

    <div id="fileswindow" style="display:none;width:70%;z-index:1000;position:absolute;top:20%;left:20%;height:70%;background-color:#00FFFF;">    <!--显示文件的窗口-->
        <span style="float: right;cursor: pointer;" onclick="close2()">x</span>
        <h1 style="text-align:center">请选择你需要下载的文件</h1>
        <div id="content_files"></div>    
    </div>

    <div id="photowindow" style="display:none;width:70%;z-index:1000;position:absolute;top:20%;left:20%;height:70%;background-color:#00FFFF;">     <!--上传图片的窗口-->
        <span style="float: right;cursor: pointer;" onclick="close3()">x</span>
            <form id = "upload_photos">
            <div style="text-align:center">
                <h2>请选择你要上传的图片</h2>
            <input type="hidden" name="user" value="<?php echo $username;?>">
            <input type="hidden" name="token" value="<?php echo $token;?>">
            <input type="file" name="photos" accept="image/png, image/jpeg, image/gif, image/jpg" />
            <button onclick="uploadphotos1();return false;">上传图片</button>
            </form>
            <div id = "result2"></div>
            </div>
    </div>
     
<script>
    window.onload=function()
    {
        getmessages();
        setInterval(`getmessages()`,5000); 
        reset();
        setInterval(`reset()`,10000);
        getphotos();
        setInterval(`getphotos()`,10000);  
    }

    function logout()
    {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState == 4)
            {
                
                document.getElementById('logout_result').innerHTML = xhr.responseText;
                alert('登出成功');
                window.open('./login_table.php','_self');
            }
        }
        xhr.open('GET','./logout.php',true);
        xhr.send(null);
    }

    function getphotos()
    {
        var xhr = new XMLHttpRequest();
        var s = "";
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState == 4)
            {
 
                var info = xhr.responseText;
                info = JSON.parse(info);
                for(var i=0;i<info.length;i++)
                {
                    s+="<p style='color:#00FFFF;'>"+info[i].sender+":";
                    s+="<img src='./chatroomphotos/"+info[i].name+"' width='15%' />";
                    s+="("+info[i].time+")"+"</p>"; 
                    s+="<br/><br/><br/>";
                }
                document.getElementById('show_photos').innerHTML = "";
                var photo = document.getElementById('show_photos');
                photo.innerHTML +=s;
                msg.scrollTop = msg.scrollHeight;
            }
        }
      xhr.open("GET","./get_photos.php",true);
      xhr.send(null);
    }
 
    function reset() 
    {
        var xhr = new XMLHttpRequest();
        var s = "";
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState == 4)
            {
              var online = xhr.responseText;
              online = JSON.parse(online);
              for(var i=0;i<online.length;i++)
              {
                  s+="<p>"+online[i].username+"</p>";
              }
              document.getElementById('getusername').innerHTML = "";
              var on = document.getElementById('getusername');
              on.innerHTML +=s;
            }
        }
        xhr.open('GET','./statistics.php');
        xhr.send(null);
    }
    
    
   function getmessages() 
        {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(){
            if(xhr.readyState==4)
            {
                var info = xhr.responseText;
                info = JSON.parse(info);
                var s="";
                for(var i=0;i<info.length;i++)
                {
                    s+="<p style='color:"+info[i].color+";'>";
                    s+=info[i].username+":";
                    s+=info[i].content+"("+info[i].time;
                    s+=")</p>";
                }
                document.getElementById('show_messages').innerHTML = "";
                var msg = document.getElementById('show_messages');
                
                msg.innerHTML +=s;
            }
        }
            xhr.open('GET','./get_messages.php',true);
            xhr.send(null);
    }
    
    function sendmsg() 
    {
        var form = document.getElementById('uploadform');
        var formdata = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState == 4)
            {
                document.getElementById('sendresult').innerHTML = xhr.responseText;
                document.getElementById('message').value = "";
                setTimeout(`hiddenmessages()`,1000);
            }
        }
            xhr.open('POST','./send_messages.php',true);
            xhr.send(formdata);
    }
    function hiddenmessages() 
    {
        document.getElementById('sendresult').innerHTML = "";
        
    }

    function upload1() 
    {
        document.getElementById('upload').style.display = "block";
    }

    function close1() 
    {
        document.getElementById('upload').style.display = "none";
    }

    function close2()   
    {
        document.getElementById('fileswindow').style.display = "none";

    }

    function files()  
    {
        document.getElementById('fileswindow').style.display = "block";
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function()
        {
            if(xhr.readyState == 4)
            {
                document.getElementById('content_files').innerHTML=xhr.responseText;

            }
            
        }
        xhr.open("GET","./get_file.php",true);
        xhr.send(null);
    }

    function uploadfile() 
    {
        var fm1 = document.getElementById('upload_data');

        var fd = new FormData(fm1);
        
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function()
        {
            if(xhr.readyState == 4)
            {
               document.getElementById('result').innerHTML = xhr.responseText;
            }
        }
        xhr.open("POST","./uploadfile.php",true);
        xhr.send(fd);
        return false;
    }

    function upload2()
    {
        document.getElementById('photowindow').style.display = "block";
    }

    function close3()
    {
        document.getElementById('photowindow').style.display = "none";
    }

    function uploadphotos1() 
    {
        var xhr = new XMLHttpRequest();
        var fm2 = document.getElementById('upload_photos');
        var fd = new FormData(fm2);

        xhr.onreadystatechange = function()
        {
            if(xhr.readyState == 4)
            {
                document.getElementById('result2').innerHTML = xhr.responseText;
            }
        }
        xhr.open("POST","./uploadphotos.php",true);
        xhr.send(fd);
        return false;
    }
    </script>