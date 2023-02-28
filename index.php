<?php session_start();
include("header.php");
?>

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
  <div>
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
    <section class="products">
      <div class="text-center container py-5 rounded">
        <div class="card p-3">
          <h4 class="mb-5 font-weight-bold"><strong>Sản phẩm đăng tải</strong></h4>
          <div class="row justify-content-center showProduct show-paginationCustom pag-wrapper" id="showProduct">

          </div>
          <div class="pagination">
            <div class="pagination-container">
              <div class="pagination-hover-overlay"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="products container">
      <div class="card" id="newsShow">

      </div>
    </section>
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
  <div class="modal fade" id="ErrorBarCode" tabindex="-1" role="dialog" aria-labelledby="ErrorQRLabel" aria-hidden="true">
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
          <p>No BarCode code found. Please make sure the BarCode code is within the camera's frame and try again.</p>
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
  <script>
    loadNews();

    function loadNews() {
      var action = "fetch";
      $.ajax({
        url: "News.php",
        method: "POST",
        data: {
          action: action
        },
        success: function(data) {
          $('#newsShow').append(data);
        }
      });
    }

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

    loadBlockchainData();

    function loadBlockchainData() {
      // Load account
      const networkId = web3.eth.net.getId();
      if (contract) {
        const items = contract.methods.items().call();
        items.then(function(itemsResult) {
          if (itemsResult > 0) {
            var itemsl = itemsResult - 1;
            for (var i = -1; i < itemsl; itemsl--) {
              const productsAll = contract.methods.allProducts(itemsl).call();
              productsAll.then(function(ShowAllProduct) {
                var html = '';
                html += '<a href="product-detail/' + ShowAllProduct.productId + '">';
                html += '<div class="pag-item col-12 col-lg-4 col-md-4 mt-3">';
                html += '<div class="icon-box card">';
                html += '<div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">';
                html += '<img src="img/Product/' + ShowAllProduct.img + '" class="img-products w-100 img-fluid" />';
                html += '<a href="product-detail/' + ShowAllProduct.productId + '">';
                html += '<div class="mask">';
                html += '<div class="qrcustom d-flex justify-content-start align-items-end h-100 p-2">';
                html += '<img style="z-index:99;" src="img/QRProduct/' + ShowAllProduct.qrcode + '" class="w-25 qrcustom" />';
                html += '</div>';
                html += '</div>';
                html += '<div class="hover-overlay">';
                html += '<div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">';
                html += '</div>';
                html += '</div>';
                html += '</a>';
                html += '</div>';
                html += '<div class="card-body">';
                html += '<a href="product-detail/' + ShowAllProduct.productId + '" class="text-reset">';
                html += '<h5 class="card-title product-tittle font-weight-bold mb-3">' + ShowAllProduct.productName + '</h5>';
                html += '</a>';
                html += '<p>NXS : ' + ShowAllProduct.date + '</p>';
                html += '<h6 class="mb-3">' + ShowAllProduct.price + '.VND</h6>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</a>';

                $("#showProduct").append(html);
                var items = $(".pag-wrapper .pag-item");
                var numItems = items.length;
                var perPage = 6;
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
              })
            }

          } else {
            var html = '<h5 class="text-center card-title text-danger m-0 p-0 font-weight-bold">Hiện tại chưa có sản phẩm nào</h5>';
            $("#showProduct").append(html);
          }
        })
        // Load products

      } else {
        window.alert('Network Error.')
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