<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/public/img/icon/link_icon.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="/public/css/all.min.css">
    <link rel="stylesheet" href="/public/css/grid.css">
    <link rel="stylesheet" href="/public/css/frontend.css">
    <link rel="stylesheet" href="/public/css/home.css">
    <script src="/public/js/jquery.min.js"></script>
    <title>Trang home</title>
</head>
<body>
    <!-- Thanh menu -->
    <?php include_once __SITE_PATH . '/frontend/layouts/header.php'; ?>

    <!--banner-->
    <?php include_once __SITE_PATH . '/frontend/layouts/banner.php'; ?>

    <!--Danh sách sản phẩm -->
    <div class="sanpham_gr">
        <input type="hidden" id="TrangHienTai" value="1">
        <div class="grid wide" id="danhsach"></div>
    </div>

    <!-- Footer -->
    <?php include_once __SITE_PATH . '/frontend/layouts/footer.php'; ?>
    <script>
        function DanhSach(hangsanxuat=''){
            var TimKiem = '';
            var timkiem_pc = $('#TimKiem').val();
            var timkiem_mb = $('#TimKiem_mobile').val();
            if(timkiem_pc!=''){
                TimKiem = timkiem_pc;
            }else if(timkiem_mb!=''){
                TimKiem = timkiem_mb;
            }else{
                TimKiem = '';
            }
            $.ajax({
                type: 'POST',
                url: '/frontend/home/home_list.php',
                data: {
                    TimKiem: TimKiem,
                    hangsanxuat: hangsanxuat,
                    tranghientai: $('#TrangHienTai').val()
                },
                dataType: 'html',
                success: function(kq){
                    $('#danhsach').html(kq)
                }
            });
        }
        DanhSach();
        function ThemVaoGioHang(idSanPham){
            $.ajax({
                type: 'POST',
                url: '/frontend/home/home_add_to_cart.php',
                data: {
                    idSanPham: idSanPham,
                    hinhanh: $('#hinhanh_'+idSanPham).attr('src'),
                    tendienthoai: $('#tendienthoai_'+idSanPham).html(),
                    giaban: $('#giaban_'+idSanPham).attr('val')
                },
                dataType: 'json',
                success: function(response){
                    if(response.status ==200){
                        $('#thongbao_giohang').html(response.soluong);
                        $('#thongbao_giohang_mobile').html(response.soluong);
                        $('.modal_cus').css('display','flex');
                    }else{
                        alert('Không thể thêm');
                    }
                }
            });
        }
    </script>
</body>
</html>