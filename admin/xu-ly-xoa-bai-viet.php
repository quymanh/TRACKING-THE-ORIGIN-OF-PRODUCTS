<?php 
    session_start();
    include "config-admin.php";
    do {
        if ($_SESSION['role'] == '1' || $_SESSION['role'] == '0') {
            
                if (isset($_POST['action']) && $_POST['action'] == 'delete') {

                    $statement_unlink = $pdo->prepare("SELECT * FROM posts WHERE id_posts =?");
                    $statement_unlink->execute(array($_POST['id_baiviet']));
                    $result_unlink = $statement_unlink->fetchAll(PDO::FETCH_ASSOC);							
                    foreach ($result_unlink as $row_unlink) {
                        if ($row_unlink !== '') {
                            unlink($_SERVER['DOCUMENT_ROOT'] .'/assets/img/bai-viet/'.$row_unlink['thumbnail']);
                        }
                    }
                    $statement_dlt_xnhs = $pdo->prepare("DELETE FROM posts WHERE id_posts=?");
                    $statement_dlt_xnhs->execute(array($_POST['id_baiviet']));
                    echo "10";
                }
        } else {
            header("Location: /");
        } 
    } while (false);
?>