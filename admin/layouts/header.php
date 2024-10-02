    <?php
    session_start();
    require_once($baseUrl . '../utils/utility.php');
    require_once($baseUrl . '../database/dbhelper.php');
    $user = getUserToken();

    if ($user == null) {
        header('Location:' . $baseUrl . ' authen/login.php');
        die();
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link rel="stylesheet" type="text/css" href="<?= $baseUrl ?>/ass/css/dashboard.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <!-- Option 1: Include in HTML -->

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <!-- jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <!-- SweetAlert2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="../../assets/js/coupons.js"></script>
        <script src="../../assets/js/supplier.js"></script>
        <script src="../../assets/js/enter_coupon.js"></script>
        <script src="../../assets/js/statistics.js"></script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
        <!-- Chart -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
        </script>
        <style>
            body,
            html {
                font-family: "Space Grotesk", sans-serif;
                height: 100%;
                margin: 0;
                padding: 0;
                font-size: 16px;
            }



            main {
                flex: 1;
                padding: 20px;
                /* Thêm padding nếu cần */
            }
        </style>

    </head>

    <body>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Ban Hang </a>

            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="<?= $baseUrl ?>authen/logout.php">Thoát</a>
                </li>
            </ul>
        </nav>

        </nav>
        <div class="">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class=" sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="img-fluid  ">

                                <img src="https://i.ibb.co/SNJSj9m/00f2ce38-42bd-46a6-a699-e1f9a0b70f97.jpg" alt="Logo" style=" width: 230px; height: 180px;  margin-right: 10px; margin-bottom:20px;object-fit: cover;" class="mr-5  rounded-circle">

                                </a>
                            </li>

                            <li class="nav-item">

                                <a class="nav-item nav-link active" href="<?= $baseUrl ?>dashboard.php">
                                    <i class="bi bi-house-fill"></i>
                                    DASHBOARD
                                </a>
                            </li>

                            <?php if (checkPrivilege('category/category_index.php')) { ?>
                                <li class="nav-item">

                                <li class="nav-item">
                                    <a class="nav-item nav-link" href="<?= $baseUrl ?>category/category_index.php">
                                        <i class="bi bi-ui-checks-grid"></i>
                                        <span>Quản lý danh mục </span>
                                    </a>
                                </li>

                            <?php } ?>

                            <?php if (checkPrivilege('product/product_index.php')) { ?>
                                <li class="nav-item">
                                    <a class="nav-item nav-link" href="<?= $baseUrl ?>product/product_index.php">
                                        <i class="bi bi-handbag"></i>
                                        <span> Quản lý sản phẩm </span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if (checkPrivilege('order/order_index.php')) { ?>
                                <li class="nav-item ">
                                    <a class="nav-item nav-link" href="<?= $baseUrl ?>order/order_index.php">
                                        <i class="bi bi-journal"></i>
                                        <span> Quản lý đơn hàng </span>
                                    </a>
                                </li>


                            <?php } ?>
                            <?php if (checkPrivilege('brand_view.php')) { ?>
                                <li class="nav-item ">
                                    <a class="nav-item nav-link" href="<?= $baseUrl ?>brand/brand_index.php">
                                        <i class="bi bi-hexagon-fill"></i>
                                        <span> Quản lý nhãn hàng </span>
                                    </a>
                                </li>

                            <?php } ?>
                            <?php if (checkPrivilege('discount/index_dis.php')) { ?>
                                <li class="nav-item ">
                                    <a class="nav-item nav-link" href="<?= $baseUrl ?>discount/index_dis.php">
                                        <i class="bi bi-cash"></i>
                                        <span> Quản lý khuyến mãi </span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if (checkPrivilege('supplier/index_sup.php')) { ?>
                                <li class="nav-item ">
                                    <a class="nav-item nav-link" href="<?= $baseUrl ?>supplier/index_sup.php">
                                        <i class="bi bi-people-fill"></i>
                                        <span> Quản lý nhà cung cấp </span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if (checkPrivilege('enter_coupon/index_cou.php')) { ?>
                                <a class="nav-item nav-link" href="<?= $baseUrl ?>enter_coupon/index_cou.php">
                                    <i class="bi bi-cart-check"></i>
                                    <span> Quản lý phiếu nhập </span>
                                </a>
                                </li>
                            <?php } ?>


                            <?php if (checkPrivilege('feedback/feedback_index.php')) { ?>
                                <li class="nav-item">
                                    <a class="nav-item nav-link" href="<?= $baseUrl ?>feedback/feedback_index.php">
                                        <i class="bi bi-chat-dots"></i>
                                        <span> Quản lý phản hồi </span>
                                    </a>
                                </li>



                            <?php } ?>

                            <?php if (checkPrivilege('user_index.php')) { ?>
                                <li class="nav-item">
                                    <a class="nav-item nav-link" href="<?= $baseUrl ?>user/user_index.php">
                                        <i class="bi bi-person-circle"></i>
                                        <span> Quản lý người dùng </span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if (checkPrivilege('chart_index.php')) { ?>
                                <li class="nav-item">
                                    <a class="nav-item nav-link" href="<?= $baseUrl ?>chart/chart_index.php">
                                        <i class="bi bi-kanban"></i>
                                        <span> Thống kê</span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5 ">