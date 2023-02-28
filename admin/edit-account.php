<?php include "header-admin.php" ?>
<main class="content">
    <div class="card card-body">
        <h1 class="fw-bold text-center text-success text-uppercase">Cập nhật tài khoản</h1>
        <form id="myForm" onsubmit="return ajax_form_lh()" method="POST" enctype="multipart/form-data">
            <?php
            $statement = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $statement->execute(array($_GET['id_acc']));
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
            ?>
                <div class="row">
                    <div class="col-12 col-md-6 mt-3">
                        <p class="mb-0">Email :</p>
                        <input type="text" value="<?= $row['email'] ?>" class="form-control rounded" name="email_qm" id="email_qm" placeholder="Email...">
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <p class="mb-0">Username :</p>
                        <input type="text" value="<?= $row['username'] ?>" class="form-control rounded" name="username_qm" id="username_qm" placeholder="Nhập địa chỉ...">
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <p class="mb-0">Mật khẩu :</p>
                        <input type="text" value="<?= $row['password'] ?>" class="form-control rounded" name="password_qm" id="password_qm" placeholder="Nhập Email...">
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <p class="mb-0">Vai trò :</p>
                        <select type="text" class="form-control rounded" name="role_qm" id="role_qm" placeholder="Nhập số điện thoại...">
                            <option value="1" <?php if ($row['role'] == "1") echo "selected"; ?>>Nhà sản xuất</option>
                            <option value="2" <?php if ($row['role'] == "2") echo "selected"; ?>>Khách hàng</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-12 mt-3 p-0">
                    <button class="btn btn-primary form-control" type="submit" name="cn_form" id="cn_form">Cập nhật</button>
                </div>
            <?php } ?>
        </form>
    </div>
</main>
<?php include "footer-admin.php" ?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    function ajax_form_lh() {
        // (A) GET FORM DATA
        var form = document.getElementById("myForm");
        var data = new FormData(form);
        data.append("email_qm", document.getElementById("email_qm").value);
        data.append("username_qm", document.getElementById("username_qm").value);
        data.append("role_qm", document.getElementById("role_qm").value);
        data.append("password_qm", document.getElementById("password_qm").value);
        data.append("cn_form", document.getElementById("cn_form").value);
        // (B) AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "xu-ly-form-lien-he.php?id_qm=<?= $row['id'] ?>");
        // hat to do when server responds
        xhr.onload = function() {
            if (this.response == 1) {
                $.notify({
                    icon: 'bi bi-exclamation-circle',
                    title: 'Lỗi',
                    message: 'Email không được để trống !',
                    allow_dismiss: true,
                });
                return;
            } else if (this.response == 2) {
                $.notify({
                    icon: 'bi bi-exclamation-circle',
                    title: 'Lỗi',
                    message: 'Username không được để trống !',
                    allow_dismiss: true,
                });
                return;
            } else if (this.response == 3) {
                $.notify({
                    icon: 'bi bi-exclamation-circle',
                    title: 'Lỗi',
                    message: 'Mật khẩu không được để trống !',
                    allow_dismiss: true,
                });
                return;
            } else if (this.response == 4) {
                $.notify({
                    icon: 'bi bi-exclamation-circle',
                    title: 'Lỗi',
                    message: 'Vai trò không được để trống !',
                    allow_dismiss: true,
                });
                return;
            } else if (this.response == 10) {
                $.notify({
                    icon: 'bi bi-check-circle-fill',
                    title: 'Thành công',
                    message: 'Thêm thành công !',
                    allow_dismiss: true,
                }, {
                    type: "success",
                });
                return;
            };

        };
        xhr.send(data);

        // (C) PREVENT HTML FORM SUBMIT
        return false;
    }
</script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap-notify.min.js"></script>