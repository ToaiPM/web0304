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

    //print_r($_SESSION['listGioHang']);die;
    $danhsach = array(array());
    $tongsodong = 0;
    if(isset($_SESSION['listGioHang'])){
        $danhsach = $_SESSION['listGioHang'];
        $tongsodong = count($danhsach);
    }
    //print_r($danhsach);die;
    if($tongsodong == 0){
?>
<div class="container">
    <div class="thongtingiohang canhbaorong"><i class="fa-solid fa-circle-exclamation"></i>&nbsp;Giỏ hàng rổng</div>
</div>
<?php }else{ ?>
<div class="container">
    <table class="table caption-top">
        <div class="thongtingiohang mt-4">Giỏ hàng của bạn</div>
        <thead>
            <tr>
                <th style="text-align:left">Thông tin sản phẩm</th>
                <th class="ancot_dongia dongia" style="text-align:left;color:#333">Đơn giá</th>
                <th style="text-align:left">Số lượng</th>
                <th style="text-align:left">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tongthanhtien = 0;
            for($i=0 ;$i<$tongsodong;$i++){
                $hinhanh = $danhsach[$i]['hinhanh'];
                $tendienthoai = $danhsach[$i]['tendienthoai'];
                $giaban = $danhsach[$i]['giaban'];
                $soluong = $danhsach[$i]['soluong'];
                $thanhtien = $soluong * $giaban;
                $tongthanhtien +=$thanhtien;
                $idSanPham = $danhsach[$i]['idSanPham'];
            ?>
            <tr>
                <td>
                    <div class="sanpham">
                        <img class="hinhanh" src="<?php echo $hinhanh; ?>" alt="" width="80px">
                        <div class="tensp_xoa">
                            <h6 class="tensp"><?php echo $tendienthoai; ?></h6>
                            <a onclick="XoaTrongGiohang('<?php echo $idSanPham; ?>')" class="xoa" href="#">Xóa</a>
                        </div>
                    </div>
                </td>
                <td class="ancot_dongia">
                    <div class="dongia">
                        <h6><?php echo number_format($giaban). ' đ'; ?></h6>
                    </div>
                </td>
                <td>
                    <div class="nhom">
                        <button onclick="CapNhatGioHang(1,'<?php echo $idSanPham; ?>')" class="soluongtru"><i class="fa-solid fa-minus"></i></button>
                        <input onchange="CapNhatGioHang(0,'<?php echo $idSanPham; ?>')" id="soluong_<?php echo $idSanPham; ?>" class="soluong" type="text" value="<?php echo $soluong; ?>">
                        <button onclick="CapNhatGioHang(2,'<?php echo $idSanPham; ?>')" class="soluongcong"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </td>
                <td>
                    <div class="thanhtien">
                        <h6 class="text text-danger"><?php echo number_format($thanhtien). ' đ'; ?></h6>
                    </div>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="1"></td>
                <td class="ancot_dongia" colspan="1"></td>
                <td colspan="1" style="text-align:right">Tổng tiền:</td>
                <td class="text text-danger"><?php echo number_format($tongthanhtien). 'đ'; ?></td>
            </tr>
            
        </tbody>
    </table>
    <div class="thanhtoan">
        <button class="btn-thanhtoan">Thanh toán</button>
    </div>
</div>
<?php } ?>