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
    $up = 0;
    if(isset($_FILES['product_thumbnail']['name'])){
        $extension = explode('.',$_FILES['product_thumbnail']['name']);
        $duoi_tep = end($extension);
        $allowed_type = array('JPG','PNG','JPEG','GIF');
        if(in_array($duoi_tep,$allowed_type)){
            $ten_moi = rand().".".$duoi_tep;
            $path = '../../public/img/products/'.$ten_moi;
            if(move_uploaded_file($_FILES['product_thumbnail']['tmp_name'],$path)){
                $up = 1; //up thanh cong
            }else{
                $up = 0; //up that bai
            }
        }else{
            $hople = 0; //file không hợp lệ
        }
    }else{
        $tontai = 0; //file không tồn tại
    }
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
    $product_title = isset($_POST['product_title']) ? $_POST['product_title'] : '';
    $product_purchase_price = isset($_POST['product_purchase_price']) ? $_POST['product_purchase_price'] : '';
    $product_price = isset($_POST['product_price']) ? $_POST['product_price'] : '';
    $product_discount = isset($_POST['product_discount']) ? $_POST['product_discount'] : '';
    $product_description = isset($_POST['product_description']) ? $_POST['product_description'] : '';
    $product_amount = isset($_POST['product_amount']) ? $_POST['product_amount'] : '';
    $product_public = isset($_POST['product_public']) ? $_POST['product_public'] : '';
    $p = new product();
    $kq = $p->Them($category_id,$product_title,$product_purchase_price,$product_price,$product_discount,$product_description,$product_amount,$product_public,$ten_moi);
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
    
