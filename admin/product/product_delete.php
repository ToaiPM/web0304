<?php
    include_once "../../helper/function.php";
    if(!isset($_SESSION)){ob_start();session_start();}
    spl_autoload_register(function ($TenLop) {
        $file = '../../classes/' . $TenLop. '.php';
        if (is_readable($file))
        {
            require_once($file);
        }
        else
            trigger_error("The class '" . $TenLop . "' or the file '" . $TenLop . "' failed to spl_autoload ");
    });
    $chuoiID = isset($_POST['chuoiID']) ? $_POST['chuoiID'] : ''; 
    $h = new product();
    $kq = $h->Xoa($chuoiID);
    if($kq){
        $mang = [
            'status'=>200,
            'content'=>'success'
        ];
    }else{
        $mang = [
            'status'=>403,
            'content'=>'failure'
        ];
    }
    echo json_encode($mang);
?>