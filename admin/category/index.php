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
    <link rel="stylesheet" href="/public/css/category.css">

    <script src="/public/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="/public/js/jquery.datetimepicker.js"></script>
    <script src="/public/js/chosen.jquery.js"></script>
    <title>Hãng sản xuất</title>
</head>
<body>
<?php
  if(!isset($_SESSION['user_id'])){
      header("Location: /");
  }
?>
<?php include_once __SITE_PATH . '/admin/layouts/navigation.php';  ?>
<?php include_once __SITE_PATH . '/admin/layouts/content_header.php';  ?>

<!--Danh sách sản phẩm -->
<div class="hangsanxuat_gr">
    <input type="hidden" id="TrangHienTai" value="1">
    <div class="hangsanxuat_title">HÃNG SẢN XUẤT</div>
    <div class="boloc_content">

        <table>
            <tr>
                <td class="cot_title">Mã&nbsp;</td>
                <td><input class="nhaptukhoa" type="text" id="boloc_content_ma"></td>
            </tr>
            <tr>
                <td class="cot_title">Tên hãng&nbsp;</td>
                <td><input class="nhaptukhoa" type="text" id="boloc_content_ten"></td>
            </tr>
            <tr>
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
            <span class="headerthem_title"></span>
            <span onclick="Huy()" class="headerthem_icon">[X]</span>
        </div>
        <div class="body">
            <div class="info_gr">
                <input type="hidden" id="id_hsx">
                <span class="info_label">Mã hãng</span>
                <input type="text" class="info_text" id="ma_hsx">
            </div>
            <div class="info_gr">
                <span class="info_label">Tên hãng</span>
                <input type="text" class="info_text" id="ten_hsx">
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

        function DanhSach(){
            var timkiem_header = $('#timkiem_header').val();
            var boloc_content_ma = $('#boloc_content_ma').val();
            var boloc_content_ten = $('#boloc_content_ten').val();
            $.ajax({
                type: 'POST',
                url: '/admin/category/category_list.php',
                data: {
                    timkiem_header: timkiem_header,
                    boloc_content_ma: boloc_content_ma,
                    boloc_content_ten: boloc_content_ten,
                    tranghientai: $('#TrangHienTai').val(),
                },
                dataType: 'html',
                success: function(res){
                    $('#danhsach').html(res);
                }
            });
        }
        DanhSach();

        function postThem(){
            if($('#ma_hsx').val()==''){
                alert('Mã không được bỏ trống');
            }else if($('#ten_hsx').val()==''){
                alert('Tên hãng không được bỏ trống');
            }else{
                if($('#id_hsx').val()==''){
                    $.ajax({
                        type: 'POST',
                        url: '/admin/category/category_add.php',
                        data: {
                            ma: $('#ma_hsx').val(),
                            ten: $('#ten_hsx').val()
                        },
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
            $('#id_hsx').val('');
            $('#ma_hsx').val('');
            $('#ten_hsx').val('');
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
                        url: '/admin/category/category_delete.php',
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