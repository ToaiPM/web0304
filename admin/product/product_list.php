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
    $timkiem_header = isset($_POST['timkiem_header']) ? $_POST['timkiem_header'] : '';
    $boloc_category_id = isset($_POST['boloc_category_id']) ? $_POST['boloc_category_id'] : '';
    $boloc_product_name = isset($_POST['boloc_product_name']) ? $_POST['boloc_product_name'] : '';
    $boloc_product_status = isset($_POST['boloc_product_status']) ? $_POST['boloc_product_status'] : '';
    $boloc_created_at = isset($_POST['boloc_created_at']) ? $_POST['boloc_created_at'] : '';
    $boloc_product_price_1 = isset($_POST['boloc_product_price_1']) ? $_POST['boloc_product_price_1'] : '';
    $boloc_product_price_2 = isset($_POST['boloc_product_price_2']) ? $_POST['boloc_product_price_2'] : '';
    $h = new product();
    $tongsodong = $h->countTotal($timkiem_header, $boloc_category_id, $boloc_product_name, $boloc_product_status, $boloc_created_at, $boloc_product_price_1, $boloc_product_price_2); 
?>
<?php if($tongsodong > 0){ ?>
<div class="action_gr">
    <p class="soluong_hangsanxuat">Có (<?php echo $tongsodong; ?>) hãng sản xuất</p>
    <div class="chucnang_gr">
        <button onclick="getThem()" class="thaotac"><span class="icon" style="color:#023ff7"><i class="fa-solid fa-plus"></i></span> Thêm</button>
        <button onclick="Xoa()" class="thaotac"><span class="icon" style="color:#f70202"><i class="fa-solid fa-trash-can"></i></span> Xóa</button>
        <button class="thaotac"><span class="icon" style="color:#077d51"><i class="fa-solid fa-print"></i></span> In</button>
        <button class="thaotac"><span class="icon" style="color:#077d51"><i class="fa-solid fa-file-excel"></i></span> Xuất Excel</button>
    </div>
</div>
<table>
    <tr>
        <th width="5%">STT</th>
        <th>Tên hãng</th>
        <th>Tên sản phẩm</th>
        <th>Giá nhập</th>
        <th>Giá bán</th>
        <th>Hình ảnh</th>
        <th>Public</th>
        <th width="7%">Chi tiết</th>
        <th width="7%">Sửa</th>
        <th width="8%">
            <label for="checkall">Chọn</label>
            <input type="checkbox" class="checkall" id="checkall" onchange="checkall()">
        </th>
    </tr>
    <?php
    $Page =$_POST["TrangHienTai"];
    $Limit = 10;
    $Start = $Limit * ($Page - 1);
    $NumPage = 4;
    $danhsach = $h->DanhSach($timkiem_header, $boloc_category_id, $boloc_product_name, $boloc_product_status, $boloc_created_at, $boloc_product_price_1, $boloc_product_price_2, $Start, $Limit);
    for($i=0;$i<count($danhsach);$i++){
        $product_id = $danhsach[$i]['product_id'];
        $id = $danhsach[$i]['category_id'];
        $tenhang = $danhsach[$i]['category_name'];
        $title = $danhsach[$i]['product_title'];
        $gianhap = $danhsach[$i]['product_purchase_price'];
        $giaban = $danhsach[$i]['product_price'];
        $hinhanh = $danhsach[$i]['product_thumbnail'];
        $public = $danhsach[$i]['product_public'];
    ?>
    <tr>
        <td  style="text-align:center"><?php echo $i+1; ?></td>
        <td><?php echo $tenhang; ?></td>
        <td><?php echo $title; ?></td>
        <td><?php echo $gianhap; ?></td>
        <td><?php echo $giaban; ?></td>
        <td style="text-align:center">
            <img width="80px" src="/public/img/products/<?php echo $hinhanh; ?>" alt="">
        </td>
        <td style="text-align:center">
            <span onclick="SanPhamChiaSe('<?php echo $product_id; ?>')" class="product_public">
                <?php if($public == 1){ ?>
                <i class="fa-solid fa-bullhorn chiase"></i>
                <?php }else{ ?>
                <i class="fa-brands fa-creative-commons-pd khongchiase"></i>
                <?php } ?>
            </span>
        </td>
        <td style="text-align:center"><span onclick="XemChitiet('<?php echo $id; ?>')" class="xemchitiet_hsx"><i class="fa-solid fa-eye"></i></span></td>
        <td style="text-align:center"><span onclick="getSua('<?php echo $id; ?>')" class="capnhat_hsx" title="Sửa"><i class="fa-solid fa-pencil"></i></span></td>
        <td style="text-align:center">
            <input type="checkbox" class="mang" value="<?php echo $id; ?>">
        </td>
    </tr>
    <?php } ?>
</table>
<div  style="margin:25px">
    <?php
        if($tongsodong>0)
            PhanTrang($Page, $tongsodong, $Limit, $NumPage);
    ?>
</div>
<?php }else{ ?>
<p>không có dữ liệu</p>
<?php } ?>

<script>
    $('.ClickPage').click(function(){
        var page = $(this).attr("val"); 
        $("#TrangHienTai").val(page); 
        DanhSach();
    })
</script>
