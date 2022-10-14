
<?php require_once 'header.php'; ?>
<style>
	.row.banner-fullwidth h {
		position: relative;
	}
	h1.title {
		color:#fff;
	}
	.row.banner-fullwidth::before{
		position: absolute;
		content:"";
		background-color:rgb(0 0 0 / 35%);
		top:0;
		left:0;
		width: 100%;
		height: 100%;			
	}

</style>
<div class="row banner-fullwidth row-o-full-height row-o-content-middle" style="background-image: url(../imgs/h4.jpg)">
	<div class="col-sm-2"></div>
	<div class="col-sm-8" >
		<div class="about-banner-text " >
			<h1 class="font-sm-50 title text-center white" style="font-weight:600">
					About Cloud Masters
			</h1>
		</div>
	</div>
	<div class="col-sm-2">

	</div>
</div>
			<div class="content-container no-padding" >
				<div class="container-full" >
					<div class="row">
						<div class="col-md-12 main-wrap">
							<div class="main-content" >
 									<div class="container"  id="imgaboutus">
										<div class="row offers">
											<div class="col-sm-6">
												<div class="content_element align_center">
														<!-- <div class="single_image-wrapper box_border_grey" id="editimg" >
															<img width="571" height="485" src="../images/aboutus/" alt="home-bg"/>
														</div> -->
														<video width="500" height="500" controls autoplay>
														<source src="../images/aboutus/456c0ce9c1d14f5954923c9bc9457702 (1).mov" type="video/mp4">
														<source src="../images/aboutus/456c0ce9c1d14f5954923c9bc9457702 (1).mov" type="video/ogg">
														Your browser does not support the video tag.
														</video> 
												</div>
												
												</div>
												<div class="col-sm-6 offer-text" id="edittext" >
													<h2 class="custom_heading">WHO WE ARE</h2>
													
													<div class="content_element">
														<p style="font-size:20px">
															We offer you a distinguished service to display the best types of sleeping supplies from different pillows, 
															blankets and liners for the yacht. Our goal is to provide you with the best services with the highest quality and the lowest price.
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row about-content">
									<div class="col-sm-3"></div>
									<div class="col-sm-6">
										<div class="row inner">
											<div class="col-sm-12" style="margin:20px">
												<div class="icon_element icon_element-outer icon_element-align-center">
													<div class="icon_element-inner icon_element-color-black icon_element-size-lg icon_element-style- icon_element-background-color-grey">
														<span class="icon_element-icon fa fa-anchor"></span>
													</div>
												</div>
												<div class="content_element" style="text-align:center">
													<p>
													Our goal is to provide suitable products for everyone at the best prices</p>
												</div>
												<div class="icon_element icon_element-outer icon_element-align-center">
													<div class="icon_element-inner icon_element-color-black icon_element-size-lg icon_element-style- icon_element-background-color-grey">
														<span class="icon_element-icon fa fa-cubes"></span>
													</div>
												</div>
												<div class="content_element" style="text-align:center">
													<p>
													Because your satisfaction with our products is our privilege</p>
												</div>
												<div class="icon_element icon_element-outer icon_element-align-center">
													<div class="icon_element-inner icon_element-color-black icon_element-size-lg icon_element-style- icon_element-background-color-grey">
														<span class="icon_element-icon fa fa-key"></span>
													</div>
												</div>
												<div class="content_element" style="text-align:center">
													<p>
														Because we believe in making things that are high quality and low maintenance.
													</p>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-3"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<script>
	window.onload = function () {
		document.getElementById("about").style.cssText = "border-bottom: 2px solid white;"
	}
	</script>


<?php require_once 'footer.php'; ?>
