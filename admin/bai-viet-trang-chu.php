<?php include "header-admin.php"?>
    <!-- Begin Page Content -->
        <div class="card card-body">
            <h2 class="text-center text-success font-weight-bold"><i class="fas fa-plus-circle"></i> Thêm bài viết Trang chủ</h2>
                <div class="d-flex justify-content-end">
                    <a href="/bai-viet" class="btn btn-primary mr-3"><i class="fas fa-sign-out-alt"></i> Quay lại</a>
                </div>
                <form id="myForm_bai_viet_big" onsubmit="return ajaxgo_bai_viet_big()" method="POST" enctype="multipart/form-data">
                <div class="row" id="show_select">

                </div>
                <hr>
                <div class="row mt-3">
                    <div class="col-12 col-md-12">
                        <button type="submit" name="submit_them_bai_viet_big" id="submit_them_bai_viet_big" class="btn btn-primary form-control submit_on_enter"><i class="fas fa-plus-circle"></i> Thêm Bài viết</button>
                    </div>
                </div>
            </form>  
        </div>
        <div class="card card-body mt-3" id="table_show">
            
        </div>
    <?php include "footer-admin.php"?>
    <script src="js/drop.zone.js"></script>
    <script src="js/summernote-bs4.min.js"></script>
    <script src="js/dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>

    <script>
        load_table();
        function load_table()
        {
            var action = "fetch";
            $.ajax({
            url:"xu-ly-show-table.php",
            method:"POST",
            data:{action:action},
            success:function(data)
            {
                $('#table_show').html(data);
            }
            });
        }

        load_seclect();                            
        function load_seclect()
        {
            var action = "select";
            $.ajax({
            url:"xu-ly-show-select.php",
            method:"POST",
            data:{action:action},
            success:function(data)
            {
                $('#show_select').html(data);
            }
            });
        }
    </script>
    <script>
        $('#nd_bai_viet').summernote({
            placeholder: 'Mời bạn nhập nội dụng',
            tabsize: 1,
            height: 300,
            lineWrapping: true
        });
    </script>
    <script>
        function ajaxgo_bai_viet_big () {
    // (A) GET FORM DATA
        var form_con = document.getElementById("myForm_bai_viet_big");
        var data = new FormData(form_con);
        var action = "";
        
        data.append("action", action);
        data.append("id_bai_viet", document.getElementById("id_bai_viet").value);
        data.append("bv_thuoc", document.getElementById("bv_thuoc").value);
        data.append("submit_them_bai_viet_big", document.getElementById("submit_them_bai_viet_big").value);
        // (B) AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "xu-ly-them-bv-trang-chu.php");
        // hat to do when server responds
        xhr.onload = function () {
            if (this.response == 1){
                $.bootstrapGrowl("Vui lòng chọn bài viết !", {
                    type: "danger",
                    offset: {from:"bottom",amount:550},
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing:10
                },2000);
                return;
            }    
            else if (this.response == 2){
                $.bootstrapGrowl("Vui lòng chọn mục tin !", {
                    type: "danger",
                    offset: {from:"bottom",amount:550},
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing:10
                },2000);
                return;
            }
            else if (this.response == 10){
                $.bootstrapGrowl("Thêm Bài viết thành công!", {
                    type: "success",
                    offset: {from:"bottom",amount:550},
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing:10
                },2000);
                form_con.reset();
                load_table();
                load_seclect();
                return;
            };
        };
        xhr.send(data);
        // (C) PREVENT HTML FORM SUBMIT
        return false;
    }
    </script>
    <script src="js/modal.xu.ly.js"></script>