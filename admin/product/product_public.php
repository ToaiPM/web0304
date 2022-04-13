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
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $p = new product();
    $kq = $p->SanPhamChiaSe($product_id);
    if($kq){
        $mang = [
            'status'=>200,
            'content'=>'success'
        ];
    }else{
        $mang = [
            'status'=>200,
            'content'=>'success'
        ];
    }
    echo json_encode($mang);
?>