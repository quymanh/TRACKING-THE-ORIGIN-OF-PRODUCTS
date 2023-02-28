<?php 
    session_start();
    do {
        function vn_to_str ($str){
            $unicode = array(
                
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
                
            'd'=>'đ',
                
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                
            'i'=>'í|ì|ỉ|ĩ|ị',
                
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
                
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                
            'D'=>'Đ',
                
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
                
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
                
            );
                
            foreach($unicode as $nonUnicode=>$uni){
                
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
                
            }
            $str = str_replace(' ','_',$str);
                
            return $str;
        }
        if (isset($_SESSION['role']) || $_SESSION['role'] == 0 || $_SESSION['role'] == 1 && isset($_POST['img'])) {
                $path_img_product = $_FILES['img']['name'];
                $path_tmp_img_product = $_FILES['img']['tmp_name'];
                $ext_img_product = pathinfo( $path_img_product, PATHINFO_EXTENSION );
                $file_name_img_product = basename( $_POST['ten_product'], '.' . $ext_img_product );
                $folder_path = $_SERVER['DOCUMENT_ROOT'].'/img/Product/'; 
            
                if( $path_img_product !== '' && $ext_img_product !='jpg' && $ext_img_product !='png' && $ext_img_product !='jpeg' && $ext_img_product !='gif' && $ext_img_product !='JPG' && $ext_img_product !='PNG' && $ext_img_product !='JPEG' && $ext_img_product !='GIF' && $ext_img_product !='WEBP' ) {
                    echo "2";
                    break;
                }
                else {
                    
                    $new_name_img = vn_to_str(preg_replace('~[\\\\/:*?"<>|_" ]~', '-', $file_name_img_product));
                    $file_name_anh_web_final = $new_name_img.'.'.$ext_img_product;

                    move_uploaded_file( $path_tmp_img_product,$folder_path.$file_name_anh_web_final);
                    echo $file_name_anh_web_final;
                }
                
        } else {
            header("Location: index.php");
        } 
    } while (false);
