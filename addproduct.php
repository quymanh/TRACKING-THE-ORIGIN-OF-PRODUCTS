<?php
session_start();
$color = "navbar-light orange darken-4";
include("header.php");
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css">
<?php
if ($_SESSION['role'] == 0 || $_SESSION['role'] == 1 && isset($_SESSION['role'])) {
?>

  <body class="violetgradient">
    <div class="preloader-pre">
      <div class="spinner-pre"></div>
      <div class="spinner-pre"></div>
      <div class="spinner-pre"></div>
    </div>
    <?php include 'navbar.php'; ?>
    <center>
      <div class="customalert">
        <div class="alertcontent">
          <div id="alertText"> &nbsp </div>
          <div class="row align-items-end">
            <div class="col-12 col-md-6 mt-3">
              <div style="display: grid;justify-content: center;" id='bcode-cardQR'>
                <div id="saveQRdiv">
                  <img id="qrious" name="qrious">
                </div>
                <div class="card-footer bg-transparent" style="display:none">
                  <center>
                    <button type="button" class=" btn-block btn btn-success btn-sm" id="printQR">Print</button>
                    <button type="button" class=" btn-block btn btn-primary btn-sm" id="saveQR">Download</button>
                  </center>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 mt-3">
              <div style="display: grid;justify-content: center;" id='bcode-card'>
                <div id="bcTarget" name="bcTarget"></div>
                <div class="card-footer bg-transparent" style="display:none">
                  <center>
                    <button type="button" class=" btn-block btn btn-success btn-sm" id="print">Print</button>
                    <button type="button" class=" btn-block btn btn-primary btn-sm" id="save">Download</button>
                  </center>

                </div>
              </div>
            </div>
          </div>
          <div id="bottomText" style="margin-top: 10px; margin-bottom: 15px;"> &nbsp </div>
          <button id="closebutton" class="btn btn-primary form-control p-0"> Done </button>
        </div>
      </div>
    </center>

    <div class="bgrolesadd">
      <center>
        <div class="mycardstyle p-1 w-75">
          <div class="card-body">
            <h3 class="font-weight-bold"> Vui lòng nhập thông tin </h3>
            <div class="LoadWaiting mt-3 mb-3"><span></span><span></span><span></span></div>
            <form id="form1" autocomplete="off">
              <div class="formitem row text-left">
                <div class="col-12 col-md-6 mt-3">
                  <p class="mb-0 font-weight-bold" type="text"> Tên sản phẩm </p>
                  <input type="text" class="form-control rounded" id="prodname" maxlength="100" required>
                </div>
                <div class="col-12 col-md-6 mt-3">
                  <p class="mb-0 font-weight-bold" type="text"> Giá </p>
                  <input type="text" class="form-control rounded" id="price" maxlength="20" required>
                </div>
                <div class="col-12 col-md-12 mt-3">
                  <p class="m-0"> Ảnh sản phẩm</p>
                  <div class="border border-2 p-3 d-flex justify-content-between align-items-center">
                    <div>
                      <label for="img" class="filupp">
                        <input type="file" class="form-control img-logo border-0" name="img" value="1" id="img" required />
                      </label>
                    </div>
                    <img class="img-fluid bg-primary" width="50px" height="50px" id="old_thumbnail" />
                  </div>
                </div>
                <div class="col-12 col-md-6 mt-3">
                  <p class="mb-0 font-weight-bold" type="text"> Mô tả ngắn </p>
                  <textarea type="text" class="form-control rounded" id="short_des" name="short_des" rows="10" maxlength="200" required></textarea>
                </div>
                <div class="col-12 col-md-6 mt-3">
                  <p class="mb-0 font-weight-bold" type="text"> Mô tả chi tiết </p>
                  <textarea type="text" class="form-control rounded" name="detail_des" id="detail_des" maxlength="2000" required></textarea>
                </div>
                <input type="hidden" class="form-control" id="user" value="<?php echo $_SESSION['username']; ?>" required>
              </div>
              <button class="btn btn-primary form-control rounded p-0 m-0 mt-3" id="mansub" type="submit">Đăng ký</button>
            </form>
          </div>
        </div>


      </center>
    <?php
  } else {
    include 'redirection.php';
    redirect('index.php');
  }
    ?>
    <div class='box'>
      <div class='wave -one'></div>
      <div class='wave -two'></div>
      <div class='wave -three'></div>
    </div>
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Material Design Bootstrap-->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script src="js/summernote-bs4.min.js"></script>
    <!-- Web3.js -->
    <script src="web3.min.js"></script>
    <script src="html2canvas.js"></script>
    <!-- QR Code Library-->
    <script src="./dist/qrious.js"></script>

    <!-- QR Code Reader -->
    <script src="https://rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>

    <script src="app.js"></script>
    <script src="js/modal.xu.ly.js"></script>
    <script>
      function registerSummernote(element, placeholder, max, callbackMax) {
        $(element).summernote({
          toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']]
          ],
          placeholder,
          callbacks: {
            onKeydown: function(e) {
              var t = e.currentTarget.innerText;
              if (t.length >= max) {
                //delete key
                if (e.keyCode != 8)
                  e.preventDefault();
                // add other keys ...
              }
            },
            onKeyup: function(e) {
              var t = e.currentTarget.innerText;
              if (typeof callbackMax == 'function') {
                callbackMax(max - t.length);
              }
            },
            onPaste: function(e) {
              var t = e.currentTarget.innerText;
              var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
              e.preventDefault();
              var all = t + bufferText;
              document.execCommand('insertText', false, all.trim().substring(0, 1500));
              if (typeof callbackMax == 'function') {
                callbackMax(max - t.length);
              }
            }
          }
        });
      }
      $(function() {
        registerSummernote('#detail_des', 'Leave a comment', 1500, function(max) {
          $('#detail_des').text(max)
        });
      });
    </script>
    <!-- Web3 Injection -->
    <script>
      var img = document.getElementById("img");
      img.onchange = evt => {
        const [file] = img.files
        if (file) {
          old_thumbnail.src = URL.createObjectURL(file)
        }
      }
      // get the name of uploaded file
      $('input[id="img"]').change(function() {
        var value = $("input[id='img']").val();
        $('.js-value').text(value);
      });
      // Initialize Web3
      if (typeof web3 !== 'undefined') {
        web3 = new Web3(web3.currentProvider);
        web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
      } else {
        web3 = new Web3(new Web3.providers.HttpProvider('HTTP://127.0.0.1:7545'));
      }

      // Set the Contract
      var contract = new web3.eth.Contract(contractAbi, contractAddress);



      $("#manufacturer").on("click", function() {
        $("#districard").hide("fast", "linear");
        $("#manufacturercard").show("fast", "linear");
      });

      $("#distributor").on("click", function() {
        $("#manufacturercard").hide("fast", "linear");
        $("#districard").show("fast", "linear");
      });

      $("#closebutton").on("click", function() {
        $(".customalert").hide("fast", "linear");
      });

      $('#form1').on('submit', function(event) {
        const existingIDs = '1';
        const getRandomDigits = (length = 1) => Array(length).fill().map(e => Math.floor(Math.random() * 10)).join('');
        const generateUniqueID = () => {
          let id = getRandomDigits(10);
          while (existingIDs.includes(id)) id = getRandomDigits(10);
          return id;
        };
        const newID = generateUniqueID();

        event.preventDefault(); // to prevent page reload when form is submitted
        prodname = $('#prodname').val();
        username = $('#user').val();
        price = $('#price').val();
        img = $('#img').val();
        short_des = $('#short_des').val();
        var detail_des = $('#detail_des').val();
        var form_con = document.getElementById("form1");
        var data = new FormData(form_con);
        data.append('img', document.getElementById("img").value);
        data.append("ten_product", prodname);
        var ajax = new XMLHttpRequest();
        ajax.open('POST', 'uploadIMG.php');
        ajax.send(data);
        ajax.onload = function() {
          if (this.response == 2) {
            $.bootstrapGrowl("Vui lòng chọn file là tệp ảnh !", {
              type: "danger",
              offset: {
                from: "bottom",
                amount: 550
              },
              align: "top",
              width: 'auto',
              delay: 3000,
              allow_dismiss: true,
              stackup_spacing: 10
            }, 2000);
            return;
          } else {
            $.bootstrapGrowl("Thao tác thành công!", {
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

            var imgBLC = this.response;

            prodname2 = $('#prodname').val();
            var today = new Date();
            var thisdate = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
            var data2 = new FormData(form_con);
            const items = contract.methods.items().call();
            items.then(function(itemsResult) {
              qr.value = newID;

              let inputValue = newID;
              let barcodeType = "code39";
              var settings = {
                output: "bmp", // renderer type
              };

              data2.append('qrious', document.getElementById("qrious").src);
              data2.append('nameProduct', prodname2);
              data2.append('idProduct', newID);
              var ajax2 = new XMLHttpRequest();
              ajax2.open('POST', 'uploadQR.php');
              ajax2.send(data2);
              ajax2.onload = function() {
                var qrBLC = this.response;
                var type = "C39";
                $.ajax({
                  url: 'barcode.php',
                  method: "POST",
                  data: {
                    code: newID,
                    type: type,
                    label: prodname2
                  },
                  error: err => {
                    console.log(err)
                  },
                  success: function(resp) {
                    $('#save').click(function() {
                      html2canvas($('#field'), {
                        onrendered: function(canvas) {
                          var img = canvas.toDataURL("image/png");

                          var uri = img.replace(/^data:image\/[^;]/, 'data:application/octet-stream');

                          var link = document.createElement('a');
                          if (typeof link.download === 'string') {
                            document.body.appendChild(link);
                            link.download = prodname2 + "-" + "barCode" + "-" + newID + '.png';
                            var barBLC = link.download;
                            link.href = uri;
                            link.click();
                            document.body.removeChild(link);
                          } else {
                            location.replace(uri);
                          }
                        }
                      });
                    })
                    var barBLC = prodname2 + "-" + "barCode" + "-" + newID + '.png';
                    $('#print').click(function() {
                      var openWindow = window.open("", "", "_blank");
                      openWindow.document.write($('#field').parent().html());
                      openWindow.document.write('<style>' + $('style').html() + '</style>');
                      openWindow.document.close();
                      openWindow.focus();
                      openWindow.print();
                      // openWindow.close();
                      setTimeout(function() {
                        openWindow.close();
                      }, 1000)
                    })
                    $('#saveQR').click(function() {
                      html2canvas($('#saveQRdiv'), {
                        onrendered: function(canvas) {
                          var img = canvas.toDataURL("image/png");

                          var uri = img.replace(/^data:image\/[^;]/, 'data:application/octet-stream');

                          var link = document.createElement('a');
                          if (typeof link.download === 'string') {
                            document.body.appendChild(link);
                            link.download = prodname2 + "-" + "QRCode" + "-" + newID + '.png';
                            var barBLC = link.download;
                            link.href = uri;
                            link.click();
                            document.body.removeChild(link);
                          } else {
                            location.replace(uri);
                          }
                        }
                      });
                    })
                    var barBLC = "M&D-" + newID + "-barCode" + '.png';
                    $('#printQR').click(function() {
                      var openWindow = window.open("", "", "_blank");
                      openWindow.document.write($('#qrious').parent().html());
                      openWindow.document.write('<style>' + $('style').html() + '</style>');
                      openWindow.document.close();
                      openWindow.focus();
                      openWindow.print();
                      // openWindow.close();
                      setTimeout(function() {
                        openWindow.close();
                      }, 1000)
                    })
                    $(".preloader-pre").addClass("preloader");
                    $(".spinner-pre").addClass("spinner");
                    $(".loading-text-pre").addClass("loading-text");
                    web3.eth.getAccounts().then(async function(accounts) {
                      var receipt = await contract.methods.newItem(username, prodname, thisdate, price, imgBLC, qrBLC, newID).send({
                          from: accounts[0],
                          gas: 3000000
                        })
                        .then(receipt => {
                          var msg = "<h5 class='font-weight-bold text-success'><b>Thêm sản phẩm thành công</b></h5><p>ID sản phẩm: " + newID + "</p>";
                          $bottom = "<p class='font-weight-bold text-warning'> Bạn có thể in QR Code hoặc mã vạch nếu cần </p>"
                          $("#alertText").html(msg);
                          $("#qrious").show();
                          $("#bottomText").html($bottom);
                          $(".customalert").show("fast", "linear");
                          $('#bcTarget').html(resp)
                          $('#bcode-card .card-footer').show('slideUp')
                          $('#bcode-cardQR .card-footer').show('slideUp')
                          var data3 = new FormData(form_con);
                          var mysrc = document.getElementById("barcode_img").src;
                          data3.append('barCode', mysrc);
                          data3.append('nameProduct', prodname2);
                          data3.append('idProduct', newID);
                          var ajax3 = new XMLHttpRequest();
                          ajax3.open('POST', 'uploadBarcode.php');
                          ajax3.send(data3);
                          $(".preloader-pre").removeClass("preloader");
                          $(".spinner-pre").removeClass("spinner");
                          $(".loading-text-pre").removeClass("loading-text");
                        });
                    });
                    web3.eth.getAccounts().then(async function(accounts) {
                      var receipt = await contract.methods.addState(newID, short_des, detail_des, barBLC).send({
                        from: accounts[0],
                        gas: 3000000
                      })
                    });
                  }
                })
              }
            });
            $("#prodname").val('');
          }
        };

      });



      $('#form2').on('submit', function(event) {
        event.preventDefault(); // to prevent page reload when form is submitted
        prodid = $('#prodid').val();
        prodlocation = $('#prodlocation').val();
        var today = new Date();
        var thisdate = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        var info = "<br><br><b>Date: " + thisdate + "</b><br>Location: " + prodlocation;
        web3.eth.getAccounts().then(async function(accounts) {
          var receipt = await contract.methods.addState(prodid, info).send({
              from: accounts[0],
              gas: 1000000
            })
            .then(receipt => {
              var msg = "Item has been updated ";
              $("#alertText").html(msg);
              $("#qrious").hide();
              $("#bottomText").hide();
              $(".customalert").show("fast", "linear");
            });
        });
        $("#prodid").val('');
        $("#prodlocation").val('');
      });


      function isInputNumber(evt) {
        var ch = String.fromCharCode(evt.which);
        if (!(/[0-9]/.test(ch))) {
          evt.preventDefault();
        }
      }

      (function() {
        var qr = window.qr = new QRious({
          element: document.getElementById('qrious'),
          size: 200,
          value: '0'
        });
      })();

      $('input#price').keyup(function(event) {

        // skip for arrow keys
        if (event.which >= 37 && event.which <= 40) return;

        // format number
        $(this).val(function(index, value) {
          return value
            .replace(/\D/g, "")
            .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
      });

      function openQRCamera(node) {
        var reader = new FileReader();
        reader.onload = function() {
          node.value = "";
          qrcode.callback = function(res) {
            if (res instanceof Error) {
              alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
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