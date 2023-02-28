<?php include "header-admin.php"?>
<?php if ($_SESSION['role'] == '0') { ?>
    <!-- Begin Page Content -->
        <div class="card card-body">
            <h2 class="text-center text-success font-weight-bold"><i class="fas fa-plus-circle"></i> Tài khoản đã thêm</h2>
            <div class="table-reponsive">
                <table class="table table-bordered text-center w-100 mydatatable mt-3">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $statement_users = $pdo->prepare("SELECT * FROM users WHERE role != 0");
                            $statement_users->execute();
                            $resul_users = $statement_users->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($resul_users as $row) {
                        ?>
                        <tr>
                            <td><?=$row['email']?></td>
                            <td><?=$row['username']?></td>
                            <td><?php if ($row['role'] == 1){ echo "Nhà sản xuất";} if ($row['role'] == 2){ echo "Khách hàng";};?></td>
                            <td>
                                <a href="edit-account.php?id_acc=<?=$row['id']?>" class="btn btn-primary">Sửa</a>
                                <a href="xu-ly-xoa-tai-khoan.php?id_acc=<?=$row['id']?>" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>            
                </table>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php include "footer-admin.php"?>
    <script src="js/dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script src="js/modal.xu.ly.js"></script>
    <script>
        load_table();
        function load_table()
        {
            var action = "fetch";
            $.ajax({
            url:"xu-ly-show-table-all.php",
            method:"POST",
            data:{action:action},
            success:function(data)
            {
                $('#table_all').html(data);
            }
            });
        }
        $('.mydatatable').DataTable({
                pagingType: 'full_numbers',
                    initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select class="form-control text-center"><option value="" selected disabled hidden>Tất cả</option><option value="">Tất cả</option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );

                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }
            });
            $(document).on("click", ".delete", function(){
                var id_baiviet = $(this).data("number");
                var action = "delete";
                $('#delete_modal').modal("show");
                $("#delete_submit").click(function (){
                    $.ajax({
                        url:"xu-ly-xoa-bai-viet.php",
                        method:"POST",
                        data:{id_baiviet:id_baiviet, action:action},
                        success:function(data)
                        {
                            if (data == 10){
                                $('#delete_modal').modal('hide');
                                $.bootstrapGrowl("Xóa Bài viết thành công!", {
                                type: "success",
                                offset: {from:"bottom",amount:550},
                                align: "right",
                                width: 'auto',
                                delay: 3000,
                                allow_dismiss: true,
                                stackup_spacing:10
                                },2000);
                                load_table();
                                return;
                            }
                        }
                    });
                });
            });
    </script>