<?php
require_once('../../model/ProfitModel.php');
class ProfitController{

    var $model;
    public function __construct()
    {
        $this->model = new ProfitModel;
    }
}