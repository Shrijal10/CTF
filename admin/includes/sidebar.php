  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="assests/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Super Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assests/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Bhavesh Chaudhary</a>
        </div>
      </div><aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="assests/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Super Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assests/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block dropdown-toggle" data-toggle="dropdown">
            Super Admin
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="javascript:logout()">Logout</a>
          </div>
        </div>
      </div>
      <script>
        function logout() {
          $.ajax({
            type: "POST",
            url: "logout_admin.php",
            success: function(response) {
              window.location.href = "admin_login.php";
            }
          });
        }
      </script>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="manage_challenges.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Manage Challenges
                <i class="right fas fa-angle"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="add_images.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Add Images
                <i class="right fas fa-angle"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="manage_users.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Add User
                <i class="right fas fa-angle"></i>
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="manage_teams.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Manage Teams
                <i class="right fas fa-angle"></i>
              </p>
            </a>
          </li>
          <li class="nav-header">Settings</li>
          <li class="nav-item">
            <a href="history.php" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Admin profile
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="registered.php" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Registered User
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>