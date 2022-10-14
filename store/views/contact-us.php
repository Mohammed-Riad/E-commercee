

<?php require_once 'header.php'; ?>





<div class="heading-container heading-resize heading-no-button">
				<div class="heading-background heading-parallax bg-1" style = "background-image: url(../imgs/h2.jpg)">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="heading-wrap">
									<div class="page-title" id="page-title">
										<h1>Contact Us</h1>
										<div class="page-breadcrumb">
											<ul class="breadcrumb">
												<li><span><a class="home" href="#"><span>Home</span></a></span></li>
												<li><span>Contact Us</span></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
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
										<div class="col-sm-8">
											<div class="row contact-form-wrapper">
												<div class="col-sm-12">
													<div class="title">
														<h2>GET IN TOUCH</h2>
													</div>
													<form>
														<div class="row">
															<div class="col-sm-6">
																<div><b>Your Name (required)<b><br />
															    	<p class="form-control-wrap your-name">
															    		<input type="text" name="your-name" value="" size="40" class="form-control text validates-as-required" />
															    	</p>
															    </div>
															</div>
															<div class="col-sm-6">
																<div>Your Email (required)<br />
														    		<p class="form-control-wrap your-email">
														    			<input type="email" name="your-email" value="" size="40" class="form-control text email validates-as-required validates-as-email" />
														    		</p>
														    	</div>
															</div>
															<div class="col-sm-12">
																<div>Your Message<br />
														    		<p class="form-control-wrap your-message">	<textarea name="your-message" cols="40" rows	="10" class="form-control textarea"></textarea>
														    		</p>
														    	</div>
															</div>
														</div>
													<b>	<input  style="background-color:#424ef5;  color: white ;"   type="submit" value="Send" class="form-control submit" /></b>
													</form>
												</div>
											</div>
										</div>
										<style>
											.support-icon {
												padding:10px !important;
												font-size:14px !important;
											}
										</style>
										<div class="col-sm-4" style="background-color:whitesmoke">
											<div class="row contact-info">
												<div class="col-sm-12">
													<div class="title">
														<h4>NEED SUPPORT</h4>
													</div>
													<div class="separator content_element separator_align_center sep_width_100 sep_pos_align_center separator_no_text">
														<span class="sep_holder sep_holder_l">
															<span class="sep_line"></span>
														</span>
														<span class="sep_holder sep_holder_r">
															<span class="sep_line"></span>
														</span>
													</div>
													<div class="content_element">
														<div class="support-icon">
															<i class="fa fa-map-marker"></i>
															JORDAN,AMMAN,Street 16
														</div>
														<div class="support-icon">
															<i class="fa fa-phone"></i>
															(+962) 778083546
														</div>
														<div class="support-icon">
															<i class="fa fa-envelope-o"></i>
															<a href="mailto:email@domain.com">
																info@cloudmaster.com
															</a>
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
				</div>
			</div>

	<script>
	window.onload = function () {
		document.getElementById("contact").style.cssText = "border-bottom: 2px solid white;"
	}
	</script>
<?php require_once 'footer.php'; ?>
