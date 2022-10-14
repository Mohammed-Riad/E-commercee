<?php require 'header2.php'; ?>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php
$delevery = 0;
$sub = 0;

//get cart info

$query = 'SELECT * from `orders` where user_id =?';
$query = $connect->prepare($query);
$query->execute([$_SESSION['userid']]);
$orders = $query->fetchAll(PDO::FETCH_OBJ);
?>

<?php if (isset($_GET['from'])) {
    if ($_GET['from'] == 'checkout') {
        echo "<script>
			window.onload =function() {
				Swal.fire({
					icon: 'success',
					title: 'Your Order has been successfully received.',
					text: 'Thank you for your trust in our products. We will contact you soon when the order is ready',
					footer: 'Here you can browse all your orders',
				})
		}
		</script>";
    }
} ?>

               <div class="heading-container">
				<div class="container heading-standar">
					<div class="page-breadcrumb">
						<ul class="breadcrumb">
							<li><span><a href="/views/profile.php" class="home"><span>Profile</span></a></span></li>
							<li><span>Order History</span></li>
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
									<form method="post" action="order_history.php">
										<table class="table shop_table cart">
											<thead>
												<tr>	
													<th class="product-name"> Order Number </th>
													<th class="product-price text-center">Date </th>
													<th class="product-quantity text-center">Total Price </th>
													<th class="product-subtotal text-center hidden-xs">phone</th>
													<th class="product-subtotal text-center hidden-xs">Address / Postal code</th>
													<th class="product-subtotal text-center hidden-xs">Used coupon</th>
													<th class="product-subtotal text-center hidden-xs">Details</th>



												</tr>
											</thead>
											<tbody>
                                                    <?php foreach (
                                                        $orders
                                                        as $order
                                                    ) {

                                                        //product
                                                        $query =
                                                            'SELECT * from `order_details` where order_id=? ';
                                                        $query = $connect->prepare(
                                                            $query
                                                        );
                                                        $query->execute([
                                                            $order->order_id,
                                                        ]);
                                                        $details = $query->fetchAll(
                                                            PDO::FETCH_OBJ
                                                        );
                                                        foreach (
                                                            $details
                                                            as $detail
                                                        ) {
                                                            $query =
                                                                'SELECT * from `products` where product_id=? ';
                                                            $query = $connect->prepare(
                                                                $query
                                                            );
                                                            $query->execute([
                                                                @$detail->product_id,
                                                            ]);
                                                            $products = [
                                                                $query->fetch(
                                                                    PDO::FETCH_OBJ
                                                                ),
                                                            ];
                                                        }
                                                        $query =
                                                            'SELECT * from `coupons` where coupon_id=? ';
                                                        $query = $connect->prepare(
                                                            $query
                                                        );
                                                        $query->execute([
                                                            $order->coupon_id,
                                                        ]);
                                                        $coupon_name = $query->fetch(
                                                            PDO::FETCH_OBJ
                                                        );

                                                        //
                                                        // $qunatity =$details->quantity;
                                                        // $unitPrice=$product->price;
                                                        ?>
                                                        <tr class="cart_item">
													<td class="product-thumbnail">
													<h6 class="amount"># <?php echo $order->order_id; ?></h6>
					
													</td>

													<td class="product-price text-center">
													<h6 class="amount"><?php echo $order->order_date; ?></h6>
													</td>

													<td class="product-price text-center">
													<h6 class="amount"><?php echo $order->total_price; ?> JD</h6>
													</td>
													<td class="product-price text-center">
                                                    <h6 class="amount"><?php echo $order->order_phone; ?><h6>
													</td>
													<td class="product-price text-center">
														
														<h6 class="amount"><?php echo $order->order_address .
                  ',' .
                  $order->order_city .
                  '/' .
                  $order->postal_code; ?></h6>
													</td>
													<td class="product-price text-center">
													<h6 class="amount"><?php echo $order->coupon_id
                 ? 'YES ' .
                     $coupon_name->coupon_name .
                     '(' .
                     $coupon_name->discount .
                     '%)'
                 : 'NO'; ?></h6>
													</td>
													<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
													<td class="product-name" style="text-align:center">
														<button type="button" class="button" id='o<?php echo $order->order_id; ?>'>Details</button>
														<?php// foreach ($details as $detail) { ?>
														<?php// foreach ($products as $product) { ?>			
																
														<!-- <dl class="variation">
															<dt class="variation-Size">unit_price:</dt>
															<dd class="variation-Size"><p><?php// echo $detail->unit_price; ?></p></dd>
														</dl>
														<dl class="variation">
															<dt class="variation-Size">quantity:</dt>
															<dd class="variation-Size"><p><?php// echo $detail->quantity; ?></p></dd>
														</dl> -->
														<style>
															.swl,.swl th,.swl td {
															border: 1px solid black;
															padding:10px 4px;
															}

														</style>
															<script>
																	document.getElementById("o<?php echo $order->order_id; ?>").onclick= function() {
																		Swal.fire({
																		title: 'Order Number: <?php echo $order->order_id; ?>',
																		html: 	'<table class="swl"><tr><th>Product</th><th>Price</th><th>Quantity</th></tr>' +
																				'<?php foreach ($details as $detail) { ?>'+
																				'<?php foreach ($products as $product) { ?>' +
																				'<tr>' +
																				'<td><?php echo $product->product_name; ?></td>' +
																				'<td class="variation">' +
																					'<?php echo $detail->unit_price; ?>'+
																				'</td>'+
																				'<td class="variation">'+
																					'<?php echo $detail->quantity; ?>'+
																				'</td>' +
																				'</tr>' +
																				'<?php }} ?>' +
																				'<td colspan="3" style="text-align:center">Total Price : <?php echo $order->total_price; ?></td>'+
																				'<br>'+
																				'</table>',
																		showClass: {
																			popup: 'animate__animated animate__fadeInDown'
																		},
																		hideClass: {
																			popup: 'animate__animated animate__fadeOutUp'
																		}
																		})
																	}
															</script>				
														<?php// }} ?>			
											</td>		
											</tr>

										<?php
                                                    } ?>
											</tbody>
										</table>
									</form>
									
		

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php require_once 'footer.php'; ?>


		<script src="cart.js"></script>