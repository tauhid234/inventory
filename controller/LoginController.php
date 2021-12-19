<?php

require_once('../model/AuthModel.php');

class LoginController{

    var $model;
    public function __construct()
    {
        $this->model = new AuthModel();
    }

    public function login($username, $password){
        $data = $this->model->getLogin($username, $password);
        return $data;
    }
}