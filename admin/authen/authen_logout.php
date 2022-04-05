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

    if(isset($_SESSION['user_id'])){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_fullname']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_phone']);
        unset($_SESSION['user_address']);
        unset($_SESSION['role_name']);
        
        $info = [
            'status'=>200,
            'content'=>'success',
        ];
    }else{
        $info = [
            'status'=>404,
            'content'=>'failure',
        ];
    }
    echo json_encode($info);
?>