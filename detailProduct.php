<?php session_start();
include("header.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

<body class="violetgradient">
  <?php
  include("navbar.php");
  ?>
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
  <section class="products pt-5 text-center">
    <form role="form" autocomplete="off" class="pt-5">
      <input type="text" id="searchText" class="searchBox" placeholder="Enter Product Code" onkeypress="isInputNumber(event)" required>
      <label class=qrcode-text-btn style="width:4%;display:none;">
        <input type=file accept="image/*" id="selectedFile" style="display:none" capture=environment onchange="openQRCamera(this);" tabindex=-1>
      </label>
      <label class=barCode-text-btn style="width:4%;display:none;">
        <input type=file accept="image/*" id="searchBarCode" style="display:none" capture=environment tabindex=-1>
      </label>
      <button type="submit" id="searchButton" class="searchBtn"><i class="fa fa-search"></i></button>
    </form>
    <button class="qrbutton mb-1" onclick="document.getElementById('selectedFile').click();">
      <i class='fa fa-qrcode'></i> Scan QR
    </button>
    <button class="qrbutton mb-1" onclick="document.getElementById('searchBarCode').click();">
      <i class="fa fa-barcode"></i> Scan BarCode
    </button>
    <center>
      <div class="LoadWaiting mt-3 mb-3"><span></span><span></span><span></span></div>
      <section id="database" class="container cardResearch text-left">
      </section>
    </center>
  </section>
  <div class="pd-wrap m-3">
    <div class="card container">
      <div class="heading-section">
        <h2 class="font-weight-bold">Chi tiết sản phẩm</h2>
      </div>
      <div class="p-3">
        <div class="row justify-content-center p-3 card-body rounded shadow" id="showDetail">

        </div>
      </div>
      <div class="product-info-tabs">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews (0)</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade " id="description" role="tabpanel" aria-labelledby="description-tab">

          </div>
          <div class="tab-pane show active" id="review" role="tabpanel" aria-labelledby="review-tab">
            <div class="review-heading">REVIEWS</div>
            <div class="card p-3 mt-3">
              <div id="RateScore">

              </div>
              <div class="row align-items-center justify-content-left d-flex">
                <div class="col-md-4 d-flex align-items-center flex-column">
                  <div class="rating-box text-center rounded">
                    <h1 class="pt-4 mb-0 font-weight-bold" id="percentCount"></h1>
                    <div class="d-flex justify-content-center">
                      <p class="mr-1 m-0 p-0">5 <i class='fa fa-star'></i> </p>
                    </div>
                    <div class="d-flex justify-content-center">
                      <p class="mr-1 m-0 p-0" id="totalRate"></p>
                      <p class="mr-1 m-0 p-0"> Reviews</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="rating-bar0 justify-content-center">
                    <table class="text-left mx-auto">
                      <tr>
                        <td class="rating-label">Excellent</td>
                        <td class="rating-bar">
                          <div class="bar-container">
                            <div class="bar-5" id="bar-5" style="width: 0%;"></div>
                          </div>
                        </td>
                        <td class="text-right" id="fiveStar2"></td>
                      </tr>
                      <tr>
                        <td class="rating-label">Good</td>
                        <td class="rating-bar">
                          <div class="bar-container">
                            <div class="bar-4" id="bar-4" style="width: 0%;"></div>
                          </div>
                        </td>
                        <td class="text-right" id="fourStar"></td>
                      </tr>
                      <tr>
                        <td class="rating-label">Average</td>
                        <td class="rating-bar">
                          <div class="bar-container">
                            <div class="bar-3" id="bar-3" style="width: 0%;"></div>
                          </div>
                        </td>
                        <td class="text-right" id="threeStar"></td>
                      </tr>
                      <tr>
                        <td class="rating-label">Poor</td>
                        <td class="rating-bar">
                          <div class="bar-container">
                            <div class="bar-2" id="bar-2" style="width: 0%;"></div>
                          </div>
                        </td>
                        <td class="text-right" id="twoStar"></td>
                      </tr>
                      <tr>
                        <td class="rating-label">Terrible</td>
                        <td class="rating-bar">
                          <div class="bar-container">
                            <div class="bar-1" id="bar-1" style="width: 0%;"></div>
                          </div>
                        </td>
                        <td class="text-right" id="oneStar"></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div id="cmtArea" class="pag-wrapper">

            </div>
            <div class="pagination">
              <div class="pagination-container">
                <div class="pagination-hover-overlay"></div>
              </div>
            </div>
            <div class="WattingComment">
              <div class="one"></div>
              <div class="two"></div>
              <div class="three"></div>
            </div>
            <div id="rateArea">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <div class="modal fade" id="ErrorStar" tabindex="-1" role="dialog" aria-labelledby="ExampleLabel" aria-hidden="true">
    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header justify-content-center bg-danger">
          <div class="icon-box text-white">
            <i class="fas fa-times"></i>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <h4>Error!</h4>
          <p>Please choose the number of stars.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="ErrorQR" tabindex="-1" role="dialog" aria-labelledby="ErrorQRLabel" aria-hidden="true">
    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header justify-content-center bg-danger">
          <div class="icon-box text-white">
            <i class="fas fa-times"></i>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <h4>Error!</h4>
          <p>No QR code found. Please make sure the QR code is within the camera's frame and try again.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="SuccessComment" tabindex="-1" role="dialog" aria-labelledby="ExampleLabel" aria-hidden="true">
    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <div class="icon-box text-white">
            <i class="fas fa-check"></i>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <h4>Great!</h4>
          <p>Review successfully.</p>
        </div>
      </div>
    </div>
  </div>

  <div class='box'>
    <div class='wave -one'></div>
    <div class='wave -two'></div>
    <div class='wave -three'></div>
  </div>
  <?php include "footer.php" ?>
  <!-- JQuery -->
  <?php include "script.php" ?>
  <script src="js/jquery.star-rating.js"></script>



  <script>
    function isInputNumber(evt) {
      var ch = String.fromCharCode(evt.which);
      if (!(/[0-9]/.test(ch))) {
        evt.preventDefault();
      }
    }

    function isNotChar(evt) {
      var ch = String.fromCharCode(evt.which);
      if (ch == "'") {
        evt.preventDefault();
      }
    }

    function blockSpaces(evt) {
      var ch = String.fromCharCode(evt.which);
      if (ch == "'" || ch == " ") {
        evt.preventDefault();
      }
    }

    function blockSpecialChar(e) {
      var k;
      document.all ? k = e.keyCode : k = e.which;
      return ((k >= 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 46 || k == 42 || k == 33 || k == 32 || (k >= 48 && k <= 57));
    }

    $("#login").on("click", function() {
      $("#card1").hide("fast", "linear");
      $("#maincard3").hide("fast", "linear");
      $("#maincard2").show("fast", "linear");
    });

    $("#gotologin").on("click", function() {
      $("#card1").hide("fast", "linear");
      $("#maincard3").hide("fast", "linear");
      $("#maincard2").show("fast", "linear");
    });

    $("#openlogin").on("click", function() {
      $("#card1").hide("fast", "linear");
      $("#maincard3").hide("fast", "linear");
      $("#maincard2").show("fast", "linear");
    });

    $("#signup").on("click", function() {
      $("#card1").hide("fast", "linear");
      $("#maincard2").hide("fast", "linear");
      $("#maincard3").show("fast", "linear");
    });

    $("#gotosignup").on("click", function() {
      $("#card1").hide("fast", "linear");
      $("#maincard2").hide("fast", "linear");
      $("#maincard3").show("fast", "linear");
    });

    $("#opensignup").on("click", function() {
      $("#card1").hide("fast", "linear");
      $("#maincard2").hide("fast", "linear");
      $("#maincard3").show("fast", "linear");
    });

    $("#closebutton").on("click", function() {
      $(".customalert").hide("fast", "linear");
    });

    function checkSecondForm(theform) {
      var email = theform.email.value;
      var pw = theform.pw.value;
      var cpw = theform.cpw.value;

      if (!validateEmail(email)) {
        showAlert("Invalid Email address");
        return false;
      }

      if (pw != cpw) {
        showAlert("Please check your password");
        return false;
      }
      return true;
    }

    function checkFirstForm(theform) {
      var email = theform.email.value;

      if (!validateEmail(email)) {
        showAlert("Invalid Email address");
        return false;
      }
      return true;
    }

    function showAlert(message) {
      $("#alertText").html(message);
      $("#qrious").hide();
      $("#bottomText").hide();
      $(".customalert").show("fast", "linear");
    }

    function validateEmail(email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }

    $("#aboutbtn").on("click", function() {
      showAlert("Meloweb là một Ứng dụng lưu trữ vị trí của sản phẩm tại mọi trung tâm vận chuyển hàng hóa trên Blockchain. Ở phía người tiêu dùng, khách hàng có thể chỉ cần quét MÃ QR của sản phẩm và nhận thông tin đầy đủ về nguồn gốc của sản phẩm đó, do đó trao quyền cho người tiêu dùng chỉ mua các sản phẩm chính hãng và chất lượng.");
    });
  </script>
  <!-- QR Code Reader -->
  <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>

  <!-- Web3 Injection -->
  <script>
    web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));

    // Set the Contract
    var contract = new web3.eth.Contract(contractAbi, contractAddress);

    $(".cardResearch").hide();
    // Change the Data
    $('form').on('submit', function(event) {
      event.preventDefault(); // to prevent page reload when form is submitted
      greeting = $('input').val();
      //$("#database").text(greeting);
      var body = $(".LoadWaiting");
      body.addClass("loading");

      contract.methods.searchProduct(greeting).call(function(err, result) {
        $(".cardResearch").show("fast", "linear");
        $("#database").html(result);
        body.removeClass("loading");
      });

    });

    loadDetailData();

    function loadDetailData() {
      // Load account
      if (contract) {
        const detailNum = contract.methods.detail().call();
        const items = contract.methods.items().call();
        items.then(function(itemsResult) {
          if (itemsResult > 0) {
            itemID = 0;
            for (var i = 0; i < itemsResult; i++) {
              const productsAll = contract.methods.allProducts(i).call();
              num = 0;
              productsAll.then(function(ShowAllProduct) {
                num++;
                if (ShowAllProduct.productId == '<?= $_GET['id_product'] ?>' || ShowAllProduct.qrcode == '<?= $_GET['id_product'] ?>') {
                  detailNum.then(function(detailNum2) {
                    for (var i = 0; i < detailNum2; i++) {
                      const promDetail = contract.methods.allState(i).call();
                      promDetail.then(function(ShowDetail) {
                        if (ShowDetail.productId == ShowAllProduct.productId) {
                          itemID++;
                          var html = '';
                          description = ShowDetail.detailDescription;
                          html += '<div class="col-md-6">';
                          html += '<figure class="item">';
                          html += '<img src="img/Product/' + ShowAllProduct.img + '" class="w-100 img-fluid rounded"/>';
                          html += '</figure>';
                          html += '</div>';
                          html += '<div class="col-md-6">';
                          html += '<div class="product-dtl">';
                          html += '<div class="product-info mb-3 row justify-content-between align-items-center">';
                          html += '<div class="product-name col-12 col-md-12">' + ShowAllProduct.productName + '</div>';
                          html += '<div class="product-price-discount col-12 col-md-12 text-success"><span>' + ShowAllProduct.price + '.VND</span></div>';
                          html += '</div>';
                          html += '<p>' + ShowDetail.shortDescription + '</p>';
                          html += '<div class="row col-12">';
                          html += '<div class="col-12 col-md-12 p-0">';
                          html += '<p class="mb-1">NXS : ' + ShowAllProduct.date + '</p>';
                          html += '<p class="mb-1">Người đăng tải : ' + ShowAllProduct.userName + '</p>';
                          html += '<div class="reviews-counter m-0 p-0">';
                          html += '</div>';
                          html += '</div>';
                          html += '</div>';
                          html += '<div class="row align-items-end">';
                          html += '<div style="display:grid;"class="col-12 col-md-6">';
                          html += '<img src="img/QRProduct/' + ShowAllProduct.qrcode + '" class="w-100 qrcustom2 d-block"/>';
                          html += '<a class="btn btn-primary qrDownload m-0" id="qrDownload" href="img/QRProduct/' + ShowAllProduct.qrcode + '" download> Tải mã QR </a>';
                          html += '</a>';
                          html += '</div>';
                          html += '<div class="col-12 col-md-6">';
                          html += '<img src="img/barCode/' + ShowDetail.barCode + '" class="mb-3 w-100 qrcustom2 d-block"/>';
                          html += '<a class="btn btn-primary form-control qrDownload m-0" id="barCodeDownload" href="img/barCode/' + ShowDetail.barCode + '" download> Tải mã vạch </a>';
                          html += '</a>';
                          html += '</div>';
                          html += '</div>';
                          html += '</div>';
                          html += '</div>';
                          $("#showDetail").append(html);
                          $("#description").append(description);
                        }
                      });
                    }
                  });
                } else if (itemID == 0 && num == itemsResult) {
                  window.location.href = "<?= BASE_URL ?>";
                }
              })
            }
          } else {
            var html = '<h5 class="text-center card-title text-danger m-0 p-0 font-weight-bold">Hiện tại chưa có sản phẩm nào</h5>';
            $("#showDetail").append(html);
            window.location.href = "<?= BASE_URL ?>";
          }
        })
        // Load products

      } else {
        window.alert('Marketplace contract not deployed to detected network.')
      }
    }

    loadRateScore();

    function loadRateScore() {
      // Load account
      if (contract) {
        const comments = contract.methods.comments().call();
        comments.then(function(commentsNumber) {
          if (commentsNumber > 0) {
            var oneStar = 0;
            var twoStar = 0;
            var threeStar = 0;
            var fourStar = 0;
            var fiveStar = 0;
            var totalRate = 0;
            for (var i = 0; i < commentsNumber; i++) {
              const commentsAll = contract.methods.allComments(i).call();
              commentsAll.then(function(ShowAllComment) {
                if (ShowAllComment.productId == '<?= $_GET['id_product'] ?>' || ShowAllComment.qrcode == '<?= $_GET['id_product'] ?>') {
                  totalRate++;
                  if (ShowAllComment.star == 1) {
                    oneStar++;
                  }
                  if (ShowAllComment.star == 2) {
                    twoStar++;
                  }
                  if (ShowAllComment.star == 3) {
                    threeStar++;
                  }
                  if (ShowAllComment.star == 4) {
                    fourStar++;
                  }
                  if (ShowAllComment.star == 5) {
                    fiveStar++;
                  }
                  var percentCount = (fiveStar / (oneStar + twoStar + threeStar + fourStar + fiveStar)) * 100;
                  var percentShort = Math.round(percentCount * 10) / 10 + "%";
                  var totalFinal = totalRate;
                  var countFour = (fourStar / (oneStar + twoStar + threeStar + fourStar + fiveStar)) * 100;
                  var countThree = (threeStar / (oneStar + twoStar + threeStar + fourStar + fiveStar)) * 100;
                  var countTwo = (twoStar / (oneStar + twoStar + threeStar + fourStar + fiveStar)) * 100;
                  var countOne = (oneStar / (oneStar + twoStar + threeStar + fourStar + fiveStar)) * 100;
                  document.getElementById("bar-5").style.width = "" + percentCount + "%";
                  document.getElementById("bar-4").style.width = "" + countFour + "%";
                  document.getElementById("bar-3").style.width = "" + countThree + "%";
                  document.getElementById("bar-2").style.width = "" + countTwo + "%";
                  document.getElementById("bar-1").style.width = "" + countOne + "%";
                  $("#percentCount").html(percentShort);
                  $("#totalRate").html(totalFinal);
                  $("#oneStar").html(oneStar);
                  $("#twoStar").html(twoStar);
                  $("#threeStar").html(threeStar);
                  $("#fourStar").html(fourStar);
                  $("#fiveStar").html(fiveStar);
                  $("#fiveStar2").html(fiveStar);
                }
              })
            }
          }
        })
        // Load products
      } else {
        window.alert('Marketplace contract not deployed to detected network.')
      }
    }

    loadCommentData();

    function loadCommentData() {
      if (contract) {
        const comments = contract.methods.comments().call();
        comments.then(function(commentsNumber) {
          if (commentsNumber >= 0) {
            var cNum = 0;
            for (var i = 0; i < commentsNumber; i++) {
              const commentsAll = contract.methods.allComments(i).call();
              var k = 0;
              commentsAll.then(function(ShowAllComment) {
                var cmpSL = 0;
                k++;
                if (ShowAllComment.productId == '<?= $_GET['id_product'] ?>' || ShowAllComment.qrcode == '<?= $_GET['id_product'] ?>') {
                  cNum++;
                  cmpSL++;
                  if (cNum > 0) {
                    var html_cmSL = '';
                    html_cmSL += 'Reviews (' + cmpSL + ')';
                    $("#review-tab").html(html_cmSL);
                    $(".noComment-text").remove();
                    var html = '';
                    html += '<div class="card pag-item pt-1 pb-1 pr-5 pl-5 mt-3 mt-3">';
                    html += '<div class="row d-flex">';
                    html += '<div class="d-flex flex-column">';
                    html += '<h3 class="mt-2 mb-0">' + ShowAllComment.username + '</h3>';
                    html += '<div>';
                    html += '<p class="text-left">';
                    html += '<span class="text-muted mr-1">' + ShowAllComment.star + '</span>';
                    for (var i = 1; i <= 5; i++) {
                      if (i <= ShowAllComment.star) {
                        html += '<span class="fa fa-star star-active"></span>';
                      } else {
                        html += '<span class="fa fa-star star-inactive"></span>';
                      }
                    }
                    html += '</p>';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="ml-auto">';
                    html += '<p class="text-muted pt-5 pt-sm-3">' + ShowAllComment.dateComment + '</p>';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="row text-left">';
                    html += '<p class="content">' + ShowAllComment.comment + '</p>';
                    html += '</div>';
                    html += '</div>';
                    $("#cmtArea").append(html);
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
                  }
                }
              })
            };
            if (cNum == 0) {
              cNum++;
              var html = '';
              html += '<h3 class="noComment-text mb-20 text-danger text-center font-weight-bold mt-3">There are no reviews yet.</h3>';
              $("#cmtArea").append(html);
            }
            var numCed = 0;

          }
        })
      } else {
        window.alert('Marketplace contract not deployed to detected network.')
      }
    }

    loadSubmit();

    function loadSubmit() {
      if (contract) {
        const comments = contract.methods.comments().call();
        comments.then(function(commentsNumber) {
          if (commentsNumber >= 0) {
            var cNum = 0;
            var numCed = 0;
            <?php if (isset($_SESSION['username'])) { ?>
              for (var z = 0; z <= commentsNumber; z++) {
                const commentsAll = contract.methods.allComments(z).call();
                var e = 0;
                var sumComment = 0;
                commentsAll.then(function(ShowAllComment) {
                  e++;
                  if (ShowAllComment.productId == '<?= $_GET['id_product'] ?>' || ShowAllComment.qrcode == '<?= $_GET['id_product'] ?>') {
                    sumComment++;
                    if (ShowAllComment.username == '<?= $_SESSION['username'] ?>') {
                      numCed++;
                      if (numCed == 1) {
                        $("#rateForm").remove();
                        $("#thankRate").remove();
                        var html_form = "";
                        html_form = '<div class="text-center mt-3">';
                        html_form += '<button id="thankRate" class="btn btn-success rounded font-weight-bold text-white"><i class="fas fa-check-circle"></i> Thank you for rating the product.</buttonf=>';
                        html_form += '</div>';
                        $("#rateArea").append(html_form);
                        return;
                      }
                    } else if (numCed < 1) {
                      var html_form = "";
                      $("#thankRate").remove();
                      $("#rateForm").remove();
                      html_form += '<form class="review-form" id="rateForm" style="display: block;">';
                      html_form += '<div class="form-group">';
                      html_form += '<label class="font-weight-bold">Your rating</label>';
                      html_form += '<div class="container">';
                      html_form += '<div class="rating"></div>';
                      html_form += '</div>';
                      html_form += '</div>';
                      html_form += '<div class="form-group">';
                      html_form += '<label>Your message</label>';
                      html_form += '<textarea id="textComment" class="form-control" rows="10"></textarea>';
                      html_form += '</div>';
                      html_form += '<input type="hidden" class="form-control" id="username" value=<?php echo $_SESSION['username']; ?> required>';
                      html_form += '<button type="submit" class="round-black-btn form-control">Submit Review</button>';
                      html_form += '</form>';
                      $("#rateArea").append(html_form);
                      $('.rating').starRating({
                        starSize: 1.5,
                        showInfo: true
                      });
                      $('#rateForm').on('submit', function(event) {
                        event.preventDefault(); // to prevent page reload when form is submitted
                        prodID = '<?= $_GET['id_product'] ?>';
                        username = $('#username').val();
                        textComment = $('#textComment').val();
                        var today = new Date();
                        thisdate = today.getDate() + '-' + (today.getMonth() + 1) + '-' + today.getFullYear();
                        var star = document.getElementsByName('rating');
                        for (var i = 0, length = star.length; i < length; i++) {
                          if (star[i].checked) {
                            // do whatever you want with the checked radio
                            var starRate = star[i].value;
                            // only one radio can be logically checked, don't check the rest
                            break;
                          }
                        }

                        if (starRate > 0) {
                          $(".WattingComment").addClass("load");
                          document.getElementById("rateForm").style.display = "none";
                          web3.eth.getAccounts().then(async function(accounts) {
                            var receipt = await contract.methods.newComment(textComment, starRate, thisdate, username, prodID).send({
                                from: accounts[0],
                                gas: 1000000
                              })
                              .then(receipt => {
                                $('#SuccessComment').modal('show');
                                $(".WattingComment").removeClass("load");
                                var html_form = "";
                                html_form = '<div class="text-center mt-3">';
                                html_form += '<button id="thankRate" class="btn btn-success rounded font-weight-bold text-white"><i class="fas fa-check-circle"></i> Thank you for rating the product.</buttonf=>';
                                html_form += '</div>';
                                $("#rateArea").append(html_form);
                                loadCommentData();
                                loadRateScore();
                              });
                          });
                        } else {
                          $('#ErrorStar').modal('show');
                        }
                      });
                      return;
                    }
                  } else if (sumComment == 0) {
                    sumComment++;
                    var html_form = "";
                    $("#thankRate").remove();
                    html_form += '<form class="review-form" id="rateForm" style="display: block;">';
                    html_form += '<div class="form-group">';
                    html_form += '<label class="font-weight-bold">Your rating</label>';
                    html_form += '<div class="container">';
                    html_form += '<div class="rating"></div>';
                    html_form += '</div>';
                    html_form += '</div>';
                    html_form += '<div class="form-group">';
                    html_form += '<label>Your message</label>';
                    html_form += '<textarea id="textComment" class="form-control" rows="10"></textarea>';
                    html_form += '</div>';
                    html_form += '<input type="hidden" class="form-control" id="username" value=<?php echo $_SESSION['username']; ?> required>';
                    html_form += '<button type="submit" class="round-black-btn form-control">Submit Review</button>';
                    html_form += '</form>';
                    $("#rateArea").append(html_form);
                    $('.rating').starRating({
                      starSize: 1.5,
                      showInfo: true
                    });
                    $('#rateForm').on('submit', function(event) {
                      event.preventDefault(); // to prevent page reload when form is submitted
                      prodID = '<?= $_GET['id_product'] ?>';
                      username = $('#username').val();
                      textComment = $('#textComment').val();
                      var today = new Date();
                      thisdate = today.getDate() + '-' + (today.getMonth() + 1) + '-' + today.getFullYear();
                      var star = document.getElementsByName('rating');
                      for (var i = 0, length = star.length; i < length; i++) {
                        if (star[i].checked) {
                          // do whatever you want with the checked radio
                          var starRate = star[i].value;
                          // only one radio can be logically checked, don't check the rest
                          break;
                        }
                      }

                      if (starRate > 0) {
                        $(".WattingComment").addClass("load");
                        document.getElementById("rateForm").style.display = "none";
                        web3.eth.getAccounts().then(async function(accounts) {
                          var receipt = await contract.methods.newComment(textComment, starRate, thisdate, username, prodID).send({
                              from: accounts[0],
                              gas: 1000000
                            })
                            .then(receipt => {
                              $('#SuccessComment').modal('show');
                              $(".WattingComment").removeClass("load");
                              var html_form = "";
                              html_form = '<div class="text-center mt-3">';
                              html_form += '<button id="thankRate" class="btn btn-success rounded font-weight-bold text-white"><i class="fas fa-check-circle"></i> Thank you for rating the product.</buttonf=>';
                              html_form += '</div>';
                              $("#rateArea").append(html_form);
                              loadCommentData();
                              loadRateScore();
                            });
                        });
                      } else {
                        $('#ErrorStar').modal('show');
                      }
                    });
                    return;
                  }
                })
              }
            <?php } ?>
          }
        })
        <?php if (empty($_SESSION['username'])) { ?>
          var html_form = "";
          html_form = '<div class="text-center mt-3">';
          html_form += '<a href="login-page.php" class="btn btn-dark rounded font-weight-bold text-white"><i class="fas fa-lock"></i> You must be logged in to submit a review.</a>';
          html_form += '</div>';
          $("#rateArea").append(html_form);
        <?php } ?>
      } else {
        window.alert('Marketplace contract not deployed to detected network.')
      }
    }


    function isInputNumber(evt) {
      var ch = String.fromCharCode(evt.which);
      if (!(/[0-9]/.test(ch))) {
        evt.preventDefault();
      }
    }

    $("#closebutton").on("click", function() {
      $(".customalert").hide("fast", "linear");
    });

    function openQRCamera(node) {
      var reader = new FileReader();
      reader.onload = function() {
        node.value = "";
        qrcode.callback = function(res) {
          if (res instanceof Error) {
            $('#ErrorQR').modal('show');
          } else {
            node.parentNode.previousElementSibling.value = res;
            document.getElementById('searchButton').click();
          }
        };
        qrcode.decode(reader.result);
      };
      reader.readAsDataURL(node.files[0]);
    }

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
</body>

</html>