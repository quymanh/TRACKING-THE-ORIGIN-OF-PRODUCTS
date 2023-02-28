<?php
include "connectdb.php";
do {
    if ($_POST['action'] == 'fetch') {
        $output = ' <div class="post-area pt-3" id="trending">
                <div class="container">
            <div class="pt-3 pb-3" id="grid">
                <div class="container">
                    <div class="row">';
        $result = mysqli_query(openConnection(), "SELECT posts.posts_name,posts.url,posts.noi_dung,posts.id_users,posts.date,posts.thumbnail,users.username,users.role FROM users JOIN posts ON posts.id_users = users.username WHERE users.role = '0'");
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $output .= '
                        <a href="' . BASE_URL . "blog-detail/" . $row['url'] . '">
                            <div class="col-lg-3 col-sm-6">
                                    <div class="single-post-wrap style-overlay">
                                            <div class="thumb">
                                                <img src="img/blog/' . $row['thumbnail'] . '" alt="img" class="w-100" style="max-height:150px;object-fit:cover;">
                                                <a class="tag-base tag-purple" href="' . BASE_URL . "blog-detail/" . $row['url'] . '">Tech</a>
                                            </div>
                                        <div class="details">
                                            <div class="post-meta-single">
                                                <p><i class="fa fa-clock-o"></i>' . $row['date'] . '</p>
                                            </div>
                                            <h6 class="title text-wrap" ><a style="text-overflow: ellipsis;display: -webkit-box;
                                            -webkit-line-clamp: 2; /* number of lines to show */
                                                    line-clamp: 2; overflow: hidden;
                                            -webkit-box-orient: vertical; height: 50px" href="' . BASE_URL . "blog-detail/" . $row['url'] . '">' . $row['posts_name'] . '</a></h6>
                                        </div>
                                    </div>
                            </div>
                        </a>
                        ';
        }
        $output .= '</div>
                </div>  
            </div>';
        echo $output;
        break;
    }
} while (false);
?>
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsiveNews.css">