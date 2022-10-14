
<?php
require_once '../../views/connection.php';

$CouponID = $_GET['id'];
$sql = $connect->query("SELECT * FROM coupons WHERE coupon_id='$CouponID'");
$sql = $sql->fetch();

try {
    $success = 0;
    if (isset($_POST['updateCoupon'])) {
        $couponname = $_POST['couponname'];
        $coupondiscount = $_POST['coupondiscount'];
        $couponcount = $_POST['couponcount'];

        $sql = $connect->query("UPDATE coupons SET
        coupon_name='$couponname', discount='$coupondiscount' , count='$couponcount' WHERE coupon_id='$CouponID'");

        if ($sql) {
            $success = 1;
            header('Refresh: 3; url=../views/coupons.php');
        }
    }
} catch (Exception $e) {
}
?>


<?php require '../views/header.php'; ?>
<div class="container-fluid page-body-wrapper">
<?php require 'sidebar.php'; ?>

<div class="main-panel">
          <?php if ($success) {
              echo "<div class='alert alert-success' role='alert'>
            Success , You Updated User Information
            </div>";
          } ?>
          <div class="content-wrapper" style="background:whitesmoke;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-ticket-percent menu-icon"></i>
                </span> Coupons
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="container-xl">
                <h3>Edit Coupon Info</h3>
                <hr>
                <form class="form" method='post'>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Coupon" name='couponname'
                    value = "<?php echo $sql['coupon_name']; ?>" required>
                    <label for="floatingInput">Coupon name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="50%" name='coupondiscount'
                    value = "<?php echo $sql['discount']; ?>" required>
                    <label for="floatingInput">Discount value</label>
                </div>
                
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="count" name='couponcount'
                    value = "<?php echo $sql['count']; ?>" required>
                    <label for="floatingInput">Coupon count</label>
                </div>
                
                    <input type="submit" class="btn btn-lg btn-outline-primary" value="Update Coupon" name='updateCoupon'>
                </div>
</form>
</div>  
</div>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>

<?php require '../views/footer.php'; ?>
