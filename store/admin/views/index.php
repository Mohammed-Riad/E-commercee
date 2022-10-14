<?php require 'header.php'; ?>
<?php
$users = $connect->query('SELECT * FROM users');
$users = $users->fetchAll();
$orders = $connect->query('SELECT * FROM orders ORDER BY order_id DESC');
$orders = $orders->fetchAll();
$products = $connect->query('SELECT * FROM products ORDER BY product_id DESC');
$products = $products->fetchAll();
$coupons = $connect->query('SELECT * FROM coupons');
$coupons = $coupons->fetchAll();
?>

  <div class="container-fluid page-body-wrapper">
    <?php require 'sidebar.php'; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper" style="background:whitesmoke;">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total users<i class="mdi mdi-account-group " style="font-size: 70px;margin-left: 5px;position: absolute;"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo count($users); ?></h2>
                    <h6 class="card-text">Increased by 5%</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Orders <i class="fa-regular fa-credit-card " style="font-size: 70px;margin-left: 10px;position: absolute;"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo count($orders); ?></h2>
                    <h6 class="card-text">Increased by 5%</h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total products<i class="mdi mdi-library-books " style="font-size: 70px;margin-left: 5px;position: absolute;"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo count($products); ?></h2>
                    <h6 class="card-text">Increased by 5%</h6>
                  </div>
                </div>
              </div>
            </div>
             <!-- ********************** -->
             <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">latest orders</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Order number </th>
                            <th> Customer </th>
                            <th> Date </th>
                            <th> Total Price </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 0;
                          foreach ($orders as $order) {

                              $i++;
                              $curUserId = $order['user_id'];
                              $curUser = $connect->query(
                                  "SELECT * FROM users WHERE user_id='$curUserId'"
                              );
                              $curUser = $curUser->fetch();
                              if ($i == 5) {
                                  break;
                              }
                              ?>
                          <tr>
                            <td><?php echo $order['order_id']; ?></td>
                            <td><?php echo $curUser['first_name'] .
                                ' ' .
                                $curUser['last_name']; ?></td>
                            <td><?php echo $order['order_date']; ?></td>
                            <td><?php echo $order['total_price']; ?></td>
                          </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ********************** -->
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">recent products</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Product ID </th>
                            <th> Product Name </th>
                            <th> Price </th>
                            <th> category </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php for ($i = 0; $i < $products; $i++) {

                            $curCatId = $products[$i]['category_id'];
                            $curCat = $connect->query(
                                "SELECT * FROM categories WHERE category_id='$curCatId'"
                            );
                            $curCat = $curCat->fetch();
                            if ($i == 5) {
                                break;
                            }
                            ?>
                          <tr>
                            <td><?php echo $products[$i]['product_id']; ?></td>
                            <td><?php echo $products[$i][
                                'product_name'
                            ]; ?></td>
                            <td><?php echo $products[$i]['price']; ?></td>
                            <td><?php echo $curCat['category_name']; ?></td>
                          </tr>
                          <?php
                        } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-black">To do List</h4>
                    <div class="add-items d-flex">
                      <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
                      <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn" id="add-task">Add</button>
                    </div>
                    <div class="list-wrapper">
                      <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Meeting with Alisa </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li class="completed">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox" checked> Call John </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Create invoice </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Print Statements </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li class="completed">
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox" checked> Prepare for presentation </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Pick up kids from school </label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ********************** -->


    </div>
        <?php require 'footer.php'; ?>
