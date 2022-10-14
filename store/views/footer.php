
<footer id="footer" class="footer" style="margin-top:50px">
	<div class="footer-info">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="footer-info-logo">
						<!-- logo image -->
						<img alt="logo" src="../images/ltrblack.png" style="max-width: 25%;">
					</div>
					<div class="copyright text-center">Copyright right © 2022 All Rights Reserved.</div>
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
			<form id="userloginModalForm" method="post" action="login.php">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
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
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" id="password" required value="" name="password" class="form-control" placeholder="Password">
					</div>
					<div class="checkbox clearfix">
						<div class="form-flat-checkbox pull-left">
							<input type="checkbox" name="rememberme" id="rememberme" value="forever"><i></i>&nbsp;Remember Me
						</div>
						<span class="lostpassword-modal-link pull-right">
							<a href="#lostpasswordModal" data-rel="lostpasswordModal">Lost your password?</a>
						</span>
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
			<form id="userregisterModalForm" action="signup.php" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title">Register account</h4>
				</div>
				<div class="modal-body">
					<!-- <div class="user-login-facebook">
								<button class="btn-login-facebook" type="button">
									<i class="fa fa-facebook"></i>Sign in with Facebook
								</button>
							</div>
							<div class="user-login-or"><span>or</span></div> -->

					<!-- register input  -->
					<div class="form-group">
						<label>First Name <span class="error" id="spanFname">* <?php if (
          isset($_POST['register'])
      ) {
          echo $nameErr;
      } ?></span></label>
						<input type="text" id="fname" name="fname" required class="form-control" value="" placeholder="First Name">
						

					</div>
					<div class="form-group">
						<label>Last Name <span class="error" id="spanLname">* <?php if (
          isset($_POST['register'])
      ) {
          echo $nameErr;
      } ?></span></label>
						<input type="text" id="lname" name="lname" required class="form-control" value="" placeholder="Last Name">
						

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>