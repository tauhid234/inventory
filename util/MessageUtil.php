<?php

class MessageUtil{
    var $success;
    var $warning;
    var $error;

    public function Success($data){
        return '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUKSES, '.$data.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    public function Info($data){
        return '<div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>INFORMASI, '.$data.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    public function Warning($data){
        return '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>PERINGATAN, '.$data.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    public function Error($data){
        return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERROR, '.$data.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
}