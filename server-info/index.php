


<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
  <title>ReturnNull Server Info</title>
 
  <link rel="stylesheet" type="text/css" href="../style.css">
  
  
   <div class="header">
   Server Info
   </div>
   
   <div class="content">
	   <?php
 $f = fopen("/sys/class/thermal/thermal_zone0/temp","r");
 $temp = fgets($f);
 echo 'CPU temperature is '.round((int)$temp/1000).'°C';
 echo '<br>'.'Uptime: '.shell_exec('uptime -p');
$exec_loads = sys_getloadavg();
$exec_cores = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
$cpu = round($exec_loads[1]/($exec_cores + 1)*100, 0) . '%';

echo '<br> CPU Usage: '.get_server_cpu_usage();







echo '<br>';


function get_server_cpu_usage(){

    $load = sys_getloadavg();
return 'Last 1 min -> '.$load[0].' / 5 min -> '.$load[1].' / 15 min -> '.$load[2];
    //return $load[0]*100;

}



echo '<br> <br> <br>'.'<a href='.'"'.'netspeed.php'.'"'.'>Click here to see the network speed.</a>';












echo '<br> The page refreshes itself in 5 seconds. <br> <br>';
$refreshAfter = 5;
 
//Send a Refresh header to the browser.
header('Refresh: ' . $refreshAfter);











 fclose($f);
 
?>
	   </div>
</head>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/footer.php';?>
</body>
</html>
