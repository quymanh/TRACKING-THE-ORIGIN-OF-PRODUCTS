<?php include "header-admin.php" ?>
<!-- Begin Page Content -->
<div class="card card-body">
    <h2 class="text-center text-success font-weight-bold"><i class="fas fa-plus-circle"></i> Thêm bài viết</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="/bai-viet-admin" class="btn btn-primary"><i class="fas fa-sign-out-alt"></i> Quay lại</a>
    </div>
    <form id="myForm_bai_viet_big" onsubmit="return ajaxgo_bai_viet_big()" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 col-md-12">
                <p class="mb-0 font-weight-bold">Tên Bài viết :</p>
                <input type="text" class="form-control rounded" maxlength="100" name="ten_bai_viet" id="ten_bai_viet" placeholder="Nhập tên Bài viết">
            </div>
            <div class="col-12 col-md-12 mt-3">
                <p class="mb-0 font-weight-bold">Nội dung Bài viết :</p>
                <textarea type="text" name="nd_bai_viet" id="nd_bai_viet" class="form-control rounded" rows="10" cols="80"></textarea>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-md-6">
                <p class="mb-0 font-weight-bold">Thumbnail Bài viết :</p>
                <div class="drop-zone">
                    <span class="drop-zone__prompt">Thả ảnh hiển thị vào đây hoặc nhấp để tải lên</span>
                    <input type="file" name="thumbnail_bai_viet" id="thumbnail_bai_viet" class="drop-zone__input">
                </div>
            </div>
        </div>
        <hr>
        <div class="row mt-3">
            <div class="col-12 col-md-12">
                <button type="submit" name="submit_them_bai_viet_big" id="submit_them_bai_viet_big" class="btn btn-primary form-control submit_on_enter"><i class="fas fa-plus-circle"></i> Thêm Bài viết</button>
            </div>
        </div>
    </form>
</div>
<?php include "footer-admin.php" ?>
<script src="js/drop.zone.js"></script>
<script src="js/summernote-bs4.min.js"></script>
<script>
    $('#nd_bai_viet').summernote({
        placeholder: 'Mời bạn nhập nội dụng',
        tabsize: 1,
        height: 300,
        lineWrapping: true
    });
</script>
<script>
    function ajaxgo_bai_viet_big() {
        // (A) GET FORM DATA
        var form_con = document.getElementById("myForm_bai_viet_big");
        var data = new FormData(form_con);
        var username = '<?= $_SESSION['username'] ?>';
        data.append("thumbnail_bai_viet", document.getElementById("thumbnail_bai_viet").value);
        data.append("ten_bai_viet", document.getElementById("ten_bai_viet").value);
        data.append("id_user", username);
        data.append("nd_bai_viet", document.getElementById("nd_bai_viet").value);
        data.append("submit_them_bai_viet_big", document.getElementById("submit_them_bai_viet_big").value);
        // (B) AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "xu-ly-them-bai-viet.php");
        // hat to do when server responds
        xhr.onload = function() {
            console.log(this.response);
            if (this.response == 1) {
                $.bootstrapGrowl("Tên Bài viết không được để trống !", {
                    type: "danger",
                    offset: {
                        from: "bottom",
                        amount: 550
                    },
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing: 10
                }, 2000);
                return;
            } else if (this.response == 4) {
                $.bootstrapGrowl("Nội dung Bài viết không được để trống !", {
                    type: "danger",
                    offset: {
                        from: "bottom",
                        amount: 550
                    },
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing: 10
                }, 2000);
                return;
            } else if (this.response == 5) {
                $.bootstrapGrowl("Tên bài viết đã tồn tại, vui lòng dặt tên khác !", {
                    type: "danger",
                    offset: {
                        from: "bottom",
                        amount: 550
                    },
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing: 10
                }, 2000);
                return;
            } else if (this.response == 6) {
                $.bootstrapGrowl("Thumbnail không được để trống !", {
                    type: "danger",
                    offset: {
                        from: "bottom",
                        amount: 550
                    },
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing: 10
                }, 2000);
                return;
            } else if (this.response == 10) {
                $.bootstrapGrowl("Thêm Bài viết thành công!", {
                    type: "success",
                    offset: {
                        from: "bottom",
                        amount: 550
                    },
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing: 10
                }, 2000);
                form_con.reset();
                return;
            };
        };
        xhr.send(data);
        // (C) PREVENT HTML FORM SUBMIT
        return false;
    }
</script>
<script src="js/modal.xu.ly.js"></script>