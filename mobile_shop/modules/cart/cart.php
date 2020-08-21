<!--	Cart	-->

<?php
if (isset($_SESSION['cart'])) { ?>
    <div id="my-cart">
        <div class="row">
            <div class="cart-nav-item col-lg-7 col-md-7 col-sm-12">Thông tin sản phẩm</div>
            <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Tùy chọn</div>
            <div class="cart-nav-item col-lg-3 col-md-3 col-sm-12">Giá</div>
        </div>
        <form method="post">

            <?php
            $cart = $_SESSION['cart'];
            $total_price = 0;
            $arr_prd_id = array();
            foreach ($cart as $prd_id => $count) {
                $arr_prd_id[] = $prd_id;
            };
            $query_in = implode(', ',$arr_prd_id);
            $sql = "SELECT * FROM product WHERE prd_id IN ($query_in)";
            $query = mysqli_query($conn, $sql);
            while($product = mysqli_fetch_array($query)) { 
                $total_price += (int)$product['prd_price'] * $cart[$product['prd_id']];
                ?>
                <div class="cart-item row">
                    <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                        <img src="admin/img/products/<?php echo $product['prd_image'] ?>">
                        <h4><?php echo $product['prd_name'] ?></h4>
                    </div>

                    <div class="cart-quantity col-lg-2 col-md-2 col-sm-12">
                        <input type="number" id="quantity" class="form-control form-blue quantity" value="<?php echo $cart[$product['prd_id']] ?>" min="1">
                    </div>
                    <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo number_format($product['prd_price'], 2, ',', '.') ?>đ</b><a href="#">Xóa</a></div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                    <button id="update-cart" class="btn btn-success" type="submit" name="sbm">Cập nhật giỏ hàng</button>
                </div>
                <div class="cart-total col-lg-2 col-md-2 col-sm-12"><b>Tổng cộng:</b></div>
                <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo number_format($total_price, 2, ',', '.') ?>đ</b></div>
            </div>
        </form>

    </div>
    <!--	End Cart	-->

    <!--	Customer Info	-->
    <div id="customer">
        <form method="post">
            <div class="row">

                <div id="customer-name" class="col-lg-4 col-md-4 col-sm-12">
                    <input placeholder="Họ và tên (bắt buộc)" type="text" name="name" class="form-control" required>
                </div>
                <div id="customer-phone" class="col-lg-4 col-md-4 col-sm-12">
                    <input placeholder="Số điện thoại (bắt buộc)" type="text" name="phone" class="form-control" required>
                </div>
                <div id="customer-mail" class="col-lg-4 col-md-4 col-sm-12">
                    <input placeholder="Email (bắt buộc)" type="text" name="mail" class="form-control" required>
                </div>
                <div id="customer-add" class="col-lg-12 col-md-12 col-sm-12">
                    <input placeholder="Địa chỉ nhà riêng hoặc cơ quan (bắt buộc)" type="text" name="add" class="form-control" required>
                </div>

            </div>
        </form>
        <div class="row">
            <div class="by-now col-lg-6 col-md-6 col-sm-12">
                <a href="#">
                    <b>Mua ngay</b>
                    <span>Giao hàng tận nơi siêu tốc</span>
                </a>
            </div>
            <div class="by-now col-lg-6 col-md-6 col-sm-12">
                <a href="#">
                    <b>Trả góp Online</b>
                    <span>Vui lòng call (+84) 0988 550 553</span>
                </a>
            </div>
        </div>
    </div>
    <!--	End Customer Info	-->
<?php } else { ?>
    <div class="alert alert-danger mt-4">Giỏ hàng của bạn đang trống!!!</div>
<?php } ?>

<!-- <div class="cart-item row">
            <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                <img src="images/product-5.png">
                <h4>iPhone Xs Max 2 Sim - 256GB Gold</h4>
            </div>
            <div class="cart-quantity col-lg-2 col-md-2 col-sm-12">
                <input type="number" id="quantity" class="form-control form-blue quantity" value="1" min="1">
            </div>

            <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b>32.990.000đ</b><a href="#">Xóa</a></div>
        </div>  -->