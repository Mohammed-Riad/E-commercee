<?php require 'header2.php'; ?>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php
$delevery = 0;
$sub = 0;

//get cart info

$fromDB = 0;
$fromSS = 0;

if (isset($_SESSION['userid'])) {
    $fromDB = 1;
    $curId = $_SESSION['userid'];
    $query = $connect->query("SELECT * from `cart` WHERE user_id='$curId'");
    $productsInCart = $query->fetchAll(PDO::FETCH_OBJ);
} else {
    $fromSS = 1;
    if (isset($_SESSION['cartVisitor'])) {
        $productsInCart = $_SESSION['cartVisitor'];
    }
}

//
if (isset($_POST['qunatity_by_js'])) {
    $query = 'UPDATE `cart` SET `quantity` = ? WHERE `cart_id` = ?';
    $query = $connect->prepare($query);
    $query->execute([intval($_POST['qunatity_by_js']), $_POST['cart_id']]);
    // print_r($qunatity);
}

//add to cart
// if (isset($_POST['update_cart'])) {

// 	// $query ="UPDATE `cart` SET `quantity` =? WHERE `cart_id` = ?";
// 	// $query = $connect->prepare($query);
// 	// $query->execute([ intval($_POST['qunatity1']),$_POST['id_c']]);

// 	// $sub=intval($_POST['qunatity1'])*intval($_POST['price']);

// }

//coupon
if (isset($_POST['apply_coupon'])) {
    $coupon = $_POST['coupon_code'];
    $query = 'SELECT * from `coupons` where coupon_name=?';
    $query = $connect->prepare($query);
    $query->execute([$coupon]);

    $coupon_saved = $query->fetch(PDO::FETCH_OBJ);
    // print_r($coupon_saved);
    if (!empty($coupon_saved)) {
        if (intval($coupon_saved->count) > 0) {
            $sub_total = isset($sub_total)
                ? $sub_total * ($coupon_saved->discount / 100)
                : 1;
            $query = 'UPDATE `coupons` SET `count` =? WHERE `coupon_id` = ?';
            $query = $connect->prepare($query);
            $coupon_saved->count -= 1;
            $query->execute([$coupon_saved->count, $coupon_saved->coupon_id]);
        } else {
            echo "<script>
			window.onload=function() {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Invalid Coupon!',
			  }) 
			} </script>";
            echo "<script>
			setTimeout(function(){
				window.location.href='cart.php';
			 }, 3000);
			</script>";
        }
    } else {
        echo "<script>
			window.onload=function() {
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Invalid Coupon!',
			  }) 
			} </script>";
        echo "<script>
			setTimeout(function(){
				window.location.href='cart.php';
			 }, 3000);
			</script>";
    }
}
?>


               <div class="heading-container">
				<div class="container heading-standar">
					<div class="page-breadcrumb">
						<ul class="breadcrumb">
							<li><span><a href="/views/index.php" class="home"><span>Home</span></a></span></li>
							<li><span>Cart</span></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="content-container">
				<div class="container">
					<div class="row">
						<div class="col-md-12 main-wrap">
							<div class="main-content">
								<div class="shop">
									<form method="post" action="cart.php">
										<table class="table shop_table cart">
											<thead>
												<tr>
													<th class="product-remove hidden-xs">&nbsp;</th>
													<th class="product-thumbnail hidden-xs">&nbsp;</th>
													<th class="product-name">Product</th>
													<th class="product-price text-center">Price</th>
													<th class="product-quantity text-center">Quantity</th>
													<th class="product-subtotal text-center hidden-xs">Total</th>
												</tr>
											</thead>
											<tbody>
                                                    <?php
                                                    $total = 0;
                                                    $item_count = 0;
                                                    // print_r($productsInCart);
                                                    foreach (
                                                        $productsInCart
                                                        as $cart
                                                    ) {

                                                        // print_r($cart);
                                                        //product
                                                        $query =
                                                            'SELECT * from `products` where product_id=? ';
                                                        $query = $connect->prepare(
                                                            $query
                                                        );
                                                        if ($fromDB) {
                                                            $query->execute([
                                                                $cart->product_id,
                                                            ]);
                                                        } else {
                                                            // print_r($cart);
                                                            $pId = $cart[0];
                                                            $query->execute([
                                                                $pId,
                                                            ]);
                                                            // print_r($cart);
                                                        }
                                                        $product = $query->fetch(
                                                            PDO::FETCH_OBJ
                                                        );

                                                        //categories
                                                        $query =
                                                            'SELECT category_name from `categories` where category_id=? ';
                                                        $query = $connect->prepare(
                                                            $query
                                                        );
                                                        $query->execute([
                                                            $product->category_id,
                                                        ]);
                                                        $category_name = $query->fetch(
                                                            PDO::FETCH_OBJ
                                                        );

                                                        //
                                                        if ($fromDB) {
                                                            $qunatity =
                                                                $cart->quantity;
                                                        } else {
                                                            $qunatity =
                                                                $cart[1];
                                                        }
                                                        $sub_total =
                                                            $product->price *
                                                            $qunatity;
                                                        ?>
                                                        <tr class="cart_item">
													<td class="product-remove hidden-xs">
														<input type="hidden" value="<?php echo $fromDB
                  ? $cart->cart_id
                  : $cart[0]; ?>" name="id_c" id="cart_id<?php echo $fromDB
    ? $cart->cart_id
    : $cart[0]; ?>">
														<a href="?del=<?php echo $fromDB
                  ? $cart->cart_id
                  : $cart[0]; ?>" class="remove" title="Remove this item">&times;</a>
													</td>
													<td class="product-thumbnail hidden-xs">
														<a href="#">
															<img width="100" height="150" src="../imgs/<?php echo $product->image1; ?>" alt="Product-1"/>
														</a>
													</td>
													<td class="product-name">
														<a href="product_page.php?prod_id=<?php echo $product->product_id; ?>" data-original-title="" title=""><?php echo $product->product_name; ?></a>
														<dl class="variation">
															<dt class="variation-Size">category:</dt>
															<dd class="variation-Size"><p><?php echo $category_name->category_name; ?></p></dd>
														</dl>
													</td>
													<td class="product-price text-center">
													<input type="hidden" value="<?php echo $product->price; ?>" name="price">
                                                    <span class="amount"> <?php echo $product->price; ?> JOD</span>

													</td>
													<td class="product-quantity text-center">
														<div class="quantity">

													<?php if ($fromDB) { ?>
										           <input type="number" step="1" min="1" id="qunatity/<?php echo $cart->cart_id; ?>/<?php echo $product->price; ?>" class="breakdown" name="qunatity<?php echo $cart->product_id; ?>" value="<?php echo $qunatity; ?>" title="Qty" class="input-text qty text" size="4"/>
													<?php } else { ?>
													<input type="number" min="1" name="quantity" id="p<?php echo $cart[0]; ?>" class='quantityBy' value="<?php echo $cart[1]; ?>">
													<?php } ?>
									           </div>
													</td>
													
													<td class="product-subtotal hidden-xs text-center">
														<span class="amount" id="subTotal"> <?php echo $product->price *
                  ($fromDB ? $cart->quantity : $cart[1]); ?> JOD</span>
													</td>
												</tr>
												<div class="modal fade shop product-quickview" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			<div class="modal-body">
				<div class="product-quickview-content">
					<div class="row">
						<div class="col-sm-6">
							<div class="single-product-images">
								<div class="single-product-images-slider">
									<img width="800" height="850" src="../images/product/product-detail/product-1.jpg" alt="Product-1">

								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="summary entry-summary">
								<!--title  -->

								<h1 class="product_title entry-title">Cras rhoncus duis viverra</h1>
								<!-- rating -->

								<div class="shop-product-rating">
									<div class="star-rating">
										<span style="width:40%"></span>
									</div>
									<a href="#reviews" class="shop-review-link">(<span class="count">1</span> customer review)</a>
								</div>
								<!-- price -->

								<p class="price">
									<span class="amount">$12.00</span>–<span class="amount">$23.00</span>
								</p>
								<!-- description -->

								<div class="product-excerpt">
									<p>
										Proin malesuada enim nulla, nec bibendum justo vestibulum non. Duis et ipsum convallis, bibendum enim a, hendrerit diam. Praesent tellus mi, vehicula et risus eget, laoreet tristique tortor. Fusce id metus eget nibh imperdiet fermentum non in metus.
									</p>
								</div>
								<div class="product-actions res-color-attr">
									<form class="cart">
										<div class="product-options-outer">
											<div class="variation_form_section">
												<div class="product-options icons-lg">

												</div>
											</div>
										</div>
										<div class="single_variation_wrap">
											<div class="single_variation">
												<!-- price  -->
												<span class="price"><span class="amount">$20.00</span></span>
											</div>
											<form action="add_to_cart.php" method="post">
											<div class="variations_button">
												<div class="quantity">
													<input type="number" name="quantity" value="1" title="Qty" class="input-text qty text" size="4">
													<input type="hidden" name="add_to_cart" value="5" title="Qty">

												</div>
				                            <button type="submit" class="button">Add to cart</button>
											</div>
											<form>
										</div>
									</form>
								</div>
								<div class="yith-wcwl-add-to-wishlist">
									<a href="#" class="add_to_wishlist">
										Add to Wishlist
									</a>
								</div>


								<div class="product_meta">
									<!-- <span class="sku_wrapper">SKU: <span class="sku">N/A</span></span> -->

									<!-- Category -->


									<span class="posted_in">Category: <a href="#">Aliquam</a></span>
									<!-- <span class="tagged_as">Tags: <a href="#">Men</a>, <a href="#">Women</a></span> -->
									<!-- <span class="posted_in">Brand: <a href="#">Adesso</a>, <a href="#">Carvela</a>.</span> -->
								</div>
								<div class="share-links">



									<div class="share-icons">
										<span class="facebook-share">
											<a href="https://www.facebook.com" title="Share on Facebook"><i class="fa fa-facebook"></i></a>
										</span>
										<span class="twitter-share">
											<a href="https://www.twitter.com" title="Share on Twitter"><i class="fa fa-twitter"></i></a>
										</span>
										<span class="instgram-share">
											<a href="https://www.instgram.com#" title="Share on Instagram "><i class="fa fa-google-plus"></i></a>
										</span>
										<span class="pinterest-share">
											<a href="https://www.pinterest.com" title="Share on Pinterest"><i class="fa fa-linkedin"></i></a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $total += $sub_total;
                                                    }
                                                    ?>

                
												<tr>
													<td colspan="6" class="actions">
														<div class="coupon">
                                                            <form method="post" action="cart.php" >
															<label for="coupon_code">Coupon:</label> 
															<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code"/> 
															<input type="submit" class="button" name="apply_coupon" value="Apply Coupon"/>
                                                          </form>
														</div>
														<input type="submit" class="button update-cart-button" name="update_cart" value="Update Cart"/>
													</td>
												</tr>
											</tbody>
										</table>
									</form>
									<?php  ?>
									<div class="cart-collaterals">
										<div class="cart_totals">
											<h2>Cart Totals</h2>
											<table>
												<tr class="cart-subtotal">
													<th>Subtotal</th>
													<td><span class="amount"> <?php echo $total; ?> JOD</span></td>
												</tr>
												<tr class="shipping">
													<th>Discount</th>
													<td><span class="amount"> <?php if (isset($_POST['apply_coupon'])) {
                 echo $coupon_saved->discount . ' %';
             } else {
                 echo '0';
             } ?></span></td>
												</tr>
												<tr class="order-total">
													<th>Total</th>
													<td><strong><span class="amount"> <?php if (isset($_POST['apply_coupon'])) {
                 echo $total - $total * ($coupon_saved->discount / 100);
             } else {
                 echo $total;
             } ?> JOD</span></strong></td>
												</tr>
											</table>
											<div class="wc-proceed-to-checkout">
												<?php if ($fromDB) { ?>
												<a href="checkout.php?price=<?php echo $total; ?>&c=<?php if (
    isset($coupon_saved->coupon_id)
) {
    echo $coupon_saved->coupon_id;
} else {
    echo '0';
} ?>" class="checkout-button button alt wc-forward">Proceed to Checkout</a>
												<?php } else { ?>
												<a data-rel="loginModal" class="checkout-button button alt wc-forward">Proceed to Checkout</a>
													<?php } ?>
											</div>
										</div>
							
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<!-- ///////////////////////////////////////////////////////////////////////////////////  -->

			<footer id="footer" class="footer">
	<div class="footer-info">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="footer-info-logo">
						<!-- logo image -->
						<img alt="logo" src="../images/ltrblack.png" style="max-width: 25%;">
					</div>
					<div class="copyright text-center">Copyright right © 2022 Gruop4. All Rights Reserved.</div>
					<div class="footer-social">
						<a href="https://www.facebook.com" title="Facebook">
							<i class="fa fa-facebook"></i>
						</a>
						<a href="https://www.twitter.com" title="Twitter">
							<i class="fa fa-behance"></i>
						</a>
						<a href="https://www.instgram.com" title="Instagram">
							<i class="fa fa-instagram instagram-bg-hover"></i>
						</a>
						<a href="https://www.pinterest.com" title="Pinterest">
							<i class="fa fa-pinterest"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
</div>




<!-- login model  -->
<div class="modal fade user-login-modal" id="userloginModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="userloginModalForm" method="post" action="login.php?from=cart">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h4>You Have To Login To Complete Checkout Proccess</h4>
					<h4 class="modal-title">Login</h4>
				</div>

				<div class="modal-body">
					<!-- <div class="user-login-facebook">
								<button class="btn-login-facebook" type="button">
									<i class="fa fa-facebook"></i>Sign in with Facebook
								</button>
							</div>
							<div class="user-login-or"><span>or</span></div> -->


					<!-- login form input  -->
					<div class="form-group">
						<label>Email</label>
						<input type="text" id="username" name="email" required class="form-control" value="" placeholder="Email">
						<input type="hidden" id="hiddenPrice" name="totalPrice" required value="<?php echo $total; ?>">
						<?php if (isset($coupon_saved->coupon_id)) { ?>
						<input type="hidden" id="hiddenCoupon" name="coupon" required value="<?php echo $coupon_saved->coupon_id; ?>">
						<?php } ?>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" id="password" required value="" name="password" class="form-control" placeholder="Password">
					</div>
				</div>

				<div class="modal-footer">
					<span class="user-login-modal-register pull-left">
						<a data-rel="registerModal" href="#">Not a Member yet?</a>
					</span>
					<button type="submit" name="login" class="btn btn-default btn-outline">Sign in</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- register modal -->
<div class="modal fade user-register-modal" id="userregisterModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="userregisterModalForm" action="signup.php?from=cart" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title">Register account</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
					<input type="hidden" id="hiddenPrices" name="totalPrice" required value="<?php if (
         isset($_POST['apply_coupon'])
     ) {
         echo $total - $total * ($coupon_saved->discount / 100);
     } else {
         echo $total;
     } ?>">
						<?php if (isset($coupon_saved->coupon_id)) { ?>
						<input type="hidden" id="hiddenCoupons" name="coupon" required value="<?php echo $coupon_saved->coupon_id; ?>">
						<?php } ?>
						<label>First Name <span class="error" id="spanFname">* <?php if (
          isset($_POST['register'])
      ) {
          echo $nameErr;
      } ?></span></label>
						<input type="text" id="fname" name="fname" required class="form-control" value="" placeholder="Username">

					</div>
					<div class="form-group">
						<label>Last Name <span class="error" id="spanLname">* <?php if (
          isset($_POST['register'])
      ) {
          echo $nameErr;
      } ?></span></label>
						<input type="text" id="lname" name="lname" required class="form-control" value="" placeholder="Username">

					</div>
					<div class="form-group">
						<label for="user_email">Email <span class="error" id="spanEmail">* <?php if (
          isset($_POST['register'])
      ) {
          echo $emailErr;
      } ?></span></label>
						<input type="email" id="user_email" name="email" required class="form-control" value="" placeholder="Email">
						

					</div>


					<div class="form-group">
						<label>Phone <span class="error" id="spanPhone">* <?php if (
          isset($_POST['register'])
      ) {
          echo $phoneErr;
      } ?></span></label>
						<input type="text" id="phone" name="phone" required class="form-control" value="" placeholder="Phone">

					</div>

					<div class="form-group">
						<label>City <span class="error" id="spanCity">* <?php if (
          isset($_POST['register'])
      ) {
          echo $cityEr;
      } ?></span></label>
						<input type="text" id="city" name="city" required class="form-control" value="" placeholder="City">
						

					</div>
					<div class="form-group">
						<label>Address <span class="error" id="spanAddress">* <?php if (
          isset($_POST['register'])
      ) {
          echo $addressEr;
      } ?></span></label>
						<input type="text" id="address" name="address" required class="form-control" value="" placeholder="Address">
						

					</div>


					
					<div class="form-group">
						<label for="user_password">Password <span class="error" id="spanPassword">* <?php if (
          isset($_POST['register'])
      ) {
          echo $passErr;
      } ?></span></label>
						<input type="password" id="user_password" required value="" name="password" class="form-control" placeholder="Password">
						

					</div>
					<div class="form-group">
						<label for="user_password">Retype password <span class="error" id="spanCPassword">* <?php if (
          isset($_POST['register'])
      ) {
          echo $cpassErr;
      } ?></span></label>
						<input type="password" id="cuser_password" required value="" name="cuser_password" class="form-control" placeholder="Retype password">
						

					</div>

				</div>
				<div class="modal-footer">
					<span class="user-login-modal-link pull-left">
						<a data-rel="loginModal" href="#loginModal">Already have an account?</a>
					</span>
					<input type="submit" name="register" class="btn btn-default btn-outline" value="Register">
				</div>
			</form>
		</div>
	</div>
</div>


	
<div class="modal fade user-lostpassword-modal" id="userlostpasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="userlostpasswordModalForm">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title">Forgot Password</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Username or E-mail:</label>
						<input type="text" name="user_login" required class="form-control" value="" placeholder="Username or E-mail">
					</div>
				</div>
				<div class="modal-footer">
					<span class="user-login-modal-link pull-left">
						<a data-rel="loginModal" href="#loginModal">Already have an account?</a>
					</span>
					<button type="submit" class="btn btn-default btn-outline">try in</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- product-quickview -->




<script type='text/javascript' src='http://code.jquery.com/jquery-1.11.3.min.js'></script>
		<script type='text/javascript' src='../js/jquery-migrate.min.js'></script>
		<script type='text/javascript' src='../js/jquery.themepunch.tools.min.js'></script>
		<script type='text/javascript' src='../js/jquery.themepunch.revolution.min.js'></script>
		<script type='text/javascript' src='../js/easing.min.js'></script>
		<script type='text/javascript' src='../js/imagesloaded.pkgd.min.js'></script>
		<script type='text/javascript' src='../js/bootstrap.min.js'></script>
		<script type='text/javascript' src='../js/superfish-1.7.4.min.js'></script>
		<script type='text/javascript' src='../js/jquery.appear.min.js'></script>
		<script type='text/javascript' src='../js/script.js'></script>
		<script type='text/javascript' src='../js/swatches-and-photos.js'></script>
		<script type='text/javascript' src='../js/jquery.prettyPhoto.min.js'></script>
		<script type='text/javascript' src='../js/jquery.prettyPhoto.init.min.js'></script>
		<script type='text/javascript' src='../js/jquery.selectBox.min.js'></script>
		<script type='text/javascript' src='../js/jquery.parallax.js'></script>
		<script type='text/javascript' src='../js/jquery.touchSwipe.min.js'></script>
		<script type='text/javascript' src='../js/jquery.transit.min.js'></script>
		<script type='text/javascript' src='../js/jquery.carouFredSel.min.js'></script>
		<script type='text/javascript' src='../js/isotope.pkgd.min.js'></script>
		<script type='text/javascript' src='../js/core.min.js'></script>
		<script type='text/javascript' src='../js/widget.min.js'></script>
		<script type='text/javascript' src='../js/mouse.min.js'></script>
		<script type='text/javascript' src='../js/slider.min.js'></script>
		<script type='text/javascript' src='../js/jquery-ui-touch-punch.min.js'></script>
		<script type='text/javascript' src='../js/price-slider.js'></script>
		<script type='text/javascript' src='../js/custom.js'></script>

		<script type='text/javascript' src='../js/jquery.magnific-popup.min.js'></script>
		<!-- <script type='text/javascript' src='../js/jquery.js'></script> -->
		<script type='text/javascript' src='../js/jquery.cookie.min.js'></script>
		<script src="cart.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	document.getElementById("fname").onblur= function() {
		let isName = /^[a-zA-Z\s]+$/igm.test(document.getElementById("fname").value);
		if(!isName) {
			document.getElementById("spanFname").innerHTML="* Name Must Be Letters Only";
		} 
		else {
			document.getElementById("spanFname").innerHTML="*";
		}
	}
	document.getElementById("lname").onblur= function() {
		let isName = /^[a-zA-Z\s]+$/igm.test(document.getElementById("lname").value);
		if(!isName) {
			document.getElementById("spanLname").innerHTML="* Name Must Be Letters Only";
		}
		else {
			document.getElementById("spanLname").innerHTML="*";
		}
	}
	document.getElementById("user_email").onblur= function() {
		let isName = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/ig.test(document.getElementById("user_email").value);
		let userEmail=document.getElementById("user_email").value;
		fetch('checkEmail.php', {
            method: 'POST', // or 'PUT'
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded', 
            },
            body: `email=${userEmail}`,
            })
            .then((response) => {
                response.text().then(res=>{
					console.log(res);
                    if(res==1) {
						document.getElementById("spanEmail").innerHTML="* Email is Already Registred";
					}
					else if(!isName){
						document.getElementById("spanEmail").innerHTML="* Email Must Be Valid Form Like : test@gmail.com";
					}
					else {
						document.getElementById("spanEmail").innerHTML="* ";
					}
                });
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
	
	document.getElementById("phone").onblur= function() {
		let isName = /^\d{10}$/igm.test(document.getElementById("phone").value);
		if(!isName) {
			document.getElementById("spanPhone").innerHTML="* Phone Number Must Be 10 Numbers";
		}
		else {
			document.getElementById("spanPhone").innerHTML="*";
		}
	}
	document.getElementById("city").onblur= function() {
		let isName = /^[a-zA-Z\s]+$/igm.test(document.getElementById("city").value);
		if(!isName) {
			document.getElementById("spanCity").innerHTML="* City Must Be Letters Only";
		}
		else {
			document.getElementById("spanCity").innerHTML="*";
		}
	}
	document.getElementById("address").onblur= function() {
		let isName = /^[a-zA-Z\s0-9-/,]+$/igm.test(document.getElementById("address").value);
		if(!isName) {
			document.getElementById("spanAddress").innerHTML="* Address Must Be Letters Only";
		}
		else {
			document.getElementById("spanAddress").innerHTML="*";
		}
	}
	document.getElementById("user_password").onblur= function() {
		let isName = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(document.getElementById("user_password").value);
		if(!isName) {
			document.getElementById("spanPassword").innerHTML="* Password Must Be Contain Uppercase , Lowercase , Number, Special Character";
		}
		else {
			document.getElementById("spanPassword").innerHTML="*";
		}
	}
	document.getElementById("cuser_password").onblur= function() {
		let isName = document.getElementById("cuser_password").value==document.getElementById("user_password").value;
		if(!isName) {
			document.getElementById("spanCPassword").innerHTML="* Confirm Password Doesn't Match";
		}
		else {
			document.getElementById("spanCPassword").innerHTML="*";
		}
	}

	// function(id,regex,error) {
	// 	document.getElementById(id).onblur= function() {
	// 	}
	// }
</script>

</body>

</html>

