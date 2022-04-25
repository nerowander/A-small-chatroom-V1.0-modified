<html>
    <head>
        <meta charset="UTF-8">
        <meta lang="zh">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>一个简易小巧的聊天室</title>
    </head>
    <script type="text/javascript">
                function initialize(){
                    var xhr =new XMLHttpRequest();
                    xhr.onreadystatechange = function(){
                        if(xhr.readyState == 4){
                            document.getElementById('result').innerHTML = xhr.responseText;
                            setTimeout("clear()",3000);
                        }
                    }
                    xhr.open("GET","./initialization.php",true);
                    xhr.send(null);
                    //return true;
                }
                function clear()
                {
                    document.getElementById('result').innerHTML = "";
                }
            </script>
    <body>
            <h1 style="font: sans-serif;font-size: 85px;">点击下面按钮完成聊天室的初始化</h1>
            <div id="result"></div>
            <button style="height: 50px;width: 100px;" type="button" onclick="initialize()">Initialization!</button><br /><br /><br />
            <button style="height: 50px;width: 100px;" type="button" onclick="document.location.href='./login_table.php'">Login!</button>
        </body>
        
</html>