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
    $boloc_content_ma = isset($_POST['boloc_content_ma']) ? $_POST['boloc_content_ma'] : '';
    $boloc_content_ten = isset($_POST['boloc_content_ten']) ? $_POST['boloc_content_ten'] : '';
    $h = new category();
    $tongsodong = $h->countTotal($timkiem_header, $boloc_content_ma, $boloc_content_ten);  
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
        <th width="15%">Mã</th>
        <th>Tên hãng</th>
        <th width="7%">Sửa</th>
        <th width="10%">
            <label for="checkall">Chọn</label>
            <input type="checkbox" class="checkall" id="checkall" onchange="checkall()">
        </th>
    </tr>
    <?php
    $Page =$_POST["tranghientai"];
    $Limit = 10;
    $Start = $Limit * ($Page - 1);
    $NumPage = 4;
    $danhsach = $h->DanhSach($timkiem_header, $boloc_content_ma, $boloc_content_ten, $Start, $Limit);
    //print_r($danhsach);die;
    for($i=0;$i<count($danhsach);$i++){
        $id = $danhsach[$i]['category_id'];
        $ma = $danhsach[$i]['category_code'];
        $ten = $danhsach[$i]['category_name'];
    ?>
    <tr>
        <td  style="text-align:center"><?php echo $i+1; ?></td>
        <td><?php echo $ma; ?></td>
        <td><?php echo $ten; ?></td>
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
