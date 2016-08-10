<?php

error_reporting(E_ALL);
$lianjie=mysql_connect("localhost","root","root");
mysql_select_db("data",$lianjie);
//确保在连接客户端时不会超时
set_time_limit(0);

$ip = '127.0.0.1';
$port = 2000;


if(($sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP)) < 0) {
    echo "socket_create() 失败的原因是:".socket_strerror($sock)."\n";
}
if(($ret = socket_bind($sock,$ip,$port)) < 0) {
    echo "socket_bind() 失败的原因是:".socket_strerror($ret)."\n";
}

if(($ret = socket_listen($sock,4)) < 0) {
    echo "socket_listen() 失败的原因是:".socket_strerror($ret)."\n";
}

$count = 0;

do {
    if (($msgsock = socket_accept($sock)) < 0) {
        echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
        break;
    } else {
        
        //发到客户端
        $msg ="测试成功个锤子！\n";
        socket_write($msgsock, $msg, strlen($msg));
        
        echo "测试成功\n";
		echo "发送的内容是:$msg\n";
        $buf = socket_read($msgsock,8192);
        $jg1=array();
		$jg1=explode("b",$buf,3);
		foreach($jg1 as $zj){
			$jg=array();
			$jg=explode("a",$zj,3);
			$month=date('Y-m');
		    $date=date('m-d');
		    $time=date('Y-m-d H:i:s');
			$sql="insert into $jg[0] values('$jg[1]','$jg[2]','$month','$date','$time')";
		    mysql_query($sql);
			}
		
        $talkback = "收到的信息:$buf\n";
        echo $talkback;
	
    }
    //echo $buf;
    socket_close($msgsock);

} while (true);

socket_close($sock);
?>