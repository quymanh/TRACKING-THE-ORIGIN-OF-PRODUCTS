<nav class="navbar navbar-expand-lg navbar-light white" style="position: fixed; width: 100%;z-index: 20;">
  <a class="navbar-brand" href="">
    <img src="img/overlays/logo.png" style="width: 30px;"> &nbsp
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon" style="color: #4287f5;"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end font-weight-normal" id="basicExampleNav">
    <ul class="navbar-nav m-auto align-items-center">
      <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL ?>">Trang chủ</a>
      </li>
      <?php
      if (isset($_SESSION['role'])) {
      ?>
        <?php
        if ($_SESSION['role'] == 1 || $_SESSION['role'] == 0) {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="addproduct.php">Thêm sản phẩm</a>
          </li>
        <?php
        }
        if ($_SESSION['role'] == 0) {
        ?>
          <li class="nav-item">
            <a class="nav-link" href="admin/index.php">Trang quản lý</a>
          </li>
          <!--<li class="nav-item">
        <a class="nav-link" href="scanshipment.php">Quét lô hàng</a>
      </li> -->
      <?php
        }
      }
      ?>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Bài viết
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="blog.php">
            <i class="fas fa-newspaper fa-sm fa-fw mr-2 text-gray-400"></i>
            Tin tức
          </a>
          <a class="dropdown-item" href="blog-producer.php">
            <i class="fas fa-users-cog fa-sm fa-fw mr-2 text-gray-400"></i>
            Từ nhà sản xuất
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="aboutbtn"> Về chúng tôi </a>
      </li>
    </ul>

    <form class="form-inline">

      <div class="md-form my-0">
        <?php
        if (isset($_SESSION['role'])) {
        ?>
          <div class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Trang quản lý
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <?php
              if ($_SESSION['role'] == '0' || $_SESSION['role'] == '1') {
              ?>
                <a class="dropdown-item" href="/admin/bai-viet.php">
                  <i class="fas fa-file-medical fa-sm fa-fw mr-2 text-gray-400"></i>
                  Thêm bài viết
                </a>
              <?php
              }
              ?>
              <a class="dropdown-item" href="/admin/doi-mat-khau.php">
                <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                Đổi mật khẩu
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Đăng xuất
              </a>
            </div>
          </div>
        <?php
        } else {
        ?>
          <a class="nav-link" href="login-page.php" style="padding-left:5px;padding-right:5px;margin-left:0px;"> Đăng nhập </a>
        <?php
        }
        ?>
      </div>
    </form>

  </div>
</nav>