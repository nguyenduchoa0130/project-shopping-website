<?php
require_once __DIR__ . "/../autoload/autoload.php";
$data = $database->fetchDataAll("tbl_category");
?>
<div class="container-fluid">
    <div class="row">
        <!-- Menu Danh Mục -->
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 p-0" id="parent-scroll">
            <div class="container-fluid border-right-3 p-0" id="scroll">
                <ul class="list-group w-100">
                    <?php foreach ($data as $item) : ?>
                        <?php
                        $category = new Category($item);
                        ?>
                        <li class="list-group-item category-item">
                            <a href="" class="item h5 text-primary text-decoration-none d-block w-100 m-0">
                                <i class="<?php echo $category->get_ImgCategory(); ?>"></i>
                                <?php echo $category->get_NameCategory() ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!-- Menu Danh Mục -->

        <!-- Nội Dung Chính -->
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 p-0">

            <!-- Banner -->
            <div class="container-fluid p-0 ml-1 mt-1">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div id="slide-banner" class="carousel slide z-depth-1-half" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block" src="https://cdn1.npcdn.net/userfiles/21114/image/HTB1UCX2SYPpK1RjSZFFq6y5PpXaw(1).jpg" width="100%" height="300px" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block" src="https://mdbootstrap.com/img/Photos/Slides/img%20(46).jpg" width="100%" height="300px" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(47).jpg" width="100%" height="300px" alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#slide-banner" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#slide-banner" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Banner -->

            <!-- Danh Sách Sản Phẩm Bán Chạy Nhất  -->

            <div class="container-fluid p-0 ml-3 mt-1">
                <div class="container-fluid">
                    <hr class="my-2">
                    <!-- Tiêu Đề  -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-0">
                            <div style="color: #FF5733;" class="ml-3">
                                <h2>
                                    <span><i class="fas fa-fire-alt"></i></span>
                                    TOP Sản Phẩm Bán Chạy Nhất
                                </h2>
                            </div>
                        </div>
                    </div>
                    <!-- Tiêu Đề  -->
                    <hr class="my-2">
                    <!-- Sản Phẩm -->
                    <div class="row d-flex justify-content-around" id="list-10-product-sellest">
                        <?php
                        $total_record = 10;
                        $limit = 3;
                        $total_page = (ceil($total_record / $limit));
                        // try {
                        //     $data = $database->getProductSellest(0, $limit);
                        //     $render = "";
                        //     foreach ($data as $item) {
                        //         $product = new Product($item);
                        //         $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
                        //         $render .= createCardProduct($product, $imgs[0]);
                        //     }
                        //     echo $render;
                        // } catch (PDOException $e) {
                        //     echo "Có lỗi khi thao tác với database " . $e->getMessage();
                        // }
                        ?>
                    </div>
                    <!-- Sản Phẩm -->

                    <!-- Phân Trang -->
                    <div class="row d-flex justify-content-center">
                        <div class="contaienr">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item">
                                        <a class="page-link previous" tabindex="-1">&laquo;</a>
                                    </li>
                                    <?php for ($i = 0; $i < $total_page; $i++) :  ?>
                                        <li class="page-item">
                                            <a class="page-link" data-task="<?php echo "sellest" ?>" data-page="<?php echo $i + 1 ?>"> <?php echo $i + 1 ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item">
                                        <a class="page-link next" tabindex="-1">&raquo;</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Phân Trang -->
                    <hr class="my-2">
                </div>
            </div>
            <!-- Danh Sách Sản Phẩm Bán Chạy Nhất  -->

            <!-- Danh Sách Sản Phẩm Được Yêu Thích Nhất  -->
            <div class="container-fluid p-0 ml-3 mt-1">
                <div class="container-fluid">
                    <!-- Tiêu Đề  -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-0">
                            <div style="color: #CB096A;" class="ml-3">
                                <h2>
                                    <span><i class="fas fa-heart"></i></span>
                                    TOP Sản Phẩm Được Yêu Thích Nhất
                                </h2>
                            </div>
                        </div>
                    </div>
                    <!-- Tiêu Đề  -->
                    <hr class="my-2">
                    <!-- Sản Phẩm -->
                    <div class="row d-flex justify-content-around" id="list-10-product-likest">
                        <?php
                        $total_record = 10;
                        $limit = 3;
                        $total_page = (ceil($total_record / $limit));
                        try {
                            $data = $database->getProductLikest(0, $limit);
                            $render = "";
                            foreach ($data as $item) {
                                $product = new Product($item);
                                $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
                                $render .= createCardProduct($product, $imgs[0]);
                            }
                            echo $render;
                        } catch (PDOException $e) {
                            echo "Có lỗi khi thao tác với database " . $e->getMessage();
                        }
                        ?>
                    </div>
                    <!-- Sản Phẩm -->

                    <!-- Phân Trang -->
                    <div class="row d-flex justify-content-center">
                        <div class="contaienr">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item">
                                        <a class="page-link" href="#" tabindex="-1">&laquo;</a>
                                    </li>
                                    <?php for ($i = 0; $i < $total_page; $i++) :  ?>
                                        <li class="page-item">
                                            <a class="page-link" data-task="<?php echo "likest" ?>" data-page="<?php echo $i + 1 ?>"> <?php echo $i + 1 ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item">
                                        <a class="page-link" href="#">&raquo;</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Phân Trang -->
                    <hr class="my-2">
                </div>
            </div>
            <!-- Danh Sách Sản Phẩm Được Yêu Thích  -->

            <!-- Danh Sách Sản Phẩm Mới Nhất  -->
            <div class="container-fluid p-0 ml-3 mt-1">
                <div class="container-fluid">
                    <!-- Tiêu Đề  -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 p-0">
                            <div style="color: #09CB52;" class="ml-3">
                                <h2>
                                    <span><i class="fas fa-upload"></i></span>
                                    TOP Sản Phẩm Mới Nhất
                                </h2>
                            </div>
                        </div>
                    </div>
                    <!-- Tiêu Đề  -->
                    <hr class="my-2">
                    <!-- Sản Phẩm -->
                    <div class="row d-flex justify-content-around p-0 m-0" id="list-10-product-new">
                        <?php
                        $total_record = 10;
                        $limit = 3;
                        $total_page = (ceil($total_record / $limit));
                        try {
                            $data = $database->getProductNewest(0, $limit);
                            $render = "";
                            foreach ($data as $item) {
                                $product = new Product($item);
                                $imgs = $database->fetchDataById("tbl_image_product", "id_product", $product->id_product);
                                $render .= createCardProduct($product, $imgs[0]);
                            }
                            echo $render;
                        } catch (PDOException $e) {
                            echo "Có lỗi khi thao tác với database " . $e->getMessage();
                        }
                        ?>
                    </div>
                    <!-- Sản Phẩm -->

                    <!-- Phân Trang -->
                    <div class="row d-flex justify-content-center">
                        <div class="contaienr">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item">
                                        <a class="page-link" href="#" tabindex="-1">&laquo;</a>
                                    </li>
                                    <?php for ($i = 0; $i < $total_page; $i++) :  ?>
                                        <li class="page-item">
                                            <a class="page-link" data-task="<?php echo "new" ?>" data-page="<?php echo $i + 1 ?>"> <?php echo $i + 1 ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item">
                                        <a class="page-link" href="#">&raquo;</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Phân Trang -->
                    <hr class="my-2">
                </div>
            </div>
            <!-- Danh Sách Sản Phẩm Mới Nhất  -->
            <!-- Nội Dung Chính -->
        </div>
        <!-- Nội Dung Chính -->


    </div>
</div>