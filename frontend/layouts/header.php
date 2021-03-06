<!-- Thanh menu PC, Tablet -->
<div class="header">
    <div class="main_menu grid wide">
        <a href="/" class="home_gr">
            <img src="/public/img/icon/home_icon.png" alt="" class="home_img">
        </a>
        <ul>
            <li>
                <a href="#">Giới thiệu</a>
            </li>
            <li>
                <a href="#">Sản phẩm &nbsp;<i class="fa-solid fa-caret-down"></i></a>
                <ul class="sub_menu">
                    <li><a href="/index.php?action=sanpham/index">Tất cả</a></li>
                    <li><a onclick="DanhSach('iPhone')" href="#">iPhone</a></li>
                    <li><a onclick="DanhSach('Samsung')" href="#">Samsung</a></li>
                    <li><a onclick="DanhSach('OPPO')" href="#">OPPO</a></li>
                    <li><a onclick="DanhSach('Xiaomi')" href="#">Xiaomi</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Tin tức</a>
            </li>
            <li>
                <a href="#">Liên hệ</a>
            </li>
        </ul>
        <div class="timkiem_gr">
            <input type="text" id="TimKiem" class="timkiem_txt" placeholder="Bạn cần tìm sản phẩm nào ...">
            <button onclick="DanhSach()" class="timkiem_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <a href="/index.php?action=frontend/cart/index" class="giohang_gr">
            <i class="fa-solid fa-cart-shopping"></i>
            <span id="thongbao_giohang" class="giohang_sl">0</span>
        </a>
        <div class="nguoidung_gr">
            <span onclick="getDangNhap()" class="nguoidung_dn">Đăng nhập</span>
            <span onclick="user()" class="nguoidung_dx">
                <img class="icon_user" src="/public/img/icon/user.png" alt="">
            </span>
        </div>
    </div>
</div>
<div class="nguoidung_tt">
    <a onclick="DangXuat()" href="#">Đăng xuất</a>
    <a onclick="ThongTinCaNhan()" href="#">Thông tin cá nhân</a>
    <?php 
        if(isset($_SESSION['role_name'])){
            if($_SESSION['role_name']=='admin' || $_SESSION['role_name']=='user'){ ?>
    <a href="/index.php?action=admin/index">Vào quản trị</a>
    <?php } } ?>
</div>
<!-- Menu mobile -->
<div class="mobile_menu">
    <span onclick="BatMenuMobile()" class="bieutuong_bars"><i class="fa-solid fa-bars"></i></span>
</div>
<!-- Content mobile -->
<div class="content_mobile">
    <div class="trangchu_gr">
        <a href="/" class="trangchu_link">
            <img src="/public/img/icon/home_icon.png" width="20px" class="trangchu_img">
        </a>
        <span onclick="TatMenuMobile()" class="closed"><i class="fa-solid fa-xmark"></i></span>
    </div>
    <hr>
    <ul>
        <li><a href="#">Giới thiệu</a></li>
        <li><a href="#">Sản phẩm</a></li>
        <li><a href="#">Tin tức</a></li>
        <li><a href="#">Liên hệ</a></li>
    </ul>
    <div class="timkiem_gr">
        <input type="text" id="TimKiem_mobile" class="timkiem_txt" placeholder="Bạn cần tìm sản phẩm nào ...">
        <button onclick="DanhSach()" class="timkiem_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <a href="/index.php?action=giohang/index" class="giohang_gr">
        <i class="fa-solid fa-cart-shopping"></i>
        <span id="thongbao_giohang_mobile" class="giohang_sl">0</span>
    </a>
    <div class="nguoidung_gr">
        <span onclick="getDangNhap()" class="nguoidung_dn">Đăng nhập</span>
        <span class="nguoidung_dx">Đăng xuất</span>
    </div>
</div>
<div onclick="TatMenuMobile()" class="overlay"></div>
<!-- Modal đăng nhập -->
<div class="modal_dangnhap">
    <div class="modal_dangnhap_content">
        <div class="modal_dangnhap_header">
            <span class="modal_dangnhap_title">Đăng nhập</span>
            <img onclick="DongFormDangNhap()" src="/public/img/icon/close_dangnhap_icon.png" alt="" class="modal_dangnhap_icon">
        </div>
        <div class="modal_dangnhap_body">
            <input type="text" id="tendangnhap" class="modal_dangnhap_text" placeholder="Tên đăng nhập">
            <input type="password" id="matkhau" class="modal_dangnhap_text" placeholder="Mật khẩu">
        </div>
        <div class="modal_dangnhap_footer">
            <button onclick="postDangNhap()" class="modal_dangnhap_submit">Đăng nhập</button>
            <button onclick="DongFormDangNhap()" class="modal_dangnhap_huy">Hủy</button>
        </div>
    </div>
</div>
<!-- Thông báo thêm vào gio hàng -->
<div class="modal_cus">
    <div class="noidung">
        <div class="noidung-header">
            <span class="noidung-header_text">Thông báo</span>
        </div>
        <div class="noidung-body">
            <span class="noidung-body_thongbao"><i class="fa-solid fa-circle-check"></i> Đã thêm vào giỏ hàng</span>
            <button onclick="DongThongBao()" class="dongy">OK</button>
        </div>
    </div>
</div>
<!-- Thông tin cá nhân -->
<div class="modal_ttcn">
    <div class="ttcn_noidung">
        <div class="ttcn_header">
            <span class="ttcn_text">Thông tin cá nhân</span>
        </div>
        <div class="ttcn_body">
            <div class="ttcn_body_group">
                <label class="text_tite" for="hovaten">Họ và tên:</label>
                <input type="text" class="input_title" id="hovaten">
            </div>
            <div class="ttcn_body_group">
                <label class="text_tite" for="tendangnhap">Tên đăng nhập:</label>
                <input type="text" class="input_title" id="tendangnhap">
            </div>
            <div class="ttcn_body_group">
                <label class="text_tite" for="email">Email:</label>
                <input type="text" class="input_title" id="email">
            </div>
            <div class="ttcn_body_group">
                <label class="text_tite" for="dienthoai">Điện thoại:</label>
                <input type="text" class="input_title" id="dienthoai">
            </div>
            <div class="ttcn_body_group">
                <label class="text_tite" for="diachi">Địa chỉ:</label>
                <textarea type="text" class="input_title" id="diachi"></textarea>
            </div>
        </div>
    </div>
</div>
<script>
    function ThongBaoTrangThai(){
        var soluong = '<?php echo isset($_SESSION["soluong_tong"]) ? $_SESSION["soluong_tong"] : 0; ?>';
        var idnguoidung = '<?php echo isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 0; ?>';
        if(idnguoidung!=0){
            $('.nguoidung_dn').css('display','none');
            $('.nguoidung_dx').css('display','block');
        }else{
            $('.nguoidung_dn').css('display','block');
            $('.nguoidung_dx').css('display','none');
        }
        $('#thongbao_giohang').html(soluong)
        $('#thongbao_giohang_mobile').html(soluong)
    }
    ThongBaoTrangThai();

    function getDangNhap(){
        $('#tendangnhap').val('');
        $('#matkhau').val('');
        $('.modal_dangnhap').addClass('active_modal_dangnhap');
    }

    function DongFormDangNhap(){
        $('.modal_dangnhap').removeClass('active_modal_dangnhap');
    }

    function postDangNhap(){
        $.ajax({
            type: 'POST',
            url: '/admin/authen/authen_login.php',
            data: {
                tendangnhap: $('#tendangnhap').val(),
                matkhau: $('#matkhau').val()
            },
            dataType: 'json',
            success: function(res){
                if(res.status == 200){
                    $('.nguoidung_dn').css('display','none');
                    $('.nguoidung_dx').css('display','block');
                    $('.modal_dangnhap').css('display','none');
                    if(res.role_name == 'admin' || res.role_name == 'user'){
                        window.location="/index.php?action=admin/index";
                    }  
                }else{
                    alert('Đăng nhập thất bại');
                }
            }
        });
    }

    function DangXuat(){
        $.ajax({
            type: 'POST',
            url: '/admin/authen/authen_logout.php',
            data: {},
            dataType: 'json',
            success: function(res){
                if(res.status == 200){
                    $('.nguoidung_dn').css('display','block');
                    $('.nguoidung_dx').css('display','none');
                    window.location="/";
                }
            }
        })
    }
    function DongThongBao(){
        $('.modal_cus').css('display','none');
    }

    function BatMenuMobile(){
        $('.content_mobile').addClass('hienthi_content_mobile');
        $('.overlay').addClass('hien_overlay');
    }
    function TatMenuMobile(){
        $('.content_mobile').removeClass('hienthi_content_mobile');
        $('.overlay').removeClass('hien_overlay');
    }
    function user(){
        $('.nguoidung_tt').toggleClass('active');
    }
    function ThongTinCaNhan(){
        $('.nguoidung_tt').toggleClass('active');
        $.ajax({
            type: 'POST',
            url: '/admin/user/user_detail.php',
            data: {},
            dataType: 'json',
            success: function(res){
                if(res.status == 200){
                    //Bật modal thông tin cá nhân
                }
            }
        });
    }
</script>