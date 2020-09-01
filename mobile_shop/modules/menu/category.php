<?php
if (isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];

    // fetch product with cat_id = $cat_id
    $sql_product = "SELECT * FROM product WHERE cat_id = '$cat_id'";
    $query_product = mysqli_query($conn, $sql_product);

    // fetch cat_name
    $sql = "SELECT * FROM category WHERE cat_id = $cat_id";
    $category = mysqli_fetch_array(mysqli_query($conn, $sql));
}

?>
<!--	List Product	-->
<div class="products">
    <h3><?php echo $category['cat_name'] ?> (hiện có <?php echo mysqli_num_rows($query_product) ?> sản phẩm)</h3>
    <?php
    $count = 0;
    while ($product = mysqli_fetch_array($query_product)) {
        if ($count === 0) echo '<div class="product-list card-deck">'; ?>

        <div class="product-item card text-center">
            <a href="?page_layout=product&prd_id=<?php echo $product['prd_id'] ?>"><img src="admin/img/products/<?php echo $product['prd_image'] ?>"></a>
            <h4><a href="?page_layout=product&prd_id=<?php echo $product['prd_id'] ?>"><?php echo $product['prd_name'] ?></a></h4>
            <p>Giá Bán: <span><?php echo number_format($product['prd_price'], 2, ',', '.') ?>đ</span></p>
        </div>

    <?php
        $count++;
        if ($count === 3) {
            echo "</div>";
            $count = 0;
        };
    }
    if ($count !== 0) echo "</div>";
    ?>
</div>

<div id="pagination">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Trang trước</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Trang sau</a></li>
    </ul>
</div>