<?php require 'header2.php'; ?>

<div class="heading-container">
			<div class="container heading-standar">
				<div class="page-breadcrumb">
					<ul class="breadcrumb">
						<li><span><a href="#" class="home"><span>Home</span></a></span></li>
						<li><span>Product Detail</span></li>
						<?php
      $product_id = $_GET['prod_id'];

      $query = $connect->prepare(
          'SELECT * FROM `products` Where product_id=? '
      );
      $query->execute([$product_id]);

      $product = $query->fetch(PDO::FETCH_OBJ);

// print_r($product);
?>
					</ul>
				</div>
			</div>
		</div>
		<div class="content-container">
			<div class="container-full">
				<div class="row">
					<div class="col-md-12 main-wrap">
						<div class="main-content">
							<div class="container">
								<div class="row">
									<div class="col-md-12 no-min-height"></div>
								</div>
							</div>
							<div class="product">
								<div class="container">
									<div class="row summary-container">
										<div class="col-md-8 col-sm-6 entry-image">
											<div class="single-product-images">
												<div class="single-product-images-slider">
													<div class="caroufredsel product-images-slider" data-synchronise=".single-product-images-slider-synchronise" data-scrollduration="500" data-height="variable" data-scroll-fx="none" data-visible="1" data-circular="1" data-responsive="1">
														<div class="caroufredsel-wrap">
															<ul class="caroufredsel-items">
																<li class="caroufredsel-item">
																	<div class="thumb">
																		<a href="../imgs/<?php echo $product->image1; ?> " data-rel="magnific-popup-verticalfit" title="Product-detail">
																			<img width="800" height="850" src="../imgs/<?php echo $product->image1; ?> " alt="Product-detail" />
																		</a>
																	</div>
																</li>
																<?php
                if ($product->image2 != null) { ?>
																<li class="caroufredsel-item">
																	<div class="thumb">
																		<a href="../imgs/<?php echo $product->image2; ?> " data-rel="magnific-popup-verticalfit" title="Product-detail">
																			<img width="800" height="850" src="../imgs/<?php echo $product->image2; ?> " alt="Product-detail" />
																		</a>
																	</div>
																</li>
																<?php }
                if ($product->image3 != null) { ?>
																<li class="caroufredsel-item">
																	<div class="thumb">
																		<a href="../imgs/<?php echo $product->image3; ?> " data-rel="magnific-popup-verticalfit" title="Product-detail">
																			<img width="800" height="850" src="../imgs/<?php echo $product->image3; ?> " alt="Product-detail" />
																		</a>
																	</div>
																</li>
																<?php }
                ?>
															</ul>
															<a href="#" class="caroufredsel-prev"></a>
															<a href="#" class="caroufredsel-next"></a>
														</div>
													</div>
												</div>

																				<?php if (isset($_POST['add_to_card'])) {
                        $qunatity = $_POST['quantity'];
                        $insert = $connect->prepare(
                            'INSERT INTO cart (quantity,product_id,user_id) VALUES (?,?,?)'
                        );
                        $insert->execute([
                            $qunatity,
                            $product->product_id,
                            $_SESSION['userid'],
                        ]);
                    } ?>
												<div class="single-product-thumbnails">
													<div class="caroufredsel product-thumbnails-slider" data-visible-min="2" data-visible-max="4" data-scrollduration="500" data-direction="up" data-height="100%" data-circular="1" data-responsive="0">
														<div class="caroufredsel-wrap">
															<ul class="single-product-images-slider-synchronise caroufredsel-items">
																<li class="caroufredsel-item selected">
																	<div class="thumb">
																		<a href="#" data-rel="1" title="Product-detail">
																			<img width="100" height="150" src="../imgs/<?php echo $product->image1; ?> " alt="Product-detail" />
																		</a>
																	</div>
																</li>
																<?php
                if ($product->image2 != null) { ?>
																<li class="caroufredsel-item">
																	<div class="thumb">
																		<a href="#" data-rel="2" title="Product-detail">
																			<img width="100" height="150" src="../imgs/<?php echo $product->image2; ?>" alt="Product-detail" />
																		</a>
																	</div>
																</li>
																<?php }
                if ($product->image3 != null) { ?>
																<li class="caroufredsel-item">
																	<div class="thumb">
																		<a href="#" data-rel="3" title="Product-detail">
																			<img width="100" height="150" src="../imgs/<?php echo $product->image3; ?>" alt="Product-detail" />
																		</a>
																	</div>
																</li>
																<?php }
                ?>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-4 col-sm-6 entry-summary">
											<div class="summary">
												<h1 class="product_title entry-title"><?php echo $product->product_name; ?></h1>

												<p class="price"><span class="amount"><?php echo $product->price; ?> JD</span></p>
												<div class="product-excerpt">
													<p>
														<?php echo $product->description; ?></p>
												</div>
												<div class="product-actions res-color-attr">
													<form class="cart" method="GET" action="add_to_cart.php">
														<div class="product-options-outer">
															<div class="variation_form_section">
																<div class="product-options icons-lg">
																	<table class="variations-table">
																	</table>
																</div>
															</div>
														</div>


						
														<div class="single_variation_wrap">
															<div class="single_variation">
																<span class="price"><span class="amount"></span></span>
															</div>
															<div class="variations_button">
																<input type="hidden" name="ad" value="<?php echo $product->product_id; ?>">
																<input type="hidden" name="from" value="product">
																<div class="quantity">
																	<input style="height:45px;" type="number" min="1" class="breakd button" id="qunatity/<?php echo $product->product_id; ?>" name="q" value="1" title="Qty" class="input-text qty text" size="4">
																</div>
																<button type="submit" id="button" name="add_to_card" class="button">Add to cart</button>
															</div>
														</div>
													</form>
												</div>
												<div class="offcanvas-widget">
												</div>
											</div>
										</div>
									</div>
									<div style="height:100px ;"></div>
									<div class="container">
										<div class="row">
											<div class="col-sm-12">
												<div class="related products">
													<div class="related-title">
														<h3><span>Related Products</span></h3>
													</div>
													<ul class="products columns-4" data-columns="4">



<?php
$query = $connect->prepare('SELECT * FROM `products` Where category_id=? ');
$query->execute([$product->category_id]);

$products = $query->fetchAll(PDO::FETCH_OBJ);
$count = 0;
foreach ($products as $prod) {
    if ($count < 4 && $prod->product_id != $product->product_id) {
        $count++; ?>
														<li class="product">
															<div class="product-container">
																<figure>
																	<div class="product-wrap">
																		<div class="product-images">
																			<div class="shop-loop-thumbnail">
																				<img width="300" height="350" src="../imgs/<?php echo $prod->image1; ?>" alt="Product-2" />
																			</div>
													
																			<div class="clear"></div>
																			
																		</div>
																	</div>
																	<figcaption>
																		<div class="shop-loop-product-info">
																			<div class="info-title">
																				<h3 class="product_title"><a href="?prod_id=<?php echo $prod->product_id; ?>"><?php echo $prod->product_name; ?></a></h3>
																			</div>
																			<div class="info-meta">
																				<div class="info-price">
																					<span class="price">
																						<span class="amount"><?php echo $prod->price; ?> JD</span>
																					</span>
																				</div>
																				<div class="loop-add-to-cart">
																					<a href="./add_to_cart.php?ad=<?php echo $prod->product_id; ?>$from=product">Add To Cart</a>
																				</div>
																			</div>
																		</div>
																	</figcaption>
																</figure>
															</div>
														</li>
														<?php
    }
}
?>
													</ul>
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
<?php require 'footer.php'; ?>
