<?php

require_once('../../model/UserModel.php');
require_once('../../util/MessageUtil.php');
class UserController{

    var $aksi;
    var $msg;

    public function __construct()
    {
        $this->msg = new MessageUtil();
        $this->aksi = new UserModel();
    }

    public function inputUser($username, $no_hp, $email, $peran, $password, $konfirm_password){
    
      if($password < 8){
          return $this->msg->Warning("Input password minimal 8 karakter");
      }
      
       if($konfirm_password != $password){
           return $this->msg->Warning("Input konfirmasi Password tidak sesuai dengan input password");
       }
       $data = $this->aksi->Add($username, $no_hp, $email, $peran, $password);
       return $data;
    }
    
    public function updateUser($id,$username, $no_hp, $email, $peran, $status){
       $data = $this->aksi->Update($id, $username, $no_hp, $email, $peran, $status);
       return $data;
    }

    public function Delete($id,$username){
       $data = $this->aksi->Delete($id,$username);
       return $data;
    }
}