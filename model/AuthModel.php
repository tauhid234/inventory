<?php 
require_once('../server/server.php');
require_once('../util/MessageUtil.php');

class AuthModel{

    var $msg;
    var $server;

    public function __construct()
    {
        $this->server = new Server();
        $this->msg = new MessageUtil();
    }

    public function getLogin($username, $password){
        session_start();
        $query = mysqli_query($this->server->mysql, "SELECT * FROM user WHERE username = '$username' AND status = 'AKTIF'");
        if(mysqli_num_rows($query) == 1){
            $row = mysqli_fetch_array($query);
            if(password_verify($password, $row["password"])){
                $_SESSION['username'] = $row['username'];
                $_SESSION['peran'] = $row['peran'];
                if($_SESSION['peran'] == 'ADMIN' || $_SESSION['peran'] == 'ADMIN_HRD'){
                    return header("Location:../pages/admin/dashboard.php");
                }else{
                    session_unset();
                    session_destroy();
                }
            }else{
                return $this->msg->Error('Username atau Password anda salah');
            }
        }else{
            return $this->msg->Error('Username atau Password anda salah');
        }
    }
}