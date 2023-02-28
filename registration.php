<?php
 session_start(); 
 include("header.php");
 ?>
  <body class="violetgradient">
  <?php
  $errormsg="";
  $submission=0;
  if( isset($_POST['loginsubmit']) ){

    if( isset($_POST['email']) && isset($_POST['username']) && isset($_POST['pw']) && isset($_POST['role']) ){
        $conn=openConnection();

        $email=mysqli_real_escape_string($conn,trim($_POST['email']));
        $username=mysqli_real_escape_string($conn,trim($_POST['username']));
        $pw=md5(trim($_POST['pw']));
        $role=$_POST['role'];
        $submission=1;

        $insertQ="SELECT * FROM users WHERE email='$email' ";
        $qry_result=mysqli_query($conn, $insertQ) or die(mysqli_error($conn));
        if( mysqli_num_rows($qry_result)>0 ){
            $errormsg="Email is already used. Please use a different Email address.";
            $submission=10;
        }

        $insertQ="SELECT * FROM users WHERE username='$username' ";
        $qry_result=mysqli_query($conn, $insertQ) or die(mysqli_error($conn));
        if( mysqli_num_rows($qry_result)>0 ){
            $errormsg="Username is already in use. Please try another username.";
            $submission=10;
        }
        if($submission==1){
            $stmt = $conn->prepare("INSERT INTO users (email ,username, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss",$email ,$username ,$pw ,$role);
            $stmt->execute();
            $_SESSION['role']=$role;
            $_SESSION['username']=$username;
            include 'redirection.php';
            redirect('index.php');
        }
    }else{
        include 'redirection.php';
        redirect('index.php');
      }
  }else{
    include 'redirection.php';
    redirect('index.php');
  }
  
  if ($submission==10){
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
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    function showAlert(message){
      $("#alertText").html(message);
      $("#qrious").hide();
      $("#bottomText").hide();
      $(".customalert").show("fast","linear");
    }
    </script>
  <?php echo "<script> showAlert('$errormsg') </script>"; ?>
    <div style="width: 100%">
      <center>
      <div class="loginformcard" id="card1">
            <h4> Tạo tài khoản mới</h4>
            <form style="margin-top: 30px; margin-bottom: 30px;" action="registration.php" method="POST" onsubmit="return checkform(this);">

            <label type="text" class="formlabel"> Email </label>
            <input type="text" class="forminput" value="<?php echo $email; ?>" name="email" onkeypress="isNotChar(event)" required>

            <label type="text" class="formlabel" style="margin-top: 10px;"> Tài khoản </label>
            <input type="text" class="forminput" value="<?php echo $username; ?>" name="username" onkeypress="blockSpaces(event)" required>

            <label type="text" class="formlabel" style="margin-top: 10px;"> Mật khẩu </label>
            <input type="password" class="forminput" value="<?php echo $_POST['pw']; ?>" name="pw" id="pw" onkeypress="isNotChar(event)" required>

            <label type="text" class="formlabel" style="margin-top: 10px;"> Confirm Mật khẩu </label>
            <input type="password" class="forminput" value="<?php echo $_POST['pw']; ?>" name="cpw" id="cpw" onkeypress="isNotChar(event)" required>

            <label type="text" class="formlabel" style="margin-top: 10px;"> Chọn vai trò</label>
            <select class="formselect" name="role">
              <option value="2">Khách hàng</option>
              <option value="1">Nhà bán lẻ</option>
              <option value="1">Nhà phân phối</option>
              <option value="0">Hãng sản xuất</option>
            </select>

            <button class="formbtn" name="loginsubmit" type="submit">Đăng ký</button>

            </form>
      </div>
      </center>
    </div>
    <?php
    }
    ?>

    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script>
  
    function isInputNumber(evt){
      var ch = String.fromCharCode(evt.which);
      if(!(/[0-9]/.test(ch))){
          evt.preventDefault();
      }
    }
    function isNotChar(evt){
      var ch = String.fromCharCode(evt.which);
      var key = evt.keyCode;
      if(ch=="'"){
        evt.preventDefault();
      }
    }

    function blockSpaces(evt){
      var ch = String.fromCharCode(evt.which);
      if(ch=="'" || ch==" "){
        evt.preventDefault();
      }
    }

    function blockSpecialChar(e){
      var k;
      document.all ? k = e.keyCode : k = e.which;
      return ((k >= 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 46|| k == 42|| k == 33 || k == 32 || (k >= 48 && k <= 57));
    }

    $("#login").on("click", function(){
      $("#card1").hide("fast","linear");
      $("#maincard3").hide("fast","linear");
      $("#maincard2").show("fast","linear");
    });

    $("#gotologin").on("click", function(){
      $("#card1").hide("fast","linear");
      $("#maincard3").hide("fast","linear");
      $("#maincard2").show("fast","linear");
    });

    $("#openlogin").on("click", function(){
      $("#card1").hide("fast","linear");
      $("#maincard3").hide("fast","linear");
      $("#maincard2").show("fast","linear");
    });

    $("#signup").on("click", function(){
      $("#card1").hide("fast","linear");
      $("#maincard2").hide("fast","linear");
      $("#maincard3").show("fast","linear");
    });

    $("#gotosignup").on("click", function(){
      $("#card1").hide("fast","linear");
      $("#maincard2").hide("fast","linear");
      $("#maincard3").show("fast","linear");
    });

    $("#opensignup").on("click", function(){
      $("#card1").hide("fast","linear");
      $("#maincard2").hide("fast","linear");
      $("#maincard3").show("fast","linear");
    });

    $("#closebutton").on("click", function(){
        $(".customalert").hide("fast","linear");
    });
    function checkSecondForm(theform){
      var email = theform.email.value;
      var pw = theform.pw.value;
      var cpw = theform.cpw.value;
      if (!validateEmail(email)) {
        showAlert("Invalid Email address");
        return false;
      }
      if (pw!=cpw) {
        showAlert("Please check your password");
        return false;
      } 
      return true;
    }

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    
    </script>
  </body>
</html>