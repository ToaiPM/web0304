<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/all.min.css">
    <link rel="stylesheet" href="/public/css/grid.css">
    <link rel="stylesheet" href="/public/css/admin.css">
    <link rel="stylesheet" href="/public/css/chosen.css">
    <link rel="stylesheet" href="/public/css/jquery.datetimepicker.css">
    <link rel="stylesheet" href="/public/css/product.css">

    <script src="/public/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="/public/js/jquery.datetimepicker.js"></script>
    <script src="/public/js/chosen.jquery.js"></script>
    <title>Sản phẩm</title>
</head>
<body>
<?php
  if(!isset($_SESSION['user_id'])){
      header("Location: /");
  }
  include_once __SITE_PATH ."/helper/function.php";
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
    $chuoiID = isset($_POST['chuoiID']) ? $_POST['chuoiID'] : ''; 
    $h = new category();
    $info_category = $h->getInfo();
?>
<?php include_once __SITE_PATH . '/admin/layouts/navigation.php';  ?>
<?php include_once __SITE_PATH . '/admin/layouts/content_header.php';  ?>

<!--Danh sách sản phẩm -->
<div class="sanpham_gr">
    <input type="hidden" id="TrangHienTai" value="1">
    <div class="sanpham_title">SẢN PHẨM</div>
    <div class="boloc_content">
        <table>
            <tr>
                <td class="cot_title">Tên hãng&nbsp;</td>
                <td>
                    <select class="nhaptukhoa" type="text" id="category_id_search">
                        <option value="">--Tất cả---</option>
                        <?php
                            for($i=0 ; $i< count($info_category) ; $i++){
                                $category_id = $info_category[$i]['category_id'];
                                $category_name = $info_category[$i]['category_name'];
                        ?>
                        <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td class="cot_title">Tên sản phẩm&nbsp;</td>
                <td><input class="nhaptukhoa" type="text" id="product_name"></td>
            </tr>
            <tr>
                <td class="cot_title">Tình trạng&nbsp;</td>
                <td>
                    <select class="nhaptukhoa" type="text" id="product_status">
                        <option value="">-- Tất cả--</option>
                        <option value="1">Public</option>
                        <option value="0">Private</option>
                    </select>
                </td>
                <td class="cot_title">Ngày nhập&nbsp;</td>
                <td><input class="nhaptukhoa" type="text" id="boloc_created_at"></td>
            </tr>
            <tr>
                <td class="cot_title">giá bán: từ&nbsp;</td>
                <td><input class="nhaptukhoa" type="number" id="product_price_1"></td>
                <td class="cot_title">đến&nbsp;</td>
                <td><input class="nhaptukhoa" type="number" id="product_price_2"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><button onclick="DanhSach()" class="btn_submit"><i class="fa-solid fa-magnifying-glass" style="font-size:12px; color:#0b73e1"></i> Tìm</button></td>
            </tr>
        </table>
    </div>
    <div id="danhsach"></div>
</div>

<?php include_once __SITE_PATH . '/admin/layouts/content_footer.php';  ?>
<!-- form thêm mới -->
<div class="modal_them">
    <div class="content_them">
        <div class="headerthem">
            <span class="headerthem_title">Thêm mới</span>
            <span onclick="Huy()" class="headerthem_icon">[X]</span>
        </div>
        <div class="body">
            <div class="info_gr">
                <input type="hidden" id="product_id">
                <span class="info_label">Hãng sản xuất&nbsp;</span>
                <select type="text" class="info_text" id="cate_id">
                <option value="">--Vui lòng chọn---</option>
                    <?php
                        for($i=0 ; $i< count($info_category) ; $i++){
                            $category_id = $info_category[$i]['category_id'];
                            $category_name = $info_category[$i]['category_name'];
                    ?>
                    <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="info_gr">
                <span class="info_label">Tên sản phẩm&nbsp;</span>
                <input type="text" class="info_text" id="product_title">
            </div>
            <div class="info_gr">
                <span class="info_label">Giá nhập&nbsp;</span>
                <input type="number" class="info_text" id="product_purchase_price">
            </div>
            <div class="info_gr">
                <span class="info_label">Giá bán&nbsp;</span>
                <input type="number" class="info_text" id="product_price">
            </div>
            <div class="info_gr">
                <span class="info_label">Giảm giá&nbsp;</span>
                <input type="number" class="info_text" id="product_discount">
            </div>
            <div class="info_gr">
                <span class="info_label">Mô tả&nbsp;</span>
                <textarea  class="info_text" name="" id="product_description" cols="30" rows="5"></textarea>
            </div>
            <div class="info_gr">
                <span class="info_label">Số lượng&nbsp;</span>
                <input type="number" class="info_text" id="product_amount">
            </div>
            <div class="info_gr">
                <span class="info_label">Hình ảnh&nbsp;</span>
                <input type="file" class="info_text" id="product_thumbnail">
            </div>
            <div class="info_gr">
                <span class="info_label">Tình trạng&nbsp;</span>
                <select type="text" class="info_text" id="product_public">
                    <option value="1">Public</option>
                    <option selected value="0">Private</option>
                </select>
            </div>
            <div class="info_gr_btn">
                <button onclick="postThem()" class="btn_them">Thực hiện</button>
                <button onclick="Huy()" class="btn_huy">Hủy</button>
            </div>
        </div>
    </div>
</div>
    <script>
        $('#codinh').click(function(){
            if(this.checked == true){
            $('.content').addClass("thaydoicontent")
            $('.navigation').addClass("thaydoinavigation")
            }else{
            $('.content').removeClass("thaydoicontent")
            $('.navigation').removeClass("thaydoinavigation")
            }
        });
        $('#cate_id').chosen({width:"100%"});
        $('#category_id_search').chosen({width:"100%"});
        $('#product_status').chosen({width:"100%"});
        $('#boloc_created_at').datetimepicker({format: 'd/m/Y',lang: 'vi'});

        function DanhSach(){
            var timkiem_header = $('#timkiem_header').val();
            var boloc_category_id = $('#category_id_search').val();
            var boloc_product_name = $('#product_name').val();
            var boloc_product_status = $('#product_status').val();
            var boloc_created_at = $('#boloc_created_at').val();
            var boloc_product_price_1 = $('#product_price_1').val();
            var boloc_product_price_2 = $('#product_price_2').val();
            $.ajax({
                type: 'POST',
                url: '/admin/product/product_list.php',
                data: {
                    timkiem_header: timkiem_header,
                    boloc_category_id: boloc_category_id,
                    boloc_product_name: boloc_product_name,
                    boloc_product_status: boloc_product_status,
                    boloc_created_at: boloc_created_at,
                    boloc_product_price_1: boloc_product_price_1,
                    boloc_product_price_2: boloc_product_price_2,
                    TrangHienTai: $('#TrangHienTai').val(),
                },
                dataType: 'html',
                success: function(res){
                    $('#danhsach').html(res);
                }
            });
        }
        DanhSach();

        function SanPhamChiaSe(product_id){
            $.ajax({
                type: 'POST',
                url: '/admin/product/product_public.php',
                data: {product_id: product_id},
                dataType: 'json',
                success: function(res){
                    if(res.status == 200){
                        DanhSach();
                    }else{
                        alert('Không thể thực hiện');
                    }
                }
            });
        }
        function postThem(){
            if($('#ma_hsx').val()==''){
                alert('Mã không được bỏ trống');
            }else if($('#ten_hsx').val()==''){
                alert('Tên hãng không được bỏ trống');
            }else{
                if($('#product_id').val()==''){
                    var formData = new FormData();
                    var product_id = $('#product_id').val();
                    var category_id = $('#cate_id').val();
                    var product_title = $('#product_title').val();
                    var product_purchase_price = $('#product_purchase_price').val();
                    var product_price = $('#product_price').val();
                    var product_discount = $('#product_discount').val();
                    var product_description = $('#product_description').val();
                    var product_amount = $('#product_amount').val();
                    var product_public = $('#product_public').val();
                    var product_thumbnail = $('#product_thumbnail').prop('files')[0];
                    formData.append("product_id",product_id);
                    formData.append("category_id",category_id);
                    formData.append("product_title",product_title);
                    formData.append("product_purchase_price",product_purchase_price);
                    formData.append("product_price",product_price);
                    formData.append("product_discount",product_discount);
                    formData.append("product_description",product_description);
                    formData.append("product_amount",product_amount);
                    formData.append("product_public",product_public);
                    formData.append("product_thumbnail",product_thumbnail);
                    $.ajax({
                        type: 'POST',
                        url: '/admin/product/product_add.php',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(res){
                            if(res.status == 200){
                                $('.modal_them').removeClass('active_them');
                                DanhSach();
                                alert('Thêm thành công');
                            }else{
                                alert('Không thể thêm');
                            }
                        }
                    });
                }else{
                    $.ajax({
                        type: 'POST',
                        url: '/admin/category/category_update.php',
                        data: {
                            id: $('#id_hsx').val(),
                            ma: $('#ma_hsx').val(),
                            ten: $('#ten_hsx').val()
                        },
                        dataType: 'json',
                        success: function(res){
                            if(res.status == 200){
                                $('.modal_them').removeClass('active_them');
                                DanhSach();
                                alert('Cập nhật thành công');
                            }else{
                                alert('Không thể cậ nhật');
                            }
                        }
                    });
                }
            }
        }

        function getThem(){
            $('.headerthem_title').html('Thêm mới');
            $('#cate_id').val('').trigger("chosen:updated");
            $('#product_title').val('');
            $('#product_purchase_price').val('');
            $('#product_price').val('');
            $('#product_discount').val('');
            $('#product_description').val('');
            $('#product_amount').val('');
            $('#product_thumbnail').val('');
            $('.modal_them').addClass('active_them');
        }
        function Huy(){
            $('.modal_them').removeClass('active_them');
        }
        function getSua(id){
            $('.headerthem_title').html('Cập nhật');
            $.ajax({
                type: 'POST',
                url: '/admin/category/category_json.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res){
                    $('#id_hsx').val(res.id);
                    $('#ma_hsx').val(res.code);
                    $('#ten_hsx').val(res.name);
                    $('.modal_them').addClass('active_them');
                }
            });
        }
        function LayGiaTri(){
            var mang = document.getElementsByClassName('mang');
            var list = '';
            for(var i=0;i<mang.length; i++){
                if(mang[i].checked==true){
                    list += mang[i].value +",";
                }
            }
            list = list.substring(0,list.length-1)
            return list;
        }

        //Viết sự kiện cho AllCheck
        function checkall(){
            var checkall = document.getElementById('checkall');
            var mang = document.getElementsByClassName('mang');
            if(checkall.checked==true){
                for(var i=0;i<mang.length; i++){
                    mang[i].checked=true;
                }
            }else{
                for(var i=0;i<mang.length; i++){
                    mang[i].checked=false;
                }
            }
        }

        function Xoa(){
            var giatri = LayGiaTri();
            if(giatri == ''){
                alert('Vui lòng chọn dòng cần xóa');
            }else{
                var kq = confirm('Thực hiện xóa các dòng được chọn?');
                if(kq == true){
                    $.ajax({
                        type: 'POST',
                        url: '/admin/product/product_delete.php',
                        data: {
                            chuoiID: giatri
                        },
                        dataType: 'json',
                        success: function(res){
                            if(res.status == 200){
                                DanhSach();
                                alert('Xóa thành công');
                            }else{
                                alert('Không thể xóa');
                            }
                        }
                    });
                }
            }
        }
    </script>
</body>
</html>