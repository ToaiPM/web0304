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
    $idSanPham = isset($_POST['idSanPham']) ? $_POST['idSanPham'] : '';
    $danhsach = $_SESSION['listGioHang'];
    foreach($danhsach as $key => $value){
        if($idSanPham == $value['idSanPham']){
            array_splice($_SESSION['listGioHang'],$key,1);
            break;
        }
    }

    $soluong_tong = 0;
    for($i = 0 ; $i < count($_SESSION['listGioHang']) ; $i++){
        $soluong_tong += $_SESSION['listGioHang'][$i]['soluong'];
    }
    $_SESSION['soluong_tong']=$soluong_tong;
    //thong bao
    $thongbao = [
        'status'=>200,
        'content'=>'success',
        'soluong_tong'=>$soluong_tong
    ];
    

    
    echo json_encode($thongbao);
