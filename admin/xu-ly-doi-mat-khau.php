<?php 
    session_start();
    include "config-admin.php";
    if(isset($_SESSION['username']) && isset($_SESSION['role'])){
    do {
        if (isset($_POST['mat_khau_cu']) && isset($_POST['mat_khau_moi']) && isset($_POST['xac_nhan_mat_khau_moi']) && isset($_POST['cap_nhat_mat_khau_admin'])) {

            function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }

            $mat_khau_cu = validate($_POST['mat_khau_cu']);
            $mat_khau_moi = validate($_POST['mat_khau_moi']);
            $xac_nhan_mat_khau_moi = validate($_POST['xac_nhan_mat_khau_moi']);

            $uppercase = preg_match('@[A-Z]@', $mat_khau_moi);
            $lowercase = preg_match('@[a-z]@', $mat_khau_moi);
            $number    = preg_match('@[0-9]@', $mat_khau_moi);
            
            if(empty($mat_khau_cu) AND empty($mat_khau_moi) AND empty($xac_nhan_mat_khau_moi)){
                echo "4";
                break;

            } else if(empty($mat_khau_cu)){
                echo "1";
                break;

            } else if(empty($mat_khau_moi)) {
                echo "2";
                break;

            } else if($mat_khau_cu == $mat_khau_moi) {
                echo "7";
                break;

            } else if(!$uppercase || !$lowercase || !$number || strlen($mat_khau_moi) < 8) {
                echo "8";
                break;

            } else if(empty($xac_nhan_mat_khau_moi)) {
                echo "3";
                break;

            

            }else if($mat_khau_moi !== $xac_nhan_mat_khau_moi){
                echo "6";
                break;

            } else {
                // hashing the password
                $mat_khau_cu = md5($mat_khau_cu);
                $mat_khau_moi = md5($mat_khau_moi);
                $username = $_SESSION['username'];

                $sql = "SELECT password
                        FROM users WHERE 
                        username='$username' AND password='$mat_khau_cu'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) === 1){
                    
                    $sql_2 = "UPDATE users
                            SET password='$mat_khau_moi'
                            WHERE username='$username'";
                    mysqli_query($conn, $sql_2);
                    echo "10";
                    break;

                }else {
                    echo "5";
                    break;
                }

            }

            
        }else{
            header("Location: /admin");
            exit();
        }
    }
    while(false);
    }else{
        header("Location: /dang-nhap");
        exit();
}
