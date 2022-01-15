<?php
require_once('../../model/ProfitModel.php');
class ProfitController{

    var $model;
    public function __construct()
    {
        $this->model = new ProfitModel;
    }

    public function ProfitAdd($id_sales, $profit, $username){
        return $this->model->SyncronizeProfit($id_sales, $profit, $username);
    }
}