<?php
//require_once 'connection.php';
?>
<?php require 'header.php'; ?>

<!-- //////////////////////////////////////////////////// -->

<!-- banner -->
<div class="heading-container heading-resize heading-button">
    <div class="heading-background heading-parallax bg-4" style="background-image:url(../imgs/h2.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-wrap">
                        <div class="page-title">
                            <h1></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$catId = 0;
if (isset($_GET['catName'])) {
    $catId = $_GET['catName'];
}
?>


<!-- fillter -->
<?php
if (isset($_POST['filter'])) {
    $min_price = $_POST['min_price'];
    $max_price = $_POST['max_price'];
    $query =
        'SELECT * from `products` where products.price >= ? and products.price <= ? ';
    $query = $connect->prepare($query);
    $query->execute([$min_price, $max_price]);
    $products = $query->fetchAll(PDO::FETCH_OBJ); // print_r($products);
} else {
    $query = 'SELECT * from `products`';
    $query = $connect->prepare($query);
    $query->execute();
    $products = $query->fetchAll(PDO::FETCH_OBJ); // print_r($products);
}
$query = 'SELECT * from categories';
$query = $connect->prepare($query);
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_OBJ);

// print_r($categories);
?>


<div class="content-container">
    <div class="container">
        <div class="row">
            <div class="col-md-3 sidebar-wrap">
                <div class="main-sidebar">
                    <div class="widget shop widget_price_filter">
                        <div style="margin-bottom:20px">
                            <input type="text" name="search" id="searchP" placeholder="Search..." style="width: 100%;
                                                                                                        height: 43px;
                                                                                                        border-radius: 15px;
                                                                                                        padding: 15px;
                                                                                                        font-size: 20px;
                                                                                                        border: 1px solid #0075ff;
                                                                                                        box-shadow: inset 0px 0px 1px 1px #0075ff;">
                        </div>
                    <div>

                    </div>
                        <h4 class="widget-title"><span>Price</span></h4>
                        <!-- <form method="post" action="shop.php">
                            <div class="price_slider_wrapper">
                                <div class="price_slider"></div>
                                <div class="price_slider_amount">
                                    <input type="range" id="min_price" name="min_price" data-min="10" placeholder="Min price" />
                                    <input type="range" id="max_price" name="max_price" data-max="100" placeholder="Max price" />
                                    <button type="submit" name="filter" class="button">Filter</button>
                                    <div class="price_label">
                                        Price: <span class="from"></span> &mdash; <span class="to"></span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </form> -->
                        <div>
                            <input type="range" id="minPrice" name="min_price" data-min="0" value="0" placeholder="Min price" />
                            <span id="spanMin">Min Price : 0</span>
                            <input type="range" id="maxPrice" name="max_price" data-max="1000" value="1000" placeholder="Max price" /> 
                            <span id="spanMax">Max Price : 1000</span>       
                        </div>

                    </div>

                    <div class="widget shop widget_products">
                        <h4 class="widget-title"><span>Best Sellers</span></h4>
                        <ul class="product_list_widget">
                        <?php
                        $products = $connect->query(
                            'SELECT * FROM products ORDER BY RAND() LIMIT 5'
                        );
                        while (
                            $product = $products->fetch(PDO::FETCH_ASSOC)
                        ) { ?>
                            <li>
                                <a href="./product_page.php?prod_id=<?php echo $product[
                                    'product_id'
                                ]; ?>" title="Donec tincidunt justo">
                                    <img width="100" height="150" src="../imgs/<?php echo $product[
                                        'image1'
                                    ]; ?>" alt="Product-13" />
                                    <span class="product-title"><?php echo $product[
                                        'product_name'
                                    ]; ?></span>
                                </a>
                                <span class="amount"><?php echo $product[
                                    'price'
                                ]; ?> JOD</span>
                                <!-- <ins><span class="amount">&#36;19.00</span></ins> -->
                            </li>
                            <?php }
                        ?>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-md-9 main-wrap" main-wrap class="main-content  " >
                <div data-itemselector=".product.infinite-scroll-item" data-layout="masonry" data-paginate="infinite_scroll" data-masonry-column="3" class="shop products-masonry  infinite-scroll masonry">
                    <div class="masonry-filter">
                        <div class="filter-action filter-action-center">
                            <?php if (isset($_GET['category'])) {
                                $cutCategory = $_GET['category']; ?> 
                            
                            <ul data-filter-key="filter">
                                <li>
                                    <!-- <a class="selected" href="./shop.php" data-filter-value="*">All</a> -->
                                    <a class="filterCat" data-filter-value="*" id='id0'>All</a>
                                </li>
                                <?php foreach ($categories as $categorie) { ?>

                                    <li>
                                        <a class="<?php if (
                                            $cutCategory ==
                                            $categorie->category_id
                                        ) {
                                            echo 'selected ';
                                        } ?>filterCat" id="id<?php echo $categorie->category_id; ?>" data-filter-value=".<?php echo trim(
    $categorie->category_name
); ?>"><?php echo ucfirst($categorie->category_name); ?></a>
                                    </li>
                                    <script>
                                        // console.log(document.querySelector(".selected"));
                                        window.onload = function() {
                                            document.querySelector(".selected").click();
                                        }
                                    </script>
                                <?php } ?>

                            </ul>

                            <?php
                            } else {
                                 ?>
                            <ul data-filter-key="filter">
                                <li>
                                    <!-- <a class="selected" href="./shop.php" data-filter-value="*">All</a> -->
                                    <a class="selected filterCat" data-filter-value="*" id='id0' style="cursor:pointer">All</a>
                                </li>
                                <?php foreach ($categories as $categorie) { ?>

                                    <li>
                                        <a class="filterCat" id="id<?php echo $categorie->category_id; ?>" style="cursor:pointer" data-filter-value=".<?php echo trim(
    $categorie->category_name
); ?>"><?php echo ucfirst($categorie->category_name); ?></a>
                                    </li>
                                    <script>
                                        console.log(document.querySelector(".selected"));
                                        window.onload = function() {
                                            document.querySelector(".selected").click();
                                        }
                                    </script>
                                <?php } ?>

                            </ul>
                            <?php
                            } ?>
                        </div>
                    </div>



                    <div class="products-masonry-wrap" id="wrapProducts">

                        <ul class="products masonry-products row masonry-wrap">
                            <?php foreach ($products as $product) {
                                foreach ($categories as $categorie) {
                                    if (
                                        $product->category_id ==
                                        $categorie->category_id
                                    ) {
                                        break;
                                    }
                                } ?>
                                <li class="product masonry-item col-md-3 col-sm-6 <?php echo trim(
                                    $categorie->category_name
                                ); ?>">
                                    <div class="product-container">
                                        <figure>
                                            <div class="product-wrap">
                                                <div class="product-images">
                                                    <div class="shop-loop-thumbnail">
                                                        <img width="300px" height="350px" src="../imgs/<?php echo $product->image1; ?>" alt="Product" />
                                                    </div>
                                                    <!-- <div class="yith-wcwl-add-to-wishlist">
																<div class="yith-wcwl-add-button">
																	<a href="#" class="add_to_wishlist">
																		Add to Wishlist
																	</a>
																</div>
															</div> -->
                                                    <div class="clear"></div>
                                                    <div class="shop-loop-quickview">
                                                        <a href="#" data-rel="quickViewModal"><i class="fa fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <figcaption>
                                                <div class="shop-loop-product-info">
                                                    <div class="info-title">
                                                        <h3 class="product_title"><a href="./product_page.php?prod_id=<?php echo $product->product_id; ?>"><?php echo $product->product_name; ?></a></h3>
                                                    </div>
                                                    <div class="info-meta">
                                                        <div class="info-price">
                                                            <span class="price">
                                                                <span class="amount"><?php echo $product->price; ?> JOD</span>
                                                            </span>
                                                        </div>
                                                        <div class="loop-add-to-cart">
                                                            <a href="./add_to_cart.php?ad=<?php echo $product->product_id; ?>&from=shop">Add To Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </li>

                            <?php
                            } ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    document.body.classList.add("shop", "page-layout-left-sidebar");

    let categ=document.getElementsByClassName("filterCat");
    let curCateg=document.querySelector(".selected");
    let curCat = (curCateg.id).slice(2);
    let leftPrice=document.getElementById("minPrice");
    let rightPrice=document.getElementById("maxPrice");
    let searchInput=document.getElementById("searchP");
    // console.log(curCat);

    [...categ].forEach(element => {
        element.addEventListener('click', function(e) {
            curCat=(element.id).slice(2);
            // console.log(curCat);
            // console.log(leftPrice.value);
            // console.log(rightPrice.value);
            fetch('filterPrice.php', {
            method: 'POST', // or 'PUT'
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded', 
            },
            body: `min=${leftPrice.value*10}&max=${rightPrice.value*10}&cat=${curCat}&s=${searchInput.value}`,
            })
            .then((response) => {
                response.text().then(res=>{
                    // console.log(res);
                    document.getElementById("wrapProducts").innerHTML = res;
                });
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        })
    });

    

    leftPrice.addEventListener("input", function() {
        document.getElementById("spanMin").innerHTML=`Min Price : ${leftPrice.value*10}`;
        fetch('filterPrice.php', {
            method: 'POST', // or 'PUT'
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded', 
            },
            body: `min=${leftPrice.value*10}&max=${rightPrice.value*10}&cat=${curCat}&s=${searchInput.value}`,
            })
            .then((response) => {
                response.text().then(res=>{
                    // console.log(res);
                    document.getElementById("wrapProducts").innerHTML = res;
                });
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }, false);

    rightPrice.addEventListener("input", function() {
        // let maxP=rightPrice.value*10;
        document.getElementById("spanMax").innerHTML=`Max Price : ${rightPrice.value*10}`;
        // console.log(rightPrice.value);
        fetch('filterPrice.php', {
            method: 'POST', // or 'PUT'
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded', 
            },
            body: `min=${leftPrice.value*10}&max=${rightPrice.value*10}&cat=${curCat}&s=${searchInput.value}`,
            })
            .then((response) => {
                response.text().then(res=>{
                    // console.log(res);
                    document.getElementById("wrapProducts").innerHTML = res;
                });
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }, false); 

    searchInput.addEventListener('input' , function() {
        console.log(searchInput.value);
        fetch('filterPrice.php', {
            method: 'POST', // or 'PUT'
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded', 
            },
            body: `min=${leftPrice.value*10}&max=${rightPrice.value*10}&cat=${curCat}&s=${searchInput.value}`,
            })
            .then((response) => {
                response.text().then(res=>{
                    // console.log(res);
                    document.getElementById("wrapProducts").innerHTML = res;
                });
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    },false);

</script>

<script>
	
	</script>

<?php require 'footer.php'; ?>
