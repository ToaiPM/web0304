<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/public/img/icon/link_icon.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="/public/css/grid.css">
    <link rel="stylesheet" href="/public/css/frontend.css">
    <link rel="stylesheet" href="/public/css/all.min.css">

    <link rel="stylesheet" href="/public/css/cart.css">
    <script src="/public/js/jquery.min.js"></script>
    
    <title>Giỏ hàng</title>
</head>
<body>
    <!-- Thanh menu -->
    <?php include_once __SITE_PATH . '/frontend/layouts/header.php'; ?>


    <!--Danh sách sản phẩm -->
    <div class="sanpham_gr">
        <div class="grid wide" id="danhsach"></div>
    </div>

    <!-- Footer -->
    <?php include_once __SITE_PATH . '/frontend/layouts/footer.php'; ?>
    <script>
        function DanhSach(){
            $.ajax({
                type: 'POST',
                url: '/frontend/cart/cart_list.php',
                data: {},
                dataType: 'html',
                success: function(kq){
                    $('#danhsach').html(kq)
                }
            });
        }
        DanhSach();

        function XoaTrongGiohang(idSanPham){
            $.ajax({
                type:'POST',
                url: '/frontend/cart/cart_delete.php',
                data: {
                    idSanPham: idSanPham
                },
                dataType: 'json',
                success: function(res){
                    if(res.status==200){
                        $('#thongbao_giohang').html(res.soluong_tong)
                        DanhSach();
                        alert('Xóa thành công');
                    }else{
                        alert('Không thể xóa');
                    }
                }
            });
        }

        function CapNhatGioHang(action,idSanPham){
            $.ajax({
                type: 'POST',
                url: '/frontend/cart/cart_update.php',
                data: {
                    action: action,
                    idSanPham: idSanPham,
                    sl: $('#soluong_'+idSanPham).val()
                },
                dataType: 'json',
                success: function(res){
                    if(res.status==200){
                        $('#thongbao_giohang').html(res.soluong_tong)
                        DanhSach();
                    }else{
                        alert('Không thể cập nhật');
                    }
                }
            });
        }
    </script>
</body>
</html>