<?php
require_once('../../model/CategoryModel.php');

class CategoryController{

    var $controller;
    public function __construct()
    {
        $this->controller = new CategoryModel();
    }

    public function AddController($name_category){
        return $this->controller->Add($name_category);
    }

    public function UpdateController($id, $name_category){
        return $this->controller->Update($id, $name_category);
    }

    public function DeleteController($id){
        return $this->controller->Delete($id);
    }
}