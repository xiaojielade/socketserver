<?php
$p=fopen("../../www/wangzhan/038/clientip.txt","r+");
$clientip=fread($p,1024);
fclose($p);
file_put_contents("../../www/wangzhan/038/clientip.txt","");
$client=explode(" ",$clientip);
$ip=$client[0];
$port=$client[1];
$formerpart="tcp://".$ip.":".$port;
echo $formerpart;
error_reporting(E_ALL);
set_time_limit(0);
echo "<h2>TCP/IP Connection</h2>\n";
$trans=array();
$trans[0]="AABB1233FF";
$trans[1]="AABB1334.5FF";
$trans[2]="AABB237.6FF";
$trans[3]="AABB225.3FF";
$trans[4]="AABB3122FF";
$trans[5]="AABB3225FF";
$trans[6]="AABB1240FF";
$trans[7]="AABB1339FF";
$trans[8]="AABB214.9FF";
$trans[9]="AABB235.5FF";
$trans[10]="AABB3123FF";
$trans[11]="AABB3235FF";
while(true){
	
	echo "next round";
	$socket=stream_socket_client($formerpart,$errno,$errstr);
	//$socket=stream_socket_client("tcp://192.168.1.100:2000",$errno,$errstr);
	$num=mt_rand(0,10);
$in=$trans[$num];
$out = '';

if(!fwrite($socket, $in, strlen($in))) {
    echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
}else {
    echo "发到服务器成功了\n";
    echo "发送的内容为:<font color='red'>$in</font> <br>";
}

while($out = fread($socket, 8192)) {
    echo "接收服务器回传信息成功！\n";
    echo "接受的内容为:$out";
}
fclose($socket);
echo "close socket";
sleep(1);
echo "circle end";
}


?>