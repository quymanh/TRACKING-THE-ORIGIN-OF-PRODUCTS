<?php include "header-blog.php" ?>

<body class="violetgradient">
    <?php
    include("navbar.php");
    ?>
    <main id="main">
        <section class="products pt-5 text-center">
            <center>
                <div class="customalert">
                    <div class="alertcontent">
                        <div id="alertText"> &nbsp </div>
                        <img id="qrious">
                        <div id="bottomText" style="margin-top: 10px; margin-bottom: 15px;"> &nbsp </div>
                        <button id="closebutton" class="formbtn"> OK </button>
                    </div>
                </div>
            </center>
        </section>
        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog products pt-5">
            <div class="container card p-3" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-8 entries text-left pag-wrapper">
                        <?php
                        $result = mysqli_query(openConnection(), "SELECT posts.posts_name,posts.url,posts.noi_dung,posts.id_users,posts.date,posts.thumbnail,users.username,users.role FROM users JOIN posts ON posts.id_users = users.username WHERE users.role = '1'");
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        ?>
                            <article class="pag-item entry">

                                <div class="entry-img">
                                    <a href="blog-detail/<?= $row['url'] ?>"><img src="img/blog/<?= $row['thumbnail'] ?>" alt="" class="w-100 img-fluid" style="background-size: cover;background-repeat: no-repeat;background-position: center center;"></a>
                                </div>

                                <h2 class="entry-title">
                                    <a href="blog-detail/<?= $row['url'] ?>"><?= $row['posts_name'] ?></a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-detail/<?= $row['url'] ?>"><?= $row['id_users'] ?></a></li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-detail/<?= $row['url'] ?>"><time datetime="<?= $row['date'] ?>"><?= $row['date'] ?></time></a></li>
                                    </ul>
                                </div>

                                <div class="entry-content overflow-hidden" style="height:90px; overflow-wrap: break-word;">
                                    <p>
                                        <?= $row['noi_dung'] ?>
                                    </p>
                                    <div class="read-more">
                                        <a href="blog-detail/<?= $row['url'] ?>">Đọc thêm</a>
                                    </div>
                                </div>

                            </article><!-- End blog entry -->
                        <?php } ?>
                        <div class="pagination">
                            <div class="pagination-container">
                                <div class="pagination-hover-overlay"></div>
                            </div>
                        </div>
                    </div><!-- End blog entries list -->

                    <div class="col-lg-4 text-left">

                        <div class="sidebar">

                            <h3 class="sidebar-title">Search</h3>
                            <div class="sidebar-item search-form">
                                <form action="">
                                    <input type="text">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div><!-- End sidebar search formn-->

                            <h3 class="sidebar-title">Categories</h3>
                            <div class="sidebar-item categories">
                                <ul>
                                    <li><a href="#">General <span>(25)</span></a></li>
                                    <li><a href="#">Lifestyle <span>(12)</span></a></li>
                                    <li><a href="#">Travel <span>(5)</span></a></li>
                                    <li><a href="#">Design <span>(22)</span></a></li>
                                    <li><a href="#">Creative <span>(8)</span></a></li>
                                    <li><a href="#">Educaion <span>(14)</span></a></li>
                                </ul>
                            </div><!-- End sidebar categories-->

                            <h3 class="sidebar-title">Recent Posts</h3>
                            <div class="sidebar-item recent-posts">
                                <?php
                                $result = mysqli_query(openConnection(), "SELECT posts.posts_name,posts.url,posts.noi_dung,posts.id_users,posts.date,posts.thumbnail,users.username,users.role FROM users JOIN posts ON posts.id_users = users.username WHERE users.role = '1' order by rand() limit 5");
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                ?>
                                    <div class="post-item clearfix">
                                        <a href="blog-detail/<?= $row['url'] ?>"><img class="img-fluid" src="img/blog/<?= $row['thumbnail'] ?>" alt=""></a>
                                        <h4><a href="blog-detail/<?= $row['url'] ?>"><?= $row['posts_name'] ?></a></h4>
                                        <time datetime="<?= $row['date'] ?>"><?= $row['date'] ?></time>
                                    </div>
                                <?php } ?>
                            </div><!-- End sidebar recent posts-->
                            <h3 class="sidebar-title">Tags</h3>
                            <div class="sidebar-item tags">
                                <ul>
                                    <li><a href="#">App</a></li>
                                    <li><a href="#">IT</a></li>
                                    <li><a href="#">Business</a></li>
                                    <li><a href="#">Mac</a></li>
                                    <li><a href="#">Design</a></li>
                                    <li><a href="#">Office</a></li>
                                    <li><a href="#">Creative</a></li>
                                    <li><a href="#">Studio</a></li>
                                    <li><a href="#">Smart</a></li>
                                    <li><a href="#">Tips</a></li>
                                    <li><a href="#">Marketing</a></li>
                                </ul>
                            </div><!-- End sidebar tags-->

                        </div><!-- End sidebar -->

                    </div><!-- End blog sidebar -->

                </div>

            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->
    <div class='box'>
        <div class='wave -one'></div>
        <div class='wave -two'></div>
        <div class='wave -three'></div>
    </div>
    <?php include "footer.php" ?>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Material Design Bootstrap-->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>

    <script src="web3.min.js"></script>
    <script src="app.js"></script>
    <script type="text/javascript" src="js/jquery.simplePagination.js"></script>
    <script type="text/javascript" src="js/paginationCss.js"></script>
    <script>
        var items = $(".pag-wrapper .pag-item");
        var numItems = items.length;
        var perPage = 4;
        items.slice(perPage).hide();
        $('.pagination-container').pagination({
            items: numItems,
            itemsOnPage: perPage,
            prevText: "&laquo;",
            nextText: "&raquo;",
            onPageClick: function(pageNumber) {
                var showFrom = perPage * (pageNumber - 1);
                var showTo = showFrom + perPage;
                items.hide().slice(showFrom, showTo).show();
            }
        });
        $("#closebutton").on("click", function() {
            $(".customalert").hide("fast", "linear");
        });

        function showAlert(message) {
            $("#alertText").html(message);
            $("#qrious").hide();
            $("#bottomText").hide();
            $(".customalert").show("fast", "linear");
        }

        $("#aboutbtn").on("click", function() {
            showAlert("Meloweb là một Ứng dụng lưu trữ vị trí của sản phẩm tại mọi trung tâm vận chuyển hàng hóa trên Blockchain. Ở phía người tiêu dùng, khách hàng có thể chỉ cần quét MÃ QR của sản phẩm và nhận thông tin đầy đủ về nguồn gốc của sản phẩm đó, do đó trao quyền cho người tiêu dùng chỉ mua các sản phẩm chính hãng và chất lượng.");
        });
    </script>