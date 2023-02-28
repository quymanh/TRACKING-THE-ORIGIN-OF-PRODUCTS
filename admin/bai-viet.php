<?php include "header-admin.php"?>

    <!-- Begin Page Content -->
        <div class="card card-body">
            <h2 class="text-center text-success font-weight-bold"><i class="fas fa-plus-circle"></i> Bài viết đã thêm</h2>
            <div class="d-flex justify-content-end">
                <a href="/them-bai-viet" class="btn btn-primary mr-3"><i class="fas fa-plus-circle"></i> Thêm bài viết</a>
            </div>
            <div id="table_all">

            </div>
            <div class="modal fade" id="delete_modal"  tabindex="-1" aria-labelledby="exampleModalLabel4" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Bạn muốn xóa bài viết?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <p>Chọn "Xóa" để xóa bài viết</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" id="delete_submit" class="btn btn-danger">Xóa</button>
                    </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
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