<?php
    if(!isset($_SESSION)){ob_start();session_start();}
    spl_autoload_register(function ($TenLop) {
        $file = 'classes/' . $TenLop. '.php';
        if (is_readable($file))
        {
            require_once($file);
        }
        else
            trigger_error("The class '" . $TenLop . "' or the file '" . $TenLop . "' failed to spl_autoload ");
    });
    $site_path = realpath(dirname(__FILE__));
    define('__SITE_PATH', $site_path);
    $action = isset($_GET['action']) ? $_GET['action'] : 'frontend/home/index';
    include_once $action . '.php';
?>