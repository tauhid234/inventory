<?php
 require_once('./server/server.php');

 $host = "31.220.110.151";
 $user = "u232684745_development";
 $pass = "Development01";
 $db = "u232684745_development";

 $conn = mysqli_connect($host,$user,$pass,$db);
 if(mysqli_errno($conn)){
     echo "KONEKSI MATI";
 }

 $select = mysqli_query($conn, "SELECT * FROM cron_job");
 $num = mysqli_num_rows($select);
 $test = "CRON JOB ".$num;
 $insert = mysqli_query($conn, "INSERT INTO cron_job ('id', 'cron_job') VALUES ('', '$test'");
 if($insert == false){
     echo "FAILED CRON JOB";
 }