<?php
session_start();
include "../connectdb.php";
include "config-admin.php";
do {
    if ($_SESSION['role'] == '0' || $_SESSION['role'] == '1') {
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'fetch') {
                $output = '<table class="table table-bordered text-center w-100 mydatatable mt-3">
                                    <thead>
                                        <tr>
                                            <th>Tên bài viết</th>
                                            <th>Thumbnail</th>
                                            <th>URL</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Tên bài viết</th>
                                            <th>Thumbnail</th>
                                            <th>URL</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>';
                $statement_bv = $pdo->prepare("SELECT * FROM posts WHERE id_users = ?");
                $statement_bv->execute(array($_SESSION['username']));
                $resul_bv = $statement_bv->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resul_bv as $row_bv) {
                    $output .= '<tr>';
                    $output .= '<td>' . $row_bv['posts_name'] . '</td>';
                    $output .= '<td><img src="../img/blog/' . $row_bv['thumbnail'] . '" class="img-thumbnail" style="max-height: 100px;" alt="thumbnail"></td>';
                    $output .= '<td><a href="' . BASE_URL . 'blog-detail/' . $row_bv['url'] . '" target="_blank">' . $row_bv['url'] . '</a></td>';
                    $output .= '<td>';
                    $output .= '<div class="d-flex align-items-center justify-content-center">';
                    $output .= '<button class="btn btn-danger mr-1 delete" data-number="' . $row_bv['id_posts'] . '">Xóa</button>';
                    $output .= '<a href="/sua-bai-viet/' . $row_bv['id_posts'] . '" class="btn btn-primary">Sửa</a>';
                    $output .= '</div>';
                    $output .= '</td>';
                }
                echo $output;
                break;
            }
        }
    } else {
        header("Location: /dang-nhap");
    }
} while (false);
?>
<script src="js/dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script>
    $('.mydatatable').DataTable({
        pagingType: 'full_numbers',
        initComplete: function() {
            this.api().columns().every(function() {
                var column = this;
                var select = $('<select class="form-control text-center"><option value="" selected disabled hidden>Tất cả</option><option value="">Tất cả</option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function(d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }
    });
</script>