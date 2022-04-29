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
    $hinhanh = isset($_POST['hinhanh']) ? $_POST['hinhanh'] : '';
    $tendienthoai = isset($_POST['tendienthoai']) ? $_POST['tendienthoai'] : '';
    $giaban = isset($_POST['giaban']) ? $_POST['giaban'] : '';
    $danhsachsanpham = array();
    $mang = [
        'idSanPham'=>$idSanPham,
        'hinhanh'=>$hinhanh,
        'tendienthoai'=>$tendienthoai,
        'giaban'=>$giaban,
        'soluong'=>1
    ];

    if(isset($_SESSION['listGioHang'])){
        //Kiem tra ton tại của idSanPham
        $tontaiID = 0;
        foreach($_SESSION['listGioHang'] as $key=>$value){
            if($idSanPham == $value['idSanPham']){
                $_SESSION['listGioHang'][$key]['soluong']++;
                $tontaiID = 1;
                break;
            }
        }
        if($tontaiID == 0){
            array_push($_SESSION['listGioHang'],$mang);
        }
        
    }else{
        array_push($danhsachsanpham,$mang);
        $_SESSION['listGioHang'] = $danhsachsanpham;
    }

    $soluong = 0;
    for($i = 0 ; $i < count($_SESSION['listGioHang']) ; $i++){
        $soluong += $_SESSION['listGioHang'][$i]['soluong'];
    }
    $thongbao = [
        'status'=>200,
        'content'=>'success',
        'soluong'=>$soluong
    ];
    $_SESSION['soluong_tong']=$soluong;
    echo json_encode($thongbao);

    //session_destroy();
    
?>