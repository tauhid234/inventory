<?php
$url = $_SERVER['SERVER_NAME'];
$path = $_SERVER['REQUEST_URI'];
require_once('../../server/server.php');
require_once('../../util/MessageUtil.php');

class UserModel{


    var $mysqlz;
    var $hasil;
    var $msg;

    public function __construct()
    {
        $this->mysqlz = new Server();
        $this->msg = new MessageUtil();
    }
 
    public function tampil_data(){
        $data = mysqli_query($this->mysqlz->mysql,"SELECT * FROM user");
        while($d = mysqli_fetch_assoc($data)){
            $this->hasil[] = $d;
        }
        return $this->hasil;
    }

    public function Add($username, $no_hp, $email, $peran, $password){

        $create_date = date('Y-m-d');
        $decode_hp = htmlspecialchars($no_hp);
        $hash = password_hash($password, PASSWORD_DEFAULT);

        if($peran == "SALES"){
            return $this->msg->Info('Mohon menunggu untuk user <b>SALES</b> masih di tahan dalam pengerjaan aplikasi web');
        }

        $sql = mysqli_query($this->mysqlz->mysql, "SELECT * FROM user WHERE username = '$username'");
        $row = mysqli_num_rows($sql);
        if($row > 0){
            return $this->msg = $this->msg->Warning('Data dengan username tersebut sudah tersedia');
        }

        $data = mysqli_query($this->mysqlz->mysql, "INSERT INTO user (id, username, no_handphone, email, peran, create_date, status, password) VALUES
        ('','$username','$decode_hp','$email','$peran','$create_date','AKTIF','$hash')");
        return $this->msg = $this->msg->Success('Data berhasil di simpan');
    }
    
    public function Update($id, $username, $no_hp, $email, $peran, $status){


        $sql = mysqli_query($this->mysqlz->mysql, "SELECT * FROM user WHERE id = '$id'");
        $row = mysqli_num_rows($sql);
        if($row == 0){
            return $this->msg = $this->msg->Warning('Data dengan id tersebut tidak tersedia');
        }
        
        if($username == "mstdev"){
            $dev = mysqli_query($this->mysqlz->mysql, "SELECT * FROM user WHERE peran = 'ADMIN_HRD' AND username = '$username'");
            $row_d = mysqli_num_rows($dev);
            if($row_d == 1){
                return $this->msg = $this->msg->Warning('Anda tidak diperkenankan untuk mengupdate data user Admin DEV !');
            }
        }

        

        $data = mysqli_query($this->mysqlz->mysql, "UPDATE user SET username = '$username', email = '$email', no_handphone = '$no_hp', status = '$status',
                peran = '$peran' WHERE id = '$id'");
        return $this->msg = $this->msg->Success('Data berhasil di update');
    }
    
    public function Delete($id, $username){

        // CEGAH USER ADMIN HAPUS DATA SEMUA -> SISAKAN SATU DATA UNTUK LOGIN SBG ADMIN
        $uname = $_SESSION['username'];
        $username2 = $username;
        $cek = mysqli_query($this->mysqlz->mysql, "SELECT * FROM user WHERE id = '$id' AND peran = 'ADMIN' AND username = '$uname'");
        $cek_2 = mysqli_query($this->mysqlz->mysql, "SELECT * FROM user WHERE id = '$id' AND peran = 'ADMIN_HRD' AND username = '$uname'");
        $row_c = mysqli_num_rows($cek);
        $row_c_2 = mysqli_num_rows($cek_2);

        if($row_c == 1){
            return $this->msg = $this->msg->Warning('Anda tidak diperkenankan untuk menghapus data user Anda sendiri !');
        }   

        if($row_c_2 == 1){
            return $this->msg = $this->msg->Warning('Anda tidak diperkenankan untuk menghapus data user Anda sendiri !');
        }        

        if($username2 == "mstdev"){
            $dev = mysqli_query($this->mysqlz->mysql, "SELECT * FROM user WHERE id = '$id' AND peran = 'ADMIN_HRD' AND username = '$username2'");
            $row_d = mysqli_num_rows($dev);
            if($row_d == 1){
                return $this->msg = $this->msg->Warning('Anda tidak diperkenankan untuk menghapus data user Admin DEV !');
            }        
        }

        $sql = mysqli_query($this->mysqlz->mysql, "SELECT * FROM user WHERE id = '$id'");
        $row = mysqli_num_rows($sql);
        if($row == 0){
            return $this->msg = $this->msg->Warning('Data dengan id tersebut tidak tersedia');
        }        

        $data = mysqli_query($this->mysqlz->mysql, "DELETE FROM user WHERE id = '$id'");
        return $this->msg = $this->msg->Success('Data berhasil di hapus');
    }

}