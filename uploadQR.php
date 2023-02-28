<?php
session_start();
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
    if (isset($_SESSION['role']) || $_SESSION['role'] == 0 || $_SESSION['role'] == 1 && isset($_POST['qrious'])) {
        $new_name_img = vn_to_str(preg_replace('~[\\\\/:*?"<>|_" ]~', '-', $_POST['nameProduct'] . '-QRCode-' . $_POST['idProduct'] . '.png'));
        echo $new_name_img;
        list($type, $_POST['qrious']) = explode(';', $_POST['qrious']);
        list(, $_POST['qrious'])      = explode(',', $_POST['qrious']);
        $_POST['qrious'] = base64_decode($_POST['qrious']);

        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/img/QRProduct/' . $new_name_img, $_POST['qrious']);
    } else {
        header("Location: index.php");
    }
} while (false);
