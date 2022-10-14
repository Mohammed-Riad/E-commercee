<?php
require_once '../../views/connection.php';

$coupons = $connect->query('SELECT * FROM coupons');
$coupons = $coupons->fetchAll();
?>


<?php require 'header.php'; ?>
<div class="container-fluid page-body-wrapper">
<?php require 'sidebar.php'; ?>

<div class="main-panel">
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
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
                        <h2>Coupons</h2>
                    </div>
                    <div class="col-sm-7">
                        <a href="../control/addCoupon.php" class="btn btn-secondary bttn"><i class="material-icons">&#xE147;</i> <span>Add New Coupon</span></a>					
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Coupon ID</th>
                        <th>Coupon name</th>			
                        <th>Discount value</th>			
                        <th>Count</th>						
                        <th>Actions</th>						
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($coupons as $coupon) { ?>
                    <tr>
                        <td><?php echo $coupon['coupon_id']; ?></td>
                        <td><?php echo $coupon['coupon_name'];?></td>
                        <td><?php echo $coupon['discount']; ?></td>
                        <td><?php echo $coupon['count']; ?></td>

                        <td>
                            <a href="../control/editCoupon.php?id=<?php echo $coupon['coupon_id']; ?>"
                             class="settings" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>    
                        </td>
                    </tr>
                    <div id="deleteEmployeeModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form>
                                    <div class="modal-header">						
                                        <h4 class="modal-title">Delete Coupon</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    </div>
                                    <div class="modal-body">					
                                        <p>Are you sure you want to delete these Records?</p>
                                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                        <a href="../control/deleteCoupon.php?id=<?php echo $coupon[
                                            'coupon_id'
                                        ]; ?>" title="Delete" data-toggle="tooltip" class="delete btn btn-danger">Delete</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>  
</div>


<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if (isset($_GET['d'])) { ?>
<script>
    swal.fire("Success , You Deleted This Coupon");
    
</script>
<?php } ?>

<?php require 'footer.php'; ?>
