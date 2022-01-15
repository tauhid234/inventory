<?php
require_once('../../model/PotonganModel.php');
class PotonganController{

    var $model;
    public function __construct()
    {
        $this->model = new PotonganModel;
    }

    public function AddPotonganController($username, $potongan, $id_sales){

        return $this->model->AddPotongan($username, $potongan, $id_sales);
    }
}