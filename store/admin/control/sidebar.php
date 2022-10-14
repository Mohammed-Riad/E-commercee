      <!-- partial -->
      
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?php echo $curUser[
                      'first_name'
                  ] .
                      ' ' .
                      $curUser['last_name']; ?></span>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../views/index.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../views/users.php">
                <span class="menu-title">Users</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../views/categories.php">
                <span class="menu-title">Categories</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../views/products.php">
                <span class="menu-title">Products</span>
                <i class="uil uil-archive menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../views/orders.php">
                <span class="menu-title">Orders</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../views/coupons.php">
                <span class="menu-title">coupons</span>
                <i class="mdi mdi-ticket-percent menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
      