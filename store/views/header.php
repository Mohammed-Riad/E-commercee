<?php require 'connection.php'; ?>
<!doctype html>
<html lang="en-US">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
	<title>Cloud Masters</title>
	<link rel="shortcut icon" href="../images/favicon.png">
	<link rel='stylesheet' href='../css/settings.css' type='text/css' media='all' />
	<link rel='stylesheet' href='../css/swatches-and-photos.css' type='text/css' media='all' />
	<link rel='stylesheet' href='../css/font-awesome.min.css' type='text/css' media='all' />
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Montserrat%3A400%2C700&#038;' type='text/css' media='all' />
	<link rel='stylesheet' href='../css/elegant-icon.css' type='text/css' media='all' />
	<link rel='stylesheet' href='../css/style.css' type='text/css' media='all' />
	<link rel='stylesheet' href='../css/shop.css' type='text/css' media='all' />
	<!-- <link rel='stylesheet' href='../css/layout.css' type='text/css' media='all' /> -->
</head>

<body>
	<div class="contain"></div>
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
					<li> <a href="index.php">Home <span class="caret"></span></a></li>
			
			
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
		<header class="header-type-classic header-absolute header-transparent">
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
				<div class="navbar navbar-default  navbar-scroll-fixed" style="background-color: #1e1e1ea8;">
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
											<a class="cart-icon-mobile" href="#">
												<!-- count of cart  -->
												<i class="elegant_icon_bag"></i><span>0</span>
											</a>


											<!-- logo image  -->
											<a class="navbar-brand" href="./">
												<img class="logo" alt="The DMCS" src="../images/ltr.png">
												<img class="logo-fixed" alt="The DMCS" src="../images/ltrblack.png">
												<img class="logo-mobile" alt="The DMCS" src="../images/ltrblack.png">
											</a>
										</div>
										<nav class="collapse navbar-collapse primary-navbar-collapse">
											<ul class="nav navbar-nav primary-nav">
												<li class="menu-item-has-children dropdown">
													<a href="./index.php" class="dropdown-hover">
														<span class="underline" id="home">Home</span> </span>
													</a>

												</li>
												<li class="menu-item-has-children megamenu megamenu-fullwidth dropdown">
													<a href="shop.php" class="dropdown-hover">
														<span class="underline" id="shop">Shop</span> <span class="caret"></span>
													</a>
												</li>
												<li class="menu-item-has-children megamenu megamenu-fullwidth dropdown">
													<a href="about-us.php" class="dropdown-hover">
														<span class="underline" id="about">About Us</span> <span class="caret"></span>
													</a>
												</li>
												<li class="menu-item-has-children megamenu megamenu-fullwidth dropdown">
													<a href="contact-us.php" class="dropdown-hover">
														<span class="underline" id="contact">Contact Us</span> <span class="caret"></span>
													</a>
												</li>
												<!-- search desktop icon -->

												<!-- cart and boxes start -->
<?php
if (isset($_GET['del'])) {
    if (isset($_SESSION['userid'])) {
        $cart_id = $_GET['del'];
        $query = $connect->prepare('DELETE FROM `cart` Where cart_id=? ');
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
		<?php if (isset($_GET['err'])) {
      if ($_GET['err'] == 'login') { ?> 
				<script>
					window.onload =function() {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Invalid Email Or Password',
						})
				}
				</script>
				<?php }
      if ($_GET['err'] == 'signup') { ?> 
					<script>
						window.onload =function() {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Invalid Information , Please Insert Correct Info',
							})
					}
					</script>
				<?php }
  }
?>
