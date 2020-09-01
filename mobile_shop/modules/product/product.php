<!--	List Product	-->
<?php
if (isset($_GET['prd_id'])) {
    $prd_id = $_GET['prd_id'];
    $sql = "SELECT * FROM product WHERE prd_id = $prd_id";
    $product = mysqli_fetch_array(mysqli_query($conn, $sql));

    // POST COMMENT ==============================
    if (isset($_POST["sbm"])) {
        $comm_name = $_POST['comm_name'];
        $comm_mail = $_POST['comm_mail'];
        date_default_timezone_set('asia/Ho_Chi_Minh');
        $comm_date = date("Y-m-d H:i:s");
        $comm_details = $_POST['comm_details'];

        $sql = "INSERT INTO comment (comm_name,comm_mail,comm_date,comm_details,prd_id) 
        VALUES ('$comm_name','$comm_mail','$comm_date','$comm_details','$prd_id')";
        mysqli_query($conn, $sql);
    }

    // POST RATE
    if (isset($_POST['rate_sbm'])) {
        $rate_mail = $_POST['rate_mail'];
        $rate_name = $_POST['rate_name'];
        $rate_star = $_POST['rate_star'];
        $rate_cmt = $_POST['rate_cmt'];
        date_default_timezone_set('asia/Ho_Chi_Minh');
        $rate_time = date("Y-m-d H:i:s");

        $sql = "INSERT INTO rate (rate_name,rate_mail,rate_star,rate_cmt,prd_id,rate_time) 
        VALUES ('$rate_name','$rate_mail',$rate_star,'$rate_cmt','$prd_id','$rate_time')";
        mysqli_query($conn, $sql);
    }

    // GET RATE 
    $sql = "SELECT * FROM rate";
    $query = mysqli_query($conn, $sql);
    $total = mysqli_num_rows($query);
    $total_1_star = 0;
    $total_2_star = 0;
    $total_3_star = 0;
    $total_4_star = 0;
    $total_5_star = 0;
    if ($total === 0) $total_rate_tb = 0;
    else {
        $total_rate = 0;
        while ($rate = mysqli_fetch_array($query)) {
            $total_rate += (int)($rate['rate_star']);
            if ($rate['rate_star'] == 1) $total_1_star += 1;
            if ($rate['rate_star'] == 2) $total_2_star += 1;
            if ($rate['rate_star'] == 3) $total_3_star += 1;
            if ($rate['rate_star'] == 4) $total_4_star += 1;
            if ($rate['rate_star'] == 5) $total_5_star += 1;
        }
        $total_rate_tb = round($total_rate / $total, 2);
        $total_5_star_tb = ($total_5_star/$total)*100;
        $total_4_star_tb = ($total_4_star/$total)*100;
        $total_3_star_tb = ($total_3_star/$total)*100;
        $total_2_star_tb = ($total_2_star/$total)*100;
        $total_1_star_tb = ($total_1_star/$total)*100;
    }
}
?>
<div id="product">
    <div id="product-head" class="row">
        <div id="product-img" class="col-lg-6 col-md-6 col-sm-12">
            <img src="admin/img/products/<?php echo $product['prd_image'] ?>">
        </div>
        <div id="product-details" class="col-lg-6 col-md-6 col-sm-12">
            <h1><?php echo $product['prd_name'] ?></h1>
            <ul>
                <li><span>Bảo hành:</span> <?php echo $product['prd_warranty'] ?></li>
                <li><span>Đi kèm:</span> <?php echo $product['prd_accessories'] ?></li>
                <li><span>Tình trạng:</span> <?php echo $product['prd_new'] ?></li>
                <li><span>Khuyến Mại:</span> <?php echo $product['prd_promotion'] ?></li>
                <li id="price">Giá Bán (chưa bao gồm VAT)</li>
                <li id="price-number"><?php echo number_format($product['prd_price'], 2, ',', '.') ?>đ</li>
                <li id="status"><?php echo $product['prd_status'] == 1 ? "Còn hàng" : "Hết hàng"  ?></li>
            </ul>
            <div id="add-cart"><a href="modules/cart/cart_add.php?prd_id=<?php echo $prd_id ?>">Mua ngay</a></div>
        </div>
    </div>
    <div id="product-body" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Đánh giá về <?php echo $product['prd_name'] ?></h3>
            <?php echo $product['prd_details'] ?>
        </div>
    </div>

    <!-- RATE BOX -->
    <h3 class="rate-box-header"><?php echo $total?> đánh giá về <?php echo $product['prd_name'] ?></h3>
    <div id="rate-box" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 rate-info">
            <div class="rate-info-tb">
                <div class="rate-info-tb-header">SAO TRUNG BÌNH</div>
                <div class="rate-info-tb-number"><span><?php echo $total_rate_tb ?></span><i class="fa fa-star"></i></div>
            </div>
            <div class="rate-info-all">
                <div class="rate-info-all-item">
                    <div class="item-star"><span>5</span><i class="fa fa-star"></i></div>
                    <div class="item-bar"><div class="item-bar-red" style="width:<?php echo $total_5_star_tb ?>%"></div></div>
                    <div class="item-number"><?php echo $total_5_star ?> đánh giá</div>
                </div>
                <div class="rate-info-all-item">
                    <div class="item-star"><span>4</span><i class="fa fa-star"></i></div>
                    <div class="item-bar"><div class="item-bar-red" style="width:<?php echo $total_4_star_tb ?>%"></div></div>
                    <div class="item-number"><?php echo $total_4_star ?> đánh giá</div>
                </div>
                <div class="rate-info-all-item">
                    <div class="item-star"><span>3</span><i class="fa fa-star"></i></div>
                    <div class="item-bar"><div class="item-bar-red" style="width:<?php echo $total_3_star_tb ?>%"></div></div>
                    <div class="item-number"><?php echo $total_3_star ?> đánh giá</div>
                </div>
                <div class="rate-info-all-item">
                    <div class="item-star"><span>2</span><i class="fa fa-star"></i></div>
                    <div class="item-bar"><div class="item-bar-red" style="width:<?php echo $total_2_star_tb ?>%"></div></div>
                    <div class="item-number"><?php echo $total_2_star ?> đánh giá</div>
                </div>
                <div class="rate-info-all-item">
                    <div class="item-star"><span>1</span><i class="fa fa-star"></i></div>
                    <div class="item-bar"><div class="item-bar-red" style="width:<?php echo $total_1_star_tb ?>%"></div></div>
                    <div class="item-number"><?php echo $total_1_star ?> đánh giá</div>
                </div>
            </div>
            <div class="rate-info-btn btn btn-danger">
                Gửi đánh giá của bạn
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 rate-for-user">
            <form method="post">
                <div class="rate-star">
                    <div class="rate-star-header">Vui lòng chọn đánh giá</div>
                    <div id="stars">
                        <i class="fa fa-star-o star"></i>
                        <i class="fa fa-star-o star"></i>
                        <i class="fa fa-star-o star"></i>
                        <i class="fa fa-star-o star"></i>
                        <i class="fa fa-star-o star"></i>
                    </div>
                </div>
                <input type="text" id="rate-star" name="rate_star" value="0" hidden>
                <div class="rate-user">
                    <div class="form-group rate-detail">
                        <label>Nội dung:</label>
                        <textarea name="rate_cmt" required rows="8" class="form-control"></textarea>
                    </div>
                    <div class="rate-user-info">
                        <div class="form-group">
                            <label>Tên:</label>
                            <input name="rate_name" required type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input name="rate_mail" required type="email" class="form-control" id="pwd">
                        </div>
                        <button type="submit" name="rate_sbm" class="btn btn-danger">Gửi đánh giá</button>
                    </div>
                </div>


            </form>
        </div>
    </div>
    <!-- END RATE BOX -->

    <!-- list user rate -->
    <div id="rate-list" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 rate-list-col">
            <?php
            $sql = "SELECT * FROM rate";
            $query = mysqli_query($conn, $sql);
            while ($rate = mysqli_fetch_array($query)) { ?>
                <div class="rate-list-item">
                    <div class="rate-list-item-username"><?php echo $rate['rate_name'] ?> <span> || <?php echo $rate['rate_time'] ?></span></div>
                    <div class="rate-list-item-rate">
                        <span>
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $rate['rate_star']) { ?>
                                    <i class="fa fa-star star"></i>
                                <?php } else { ?>
                                    <i class="fa fa-star-o star"></i>
                            <?php }
                            } ?>
                            <!-- <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star-o star"></i>
                            <i class="fa fa-star-o star"></i> -->
                        </span>
                        <span><?php echo $rate['rate_cmt'] ?></span>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
    <!-- end list user rate -->

    <!--	Comment	-->
    <div id="comment" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h3>Bình luận sản phẩm</h3>
            <form method="post">
                <div class="form-group">
                    <label>Tên:</label>
                    <input name="comm_name" required type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input name="comm_mail" required type="email" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <label>Nội dung:</label>
                    <textarea name="comm_details" required rows="8" class="form-control"></textarea>
                </div>
                <button type="submit" name="sbm" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>
    <!-- </div> -->
    <!--	End Comment	-->

    <!--	Comments List	-->
    <div id="comments-list" class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php
            if (isset($prd_id)) {
                $sql = "SELECT * FROM comment WHERE prd_id = $prd_id ORDER BY comm_id DESC";
                $query = mysqli_query($conn, $sql);
                while ($comment = mysqli_fetch_array($query)) { ?>
                    <div class="comment-item">
                        <ul>
                            <li><b><?php echo $comment['comm_name'] ?></b></li>
                            <li><?php echo $comment['comm_date'] ?></li>
                            <li>
                                <p><?php echo $comment['comm_details'] ?></p>
                            </li>
                        </ul>
                    </div>
            <?php }
            }
            ?>
        </div>
    </div>
</div>

<!--	End Product	-->
<div id="pagination">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Trang trước</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Trang sau</a></li>
    </ul>
</div>

<script>
    // toggle form rate
    const formRate = document.querySelector('.rate-for-user')
    const buttonToggle = document.querySelector('.rate-info-btn')
    buttonToggle.addEventListener('click', () => {
        formRate.classList.toggle('active');
        if (formRate.classList.contains('active'))
            buttonToggle.textContent = "Đóng";
        else buttonToggle.textContent = "Gửi đánh giá của bạn"
    })


    let rateValue = document.getElementById('rate-star');
    let index = -1;
    let stars = document.getElementById('stars').children;
    for (let i = 0; i < stars.length; i++) {
        stars[i].addEventListener('mouseover', () => {
            for (let j = 0; j < stars.length; j++) {
                stars[j].classList.remove("fa-star");
                stars[j].classList.add("fa-star-o");
            }
            for (let j = 0; j <= i; j++) {
                stars[j].classList.remove("fa-star-o");
                stars[j].classList.add("fa-star");
            }
        })

        // add event click
        stars[i].addEventListener('click', () => {
            rateValue.value = i + 1;
            index = i;
            // for (let j = 0; j <= i; j++) {
            //     stars[j].classList.remove("fa-star-o");
            //     stars[j].classList.add("fa-star");
            // }
        })

        // mouseout
        stars[i].addEventListener('mouseout', () => {
            for (let j = 0; j < stars.length; j++) {
                stars[j].classList.remove("fa-star");
                stars[j].classList.add("fa-star-o");
            }
            for (let j = 0; j <= index; j++) {
                stars[j].classList.remove("fa-star-o");
                stars[j].classList.add("fa-star");
            }
        })
    }
</script>