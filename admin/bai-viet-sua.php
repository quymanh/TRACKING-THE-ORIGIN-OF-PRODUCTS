<?php include "header-admin.php"?>
    <!-- Begin Page Content -->
        <div class="card card-body">
            <h2 class="text-center text-success font-weight-bold"><i class="fas fa-plus-circle"></i> Cập nhật bài viết</h2>
                <div class="d-flex justify-content-end mb-3">
                    <a href="/bai-viet-admin" class="btn btn-primary"><i class="fas fa-sign-out-alt"></i> Quay lại</a>
                </div>
                <form id="myForm_bai_viet_big" onsubmit="return ajaxgo_bai_viet_big()" method="POST" enctype="multipart/form-data">
                <?php
                    $statement_baiviet = $pdo->prepare("SELECT * FROM posts WHERE id_posts = ?");
                    $statement_baiviet->execute(array($_REQUEST['ma_bai_viet']));
                    $total_check = $statement_baiviet->rowCount();
                    $resul_baiviet = $statement_baiviet->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($resul_baiviet as $row_baiviet) {
                ?>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <p class="mb-0 font-weight-bold">Tên Bài viết :</p>
                        <input type="text" class="form-control rounded" name="ten_bai_viet" value="<?=$row_baiviet['posts_name']?>" id="ten_bai_viet" placeholder="Nhập tên Bài viết">
                    </div>
                    <div class="col-12 col-md-12 mt-3">
                        <p class="mb-0 font-weight-bold">Nội dung Bài viết :</p>
                        <textarea type="text" name="nd_bai_viet" id="nd_bai_viet" class="form-control rounded" rows="10" cols="80"><?=$row_baiviet['noi_dung']?></textarea>
                    </div>
                    <div class="col-md-6 mt-3">
                        <p class="m-0">Thumbnail</p>
                        <div class="border border-2 p-3 d-flex justify-content-between align-items-center" >
                            <div>
                                <label for="new_thumbnail" class="filupp">
                                    <span class="filupp-file-name js-value-2">Cập nhật ảnh</span>
                                    <input type="file" class="form-control img-logo border-0" name="new_thumbnail" value="1" id="new_thumbnail"/>
                                </label>
                            </div>
                            <img class="img-fluid bg-primary" width="50px" height="50px" id="old_thumbnail"  src="../../img/blog/<?=$row_baiviet['thumbnail'];?>" alt="your image" />
                        </div>
                    </div>
                </div>
                
                <hr>
                <div class="row mt-3">
                    <div class="col-12 col-md-12">
                        <button type="submit" name="submit_them_bai_viet_big" id="submit_them_bai_viet_big" class="btn btn-primary form-control submit_on_enter"><i class="fas fa-plus-circle"></i> Cập nhật Bài viết</button>
                    </div>
                </div>
                <?php } ?>
            </form>  
        </div>
    <?php include "footer-admin.php"?>
    <script src="js/drop.zone.js"></script>
    <script src="js/summernote-bs4.min.js"></script>
    <script>
            var new_thumbnail = document.getElementById("new_thumbnail");
            new_thumbnail.onchange = evt => {
            const [file] = new_thumbnail.files
                if (file) {
                    old_thumbnail.src = URL.createObjectURL(file)
                }
            }
            // get the name of uploaded file
            $('input[id="new_thumbnail"]').change(function(){
                var value = $("input[id='new_thumbnail']").val();
                $('.js-value').text(value);
            });
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
        
        data.append("new_thumbnail", document.getElementById("new_thumbnail").value);
        data.append("ten_bai_viet", document.getElementById("ten_bai_viet").value);
        data.append("nd_bai_viet", document.getElementById("nd_bai_viet").value);
        data.append("submit_them_bai_viet_big", document.getElementById("submit_them_bai_viet_big").value);
        // (B) AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "xu-ly-sua-bai-viet.php?mbv=<?=$_REQUEST['ma_bai_viet']?>");
        // hat to do when server responds
        xhr.onload = function () {
            console.log(this.response);
            if (this.response == 1){
                $.bootstrapGrowl("Tên Bài viết không được để trống !", {
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
            else if (this.response == 4){
                $.bootstrapGrowl("Nội dung Bài viết không được để trống !", {
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
            else if (this.response == 3){
                $.bootstrapGrowl("Vui lòng chọn trang hiển thị !", {
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
            else if (this.response == 5){
                $.bootstrapGrowl("URL đã tồn tại, vui lòng dặt URL khác !", {
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

            else if (this.response == 6){
                $.bootstrapGrowl("Thumbnail không được để trống !", {
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

            else if (this.response == 7){
                $.bootstrapGrowl("Vui lòng chọn mục bài viết !", {
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
                $.bootstrapGrowl("Cập nhật Bài viết thành công!", {
                    type: "success",
                    offset: {from:"bottom",amount:550},
                    align: "right",
                    width: 'auto',
                    delay: 3000,
                    allow_dismiss: true,
                    stackup_spacing:10
                },2000);
                return;
            };
        };
        xhr.send(data);
        // (C) PREVENT HTML FORM SUBMIT
        return false;
    }
    </script>
    <script src="js/modal.xu.ly.js"></script>