
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
  <title>ReturnNull Server Info</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
   <div class="header">
   Server Info
   </div>
 <div class="content" style="overflow: hidden;">
	 
	 
	 <?php

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

echo 'Your IP - '.getUserIpAddr();
echo '<br>';
echo 'Ping: ';
function GetPing($ip=NULL) {
     if(empty($ip)) {$ip = $_SERVER['REMOTE_ADDR'];}
     if(getenv("OS")=="Windows_NT") {
       $ping=explode(",", $exec);
       return $ping[1];//Maximum = 78ms
     }
     else {
      $exec = exec("ping -c 3 -s 64 -t 64 ".$ip);
      $tmpp = explode("=", $exec );
      $tmp = explode("/", end($tmpp) );
      $array = end($tmp);
      return ceil($array[1]) . 'ms';
     }
    }

    echo GetPing();

echo '<br> <br>';
$kb=512;

echo 'Getting'.' '.$kb.' '.'kilobytes.';
echo '<br>';
$time = explode(" ",microtime());
$start = $time[0] + $time[1];
for($x=0;$x<$kb;$x++){
    echo str_pad('', 1024, '.');
  //str_pad('', 1024, '.');
    flush();
}
$time = explode(" ",microtime());
$finish = $time[0] + $time[1];
$deltat = $finish - $start;
echo 'Test finished in '.$deltat.' seconds.'.' <br> Your speed is '. round($kb / $deltat, 3)." Kilobyte/s";



echo '<br> <br> <br>'.'<a href='.'"'.'index.php'.'"'.'>Back</a>';
// fclose($f);
 
 
 
?>


	 
	 
	 
	 
	 </div>
</head>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>
</html>
