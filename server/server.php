<?php

class Server{

    var $host = "194.163.35.51";
    var $user = "u991438636_bintang89";
    var $pass = "Bintang89";
    var $db = "u991438636_bintang89";

    var $mysql;
    

    public function __construct()
    {
        $this->mysql = new mysqli($this->host,$this->user,$this->pass,$this->db);
        // mysqli_select_db($this->mysql,$this->db);
        if($this->mysql->connect_errno){
            echo "FAILED";
        }
        return $this->mysql;
    }

    public function index(){
        $this->mysql = mysqli_connect($this->host,$this->user,$this->pass,$this->db);
        return $this->mysql;
    }

    public function tampil_data(){
        $data = mysqli_query($this->mysql,"SELECT * FROM user");
        while($d = mysqli_fetch_array($data)){
            $hasil[] = $d;
        }
        return $hasil;
    }
}