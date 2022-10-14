<?php require './connection.php'; ?>
<?php
@$total = $_GET['price']; // echo $total;
if (isset($_GET['c'])) {
    if ($_GET['c'] == '0') {
        $couponNow = 0;
    } else {
        $couponNow = $_GET['c'];
    }
}
$userid = $_SESSION['userid'];
if (isset($_POST['Chekout'])) {
    if ($_POST['c'] == 0) {
        $q = "INSERT INTO orders(total_price,user_id,order_address, order_phone, postal_code, order_city) 
        VALUES (:total1,:user_id1,:address1,:phone1,:postal_code1,:city1)"; //  $stmt->execute();
    } else {
        $q = "INSERT INTO orders(total_price,user_id,order_address, order_phone, postal_code, order_city,coupon_id) 
        VALUES (:total1,:user_id1,:address1,:phone1,:postal_code1,:city1,:c)";
    } // INSERT INTO `orders` (`total_price`, `user_id`, `date`, `address`, `phone`, `postal_code`, `coupon_id`, `city`) VALUES (:total, '9', '2022-10-02 21:10:10.000000', 'مم', '655', '666', NULL, 'sssvv');
    $stmt = $connect->prepare($q);
    $stmt->bindParam(':user_id1', $userid);
    $stmt->bindParam(':total1', $_POST['price']);
    $stmt->bindParam(':address1', $_REQUEST['address']);
    $stmt->bindParam(':phone1', $_REQUEST['phone']);
    $stmt->bindParam(':postal_code1', $_REQUEST['postal_code']);
    $stmt->bindParam(':city1', $_REQUEST['city']);
    if ($_POST['c'] == 0) {
        echo 'Good';
    } else {
        $stmt->bindParam(':c', $_POST['c']);
    } //  $stmt->execute();
    $stmt->execute();
    $lastOrder = $connect->lastInsertId();
    $carts = $connect->query("SELECT * from cart WHERE user_id='$userid'");
    $carts = $carts->fetchAll();
    foreach ($carts as $cart) {
        $prodID = $cart['product_id'];
        $quant = $cart['quantity'];
        $prodPrice = $connect->query("SELECT * FROM products WHERE product_id='$prodID'");
        $prodPrice = $prodPrice->fetch();
        $prodPrice = $prodPrice['price'];
        $sql = $connect->query("INSERT INTO order_details (product_id , unit_price , quantity, order_id) 
        VALUES ('$prodID' ,'$prodPrice','$quant','$lastOrder')");
    }
    $emptyCart = $connect->query("DELETE FROM cart WHERE user_id='$userid'");
    header('location:order_history.php?from=checkout'); // header('Refresh:0');
}
$query = 'SELECT * from `users` where user_id=?';
$query = $connect->prepare($query);
$query->execute([$userid]);
$userNow = $query->fetch(PDO::FETCH_OBJ);
?>

<!doctype html>
<html lang="en-US">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
	<title>Cloud Masters</title>
	<link rel="shortcut icon" href="images/favicon.png">
	<link rel='stylesheet' href='../css/settings.css' type='text/css' media='all' />
	<link rel='stylesheet' href='../css/swatches-and-photos.css' type='text/css' media='all' />
	<link rel='stylesheet' href='../css/font-awesome.min.css' type='text/css' media='all' />
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Montserrat%3A400%2C700&#038;' type='text/css' media='all' />
	<link rel='stylesheet' href='../css/elegant-icon.css' type='text/css' media='all' />
	<link rel='stylesheet' href='../css/style.css' type='text/css' media='all' />
	<link rel='stylesheet' href='../css/shop.css' type='text/css' media='all' />
	<link rel='stylesheet' href='../css/magnific-popup.css' type='text/css' media='all' />
</head>

<body class="shop">
	<div class="offcanvas open">
		<div class="offcanvas-wrap">
		<div class="offcanvas-user clearfix">
			<?php if (isset($_SESSION['userid'])) { ?> 
											<a href='./profile/My-profile.php'><?php echo $user['first_name'] .
               ' ' .
               $user['last_name'];} else { ?></a>
											<a data-rel="loginModal" href="#"><i class="fa fa-user"></i> Login</a>
											<?php } ?>
			</div>
			<nav class="offcanvas-navbar">
				<ul class="offcanvas-nav">
					<li class="menu-item-has-children dropdown">
						<a href="./index.php" class="dropdown-hover">Home <span class="caret"></span></a>
					</li>
					<li class="menu-item-has-children dropdown">
						<a href="#" class="dropdown-hover">Pages <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="about-us.php">About us</a></li>
							<li><a href="contact-us.php">Contact Us</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<div id="wrapper" class="wide-wrap">
		<div class="offcanvas-overlay"></div>
		<header class="header-type-classic">
			<div class="topbar">
				<div class="container topbar-wap">
					<div class="row">
						<div class="col-sm-6">
						</div>
						<div class="col-sm-6">
						<div class="right-topbar">
								<?php if (isset($_SESSION['userid'])) { ?>
														<div class="user-wishlist">
															<a href="../views/profile/logout.php"><i class="fa fa-share-square-o"></i>Logout</a>
														</div>
													<?php } ?>
							<?php if (isAdmin()) { ?>
												<div class="user-wishlist">
													<a href="../admin/views/index.php"><i class="fa fa-cog"></i>Dashboard</a>
												</div>
											<?php } ?>
								<div class="user-login">
									<ul class="nav top-nav">
										<li class="menu-item">
											<?php if (isset($_SESSION['userid'])) { ?> 
											<a href='./profile/My-profile.php'><?php echo $user['first_name'] .
               ' ' .
               $user['last_name'];} else { ?></a>
											<a data-rel="loginModal" href="#"><i class="fa fa-user"></i> Login</a>
											<?php } ?>
											
										</li>

									</ul>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="navbar-container">
				<div class="navbar navbar-default  navbar-scroll-fixed">
					<div class="navbar-default-wrap">
						<div class="container">
							<div class="row">
								<div class="col-md-12 navbar-default-col">
									<div class="navbar-wrap">
										<div class="navbar-header">
											<button type="button" class="navbar-toggle">
												<span class="sr-only">Toggle navigation</span>
												<span class="icon-bar bar-top"></span>
												<span class="icon-bar bar-middle"></span>
												<span class="icon-bar bar-bottom"></span>
											</button>
											<a class="navbar-search-button search-icon-mobile" href="#">
												<i class="fa fa-search"></i>
											</a>
											<a class="cart-icon-mobile" href="#">
												<i class="elegant_icon_bag"></i><span>0</span>
											</a>
											<a class="navbar-brand" href="./">
												<img class="logo" alt="The DMCS" src="../images/ltrblack.png">
												<img class="logo-fixed" alt="The DMCS" src="../images/ltrblack.png">
												<img class="logo-mobile" alt="The DMCS" src="../images/ltrblack.png">
											</a>
										</div>
										<nav class="collapse navbar-collapse primary-navbar-collapse">
											<ul class="nav navbar-nav primary-nav">
												<li class="menu-item-has-children dropdown">
													<a href="./index.php" class="dropdown-hover">
														<span class="underline">Home</span> <span class="caret"></span>
													</a>
												</li>
												<li class="menu-item-has-children megamenu megamenu-fullwidth dropdown">
													<a href="shop.php" class="dropdown-hover">
														<span class="underline">Shop</span> <span class="caret"></span>
													</a>
												</li>
												<li class="menu-item-has-children megamenu megamenu-fullwidth dropdown">
													<a href="about-us.php" class="dropdown-hover">
														<span class="underline">About Us</span> <span class="caret"></span>
													</a>
												</li>
												<li class="menu-item-has-children megamenu megamenu-fullwidth dropdown">
													<a href="contact-us.php" class="dropdown-hover">
														<span class="underline">Contact Us</span> <span class="caret"></span>
													</a>
												</li>
												<?php
            if (isset($_GET['del'])) {
                if (isset($_SESSION['userid'])) {
                    $cart_id = $_GET['del'];
                    $query = $connect->prepare(
                        'DELETE  FROM `cart` Where cart_id=? '
                    );
                    $query->execute([$cart_id]);
                } else {
                    $productsInCart = $_SESSION['cartVisitor'];
                    for ($i = 0; $i < count($productsInCart); $i++) {
                        if ($productsInCart[$i][0] == $_GET['del']) {
                            unset($_SESSION['cartVisitor'][$i]);
                        }
                    }
                }
            }
            $fromDB = 0;
            $fromSS = 0;
            if (isset($_SESSION['userid'])) {
                $query = 'SELECT * from `cart`';
                $query = $connect->prepare($query);
                $query->execute();
                $productsInCart = $query->fetchAll(PDO::FETCH_OBJ);
                $fromDB = 1;
            } elseif (isset($_SESSION['cartVisitor'])) {
                $productsInCart = $_SESSION['cartVisitor'];
                $fromSS = 1;
            } else {
                $productsInCart = [];
            }
            if (empty($productsInCart)) { ?>
												<li class="navbar-minicart navbar-minicart-nav">
													<a class="minicart-link" href="#">
														<span class="minicart-icon">
															<i class="minicart-icon-svg elegant_icon_bag"></i>
															<span><?php echo count($productsInCart); ?></span>
														</span>
													</a>

													<div class="minicart">
														<div class="minicart-header no-items show">
															Your shopping bag is empty.
														</div>

														<div class="minicart-footer">
															<div class="minicart-actions clearfix">
																<a class="button" href="./shop.php">
																	<span class="text">Go to the shop</span>
																</a>
															</div>
														</div>
													</div>
												</li>


<?php } else { ?>
												<li class="navbar-minicart navbar-minicart-nav">
														<a class="minicart-link" href="#">
															<span class="minicart-icon has-item">
																<i class="minicart-icon-svg elegant_icon_bag"></i> <span><?php echo count(
                    $productsInCart
                ); ?></span>
															</span>
														</a>
														<div class="minicart" style="display:none">
															<div class="minicart-header"><?php echo count(
                   $productsInCart
               ); ?> items in the shopping cart</div>
															<div class="minicart-body">
																<?php foreach ($productsInCart as $pInCart) {

                    if ($fromDB) {
                        $query = "SELECT * from `products` WHERE product_id= '$pInCart->product_id'";
                    } else {
                        $query = "SELECT * from `products` WHERE product_id= '$pInCart[0]'";
                    }
                    $query = $connect->prepare($query);
                    $query->execute();
                    $product = $query->fetch(PDO::FETCH_OBJ);
                    ?>
																<div class="cart-product clearfix">
																	<div class="cart-product-image">
																		<a class="cart-product-img" href="#">
																			<img width="100" height="150" src="../imgs/<?php echo $product->image1; ?>" alt="Product-1"/>
																		</a>
																	</div>
																	<div class="cart-product-details">
																		<div class="cart-product-title">
																			<a href="#"><?php echo $product->product_name; ?></a>
																		</div>
																		<div class="cart-product-quantity-price">
																			<?php echo $fromDB
                       ? $pInCart->quantity
                       : $pInCart[1]; ?> x <span class="amount">&#36;<?php echo $product->price; ?></span>
																		</div>
																	</div>
																	<a href="?del=<?php echo $fromDB
                     ? $pInCart->cart_id
                     : $pInCart[0]; ?>" class="remove" title="Remove this item">&times;</a>
																</div>
																<?php
                } ?>
															</div>
															<div class="minicart-footer">
																<div class="minicart-actions clearfix">
																	<a class="checkout-button button" href="./cart.php">
																		<span class="text">View Cart</span>
																	</a>
																</div>
															</div>
														</div>
													</li>
<?php }
            ?>
												<!-- cart and boxes -->
											</ul>

											<!--desktop nav end -->
										</nav>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- search open box -->
					<div class="header-search-overlay hide">
						<div class="container">
							<div class="header-search-overlay-wrap">
								<!-- search form -->
								<button type="button" class="close">
									<span aria-hidden="true" class="fa fa-times"></span>
									<span class="sr-only">Close</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php
$curUserId = $_SESSION['userid'];
$cart = $connect->query(
    "SELECT * FROM cart JOIN products ON cart.product_id=products.product_id WHERE cart.user_id='$curUserId'"
);
$cart = $cart->fetchAll();
if ($_GET['c'] != '0') {
    $idCoupon = $_GET['c'];
    $coupuns = $connect->query(
        "SELECT * FROM coupons WHERE coupon_id='$idCoupon'"
    );
    $coupon = $coupuns->fetch();
    $couponDiscount = $coupon['discount'];
} else {
    $couponDiscount = 0;
}
?>

               <div class="heading-container">
				<div class="container heading-standar">
					<div class="page-breadcrumb">
						<ul class="breadcrumb">
							<li><span><a href="/views/profile.php" class="home"><span>Cart</span></a></span></li>
							<li><span>Checkout</span></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="content-container">
				<div class="container">
					<div class="row">
						<div class="col-md-5 main-wrap">
							<div class="main-content">
								<div class="shop">
                                <h2>ORDER INFORMATION</h2>
									<form method="post" action="checkout.php">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div>
                                            <p class="form-control-wrap your-name">
                                                <LAbel> Full Name </LAbel>
                                                <input type="text" name="address" value="<?php echo $userNow->first_name .
                                                    ' ' .
                                                    $userNow->last_name; ?>" size="40"  class="form-control text validates-as-required"/>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                    <div>
                                            <p class="form-control-wrap your-name">
                                            <LAbel>Phone </LAbel>
                                                <input type="text" name="phone" value="<?php echo $userNow->phone; ?>" size="40" class="form-control text validates-as-required"/>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                <div>
                                            <p class="form-control-wrap your-name">
                                            <LAbel>Address </LAbel>
                                                <input type="text" name="address" value="<?php echo $userNow->address; ?>" size="40" class="form-control text validates-as-required"/>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                <div>
                                            <p class="form-control-wrap your-name">
                                            <LAbel>City </LAbel>
                                                <input type="text" name="city" value="<?php echo $userNow->city; ?>" size="40" class="form-control text validates-as-required"/>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div>

                                            <p class="form-control-wrap your-name">
                                            <LAbel>Postal Code </LAbel>
                                            <input type="hidden" name="price" value="<?php echo $couponDiscount
                                                ? $_GET['price'] -
                                                    $_GET['price'] *
                                                        ($couponDiscount / 100)
                                                : $_GET[
                                                    'price'
                                                ]; ?>" size="40" class="form-control text validates-as-required"/>
                                            <input type="hidden" name="c" value="<?php echo $couponNow; ?>" size="40" class="form-control text validates-as-required"/>
                                                <input type="text" name="postal_code" value="" size="40" class="form-control text validates-as-required"/>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                                <input type="submit" name="Chekout" value="Checkout"  class="form-control submit" />
                                </form>
					            </div>
								</div>
							</div>
                            <link rel="stylesheet" href="checkout.css">
                            <div class="col-md-1"></div>
                            <div class="col-md-6">
                            <section class="woocommerce-order-details">
                                <h2 class="woocommerce-order-details__title">Order details</h2>
                                    <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">
                                    <thead>
                                        <tr>
                                        <th class="woocommerce-table__product-table product-total" style="text-align:left">Product Name</th>
                                        <th class="woocommerce-table__product-table product-total">Unit Price</th>
                                        <th class="woocommerce-table__product-table product-total">Quantity</th>
                                        <th class="woocommerce-table__product-table product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cart as $c) { ?>

                                        <tr class="woocommerce-table__line-item order_item">
                                        <td class="woocommerce-table__product-name product-name" style="text-align:left">
                                            <?php echo $c[
                                                'product_name'
                                            ]; ?></td>
                                            <td><strong class="product-quantity"><?php echo $c[
                                                'price'
                                            ]; ?></strong></td>
                                            <td><strong class="product-quantity"><?php echo $c[
                                                'quantity'
                                            ]; ?></strong></td>
                                        <td class="woocommerce-table__product-total product-total">
                                            <?php echo $c['price'] *
                                                $c['quantity']; ?>
                                        </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th scope="row">Subtotal:</th>
                                        <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span><?php echo $_GET[
                                            'price'
                                        ]; ?></span>
                                        </td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Discount :</th>
                                        <td><?php echo $couponDiscount
                                            ? $couponDiscount
                                            : 0; ?>%</td>
                                        </tr>
                                        <tr>
                                        <th scope="row">Total:</th>
                                        <td><?php echo $couponDiscount
                                            ? $_GET['price'] -
                                                $_GET['price'] *
                                                    ($couponDiscount / 100)
                                            : $_GET['price']; ?>
                                        </td>
                                        </tr>
                                    </tfoot>
                                    </table>
                                </section>
                            </div>
						</div>
					</div>
				</div>
			</div>
<?php require_once 'footer.php'; ?>

