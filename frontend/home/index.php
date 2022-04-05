<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/public/img/icon/link_icon.jpg" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="/public/css/all.min.css">
    <link rel="stylesheet" href="/public/css/grid.css">
    <link rel="stylesheet" href="/public/css/main.css">
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

    
</body>
</html>