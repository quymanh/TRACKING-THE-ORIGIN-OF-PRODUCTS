<?php
session_start();
include "config-admin.php";
do {
    function vn_to_str($str)
    {
        $unicode = array(

            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',

            'd' => 'đ',

            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',

            'i' => 'í|ì|ỉ|ĩ|ị',

            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',

            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',

            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',

            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',

            'D' => 'Đ',

            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',

            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',

            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',

            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',

            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',

        );

        foreach ($unicode as $nonUnicode => $uni) {

            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ', '_', $str);

        return $str;
    }

    if ($_SESSION['role'] == '1' || $_SESSION['role'] == '0') {

        if (isset($_POST['submit_them_bai_viet_big'])) {
            if ($_POST['ten_bai_viet'] == '') {
                echo "1";
                break;
            }
            $old_id = $_REQUEST["mbv"];
            $url = $_POST['ten_bai_viet'];
            if ($_POST['nd_bai_viet'] == '') {
                echo "4";
                break;
            }

            $statement_check = $pdo->prepare("SELECT * FROM posts WHERE id_posts =?");
            $statement_check->execute(array($old_id));
            $total_check = $statement_check->rowCount();
            $resul_baiviet = $statement_check->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resul_baiviet as $row_baiviet) {
                $thumbnail_old = $row_baiviet['thumbnail'];
            }

            $check_thumbnail = mysqli_query($conn, "SELECT * FROM posts WHERE id_posts = '$old_id'");
            $row2 = mysqli_fetch_array($check_thumbnail, MYSQLI_ASSOC);

            if ($_POST['new_thumbnail'] == '' && $row2['thumbnail'] == '') {
                echo "6";
                break;
            } else {
                $path_anh_thumbnail = $_FILES['new_thumbnail']['name'];
                $path_tmp_anh_thumbnail = $_FILES['new_thumbnail']['tmp_name'];
                $ext_anh_thumbnail = pathinfo($path_anh_thumbnail, PATHINFO_EXTENSION);
                $file_name_anh_thumbnail = basename($path_anh_thumbnail, '.' . $ext_anh_thumbnail);
                $folder_path = $_SERVER['DOCUMENT_ROOT'] . '/img/blog/';

                $new_url = vn_to_str(preg_replace('~[\\\\/:*?"<>|_" ]~', '-', $_POST["ten_bai_viet"]));
                $file_name_anh_web_final = $new_url . '.' . $ext_anh_thumbnail;

                $date = date('d-m-Y | H:i A');

                if ($path_anh_thumbnail !== '') {
                    unlink($folder_path . $thumbnail_old);
                    move_uploaded_file($path_tmp_anh_thumbnail, $folder_path . $file_name_anh_web_final);
                    $statement_insert_mn2 = $pdo->prepare("UPDATE posts SET posts_name=?, noi_dung=?, url=?, date=?, thumbnail=? WHERE id_posts =? ");
                    $statement_insert_mn2->execute(array($_POST['ten_bai_viet'], $_POST['nd_bai_viet'], $new_url, $date, $file_name_anh_web_final, $_REQUEST["mbv"]));
                }
                if ($path_anh_thumbnail == '') {
                    $statement_insert_mn2 = $pdo->prepare("UPDATE posts SET posts_name=?, noi_dung=?, url=?, date=? WHERE id_posts =? ");
                    $statement_insert_mn2->execute(array($_POST['ten_bai_viet'], $_POST['nd_bai_viet'], $new_url, $date, $_REQUEST["mbv"]));
                }
                echo "10";
            }
        }
    } else {
        header("Location: /dang-nhap");
    }
} while (false);
