<?php 
include "header-admin.php";
if($_SESSION['role'] == '0' || $_SESSION['role'] == '1'){
?>
    <div class="card card-body d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-6 d-grid justify-content-center align-items-center p-0">
            <form onsubmit="return ajaxgo_dmk()" action="" method="POST" id="form_dmk">
                <label for="password" class="mb-0 col-12 col-md-12 p-0 font-weight-bold mt-3">Mật khẩu cũ :</label>
                <div class="input-group" id="show_hide_password_cu">
                    <input class="form-control" type="password" placeholder="Nhập mật khẩu mới..." name="mat_khau_cu" id="mat_khau_cu" data-toggle="password">
                    <div class="input-group-append" style="pointer-events: visible;">
                        <a type="button" class="input-group-text text-decoration-none" style="color: inherit;max-width: 43px;" ><i class="fas fa-eye-slash"></i></a>
                    </div>
                </div>
                <label for="password" class="mb-0 col-12 col-md-12 p-0 font-weight-bold mt-3">Mật khẩu mới:</label>
                <div class="input-group" id="show_hide_password">
                    <input class="form-control" type="password" placeholder="Nhập mật khẩu mới..." name="mat_khau_moi" id="mat_khau_moi" data-toggle="password">
                    <div class="input-group-append" style="pointer-events: visible;">
                        <a type="button" class="input-group-text text-decoration-none" style="color: inherit;max-width: 43px;" ><i class="fas fa-eye-slash"></i></a>
                    </div>
                </div>
                <label for="password" class="mb-0 col-12 col-md-12 p-0 font-weight-bold mt-3">Xác nhận mật khẩu mới :</label>
                <div class="input-group" id="show_hide_password_xn">
                    <input class="form-control" type="password" placeholder="Xác nhận mật khẩu mới..." name="xac_nhan_mat_khau_moi" id="xac_nhan_mat_khau_moi" data-toggle="password">
                    <div class="input-group-append" style="pointer-events: visible;">
                        <a type="button" class="input-group-text text-decoration-none" style="color: inherit;max-width: 43px;" ><i class="fas fa-eye-slash"></i></a>
                    </div>
                </div>
                <button class="btn btn-primary form-control mt-3" id="cap_nhat_mat_khau_admin">Cập nhật</button>
            </form>
        </div>
    </div>
<?php include "footer-admin.php";?>
<script>
        $(document).ready(function() {
        $("#show_hide_password_cu a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password_cu input').attr("type") == "text"){
                $('#show_hide_password_cu input').attr('type', 'password');
                $('#show_hide_password_cu i').addClass( "fa-eye-slash" );
                $('#show_hide_password_cu i').removeClass( "fa-eye" );
            }else if($('#show_hide_password_cu input').attr("type") == "password"){
                $('#show_hide_password_cu input').attr('type', 'text');
                $('#show_hide_password_cu i').removeClass( "fa-eye-slash" );
                $('#show_hide_password_cu i').addClass( "fa-eye" );
            }
        });
    });
</script>
<script>
        $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });
    });
</script>
<script>
        $(document).ready(function() {
        $("#show_hide_password_xn a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password_xn input').attr("type") == "text"){
                $('#show_hide_password_xn input').attr('type', 'password');
                $('#show_hide_password_xn i').addClass( "fa-eye-slash" );
                $('#show_hide_password_xn i').removeClass( "fa-eye" );
            }else if($('#show_hide_password_xn input').attr("type") == "password"){
                $('#show_hide_password_xn input').attr('type', 'text');
                $('#show_hide_password_xn i').removeClass( "fa-eye-slash" );
                $('#show_hide_password_xn i').addClass( "fa-eye" );
            }
        });
    });
</script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script>
        function ajaxgo_dmk () {
    // (A) GET FORM DATA
        var form = document.getElementById("form_dmk");
        var data = new FormData(form);
        data.append("mat_khau_cu", document.getElementById("mat_khau_cu").value);
        data.append("mat_khau_moi", document.getElementById("mat_khau_moi").value);
        data.append("xac_nhan_mat_khau_moi", document.getElementById("xac_nhan_mat_khau_moi").value);
        data.append("cap_nhat_mat_khau_admin", document.getElementById("cap_nhat_mat_khau_admin").value);
        // (B) AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "xu-ly-doi-mat-khau.php");
        // hat to do when server responds
        xhr.onload = function () {
            if (this.response == 1){
                $.bootstrapGrowl("Mật khẩu cũ không được để trống !", {
                    type: "danger",
                    offset: {from:"top",amount:70},
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing:10
                },2000);
            }    
            else if (this.response == 2){
                $.bootstrapGrowl("Mật khẩu mới không được để trống !", {
                    type: "danger",
                    offset: {from:"top",amount:70},
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing:10
                },2000);
                return;
            } 
            else if (this.response == 3){
                $.bootstrapGrowl("Mật khẩu xác nhận không được để trống !", {
                    type: "danger",
                    offset: {from:"top",amount:70},
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing:10
                },2000);
                return;
            } 
            else if (this.response == 4){
                $.bootstrapGrowl("Vui lòng điền Thông tin !", {
                    type: "danger",
                    offset: {from:"top",amount:70},
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing:10
                },2000);
                return;
            } 
            else if (this.response == 5){
                $.bootstrapGrowl("Sai mật khẩu cũ !", {
                    type: "danger",
                    offset: {from:"top",amount:70},
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing:10
                },2000);
                return;
            } 
            else if (this.response == 6){
                $.bootstrapGrowl("Mật khẩu mới và mật khẩu xác nhận không khớp !", {
                    type: "danger",
                    offset: {from:"top",amount:70},
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing:10
                },2000);
                return;
            } 
            else if (this.response == 7){
                $.bootstrapGrowl("Mật khẩu cũ và mật khẩu mới không thể giống nhau!", {
                    type: "danger",
                    offset: {from:"top",amount:70},
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing:10
                },2000);
                return;
            } 
            else if (this.response == 8){
                $.bootstrapGrowl("Mật khẩu phải có ít nhất 8 ký tự với 1 chữ hoa và 1 số !", {
                    type: "danger",
                    offset: {from:"top",amount:70},
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing:10
                },2000);
                return;
            } 
            else if (this.response == 10){
                $.bootstrapGrowl("Cập nhật thành công!", {
                    type: "success",
                    offset: {from:"top",amount:70},
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing:10
                },2000);
                setTimeout(function(){
                    window.location.href = '/admin/index.php"; ?>';
                }, 1200);
                return;
            };
            
        };
        xhr.send(data);

        // (C) PREVENT HTML FORM SUBMIT
        return false;
    }
    </script>
    <script src="js/modal.xu.ly.js"></script>
</html>
<?php } else { 
    header("Location: /dang-nhap");
}?>