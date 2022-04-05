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
    $tendangnhap = isset($_POST['tendangnhap']) ? $_POST['tendangnhap'] : '';
    $matkhau = isset($_POST['matkhau']) ? md5($_POST['matkhau']) : '';
    $user = new user();
    $res = $user->Login($tendangnhap, $matkhau);
    if(empty($res)==false){
        //Ghi vào sesstion
        $_SESSION['user_id'] = $res['user_id'];
        $_SESSION['user_name'] = $res['user_name'];
        $_SESSION['user_fullname'] = $res['user_fullname'];
        $_SESSION['user_email'] = $res['user_email'];
        $_SESSION['user_phone'] = $res['user_phone'];
        $_SESSION['user_address'] = $res['user_phone'];
        $_SESSION['role_name'] = $res['role_name'];
        
        $info = [
            'status'=>200,
            'content'=>'success',
            'role_name'=>$res['role_name']
        ];
    }else{
        $info = [
            'status'=>403,
            'content'=>'failure'
        ];
    }
    echo json_encode($info);
?>