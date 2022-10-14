<?php
require_once 'connection.php';

if (isset($_POST['login'])) {
    $password = $_POST['password'];
    $email = $_POST['email'];

    $query = 'SELECT * from `users` where email=?';
    $query = $connect->prepare($query);
    $query->execute([$email]);

    $user = $query->fetch(PDO::FETCH_OBJ);
    // print_r($user);
    // print_r($_SESSION);

    if (!empty($user)) {
        if ($password == $user->password) {
            $_SESSION['userid'] = $user->user_id;
            if (isset($_GET['from'])) {
                $cartInVisitor = $_SESSION['cartVisitor'];
                foreach ($cartInVisitor as $cart) {
                    $sql = $connect->query("INSERT INTO cart (user_id, product_id , quantity)
					VALUES ('$user->user_id','$cart[0]','$cart[1]')");
                }
                unset($_SESSION['cartVisitor']);
                $total = $_POST['totalPrice'];
                if (isset($_POST['coupon'])) {
                    $coupon = $_POST['coupon'];
                    header("location: ./checkout.php?price=$total&c=$coupon");
                }
                header("location: ./checkout.php?price=$total&c=0");
            } else {
                echo "<script>swal({ icon: 'success',});</script>";
                if ($user->is_admin) {
                    header('location: ../admin/views/index.php');
                } else {
                    header('location: index.php');
                }
            }
        }
        //$user->user_id;}
        else {
            echo "<script>location.href = 'index.php?err=login'</script>";
            echo "<script>alert('incorrect password ');</script>";
        }
        // header("Location: index.php");
    } else {
        echo "<script>location.href = 'index.php?err=login'</script>";
        echo "<script>alert('It looks like you’re used incorrect email try login. Please ');</script>";
    }
}
?>

<?php  ?>

<div style="height: 100px ;"></div>

<div class="heading-container">
	<div class="container heading-standar">
		<div class="page-breadcrumb">
			<ul class="breadcrumb">
				<li><span><a href="#" class="home"><span>Home</span></a></span></li>
				<li><span>login</span></li>
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
						<h2 class="shop-account-heading">Login</h2>

						<form class="login" method="post" action="login.php">
							<p class="form-row form-row-wide">
								<label>Email address <span class="required">*</span></label>
								<input type="text" class="input-text" name="email" value="" />
							</p>
							<p class="form-row form-row-wide">
								<label>Password <span class="required">*</span></label>
								<input class="input-text" type="password" name="password" />
							</p>
							<p class="form-row">

								<input type="submit" class="button" name="login" value="Login" />
							</p>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 

<?php require 'footer.php'; ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>


<!-- <script>
	document.body.classList.add("shop-account")
</script> -->